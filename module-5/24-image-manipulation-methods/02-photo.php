<?php

$image = imagecreatefromjpeg("test-images/companion.jpeg");

imagegammacorrect($image, 1.0, 3.0);

imagejpeg($image, 'image-output.jpeg');
?>