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

try {
    $twig->display("message.html.twig", [
        "name" => "John Doe",
        "message" => "I'm back baby!",
    ]);
} catch (LoaderError $e) {
    // LoaderError Exception behandeln (z.B. auf eine Fehlerseite weiterleiten).
} catch (RuntimeError $e) {
    // RuntimeError Exception behandeln (z.B. auf eine Fehlerseite weiterleiten).
} catch (SyntaxError $e) {
    // SyntaxError Exception behandeln (z.B. auf eine Fehlerseite weiterleiten).
}