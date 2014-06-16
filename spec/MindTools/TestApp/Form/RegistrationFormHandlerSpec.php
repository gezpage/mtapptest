<?php

namespace spec\MindTools\TestApp\Form;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RegistrationFormHandlerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MindTools\TestApp\Form\RegistrationFormHandler');
    }

    function it_handles_a_registration_form_post()
    {
        $post = array(
            'name' => 'Gez Page',
            'email' => 'gezpage@test.com',
            'username' => 'gez',
            'password' => 'password',
        );
        $this->handle($post);
    }
}
