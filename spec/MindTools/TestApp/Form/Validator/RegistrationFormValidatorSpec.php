<?php

namespace spec\MindTools\TestApp\Form\Validator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RegistrationFormValidatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MindTools\TestApp\Form\Validator\RegistrationFormValidator');
    }

    function it_should_validate_a_registration_form_post()
    {
        $post = $this->makeValidPostArray();

        $this->validate($post)->shouldReturn(true);
    }

    function it_should_throw_validation_exception_if_passwords_do_not_match()
    {
        $post = $this->makeValidPostArray();
        $post['password_confirm'] = 'Au43kl231111';

        $this->shouldThrow('MindTools\TestApp\Form\Validator\FormValidationException')->duringValidate($post);
    }

    function it_should_throw_validation_exception_if_fields_are_missing()
    {
        foreach (array('username', 'name', 'email', 'password', 'password_confirm') as $field) {
            $post = $this->makeValidPostArray();
            unset($post[$field]);

            $this->shouldThrow('MindTools\TestApp\Form\Validator\FormValidationException')->duringValidate($post);
        }
    }

    function it_should_throw_validation_exception_if_any_field_has_no_value()
    {
        foreach (array('username', 'name', 'email', 'password') as $field) {
            $post = $this->makeValidPostArray();
            $post[$field] = '';

            $this->shouldThrow('MindTools\TestApp\Form\Validator\FormValidationException')->duringValidate($post);
        }
    }

    function it_should_throw_validation_exception_if_username_is_less_than_four_chars()
    {
        $post = $this->makeValidPostArray();
        $post['username'] = 'gez';

        $this->shouldThrow('MindTools\TestApp\Form\Validator\FormValidationException')->duringValidate($post);
    }

    function it_should_throw_validation_exception_if_username_has_uppercase_letters()
    {
        $post = $this->makeValidPostArray();
        $post['username'] = 'GEZPAGE';

        $this->shouldThrow('MindTools\TestApp\Form\Validator\FormValidationException')->duringValidate($post);
    }

    function it_should_throw_validation_exception_if_username_has_invalid_chars()
    {
        $post = $this->makeValidPostArray();
        $post['username'] = 'gez$$$';

        $this->shouldThrow('MindTools\TestApp\Form\Validator\FormValidationException')->duringValidate($post);
    }

    function it_should_throw_validation_exception_if_password_is_less_than_eight_characters()
    {
        $post = $this->makeValidPostArray();
        $post['password'] = '1234567';

        $this->shouldThrow('MindTools\TestApp\Form\Validator\FormValidationException')->duringValidate($post);
    }

    function it_should_throw_validation_exception_if_password_has_no_numbers()
    {
        $post = $this->makeValidPostArray();
        $post['password'] = 'password';

        $this->shouldThrow('MindTools\TestApp\Form\Validator\FormValidationException')->duringValidate($post);
    }

    function it_should_throw_validation_exception_if_password_has_no_uppercase_letters()
    {
        $post = $this->makeValidPostArray();
        $post['password'] = 'au43kl23';

        $this->shouldThrow('MindTools\TestApp\Form\Validator\FormValidationException')->duringValidate($post);
    }

    protected function makeValidPostArray()
    {
        $post = array(
            'name' => 'Gez Page',
            'email' => 'gezpage@test.com',
            'username' => 'gezpage',
            'password' => 'Au43kl23',
            'password_confirm' => 'Au43kl23',
        );

        return $post;
    }
}
