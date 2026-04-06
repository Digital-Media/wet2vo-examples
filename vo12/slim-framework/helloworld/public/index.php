<?php

use Slim\Factory\AppFactory;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

require "../vendor/autoload.php";

$app = AppFactory::create();

$app->setBasePath("/hyp2vo-t1-examples/vl11/slim-framework/helloworld/public");

$app->get(
    "/",
    function (Request $request, Response $response, array $args) {
        $response->getBody()->write("Hello world!");
        return $response;
    }
);

$app->run();