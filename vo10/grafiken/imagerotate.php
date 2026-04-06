<?php

// Create image
$image = imagecreatetruecolor(300, 300);

// Allocate colors
$yellow = imagecolorallocate($image, 255, 255, 0);
$black = imagecolorallocate($image, 0, 0, 0);

// Draw rectangles
imagerectangle($image, 10, 10, 110, 110, $yellow);
imagefilledrectangle($image, 70, 120, 280, 250, $yellow);

// Rotate image
$image = imagerotate($image, 45, $black);

// Output and clean up
header("Content-type: image/png");
imagepng($image);
imagedestroy($image);