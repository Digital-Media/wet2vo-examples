<?php

$str = mb_trim("  Hallo Welt    "); // Hallo Welt
$more = mb_trim("!-Hallo Welta", "a-!"); // Hallo Welt

echo $str . "<br>";
echo $more;