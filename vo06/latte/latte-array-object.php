<?php

declare(strict_types=1);

namespace Fhooe\Mtd\WebTechnologies\Vo06;

use Latte\Engine;
use Latte\Loaders\FileLoader;

require __DIR__ . "/vendor/autoload.php";

/**
 * A simple class representing a person by name, gender, and age.
 */
class Person
{
    /**
     * Creates a new person.
     *
     * @param string $name   The person's name.
     * @param string $gender The person's gender.
     * @param int    $age    The person's age.
     */
    public function __construct(
        public string $name,
        public string $gender,
        public int $age,
    ) {}
}

// Initialize Latte template engine
$latte = new Engine();
$latte->setLoader(new FileLoader(__DIR__ . "/templates"));
$latte->setCacheDirectory(__DIR__ . "/cache");

// Define some data
$array = [
    "John Doe",
    "male",
    25,
];

$assocArray = [
    "name"    => "Jane Doe",
    "details" => [
        "gender" => "female",
        "age"    => 23,
    ],
];

$object = new Person(
    "Jim Doe",
    "male",
    3,
);

// Render the template with the data
$latte->render("array-object.latte", [
    "data1" => $array,
    "data2" => $assocArray,
    "data3" => $object,
]);