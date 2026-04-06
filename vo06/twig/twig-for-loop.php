<?php

declare(strict_types=1);

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

require "vendor/autoload.php";

$loader = new FilesystemLoader("templates");
$twig = new Environment($loader, [
    "cache" => "cache",
    "auto_reload" => true,
]);

$array = [
    "Red",
    "Green",
    "Blue",
];

try {
    $twig->display("for.html.twig", [
        "colors" => $array,
    ]);
} catch (LoaderError) {
    // LoaderError Exception behandeln (z.B. auf eine Fehlerseite weiterleiten).
} catch (RuntimeError) {
    // RuntimeError Exception behandeln (z.B. auf eine Fehlerseite weiterleiten).
} catch (SyntaxError) {
    // SyntaxError Exception behandeln (z.B. auf eine Fehlerseite weiterleiten).
}