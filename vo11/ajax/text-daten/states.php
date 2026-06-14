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

if (!isset($_GET["index"])) {
    // No parameter index was given.
    http_response_code(400);
} elseif (array_key_exists($_GET["index"], $capitals)) {
    // Index is valid.
    http_response_code(200);
    echo $capitals[$_GET["index"]];
} else {
    // Index has been passed, but is not valid.
    http_response_code(404);
}