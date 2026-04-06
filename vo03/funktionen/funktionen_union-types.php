<?php

// Strikte Typen erzwingen
declare(strict_types=1);

// Union-Types für Parameter und Rückgabewerte: funktionieren ab PHP 8.0.
function getSum(int|float $a, int|float $b): int|float
{
    return $a + $b;
}

echo "<p>Summe: " . getSum(3, 4) . "</p>"; // funktioniert
echo "<p>Summe: " . getSum(3.0, 4.0) . "</p>"; // funktioniert
echo "<p>Summe: " . getSum(3.0, 2.5) . "</p>"; // funktioniert
echo "<p>Summe: " . getSum(3, 2.5) . "</p>"; // funktioniert
