<?php

// Ist "a" in "Hallo Welt!" enthalten?
if (preg_match("/a/", "Hallo Welt!")) {
    echo "<p>1. okay!<p>";
}

// Ist "a", "b", "c" oder " " in "Hallo Welt!" enthalten?
if (preg_match("/[abc ]/", "Hallo Welt!")) {
    echo "<p>2. okay!<p>";
}

// Sind alphanumerische Zeichen in "Hallo 2025!" enthalten?
if (preg_match("/[[:alnum:]]/", "Hallo 2025!")) {
    echo "<p>3. okay!<p>";
}

// Ist "H", dann nicht "a", "e", "i", "o" oder "u" dann "llo" in "Hallo Welt!" enthalten?
if (preg_match("/H[^aeiou]llo/", "Hallo Welt!")) {
    echo "<p>4. okay!<p>"; // wird nicht betreten
}

// Ist "a" und optional "b" oder "c" in "bc" enthalten?
if (preg_match("/a(bc)* /", "bc")) {
    echo "<p>5. okay!<p>"; // wird nicht betreten
}

// Datum wird mit Klammern aufgeteilt: 1 oder 2 Zahlen, ".", 1 oder 2  Zahlen, ".", vier Zahlen
if (preg_match("/([0-9]{1,2})\.([0-9]{1,2})\.([0-9]{4})/", "13.03.2025", $matches)) {
    echo $matches[0] . "<br>"; // 13.03.2025
    echo $matches[1] . "<br>"; // 13
    echo $matches[2] . "<br>"; // 03
    echo $matches[3]; // 2025
}
