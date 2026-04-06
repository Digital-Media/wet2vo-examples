<?php
$str = "Hallo Welt";
echo mb_substr($str, 2, 3) . "<br>"; // llo
echo mb_substr($str, -2) . "<br>"; // lt
echo mb_substr($str, -3, 2) . "<br>"; // el
echo mb_substr($str, 2, -3); // llo W
