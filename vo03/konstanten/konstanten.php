<?php

// Konstanten mit define()
define("USERNAME", "John Doe");
echo USERNAME . "<br>"; // John Doe
// echo Username; // Führt beim Einkommentieren zu einem Fehler


// Konstanten mit const
const USER = "Jane Doe";
echo USER . "<br>";


// Konstanten überprüfen
if (defined("USERNAME")) {
    echo "<p>Welcome " . USERNAME . "!</p>";
}

// const funktioniert nur am Top-Level
if (!defined("FOO")) {
    define("FOO", "bar");
    // const FOO = "bar"; -> Funktioniert hier nicht
}


// Magische Konstanten
echo __LINE__ . "<br>"; // Aktuelle Zeilennummer im Skript


// Core Konstanten
echo PHP_VERSION . "<br>"; // PHP-Version
echo PHP_OS . "<br>"; // Betriebssystem auf dem PHP dzt. läuft
echo PHP_INT_MAX . "<br>"; // Maximale Integer-Größe
echo PHP_INT_SIZE . "<br>"; // Wie viel Byte hat ein Integer?


// Standard Konstanten
echo M_PI; // Pi
