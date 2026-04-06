<?php

// Create images
$image1 = imagecreatetruecolor(300, 300);
$image2 = imagecreatetruecolor(100, 100);

// Allocate yellow color
$yellow = imagecolorallocate($image1, 255, 255, 0);

// Draw rectangles
imagerectangle($image1, 10, 10, 110, 110, $yellow);
imagefilledrectangle($image1, 70, 120, 280, 250, $yellow);

// Resample and copy part of $image1 to $image2
imagecopyresampled($image2, $image1, 0, 0, 0, 0, 100, 100, 300, 300);

// Output and clean up
header("Content-type: image/png");
imagepng($image2);
imagedestroy($image1);
imagedestroy($image2);