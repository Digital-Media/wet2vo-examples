<?php

$string = "Hällo";
$length = strlen($string);
$mbLength = mb_strlen($string);

echo "<p>String, dessen Länge abgefragt wird: $string</p>";
echo "<p>Länge mit strlen: $length</p>"; // 6
echo "<p>Länge mit mb_strlen: $mbLength</p>"; // 5