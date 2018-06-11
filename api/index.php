<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require 'src/config/db.php';

$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
});

// Routes
require 'src/routes/login.php';
require 'src/routes/classes.php';
require 'src/routes/exceptions.php';
require 'src/routes/profile.php';
require 'src/routes/registration.php';
require 'src/routes/rooms.php';
require 'src/routes/teachers.php';

$app->run();

