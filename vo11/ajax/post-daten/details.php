<?php

header("Content-Type: text/plain");

if (!empty($_POST)) {
    $lines = [];
    foreach ($_POST as $key => $value) {
        $lines[] = "$key: $value";
    }
    $output = implode(PHP_EOL, $lines);

    http_response_code(200);
    echo $output;
} else {
    http_response_code(400);
}