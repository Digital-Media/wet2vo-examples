<?php

declare(strict_types=1);

use Fhooe\Router\Router;
use Fhooe\Twig\RouterExtension;
use Fhooe\Twig\SessionExtension;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\PsrLogMessageProcessor;
use RestApiExample\CreateDB;
use RestApiExample\UserManager;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

require "../vendor/autoload.php";

/**
 * When working with sessions, start them here.
 */
//session_start();

/**
 * Instantiated Router invocation. Create an object, define the routes and run it.
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

// Create a new Twig instance for advanced templates.
$twig = new Environment(
    new FilesystemLoader("../views"),
    [
        "cache" => "../cache",
        "auto_reload" => true,
        "debug" => true,
    ],
);

// Add the router extension to Twig. This makes the url_for() and get_base_path() functions available in templates.
$twig->addExtension(new RouterExtension($router));
// Add the session extension to Twig. This makes the session() function available in templates to access entries in $_SESSION.
$twig->addExtension(new SessionExtension());
// Add the debug extension to Twig. This makes the dump() function available in templates to dump variables.
$twig->addExtension(new DebugExtension());

// Set a base path if your code is not in your server's document root.
$router->setBasePath("/hyp2vo-t1-examples/vl10/rest-api/public");

// Set a 404 callback that is executed when no route matches.
// Example for the use of an arrow function. It automatically includes variables from the parent scope (such as $twig).
$router->set404Callback(fn() => $twig->display("404.html.twig"));

// Define all routes here.
$router->get("/", function () use ($twig) {
    $twig->display("index.html.twig");
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

$router->get("/adduser", function () use ($twig) {
    $twig->display("adduser.html.twig");
});

$router->get("/createdb", function () use ($twig) {
    $createDB = new CreateDB($twig);
    $createDB->createSchema();
    $createDB->createTable();
    $createDB->addUsers();
    $createDB->displayOutput();
});

// Run the router to get the party started.
$router->run();