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
use RestApiExample\CreateDB;
use RestApiExample\UserManager;

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
$router->basePath = "/wet2vo-examples/vo11/rest-api/public";

// Set a 404 callback executed when no route matches.
// Example for the use of an arrow function. It automatically includes variables from the parent scope (such as $latte).
$router->set404Callback(fn() => $latte->render("404.latte"));

// Define all routes here.
$router->get("/", function () use ($latte) {
    $latte->render("index.latte");
});

$router->get("/users", function () {
    $userManager = new UserManager();
    $userManager->listUsers();
});

$router->get("/users/{id}", function ($id) {
    $userManager = new UserManager();
    $userManager->listUser($id);
});

$router->post("/users", function () {
    $userManager = new UserManager();
    $userManager->addUser();
});

$router->get("/adduser", function () use ($latte) {
    $latte->render("adduser.latte");
});

$router->get("/createdb", function () use ($latte) {
    $createDB = new CreateDB($latte);
    $createDB->createSchema();
    $createDB->createTable();
    $createDB->addUsers();
    $createDB->displayOutput();
});

// Run the router to get the party started.
$router->run();