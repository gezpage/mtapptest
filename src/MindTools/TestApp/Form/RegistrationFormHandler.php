<?php

namespace MindTools\TestApp\Form;

use MindTools\TestApp\Form\Validator\RegistrationFormValidator;
use MindTools\TestApp\User\UserManager;

class RegistrationFormHandler
{
    protected $userManager;

    protected $validator;

    public function __construct(UserManager $userManager, RegistrationFormValidator $validator)
    {
        $this->userManager = $userManager;
        $this->validator = $validator;
    }

    public function handle(array $post)
    {
        $this->validatePostData($post);

        return $this->userManager->createUser(
            $post['username'],
            $post['name'],
            $post['email'],
            $post['password']
        );
    }

    protected function validatePostData(array $post)
    {
        $this->validator->validate($post);
    }
}
