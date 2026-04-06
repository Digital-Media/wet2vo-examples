<?php

$arr1 = [2, "Hallo", 4.3];
$arr2 = ["Test", 7, [3, 5, "Hi"]];
echo count($arr1) . "<br>"; // 3
echo count($arr2) . "<br>"; // 3
echo count($arr2, COUNT_RECURSIVE) . "<br><br>"; // 6

$text = "Hello little world!";
$pieces = explode(" ", $text); //
print_r($pieces);

$parts = ["name", "alter", "geschlecht"];
$string = implode(",", $parts);
echo "<p>$string</p>";

$date = "13/03/2025";
$values = preg_split("#[/.-]#", $date);
print_r($values);
