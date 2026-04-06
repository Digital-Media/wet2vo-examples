<?php

require_once("JSONData/SearchData.php");

use JSONData\SearchData;

$data = new SearchData();

header("Content-Type: application/json");
if (isset($_GET["search"])) {
    http_response_code(200);
    echo $data->search($_GET["search"]);
} else {
    http_response_code(400);
}