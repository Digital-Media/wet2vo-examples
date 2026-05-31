<?php

use Latte\Engine;
use Latte\Essential\TranslatorExtension;
use Latte\Loaders\FileLoader;
use Symfony\Component\Translation\Loader\JsonFileLoader;
use Symfony\Component\Translation\Translator;

require "vendor/autoload.php";

$locale = "en-US";
if (isset($_GET["locale"])) {
    $locale = $_GET["locale"];
}

$translator = new Translator($locale);
$translator->addLoader("json", new JsonFileLoader());
$translator->addResource("json", "translations/messages.de.json", "de-AT");
$translator->addResource("json", "translations/messages.en.json", "en-US");

$latte = new Engine();
$latte->setLoader(new FileLoader(__DIR__ . "/templates"));
$latte->setCacheDirectory(__DIR__ . "/cache");

$latte->addExtension(new TranslatorExtension($translator->trans(...)));

$latte->render("index.latte", [
    "locale" => $locale,
    "scriptName" => $_SERVER["SCRIPT_NAME"],
    "nrOfMessages" => isset($_GET["nrOfMessages"]) ? intval($_GET["nrOfMessages"]) : null,
]);