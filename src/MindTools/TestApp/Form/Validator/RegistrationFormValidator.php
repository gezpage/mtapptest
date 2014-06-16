<?php

namespace MindTools\TestApp\Form\Validator;

class RegistrationFormValidator
{
    public function validate(array $post)
    {
        $this->validateFields($post);
        $this->validateUsername($post['username']);
        $this->validatePassword($post['password']);

        return true;
    }

    protected function validateFields(array $post)
    {
        foreach (array('username', 'name', 'email', 'password') as $field) {
            if (false === isset($post[$field]) || true === empty($post[$field])) {
                throw new FormValidationException('Invalid form post, missing post data.');
            }
        }
    }

    protected function validateUsername($username)
    {
        if (strlen($username) < 4) {
            throw new FormValidationException('Username must be at least 4 characters');
        }
        if (1 === preg_match('/^[A-Z]*$/', $username)) {
            throw new FormValidationException('Username cannot contain uppercase letters');
        }
        if (0 === preg_match('/^[a-zA-Z0-9_]*$/', $username)) {
            throw new FormValidationException('Username cannot contain uppercase letters');
        }
    }

    protected function validatePassword($password)
    {
        if (strlen($password) < 8) {
            throw new FormValidationException('Password must be at least 8 characters');
        }
        if (0 === preg_match('/[0-9]/', $password)) {
            throw new FormValidationException('Password must have at least one numeric character.');
        }
        if (0 === preg_match('/[A-Z]/', $password)) {
            throw new FormValidationException('Password must have at least one uppercase letter.');
        }
    }
}
