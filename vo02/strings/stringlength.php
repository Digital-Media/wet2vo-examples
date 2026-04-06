<?php
$string = "Hällo";

echo "<p>String, dessen Länge abgefragt wird: $string</p>";
echo "<p>Länge mit strlen: " . strlen($string) . "</p>"; // 6
echo "<p>Länge mit mb_strlen: " . mb_strlen($string) . "</p>"; // 5
