<?php

require __DIR__ . "/../vendor/autoload.php";

use PHPUnitExample\FavoriteMTDSubject;

// Shout the favorite subject
$favoriteSubject = new FavoriteMTDSubject("Web Technologies");
echo "<p>{$favoriteSubject->say()}</p>";

// Simply retrieve the favorite subject
echo "<p>$favoriteSubject->favoriteSubject</p>";

// Create an empty favorite subject
try {
    new FavoriteMTDSubject("");
} catch (InvalidArgumentException $e) {
    echo "<p>{$e->getMessage()}</p>";
}

// Disagree with another statement
$otherSubject1 = new FavoriteMTDSubject("Algorithmic Thinking");
try {
    echo $favoriteSubject->respondTo($otherSubject1->say());
} catch (Exception $e) {
    echo "<p>{$e->getMessage()}</p>";
}

// Agree with another statement
$otherSubject2 = new FavoriteMTDSubject("Web Technologies");
try {
    echo "<p>{$favoriteSubject->respondTo($otherSubject2->say())}</p>";
} catch (Exception $e) {
    echo "<p>{$e->getMessage()}</p>";
}