<?php

namespace MindTools\TestApp\User;

use MindTools\TestApp\User\Storage\StorageInterface;
use MindTools\TestApp\Model\User;
use MindTools\TestApp\User\Verification\EmailVerification;
use MindTools\TestApp\User\Verification\VerificationException;

/**
 * Class UserManager
 *
 * @package MindTools\TestApp\User
 */
class UserManager
{
    /** @var Storage\StorageInterface */
    protected $storage;

    /**
     * @var Verification\EmailVerification
     */
    protected $verifier;

    /**
     * @var HasherInterface
     */
    protected $hasher;

    /**
     * @param StorageInterface  $storage
     * @param EmailVerification $verifier
     * @param HasherInterface   $hasher
     */
    public function __construct(StorageInterface $storage, EmailVerification $verifier, HasherInterface $hasher)
    {
        $this->storage = $storage;
        $this->verifier = $verifier;
        $this->hasher = $hasher;
    }

    /**
     * @param string $username
     * @param string $name
     * @param string $email
     * @param string $password
     *
     * @return User
     */
    public function createUser($username, $name, $email, $password)
    {
        // Create a hash of the password
        $hash = $this->hasher->hash($password);

        // Create the user and persist it to the database
        $user = $this->storage->createUser($username, $name, $email, $hash);

        // Send email for verification
        $this->verifier->sendVerification($user);

        return $user;
    }

    /**
     * @param $verificationCode
     *
     * @return User
     *
     * @throws Verification\VerificationException
     */
    public function verifyUser($verificationCode)
    {
        $user = $this->storage->findUserByVerificationCode($verificationCode);
        if (!$user instanceof User) {
            throw new VerificationException('Unable to find user - verification failed');
        }

        if (USER::STATUS_AWAITING_VERIFICATION !== $user->getStatus()) {
            throw new VerificationException('User is not awaiting verification - verification failed');
        }

        $user->setStatus(USER::STATUS_ENABLED);
        $this->storage->updateUser($user);

        return $user;
    }

    /**
     * @param string $username
     * @param string $password
     *
     * @return User
     *
     * @throws LoginException
     */
    public function login($username, $password)
    {
        $user = $this->storage->findUser($username);
        if (!$user instanceof User) {
            throw new LoginException('Invalid username');
        }

        if (false === $this->hasher->verify($password, $user->getPasswordHash())) {
            throw new LoginException('Password incorrect');
        }

        return $user;
    }
}
