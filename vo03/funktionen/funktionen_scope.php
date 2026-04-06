<?php

// Lokale Variable
function fooLokal(): void
{
    $x = "Lokal";
}

$x = "Global";
fooLokal();
echo "<p>$x</p>"; // Global


// Globale Variable
function fooGlobal(): void
{
    global $x;
    $x = "Jetzt global";
}

$x = "Global";
fooGlobal();
echo "<p>$x</p>"; // Jetzt global


// Statische Variable
function counter(): int
{
    static $count = 0;
    return $count++;
}

for ($i = 0; $i < 5; $i++) {
    echo counter();
}
