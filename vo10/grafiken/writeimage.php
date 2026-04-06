<?php

// Create image
$image = imagecreatetruecolor(300, 300);

// Display image
imagepng($image, "emptyimage.png");
imagedestroy($image);