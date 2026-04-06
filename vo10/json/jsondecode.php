<?php

$jsonString = file_get_contents("addressbook.json");

// Output as object
$jsonData = json_decode($jsonString);

// Output as associative array
//$jsonData = json_decode($jsonString, true);

var_dump($jsonData);

// Access to object properties
echo $jsonData->lastName; // Doe
echo $jsonData->address->street; // 21 Doe St.
echo $jsonData->phoneNumbers[1]->number; // 800 999 666-333

// Access to array values
// echo $jsonData["lastName"]; // Doe
// echo $jsonData["address"]["street"]; // 21 Doe St.
// echo $jsonData["phoneNumbers"][1]["number"]; // 800 999 666-333
