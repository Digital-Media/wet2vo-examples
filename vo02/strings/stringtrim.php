<?php
$str = trim("  Hallo Welt    "); // Hallo Welt
$more = trim("!-Hallo Welta", "a-!"); // Hallo Welt

echo $str . "<br>";
echo $more;
