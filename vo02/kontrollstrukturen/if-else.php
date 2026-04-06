<?php
// if-else-Bedingung
$name = "";
if ($name !== "") {
    $username = $name;
} else {
    $username = "John Doe";
}

$n = 1;

// if-elseif-else-Kaskade
if ($n === 1) {
    echo "Die Zahl ist 1";
} elseif ($n === 2) {
    echo "Die Zahl ist 2";
} else {
    echo "Die Zahl ist weder 1 noch 2";
}

// Switch-Anweisung statt Kaskade
switch ($n) {
    case 1:
        echo "Die Zahl ist 1";
        break;
    case 2:
        echo "Die Zahl ist 2";
        break;
    default:
        echo "Die Zahl ist weder 1 noch 2";
        break;
}

// PHP 8: Match Expression anstatt switch möglich
echo match ($n) {
    1 => "Die Zahl ist 1",
    2 => "Die Zahl ist 2",
    default => "Die Zahl ist weder 1 noch 2"
};
