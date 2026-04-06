<?php

declare(strict_types=1);

use Fhooe\Router\Router;

require "vendor/autoload.php";

// 1. Create the Router object
$router = new Router();

// 2. Optional: set the base path if the application is in a subdirectory
$router->setBasePath("/hyp2vo-t1-examples/vl05/fhooe-router");

// 3. Define all the needed routes
$router->get("/", function () {
    require "views/main.php";
});

$router->get("/form", function () {
    require "views/form.php";
});

$router->post("/form", function () {
    require "views/form.php";
});

// 4. Define a 404 callback
$router->set404Callback(function () {
    require "views/404.html";
});

// 5. Start the routing mechanism
$router->run();