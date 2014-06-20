<?php

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
 * Login form post page
 */
$app->post('/login', function(\Symfony\Component\HttpFoundation\Request $request) use ($app) {
    $username = $request->get('username');
    $password = $request->get('password');
    try {

        $app['user_manager']->login($username, $password);

    } catch (\MindTools\TestApp\User\LoginException $e) {

        return $app['twig']->render('login.html.twig', array(
            'error' => $e->getMessage(),
        ));

    }

    return $app['twig']->render('logged_in_area.html.twig');
});

/**
* Register page
*/
$app->get('/register', function () use ($app) {
    return $app['registration_form']->makeForm();
});

/**
 * Register form post page
 */
$app->post('/register', function (\Symfony\Component\HttpFoundation\Request $request) use ($app) {

    $post = array(
        'name' => $request->get('name'),
        'username' => $request->get('username'),
        'email' => $request->get('email'),
        'password' => $request->get('password'),
        'password_confirm' => $request->get('password_confirm'),
    );

    $result = $app['registration_form']->handleFormPost($post);

    // True means the validation and account creation succeeded, redirect to success
    // page to avoid accidental form re-submissions
    if (true === $result) {
        return $app->redirect('/registration_complete');
    }

    return $result;
});

/**
 * Registration complete page
 */
$app->get('/registration_complete', function () use ($app) {
    return $app['twig']->render('registration_form_complete.html.twig');
});

/**
 * Account verification page
 */
$app->get('/verify', function (\Symfony\Component\HttpFoundation\Request $request) use ($app) {

    $code = $request->get('code');
    try {

        $app['user_manager']->verifyUser($code);

        // Redirect to avoid user page refresh causing errors
        return $app->redirect('/verification_success');

    } catch (\MindTools\TestApp\User\Verification\VerificationException $e) {

        // Show verification failure page
        return $app['twig']->render('account_verification_failure.html.twig');
    }

});

/**
 * Account verification success page
 */
$app->get('/verification_success', function () use ($app) {
    return $app['twig']->render('account_verification.html.twig');
});
