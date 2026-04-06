<?php

/**
 * Contrary to hypermedia.php, this file uses the autoloader to load the classes.
 * We don't have to specifically include the files for the classes we need.
 */

require "autoload.php";

use Fhooe\Mtd\Hypermedia\Exercise;
use Fhooe\Mtd\Hypermedia\Lecture;

$lecture = new Lecture();
$exercise = new Exercise();
