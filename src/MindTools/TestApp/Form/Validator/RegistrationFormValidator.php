<?php

namespace MindTools\TestApp\Form\Validator;

class RegistrationFormValidator
{
    protected $errors = array();

    public function validate(array $post)
    {
        $this->validateFields($post);
        $this->validateUsername($post['username']);
        $this->validatePassword($post['password']);

        if (count($this->errors) > 0) {
            $exception = new FormValidationException('Form validation failed');
            $exception->setValidationErrors($this->errors);

            throw $exception;
        }

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
            $this->validationError('Username must be at least 4 characters', 'username');
        }
        if (1 === preg_match('/^[A-Z]*$/', $username)) {
            $this->validationError('Username cannot contain uppercase letters', 'username');
        }
        if (0 === preg_match('/^[a-zA-Z0-9_]*$/', $username)) {
            $this->validationError('Username cannot contain uppercase letters', 'username');
        }
    }

    protected function validatePassword($password)
    {
        if (strlen($password) < 8) {
            $this->validationError('Password must be at least 8 characters', 'password');
        }
        if (0 === preg_match('/[0-9]/', $password)) {
            $this->validationError('Password must have at least one numeric character.', 'password');
        }
        if (0 === preg_match('/[A-Z]/', $password)) {
            $this->validationError('Password must have at least one uppercase letter.', 'password');
        }
    }

    protected function validationError($message, $field = null)
    {
        if (null === $field) {
            $this->errors['other'] = $message;
        } else {
            $this->errors[$field] = $message;
        }
    }
}
