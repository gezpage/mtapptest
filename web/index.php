<?php

umask(0002);

require_once __DIR__.'/../vendor/autoload.php';
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$route = new Route('/index.php/foo', array('controller' => 'MyController'));
$routes = new RouteCollection();
$routes->add('route_name', $route);

$context = new RequestContext($_SERVER['REQUEST_URI']);

$matcher = new UrlMatcher($routes, $context);

$parameters = $matcher->match('/foo');
// array('controller' => 'MyController', '_route' => 'route_name')

exit;

?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

<div>
    <form role="form">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Enter username">
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="password_confirm">Password</label>
            <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>

</div>
