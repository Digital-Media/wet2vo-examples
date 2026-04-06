<?php

// Create image
$image = imagecreatetruecolor(300, 300);

// Display image
header("Content-type: image/png");
imagepng($image);
imagedestroy($image);