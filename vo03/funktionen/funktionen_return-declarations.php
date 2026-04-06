<?php

// Strikte Typen erzwingen
//declare(strict_types=1);

// Rückgabewertsdeklaration
function getSum($a, $b): int
{
    return $a + $b;
}

echo "<p>Summe: " . getSum(3, 4) . "</p>"; // funktioniert
echo "<p>Summe: " . getSum(3.0, 4.0) . "</p>"; // funktioniert, wenn declare(strict_types = 1) nicht gesetzt
echo "<p>Summe: " . getSum(3.0, 2.5) . "</p>"; // funktioniert, wenn declare(strict_types = 1) nicht gesetzt,
// erzeugt aber als Ergebnis 5, weil auf int abgeschnitten wird

// Nullable Rückgabewertsdeklaration
function getSumOrNull($a, $b): ?int
{
    return ($a + $b) > 0 ? $a + $b : null;
}

echo "<p>Summe: " . getSumOrNull(5, 1) . "</p>"; // funktioniert und liefert int
echo "<p>Summe: " . getSumOrNull(0, 0) . "</p>"; // funktioniert und liefert null (nicht 0)

// Void Returns
function getNothing(): void
{
    echo "<p>Hier wird nichts zurückgegeben.</p>";
    return; // Optional, hier besser gleich weglassen
}

getNothing();

// Never Returns (Aufruf auskommentiert, weil der Redirect die Datei verlässt)
function redirect(string $uri): never
{
    header("Location: " . $uri);
    exit();
}

//redirect("https://www.fh-ooe.at/");

// False als standalone Rückgabewert
function alwaysFalse(): false
{
    return false;
}

if (alwaysFalse()) {
    echo "<p>Das wird nie ausgegeben.</p>";
}
