<?php

use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Component\Translation\Loader\JsonFileLoader;
use Symfony\Component\Translation\Translator;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require "vendor/autoload.php";

$locale = "en-US";
if (isset($_GET["locale"])) {
    $locale = $_GET["locale"];
}

$translator = new Translator($locale);
$translator->addLoader("json", new JsonFileLoader());
$translator->addResource("json", "translations/messages.de.json", "de-AT");
$translator->addResource("json", "translations/messages.en.json", "en-US");

$twig = new Environment(
    new FilesystemLoader("templates"),
    [
        "cache" => "cache",
        "auto_reload" => true,
    ],
);

$twig->addExtension(new TranslationExtension($translator));

$twig->display("index.html.twig", [
    "scriptName" => $_SERVER["SCRIPT_NAME"],
    "nrOfMessages" => $_GET["nrOfMessages"] ?? null,
]);