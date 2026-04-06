<?php

$capitals = [
    "Please select a state",
    "Eisenstadt",
    "Klagenfurt",
    "Sankt Pölten",
    "Salzburg",
    "Graz",
    "Innsbruck",
    "Linz",
    "Bregenz",
    "Vienna",
];

header("Content-Type: text/plain");

$index = $_GET["index"] ?? null;

if (array_key_exists($index, $capitals)) {
    http_response_code(200);
    echo $capitals[$index];
} else {
    http_response_code($index === null ? 400 : 404);
}