<?php

namespace spec\MindTools\TestApp\Form;

use MindTools\TestApp\Form\Validator\RegistrationFormValidator;
use MindTools\TestApp\Model\User;
use MindTools\TestApp\User\UserManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RegistrationFormHandlerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MindTools\TestApp\Form\RegistrationFormHandler');
    }

    function let(UserManager $userManager, RegistrationFormValidator $validator)
    {
        $this->beConstructedWith($userManager, $validator);
    }

    function it_handles_a_registration_form_post(UserManager $userManager, RegistrationFormValidator $validator, User $user)
    {
        $post = array(
            'name' => 'Gez Page',
            'email' => 'gezpage@test.com',
            'username' => 'gez',
            'password' => 'password',
            'password_confirm' => 'password',
        );

        $validator->validate($post)
            ->shouldBeCalled();

        $userManager->createUser($post['username'], $post['name'], $post['email'], $post['password'])
            ->shouldBeCalled()
            ->willReturn($user);

        $this->handle($post)->shouldReturn($user);
    }
}
