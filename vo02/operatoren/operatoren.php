<?php
$a = 5;
$b = 5.0;

if ($a == $b) {
    echo "Werte gleich" . "<br>";
}

if ($a === $b) {
    echo "Werte und Typ gleich" . "<br>";
}

// Konditionaler Operator
$test = true;
echo ($test ? "Hallo" : "Kein Hallo") . "<br>"; // Hallo

// Null Coalescing Operator
//$vorname = "Jane"; // Diese Zeile ein- bzw. auskommentieren um die Funktionsweise zu testen
$name = $vorname ?? "Nobody";
echo $name . "<br>";


// Null Coalescing Assignment Operator
// $hero = "Batman";  // Diese Zeile ein- bzw. auskommentieren um die Funktionsweise zu testen
$hero ??= "Superman";
echo "<p>$hero</p>";
// Entspricht $hero = $hero ?? "Batman";


// Spaceship Operator
echo 1 <=> 1; // 0
echo 1.5 <=> 2.5; // -1
echo "b" <=> "a"; // 1
