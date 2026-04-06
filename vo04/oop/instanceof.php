<?php

/**
 * A human.
 */
class Human
{
    // ...
}

/**
 * An employee based on Human.
 */
class Employee extends Human
{
    // ...
}

/**
 * An animal.
 */
class Animal
{
    // ...
}

$obj = new Employee();

if ($obj instanceof Employee) { // true
    echo "Object is Employee";
}
if ($obj instanceof Human) { // true
    echo "Object is Human";
}
if ($obj instanceof Animal) { // false
    echo "Object is Animal";
}
