<?php

// Array mit numerischen Schlüsseln
$array1 = [3, 14, 4, 9];

foreach ($array1 as $value) {
    echo $value; // Ausgabe: 31449
}

// Array mit assoziativen Schlüsseln
$array2 = [
    "eins" => 1,
    "zwei" => 2,
    "drei" => 3,
];

foreach ($array2 as $key => $value) {
    echo $key . ": " . $value; // Ausgabe: eins: 1zwei: 2drei: 3
}
