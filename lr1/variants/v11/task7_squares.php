<?php
header("Content-Type: image/png");

$width = 600;
$height = 600;
$image = imagecreatetruecolor($width, $height);

$white = imagecolorallocate($image, 255, 255, 255);
$blue  = imagecolorallocate($image, 0, 0, 255);

imagefill($image, 0, 0, $white);

$radius = 100; 
$spacing = 200; 
$offset = 100;  

for ($row = 0; $row < 3; $row++) {
    for ($col = 0; $col < 3; $col++) {
        $x = $offset + ($col * $spacing);
        $y = $offset + ($row * $spacing);
        
        imagefilledellipse($image, $x, $y, $radius, $radius, $blue);
    }
}

imagepng($image);

imagedestroy($image);
?>
