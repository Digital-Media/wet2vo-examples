<?php

// Länge bestimmen
$arr1 = [2, "Hallo", 4.3];
$arr2 = ["Test", 7, [3, 5, "Hi"]];
echo count($arr1) . "<br>"; // 3
echo count($arr2) . "<br>"; // 3
echo count($arr2, COUNT_RECURSIVE) . "<br><br>"; // 6

// Werte prüfen und abfragen
$arr3 = [1, 3, 5, 7];
echo in_array(3, $arr3) . "<br>"; // true (1)
echo array_first($arr3). "<br>"; // 1
echo array_last($arr3). "<br>"; // 7

// Schlüssel prüfen und abfragen
$arr4 = [
    "name" => "John Doe",
    "alter" => 34,
    "geschlecht" => "männlich",
];
echo array_key_exists("alter", $arr4) . "<br>"; // true (1)
echo array_key_first($arr4). "<br>"; // name
echo array_key_last($arr4). "<br>"; // geschlecht

// String in Array aufteilen
$text = "Hello little world!";
$pieces = explode(" ", $text); //
print_r($pieces);

// Array zu String zusammenfügen
$parts = ["name", "alter", "geschlecht"];
$string = implode(",", $parts);
echo "<p>$string</p>";

// String mit einer Regular Expression zerteilen
$date = "23/04/2026";
$values = preg_split("#[/.-]#", $date);
print_r($values);