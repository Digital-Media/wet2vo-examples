<?php
$text = "Hallo kleine Welt";

echo mb_convert_case($text, MB_CASE_UPPER) . "<br>";
echo mb_convert_case($text, MB_CASE_LOWER) . "<br>";
echo mb_convert_case($text, MB_CASE_TITLE) . "<br>";
