<?php

use App\Renderer\TemplateRenderer;
use DI\ContainerBuilder;
use Latte\Engine;
use Latte\Loaders\FileLoader;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;
use Slim\Factory\AppFactory;

require __DIR__ . "/../vendor/autoload.php";

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
            "template" => [
                "path" => "../templates",
                "cache" => "../cache",
                "auto_refresh" => true,
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
        Engine::class => function (ContainerInterface $container) {
            $settings = $container->get("settings");

            $templateSettings = $settings["template"];

            $latte = new Engine();
            $latte->setLoader(new FileLoader($templateSettings["path"]));
            $latte->setCacheDirectory($templateSettings["cache"]);
            $latte->setAutoRefresh($templateSettings["auto_refresh"]);

            $routeParser = $container->get("routeParser");
            $latte->addFunction("url_for",
                fn(string $name, array $data = [], array $query = []): string
                    => $routeParser->urlFor($name, $data, $query),
            );

            return $latte;
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
$app->setBasePath("/wet2vo-examples/vo12/slim-framework/slimexample/public");

// Set the route parser in the container
$container->set("routeParser", $app->getRouteCollector()->getRouteParser());

// Get the logger
$logger = $container->get(LoggerInterface::class);
$logger->info("Logger dependency created.");

##################
# Add Middleware #
##################
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
$app->get("/", function (Request $request, Response $response, array $args) {
    return $this->get(TemplateRenderer::class)->template($response, "form.latte");
});

$app->get("/{placeholder}[/]", function (Request $request, Response $response, array $args) {
    return $this->get(TemplateRenderer::class)->template($response, "form.latte",
        ["placeholder" => $args["placeholder"]]);
});

$app->post("/", function (Request $request, Response $response, array $args) {
    $data = $request->getParsedBody();
    $name = $data["name"];

    return $this->get(TemplateRenderer::class)->template($response, "result.latte", ["name" => $name]);
})->setName("result");

###############
# Run the app #
###############
$app->run();