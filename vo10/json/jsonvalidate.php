<?php

$jsonString = file_get_contents("addressbook.json");

$jsonIsValid = json_validate($jsonString);

echo $jsonIsValid ? "JSON structure is valid." : "JSON structure is not valid.";