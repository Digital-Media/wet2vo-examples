<?php

$a = 1;
if ($a == true) {
    echo "Typumwandlung in Boolean ist erfolgt!" . "<br>";
}
if ($a === true) {
    echo "Dieser Operator lässt sich nicht überlisten!" . "<br>";
}

$b = "2";
$b += 4;
echo $b;
