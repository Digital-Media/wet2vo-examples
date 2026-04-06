<?php

$first = 100;
$second = 50;
echo $first . $second . "<br>";
echo $first + $second;


$str = "Hallo " . "Welt";
echo $str . "<br>";

$wrong = "Hallo " + "Welt";
echo $wrong . "<br>"; // Ab PHP 8: Fehler. Davor: 0.
