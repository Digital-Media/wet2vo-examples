<?php

// This contains the request method (GET or POST)
$method = $_SERVER["REQUEST_METHOD"];

// This will have the full URL (without domain/IP) coming from the request
$path = $_SERVER["REQUEST_URI"];

// If the application is not in the server's root application, we need to add this part of the path as base path
$basePath = "/hyp2vo-t1-examples/vl05/routing";

// If we have a base path set we need to remove it now in order to only get the important path of the route
if (!empty($basePath)) {
    $path = substr($path, strlen($basePath));
}

// Our route consists of method and path, separated by a space
$route = "$method $path";

// Go through the routes and see if we defined one. If not, send back a 404 code with a message
switch ($route) {
    case "GET /":
        echo "Here's the root page";
        break;
    case "GET /other":
        echo "Here's the other page.";
        break;
    default:
        http_response_code(404);
        echo "Page not found!";
}