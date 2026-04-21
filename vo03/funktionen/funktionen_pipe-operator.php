<?php

$input = "  hällo welt  ";

// Verschachtelter Funktionsaufruf (ggf. schwer lesbar)
$res1 = mb_substr(mb_strtoupper(mb_trim($input)), 0, 5);
echo "<p>$res1</p>";

// Pipe-Operator (linearer Datenfluss)
$res2 = $input
        |> mb_trim(...)
        |> mb_strtoupper(...)
        |> (fn($x) => mb_substr($x, 0, 5));

echo "<p>$res2</p>"; // HÄLLO