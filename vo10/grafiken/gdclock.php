<?php

/**
 * Code adapted from https://www.codelibary.com/snippet/655/gd-clock
 */

// Define measurements
$maxLength = 150;
$marker = 5;
$originX = $originY = $maxLength / 2;
$radius = $maxLength / 2 - 2;
$hourSegment = $radius * 0.50;
$minuteSegment = $radius * 0.80;

// Create image
$image = imagecreatetruecolor($maxLength, $maxLength);

// Allocate colors
$black = imagecolorallocate($image, 0, 0, 0);
$red = imagecolorallocate($image, 255, 0, 0);
$blue = imagecolorallocate($image, 0, 0, 255);
$white = imagecolorallocate($image, 254, 255, 255);

// Get current time
date_default_timezone_set("Europe/Vienna");
$lt = localtime();

// Calculate hand angles
$hourAngle = deg2rad(($lt[2] + ($lt[1] / 60) - 3) * 30);
$minuteAngle = deg2rad(($lt[1] + ($lt[0] / 60) - 15) * 6);

// White background
imagefilledrectangle($image, 0, 0, $maxLength, $maxLength, $white);

// Outer clock circle
imagearc(
    $image,
    $originX,
    $originY,
    $maxLength - 2,
    $maxLength - 2,
    0,
    360,
    $blue,
);

// Hour markers
for ($i = 0; $i < 360; $i = $i + 30) {
    $degrees = deg2rad($i);
    imageline(
        $image,
        intval($originX + (($radius - $marker) * cos($degrees))),
        intval($originY + (($radius - $marker) * sin($degrees))),
        intval($originX + ($radius * cos($degrees))),
        intval($originY + ($radius * sin($degrees))),
        $red,
    );
}

// Hour hand
imageline(
    $image,
    $originX,
    $originY,
    intval($originX + ($hourSegment * cos($hourAngle))),
    intval($originY + ($hourSegment * sin($hourAngle))),
    $black,
);

// Minute hand
imageline(
    $image,
    $originX,
    $originY,
    intval($originX + ($minuteSegment * cos($minuteAngle))),
    intval($originY + ($minuteSegment * sin($minuteAngle))),
    $black,
);

// Center dot
imagearc(
    $image,
    $originX,
    $originY,
    6,
    6,
    0,
    360,
    $red,
);
imagefill(
    $image,
    $originX + 1,
    $originY + 1,
    $red,
);

// Draw image
header("Content-type: image/png");
imagepng($image);
imagedestroy($image);