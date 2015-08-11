<?php

$im = imagecreate($_GET['width'], $_GET['height']);

$orange = imagecolorallocate($im, 220, 210, 60);
$black = imagecolorallocate($im, 0, 0, 0);

for ($i = 0; $i <= $_GET['width']; $i += 100) {
  imageline($im, $i - 1, 0, $i - 1, $_GET['height'], $black);
  imageline($im, $i, 0, $i, $_GET['height'], $black);
}

for ($i = 0; $i <= $_GET['height']; $i += 100) {
  imageline($im, 0, $i - 1, $_GET['width'], $i - 1, $black);
  imageline($im, 0, $i, $_GET['width'], $i, $black);
}

if (isset($_GET['crop'])) {
  list($cropX, $cropY, $cropWidth, $cropHeight) = explode(',', $_GET['crop']);
  $im = imagecrop($im, ['x' => $cropX, 'y' => $cropY, 'width' => $cropWidth, 'height' => $cropHeight]);
}

header("Content-type: image/png");
imagepng($im);
imagedestroy($im);
