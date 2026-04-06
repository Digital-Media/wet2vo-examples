<?php

$pattern1 = "Hallo {name}.";
$pattern2 = "Das kostet {value,number,currency}.";
$pattern3 = "Heute ist der {datum,date,short}";
$pattern4 = "Es ist jetzt {uhrzeit,time}";

$mfSimple = new MessageFormatter("de-AT", $pattern1);
echo $mfSimple->format(["name" => "Wolfgang"]) . "<br>";

$mfSimple->setPattern($pattern2);
echo $mfSimple->format(["value" => 3]) . "<br>";

$mfSimple->setPattern($pattern3);
echo $mfSimple->format(["datum" => new DateTime()]) . "<br>";

$mfSimple->setPattern($pattern4);
echo $mfSimple->format(["uhrzeit" => new DateTime()]) . "<br>";


$patternPlural = "{nr,plural,
        zero {Niemand kam.}
        one {Jemand kam.}
        other {Viele kamen.} 
    }";
$patternSelect = "{gender,select,
    male {Er}
    female {Sie}
    other {They}
    }";

$mfComplex = new MessageFormatter("de-AT", $patternPlural);
echo $mfComplex->format(["nr" => 5]) . "<br>";

$mfComplex->setPattern($patternSelect);
echo $mfComplex->format(["gender" => "other"]);