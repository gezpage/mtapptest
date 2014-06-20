<?php

namespace spec\MindTools\TestApp\Email;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EmailSenderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MindTools\TestApp\Email\EmailSender');
    }

    function let(\Swift_Mailer $mailer)
    {
        $this->beConstructedWith($mailer);
    }

    function it_should_send_an_email_using_swiftmailer(\Swift_Mailer $mailer)
    {
        $mailer->send(Argument::type('\Swift_Message'))
            ->shouldBeCalled();

        $this->setSubject('Subject');
        $this->setFrom(array('gezpage@test.com'));
        $this->setTo(array('gezpage@test.com'));
        $this->setBody('Email body');
        $this->send();
    }
}
