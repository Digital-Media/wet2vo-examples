<?php

// Call by value
function cbv($x)
{
    return $x += 5;
}

$test1 = 5;
$result1 = cbv($test1);
echo "<p>Resultat CBV: $result1 <br>";
echo "Variable: $test1 </p>";


// Call by reference
function cbr(&$x)
{
    return $x += 5;
}

$test2 = 5;
$result2 = cbr($test2);
echo "<p>Resultat CBR: $result2 <br>";
echo "Variable: $test2 </p>";
