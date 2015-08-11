<?php

/*
 * http://geekthis.net/blog/87/php-gradient-images-rectangle-gd
 * bool image_gradientrect(resource $image, int $x1, int $y1, int $x2, int $y2, string $HexColorCodeStart, string $HexColorCodeEnd);
 */
function image_gradientrect($img,$x,$y,$x1,$y1,$start,$end) {
   if($x > $x1 || $y > $y1) {
      return false;
   }
   $s = array(
      hexdec(substr($start,0,2)),
      hexdec(substr($start,2,2)),
      hexdec(substr($start,4,2))
   );
   $e = array(
      hexdec(substr($end,0,2)),
      hexdec(substr($end,2,2)),
      hexdec(substr($end,4,2))
   );
   $steps = $y1 - $y;
   for($i = 0; $i < $steps; $i++) {
      $r = $s[0] - ((($s[0]-$e[0])/$steps)*$i);
      $g = $s[1] - ((($s[1]-$e[1])/$steps)*$i);
      $b = $s[2] - ((($s[2]-$e[2])/$steps)*$i);
      $color = imagecolorallocate($img,$r,$g,$b);
      imagefilledrectangle($img,$x,$y+$i,$x1,$y+$i+1,$color);
   }
   return true;
}

$im = imagecreate($_GET['width'], $_GET['height']);

$white = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 0, 0, 0);

image_gradientrect($im, 0,0, $_GET['width'], $_GET['height'], 'FF0000', '0000FF');

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
