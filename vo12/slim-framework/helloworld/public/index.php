<?php

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require __DIR__ . "/../vendor/autoload.php";

$app = AppFactory::create();

$app->setBasePath("/wet2vo-examples/vo12/slim-framework/helloworld/public");
$app->addErrorMiddleware(true, false, false);

$app->get("/", function (Request $request, Response $response, array $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});

$app->run();