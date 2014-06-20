<?php

namespace spec\MindTools\TestApp\User\Verification;

use MindTools\TestApp\Email\EmailSender;
use MindTools\TestApp\Model\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EmailVerificationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MindTools\TestApp\User\Verification\EmailVerification');
    }

    function let(EmailSender $mailer, \Twig_Environment $twig)
    {
        $this->beConstructedWith($mailer, $twig, 'url');
    }

    function it_should_throw_exception_if_user_is_not_awaiting_verification(User $user)
    {
        $user->getStatus()->willReturn(USER::STATUS_ENABLED);
        $this->shouldThrow('\Exception')->duringSendVerification($user);
    }

    function it_should_send_email_verification_for_a_user(User $user, EmailSender $mailer, \Twig_Environment $twig)
    {
        $user->getEmail()->willReturn('gezpage@test.com');
        $user->getName()->willReturn('Gez Page');
        $user->getVerificationCode()->willReturn('code');
        $user->getStatus()->willReturn(User::STATUS_AWAITING_VERIFICATION);

        $twig->render(Argument::type('string'), Argument::type('array'))
            ->willReturn('body');

        $mailer->setFrom(array('admin@test.com'=>'Administrator'))->shouldBeCalled();
        $mailer->setTo(array('gezpage@test.com'=>'Gez Page'))->shouldBeCalled();
        $mailer->setSubject('Account Verification')->shouldBeCalled();
        $mailer->setBody('body')->shouldBeCalled();
        $mailer->send()->shouldBeCalled();

        $this->sendVerification($user);
    }

}
