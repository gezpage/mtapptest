<?php

// Twig template engine
use MindTools\TestApp\Form\RegistrationFormHandler;
use MindTools\TestApp\Form\Validator\RegistrationFormValidator;
use MindTools\TestApp\User\UserManager;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

$app['user_storage'] = $app->share(function($app) {
    return new MindTools\TestApp\User\Storage\MysqlStorage();
});

$app['user_manager'] = $app->share(function($app) {
    return new UserManager($app['user_storage']);
});

$app['registration_form_validator'] = $app->share(function($app) {
    return new RegistrationFormValidator();
});

// Registration form handler
$app['registration_form_handler'] = $app->share(function($app) {
    return new RegistrationFormHandler($app['user_manager'], $app['registration_form_validator']);
});

// Registration form
$app['registration_form'] = $app->share(function($app) {
    return new MindTools\TestApp\Form\RegistrationForm($app['twig'], $app['registration_form_handler']);
});
