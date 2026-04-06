<?php

header("Content-Type: text/plain");

if (!empty($_POST)) {
    $output = implode(
        PHP_EOL,
        array_map(
            function ($key, $value) {
                return "$key: $value";
            },
            array_keys($_POST),
            $_POST,
        ),
    );

    http_response_code(200);
    echo $output;
} else {
    http_response_code(400);
}