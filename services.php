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
        'user'      => 'mindtools',
        'password'  => 'mtpw9900',
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

$app['password_hasher'] = $app->share(function() {
    return new \MindTools\TestApp\User\PasswordHasher();
});

$app['email_sender'] = $app->share(function($app) {
    return new \MindTools\TestApp\Email\EmailSender($app['mailer']);
});

$app['email_verifier'] = $app->share(function($app) {
    return new \MindTools\TestApp\User\Verification\EmailVerification($app['email_sender'], $app['twig'], 'http://mttestapp.gezpage.com');
});

$app['user_storage'] = $app->share(function($app) {
    return new MindTools\TestApp\User\Storage\MysqlStorage($app['db']);
});

$app['user_manager'] = $app->share(function($app) {
    return new UserManager($app['user_storage'], $app['email_verifier'], $app['password_hasher']);
});

$app['registration_form_validator'] = $app->share(function() {
    return new RegistrationFormValidator();
});

$app['registration_form_handler'] = $app->share(function($app) {
    return new RegistrationFormHandler($app['user_manager'], $app['registration_form_validator']);
});

$app['registration_form'] = $app->share(function($app) {
    return new MindTools\TestApp\Form\RegistrationForm($app['twig'], $app['registration_form_handler']);
});
