<?php

use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

require "../vendor/autoload.php";

###################################
# Build container and definitions #
###################################
$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions(
    [
        "settings" => [
            "displayErrorDetails" => true,
            "logErrors" => true,
            "logErrorDetails" => true,
            "logger" => [
                "name" => "slimexample-logger",
                "path" => "../logs/app.log",
                "level" => Level::Debug,
            ],
            "view" => [
                "templates" => "../templates",
                "cache" => "../cache",
                "auto_reload" => true,
            ],
        ],
        LoggerInterface::class => function (ContainerInterface $container) {
            $settings = $container->get("settings");
            $loggerSettings = $settings["logger"];

            $logger = new Logger($loggerSettings["name"]);

            $fileHandler = new StreamHandler($loggerSettings["path"], $loggerSettings["level"]);
            $logger->pushHandler($fileHandler);

            return $logger;
        },
        "view" => function (ContainerInterface $container) {
            $settings = $container->get("settings");
            $viewSettings = $settings["view"];
            return Twig::create(
                $viewSettings["templates"],
                [
                    "cache" => $viewSettings["cache"],
                    "auto_reload" => $viewSettings["auto_reload"],
                ],
            );
        },
    ],
);

$container = $containerBuilder->build();
AppFactory::setContainer($container);

################################
# Create app and set base path #
################################
$app = AppFactory::create();

// Set the base path
$app->setBasePath("/hyp2vo-t1-examples/vl11/slim-framework/slimexample/public");

// Get the logger
$logger = $container->get(LoggerInterface::class);
$logger->info("Logger dependency created.");

##################
# Add Middleware #
##################
$app->add(TwigMiddleware::createFromContainer($app));
$logger->info("Twig middleware added.");

$app->addRoutingMiddleware();
$logger->info("Routing middleware added.");

$settings = $container->get("settings");
$app->addErrorMiddleware(
    $settings["displayErrorDetails"],
    $settings["logErrors"],
    $settings["logErrorDetails"],
    $logger,
);
$logger->info("Error middleware added.");

#################
# Create routes #
#################
$app->get(
    "/",
    function (Request $request, Response $response, array $args) {
        return $this->get("view")->render($response, "form.html.twig");
    },
);

$app->get(
    "/{placeholder}[/]",
    function (Request $request, Response $response, array $args) {
        return $this->get("view")->render($response, "form.html.twig", ["placeholder" => $args["placeholder"]]);
    },
);

$app->post(
    "/",
    function (Request $request, Response $response, array $args) {
        $data = $request->getParsedBody();
        $name = $data["name"];
        return $this->get("view")->render($response, "result.html.twig", ["name" => $name]);
    },
)->setName("result");

###############
# Run the app #
###############
$app->run();