# Reverse Image Cover

Small library that can compute the part of the source image that is shown when it is being projected onto an element as background.

Can be used for example to reduce bandwidth by preprocessing the image so that only the crop is returned. The end result will be identical to the viewer.

Currently only supports backgrounds that _cover_ the image and use percentages to position the image.

## Usage

```php
$viewport = new BackgroundCoverViewport(
  $viewportWidth,
  $viewportHeigt,
  $backgroundPositionX,
  $backgroundPositionY
);

$crop = $viewport->computeUsedCrop(
  $imageWidth,
  $imageHeight
);

echo "Visible part of image starts at({$crop[0]}, {$crop[1]}) ";
echo "and has a dimension of {$crop[2]} x {$crop[3]}";
```

## Tests

Tests can be ran by:

1. `composer install`
2. `vendor/bin/phpunit`

The test suite can be visualized as follows:

1. Run server `php -S localhost:8080`
2. Visit http://localhost:8080/tests/demo.php`
