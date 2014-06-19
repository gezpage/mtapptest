<?php

$app->get('/email', function () use ($app) {

    $message = \Swift_Message::newInstance()
        ->setSubject('test email')
        ->setFrom(array('gezpage@gezpage.com'))
        ->setTo(array('gezpage@gmail.com'))
        ->setBody('message content....');

    $app['mailer']->send($message);

    return new \Symfony\Component\HttpFoundation\Response('Thank you for your feedback!', 201);
});

/**
 * Home page
 */
$app->get('/', function () use ($app) {
    return $app['twig']->render('home.html.twig');
});

/**
 * Login page
 */
$app->get('/login', function () use ($app) {
    return $app['twig']->render('login.html.twig');
});

/**
* Register page
*/
$app->get('/register', function () use ($app) {
    return $app['registration_form']->makeForm();
});

$app->post('/register', function (\Symfony\Component\HttpFoundation\Request $request) use ($app) {
    $post = array(
        'name' => $request->get('name'),
        'username' => $request->get('username'),
        'email' => $request->get('email'),
        'password' => $request->get('password'),
        'password_confirm' => $request->get('password_confirm'),
    );
    return $app['registration_form']->handleFormPost($post);
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
