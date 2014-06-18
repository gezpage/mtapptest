<?php

namespace MindTools\TestApp\Form;

class RegistrationForm
{
    protected $twig;

    protected $handler;

    public function __construct(\Twig_Environment $twig, RegistrationFormHandler $handler)
    {
        $this->twig = $twig;
        $this->handler = $handler;
    }

    public function makeForm()
    {
        return $this->twig->render('registration_form.html.twig');
    }

    public function handleFormPost()
    {
        $user = $this->handler->handle($_POST);

        return $this->twig->render('registration_form_complete.html.twig', array(
            'user' => $user,
        ));
    }
}
