<?php

namespace MindTools\TestApp\Form\Validator;

class RegistrationFormValidator
{
    protected $errors = array();

    public function validate(array $post)
    {
        // Preliminary check field keys exist and have values
        $this->validateFields($post);
        $this->checkValidation();

        // Field specific checks
        $this->validateUsername($post['username']);
        $this->validatePassword($post['password'], $post['password_confirm']);
        $this->checkValidation();

        return true;
    }

    protected function validateFields(array $post)
    {
        foreach (array('username', 'name', 'email', 'password', 'password_confirm') as $field) {
            if (false === isset($post[$field])) {
                $this->validationError('Field cannot be blank', $field);
            }
        }
        foreach (array('username', 'name', 'email', 'password', 'password_confirm') as $field) {
            if (true === empty($post[$field])) {
                $this->validationError('Field cannot be blank', $field);
            }
        }
    }

    protected function validateUsername($username)
    {
        if (strlen($username) < 4) {
            return $this->validationError('Username must be at least 4 characters', 'username');
        }
        if (1 === preg_match('/^[A-Z]*$/', $username)) {
            return $this->validationError('Username cannot contain uppercase letters', 'username');
        }
        if (0 === preg_match('/^[a-zA-Z0-9_]*$/', $username)) {
            return $this->validationError('Username cannot contain uppercase letters', 'username');
        }
    }

    protected function validatePassword($password, $passwordConfirmation)
    {
        if (strlen($password) < 8) {
            return $this->validationError('Password must be at least 8 characters', 'password');
        }
        if (0 === preg_match('/[0-9]/', $password)) {
            return $this->validationError('Password must have at least one numeric character.', 'password');
        }
        if (0 === preg_match('/[A-Z]/', $password)) {
            return $this->validationError('Password must have at least one uppercase letter.', 'password');
        }
        if ($password !== $passwordConfirmation) {
            return $this->validationError('Passwords must match', 'password_confirm');
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

    public function checkValidation()
    {
        if (count($this->errors) > 0) {
            $exception = new FormValidationException('Form validation failed.');
            $exception->setValidationErrors($this->errors);

            throw $exception;
        }
    }
}
