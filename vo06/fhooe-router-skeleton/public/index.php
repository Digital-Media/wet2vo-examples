<?php

declare(strict_types=1);

use Fhooe\Latte\RouterExtension;
use Fhooe\Latte\SessionExtension;
use Fhooe\Router\Router;
use Latte\Engine;
use Latte\Loaders\FileLoader;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\PsrLogMessageProcessor;

require "../vendor/autoload.php";

/**
 * When working with sessions, start them here.
 */
//session_start();

/**
 * Instantiated Router invocation. Create an object, define the routes, and run it.
 */
// Create a monolog instance for logging in the skeleton.
$logger = new Logger("skeleton-logger");
$logger->pushProcessor(new PsrLogMessageProcessor());
$formatter = new LineFormatter(
    "[%datetime%] %channel%.%level_name%: %message%\n",
    "d.m.Y H:i:s T",
    true,
    true,
);
$handler = new StreamHandler(__DIR__ . "/../logs/router.log");
$handler->setFormatter($formatter);
$logger->pushHandler($handler);

// Create a new Router object with the logger.
$router = new Router($logger);

// Create a new Latte instance for advanced templates.
$latte = new Engine();
$latte->setLoader(new FileLoader(__DIR__ . "/../views"));
$latte->setCacheDirectory(__DIR__ . "/../cache");
$latte->addExtension(new RouterExtension($router));
$latte->addExtension(new SessionExtension());

// Set a base path if your code is not in your server's document root.
$router->basePath = "/wet2vo-examples/vo06/fhooe-router-skeleton/public";

// Set a 404 callback executed when no route matches.
// Example for the use of an arrow function. It automatically includes variables from the parent scope (such as $latte).
$router->set404Callback(fn() => $latte->render("404.latte"));

// Define all routes here.
$router->get("/", function () use ($latte) {
    $latte->render("index.latte");
});

$router->get("/form", function () {
    require __DIR__ . "/../views/form.php";
});

$router->post("/form", function () {
    require __DIR__ . "/../views/form.php";
});

$router->get("/templateform", function () use ($latte) {
    $latte->render("templateform.latte");
});

$router->post("/templateformresult", function () use ($latte) {
    $latte->render(
        "templateformresult.latte",
        ["nameInput" => $_POST["nameInput"]],
    );
});

$router->get("/product/{id}[/]", function ($id) use ($latte) {
    $latte->render("product.latte", ["id" => $id]);
});

$router->get("/staticpage", function () {
    require __DIR__ . "/../views/staticpage.html";
});

// Run the router to get the party started.
$router->run();