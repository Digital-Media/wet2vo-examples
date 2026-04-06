<?php

require "../vendor/autoload.php";

use PHPUnitExample\FavoriteMTDSubject;

// Shout the favorite subject
$favoriteSubject = new FavoriteMTDSubject("Hypermedia 2");
echo $favoriteSubject->say();

// Simply retrieve the favorite subject
echo $favoriteSubject->favoriteSubject;

// Create an empty favorite subject
try {
    new FavoriteMTDSubject("");
} catch (InvalidArgumentException $e) {
    echo $e->getMessage();
}

// Disagree with another statement
$otherSubject1 = new FavoriteMTDSubject("Media Technology 2");
try {
    echo $favoriteSubject->respondTo($otherSubject1->say());
} catch (Exception $e) {
    echo $e->getMessage();
}

// Agree with another statement
$otherSubject2 = new FavoriteMTDSubject("Hypermedia 2");
try {
    echo $favoriteSubject->respondTo($otherSubject2->say());
} catch (Exception $e) {
    echo $e->getMessage();
}