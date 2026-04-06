<?php

/**
 * Code originally adapted from http://www.akchauhan.com/dynamic-progress-bar-or-status-bar-using-gd-library/
 */

// Set width and height of progress bar in px
$width = 500;
$height = 50;

// Current percentage (50 if not set)
$current = $_GET["c"] ?? 50;
// Start percentage (0 if not set)
$start = $_GET["s"] ?? 0;
// End percentage (100 if not set)
$end = $_GET["e"] ?? 100;
// Print text (true if not set)
$p = !isset($_GET["p"]) || filter_input(INPUT_GET, "p", FILTER_VALIDATE_BOOLEAN);

// Calculate current position in px
$pos = intval(floor($current / ($end - $start) * $width));

// Create an image and set colors
$image = imagecreate($width, $height); // width , height px
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);
$green = imagecolorallocate($image, 0, 204, 51);

// Set the border thickness
imagesetthickness($image, intval($height * 0.1));

// Fill the rectangle with the amount needed and draw the border
imagefilledrectangle($image, 0, 0, $pos, $height, $green);
imagerectangle($image, 0, 0, $width, $height, $black);

// Display the text centered if enabled
if ($p) {
    $text = floor($pos / $width * 100) . " %";
    $font = __DIR__ . "/arial.ttf";
    $fontSize = intval($height * 0.3);
    $black = imagecolorallocate($image, 0, 0, 0);
    $textSize = imagettfbbox($fontSize, 0, $font, $text);
    $textLength = $textSize[2] - $textSize[0];
    $textX = intval($width / 2 - $textLength / 2);
    $textY = intval($height / 2 + $fontSize / 2);
    imagettftext($image, $fontSize, 0, $textX, $textY, $black, $font, $text);
}

// Output the image
header("Content-type: image/png");
imagepng($image);
imagedestroy($image);