<?php

namespace JSONExample;

/**
 * A simple person class to demonstrate JSON functionalities.
 */
class Person
{
    /**
     * Person constructor.
     * @param string $name The person's name.
     * @param int $age The person's age.
     * @param string $country The person's country of residence.
     */
    public function __construct(public string $name, public int $age, public string $country) {}
}