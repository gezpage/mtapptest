<?php

/**
* Register page
*/
$app->get('/register', function () use ($app) {
    return $app['registration_form']->makeForm();
});

/**
* Login page
*/
$app->get('/login', function () use ($app) {
    return 'Login ';
});

/**
* Secure area page
*/
$app->get('/secure', function () use ($app) {
    return 'Secure area ';
});
