<?php

namespace MindTools\TestApp\Form;

use MindTools\TestApp\Form\Validator\RegistrationFormValidator;
use MindTools\TestApp\User\UserManager;

/**
 * Class RegistrationFormHandler
 *
 * @package MindTools\TestApp\Form
 */
class RegistrationFormHandler
{
    /**
     * @var \MindTools\TestApp\User\UserManager
     */
    protected $userManager;

    /**
     * @var Validator\RegistrationFormValidator
     */
    protected $validator;

    /**
     * @param UserManager $userManager
     * @param RegistrationFormValidator $validator
     */
    public function __construct(UserManager $userManager, RegistrationFormValidator $validator)
    {
        $this->userManager = $userManager;
        $this->validator = $validator;
    }

    /**
     * @param array $post
     *
     * @return \MindTools\TestApp\Model\User
     */
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

    /**
     * @param array $post
     */
    protected function validatePostData(array $post)
    {
        $this->validator->validate($post);
    }
}
