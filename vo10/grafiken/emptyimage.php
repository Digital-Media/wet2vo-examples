<?php

// Create image
$image = imagecreatetruecolor(300, 300);

// Output image
header("Content-type: image/png");
imagepng($image);