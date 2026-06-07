<?php

// Create image
$image = imagecreatetruecolor(300, 300);

// Output image
imagepng($image, "emptyimage.png");