<?php

namespace MindTools\TestApp\Form;

use MindTools\TestApp\Form\Validator\FormValidationException;

/**
 * Class RegistrationForm
 * @package MindTools\TestApp\Form
 */
class RegistrationForm
{
    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * @var RegistrationFormHandler
     */
    protected $handler;

    /**
     * @param \Twig_Environment       $twig
     * @param RegistrationFormHandler $handler
     */
    public function __construct(\Twig_Environment $twig, RegistrationFormHandler $handler)
    {
        $this->twig = $twig;
        $this->handler = $handler;
    }

    /**
     * @param array $post
     * @param array $validationErrors
     *
     * @return string
     */
    public function makeForm(array $post = array(), array $validationErrors = array())
    {
        return $this->twig->render('registration_form.html.twig', array(
            'post' => $post,
            'errors' => $validationErrors,
        ));
    }

    public function handleFormPost(array $post)
    {
        try {

            // Handle the registration should create a user and return a User object
            $user = $this->handler->handle($post);

            return $this->twig->render('registration_form_complete.html.twig', array(
                'user' => $user,
            ));

        } catch (FormValidationException $e) {

            // Form validation errors should cause the registration form to reappear with errors array
            return $this->makeForm($post, $e->getValidationErrors());
        }
    }
}
