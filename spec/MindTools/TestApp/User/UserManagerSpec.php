<?php

namespace spec\MindTools\TestApp\User;

use MindTools\TestApp\User\HasherInterface;
use MindTools\TestApp\User\Storage\StorageInterface;
use MindTools\TestApp\User\Verification\EmailVerification;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use MindTools\TestApp\Model\User;

class UserManagerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MindTools\TestApp\User\UserManager');
    }

    function let(StorageInterface $storage, EmailVerification $verifier, HasherInterface $hasher)
    {
        $this->beConstructedWith($storage, $verifier, $hasher);
    }

    function it_should_create_a_user_and_send_verification_email(StorageInterface $storage, User $user, EmailVerification $verifier, HasherInterface $hasher)
    {
        $hasher->hash('password')
            ->willReturn('hash');

        $storage->createUser('gez', 'Gez Page', 'gezpage@test.com', 'hash')
            ->shouldBeCalled()
            ->willReturn($user);

        $verifier->sendVerification($user)
            ->shouldBeCalled();

        $this->createUser('gez', 'Gez Page', 'gezpage@test.com', 'password')
            ->shouldReturn($user);
    }

    function it_should_confirm_verification(StorageInterface $storage, User $user)
    {
        $code = 'tejsakltjeklagjlak';

        $storage->findUserByVerificationCode($code)
            ->willReturn($user);

        $user->getStatus()
            ->willReturn(USER::STATUS_AWAITING_VERIFICATION);

        $user->setStatus(USER::STATUS_ENABLED)
            ->shouldBeCalled();

        $storage->updateUser($user)
            ->shouldBeCalled();

        $this->verifyUser($code);
    }

    function it_should_fail_verification_if_user_is_not_awaiting_verification(StorageInterface $storage, User $user)
    {
        $code = 'tejsakltjeklagjlak';

        $storage->findUserByVerificationCode($code)
            ->willReturn($user);

        $user->getStatus()
            ->shouldBeCalled()
            ->willReturn(USER::STATUS_DISABLED);

        $this->shouldThrow('MindTools\TestApp\User\Verification\VerificationException')->duringVerifyUser($code);
    }

    function it_should_login_a_user(StorageInterface $storage, User $user, HasherInterface $hasher)
    {
        $username = 'gez';
        $password = 'password';
        $hash = 'hash';

        $storage->findUser($username)
            ->willReturn($user);

        $user->getPasswordHash()
            ->willReturn($hash);

        $hasher->verify($password, $hash)
            ->willReturn(true);

        $this->login($username, $password)->shouldReturn($user);
    }

    function it_should_throw_exception_if_username_not_found(StorageInterface $storage)
    {
        $username = 'gez';

        $storage->findUser($username)
            ->willReturn(null);

        $this->shouldThrow('MindTools\TestApp\User\LoginException')->duringLogin($username, 'password');
    }

    function it_should_throw_exception_if_password_is_incorrect(StorageInterface $storage, User $user, HasherInterface $hasher)
    {
        $username = 'gez';
        $password = 'password';
        $hash = 'hash';

        $storage->findUser($username)
            ->willReturn($user);

        $user->getPasswordHash()
            ->willReturn($hash);

        $hasher->verify($password, $hash)
            ->willReturn(false);

        $this->shouldThrow('MindTools\TestApp\User\LoginException')->duringLogin($username, $password);
    }
}
