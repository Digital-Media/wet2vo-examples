<?php

$value1 = 3;
$value2 = "3";
$name1 = "Fred";
$name2 = "Wilma";

# Vergleich zweier Integer mit strcmp
echo strcmp($value1, $value1) . "<br>"; // 0
# Vergleich auf Wert (==)
if ($value1 == $value2) {
    echo "Wert gleich" . "<br>"; // wird ausgegeben
}
# Vergleich auf Wert und Typ (===)
if ($value1 === $value2) {
    echo "Wert und Typ gleich" . "<br>"; // wird nicht ausgegeben
}
# Lexikografischer Vergleich zweier Strings
if ($name1 < $name2) {
    echo "Fred kommt vor Wilma" . "<br>"; // wird ausgegeben
}
# Lexikografischer Vergleich von String mit Integer
if ($name1 < $value1) {
    echo "Fred < 3" . "<br>"; // Vor PHP 8 ausgegeben (aber falsch!), mit PHP 8 nicht ausgegeben
}
# Vergleich mit strcmp von String mit Integer
echo strcmp($name1, $value1); // 19 (F ist in der ASCII-Tabelle 19 Stellen hinter 3)
