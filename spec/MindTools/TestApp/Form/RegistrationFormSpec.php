<?php

namespace spec\MindTools\TestApp\Form;

use MindTools\TestApp\Form\RegistrationFormHandler;
use MindTools\TestApp\Model\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RegistrationFormSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MindTools\TestApp\Form\RegistrationForm');
    }

    function let(\Twig_Environment $twig, RegistrationFormHandler $handler)
    {
        $this->beConstructedWith($twig, $handler);
    }

    function it_should_display_the_form_template(\Twig_Environment $twig)
    {
        $twig->render('registration_form.html.twig', Argument::type('array'))
            ->shouldBeCalled()
            ->willReturn('html');

        $this->makeForm()->shouldReturn('html');
    }

    function it_should_handle_the_form_post(\Twig_Environment $twig, RegistrationFormHandler $handler, User $user)
    {
        $post = array('post array');

        $handler->handle($post)
            ->shouldBeCalled()
            ->willReturn($user);

        $twig->render('registration_form_complete.html.twig', array('user'=>$user))
            ->shouldBeCalled()
            ->willReturn('html');

        $this->handleFormPost($post)->shouldReturn('html');
    }
}
