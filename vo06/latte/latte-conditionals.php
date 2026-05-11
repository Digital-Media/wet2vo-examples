<?php

declare(strict_types=1);

use Latte\Engine;
use Latte\Loaders\FileLoader;

require __DIR__ . "/vendor/autoload.php";

$latte = new Engine();
$latte->setLoader(new FileLoader(__DIR__ . "/templates"));
$latte->setCacheDirectory(__DIR__ . "/cache");

$gender = "male";

$latte->render("conditionals.latte", [
    "gender" => $gender,
    "name"   => "John Doe",
]);