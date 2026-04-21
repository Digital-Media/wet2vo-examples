<?php

// 1. Klassische anonyme Funktion
$callback = function ($name) {
    return "Hallo $name";
};

echo "<p>{$callback("Igor")}</p>"; // Hallo Igor

// 2. Moderne Arrow Function (kürzer, gleiches Ergebnis)
$arrow = fn($name) => "Hallo $name";

echo "<p>{$arrow("Igor")}</p>"; // Hallo Igor