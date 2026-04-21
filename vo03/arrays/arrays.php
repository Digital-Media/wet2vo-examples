<?php

// Definieren von Arrays
$a1 = []; // Leeres Array
$a2 = ["a", "b", "c"]; // Indiziertes Array
$a3 = [3, "Hallo", 5.1]; // Gemische Datentypen als Werte

$a4 = [0 => "a", 1 => "b", 2 => "c"]; // Explizit zugewiesene Schlüssel
$a5 = [0 => "a", 3 => "b", 4 => "c"]; // Zuweisung mit Lücken

$a6 = ["Vorname" => "John", "Nachname" => "Doe", "Alter" => "34"]; // Assoziatives Array
$a7 = ["farbe" => "rot", "form" => "rund", 3]; // Gemischtes Array

$a8 = [
    "multi",
    "line",
    "declaration",
];

// Erweitern von Arrays
$arr1 = [7, 4, 3]; // Stellen 0, 1, 2 sind belegt
$arr1[7] = 14; // Landet an Stelle 7
$arr1["test"] = 5; // Landet an Stelle "test"

var_dump($arr1); // Ausgabe des Arrays mit var_dump

echo "<p>Hier werden nur Arrays definiert, aber nichts ausgegeben. Daher bleibt die Seite, bis auf diesen Text, leer.</p>";