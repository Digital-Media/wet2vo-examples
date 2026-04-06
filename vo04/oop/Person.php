<?php

require "LocatableTrait.php";

/**
 * A person who wants to be locatable by coordinates.
 */
class Person
{
    use LocatableTrait;

    // ...
}

$pers = new Person();
$pers->setPosition([48.368201, 14.514065]);
echo "<p>Latitude: " . $pers->latitude . "°</p>";
echo "<p>Longitude: " . $pers->longitude . "°</p>";
