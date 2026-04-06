<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

require "vendor/autoload.php";

$client = new Client([
    "base_uri" => "https://httpbin.org",
]);

try {
    $getResponse = $client->get("/get", [
        "query" => ["foo" => "bar"],
    ]);
} catch (ClientException $e) {
    $getResponse = $e->getResponse();
}
try {
    $postResponse = $client->post("/post", [
        "form_params" => ["foo" => "bar"],
    ]);
} catch (ClientException $e) {
    $postResponse = $e->getResponse();
}

echo <<<GETRESPONSE
<p><strong>The GET Response:</strong><br>
{$getResponse->getStatusCode()}<br>
{$getResponse->getReasonPhrase()}<br>
{$getResponse->getHeader("Content-Type")[0]}</p>
<pre>{$getResponse->getBody()->getContents()}</pre>
GETRESPONSE;

echo <<<POSTRESPONSE
<p><strong>The POST Response:</strong><br>
{$postResponse->getStatusCode()}<br>
{$postResponse->getReasonPhrase()}<br>
{$postResponse->getHeader("Content-Type")[0]}</p>
<pre>{$postResponse->getBody()->getContents()}</pre>
POSTRESPONSE;