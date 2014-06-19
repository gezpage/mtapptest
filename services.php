<?php

use MindTools\TestApp\Form\RegistrationFormHandler;
use MindTools\TestApp\Form\Validator\RegistrationFormValidator;
use MindTools\TestApp\User\UserManager;

/**
 * 3rd party dependencies
 */

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'    => 'pdo_mysql',
        'host'      => 'localhost',
        'dbname'    => 'mindtools',
        'user'      => 'root',
        'password'  => 'docker',
        'charset'   => 'utf8',
    ),
));

$app->register(new Silex\Provider\SwiftmailerServiceProvider(), array(
    'host' => '127.0.0.1',
    'port' => '25',
    'username' => null,
    'password' => null,
    'encryption' => null,
    'auth_mode' => null
));

/**
 * Project (user) dependencies
 */

$app['user_storage'] = $app->share(function($app) {
    return new MindTools\TestApp\User\Storage\MysqlStorage($app['db']);
});

$app['user_manager'] = $app->share(function($app) {
    return new UserManager($app['user_storage']);
});

$app['registration_form_validator'] = $app->share(function() {
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
