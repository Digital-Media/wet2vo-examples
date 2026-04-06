<?php

/**
 * Code adapted from https://www.php.net/manual/en/function.imagefilledarc.php
 */

// Create an image
$width = $height = 1000;
$image = imagecreatetruecolor($width, $height);

// Allocate some colors
$white = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
$gray = imagecolorallocate($image, 0xC0, 0xC0, 0xC0);
$darkGray = imagecolorallocate($image, 0x90, 0x90, 0x90);
$navy = imagecolorallocate($image, 0x00, 0x00, 0x80);
$darkNavy = imagecolorallocate($image, 0x00, 0x00, 0x50);
$red = imagecolorallocate($image, 0xFF, 0x00, 0x00);
$darkRed = imagecolorallocate($image, 0x90, 0x00, 0x00);

// Set background to white
imagefilledrectangle($image, 0, 0, $width, $height, $white);

// Make the 3D effect
for ($i = $height * 0.6; $i > $height / 2; $i--) {
    imagefilledarc($image, $width / 2, $i, $width, $height / 2, 0, 45, $darkNavy, IMG_ARC_PIE);
    imagefilledarc($image, $width / 2, $i, $width, $height / 2, 45, 75, $darkGray, IMG_ARC_PIE);
    imagefilledarc($image, $width / 2, $i, $width, $height / 2, 75, 360, $darkRed, IMG_ARC_PIE);
}

// Draw the top with lighter colors
imagefilledarc($image, $width / 2, $height / 2, $width, $height / 2, 0, 45, $navy, IMG_ARC_PIE);
imagefilledarc($image, $width / 2, $height / 2, $width, $height / 2, 45, 75, $gray, IMG_ARC_PIE);
imagefilledarc($image, $width / 2, $height / 2, $width, $height / 2, 75, 360, $red, IMG_ARC_PIE);

// Flush the image
header("Content-type: image/png");
imagepng($image);
imagedestroy($image);