<?php

/**
 * Contrary to webtechnologies.php, this file uses the autoloader to load the classes.
 * We don't have to specifically include the files for the classes we need.
 */

require "autoload.php";

use Fhooe\Mtd\WebTechnologies\Exercise;
use Fhooe\Mtd\WebTechnologies\Lecture;

$lecture = new Lecture();
$exercise = new Exercise();