<?php

$timezone = new DateTimeZone("Europe/Vienna");

/*$d1 = new DateTime("now", $timezone);
echo "<p>It's now " . $d1->format("r") . "</p>";*/

$d2 = new DateTime("2025-04-24T12:40:00+00:00");
echo "<p>Original timestamp: " . $d2->format("r") . "</p>";
$d2->setTimezone($timezone);
echo "<p>Time zone corrected timestamp: " . $d2->format("r") . "</p>";