<?php

namespace ImageCover;

class BackgroundCoverViewport
{
  protected $width, $height;
  protected $positionX, $positionY;

  public function __construct($width, $height, $positionX, $positionY)
  {
    $this->width = (double)$width;
    $this->height = (double)$height;
    $this->positionX = (double)$positionX;
    $this->positionY = (double)$positionY;
  }

  public function computeUsedCrop($imageWidth, $imageHeight)
  {
    $imageWidth = (double)$imageWidth;
    $imageHeight = (double)$imageHeight;

    if ($imageWidth === 0.0 || $imageHeight === 0.0 || $this->width === 0.0 || $this->height === 0.0) {
      return [0, 0, 0, 0];
    }

    // Scale image so shortest side fits exactly
    $scale = max(
      $this->width / $imageWidth,
      $this->height / $imageHeight
    );

    $resizedImageWidth = $imageWidth * $scale;
    $resizedImageHeight = $imageHeight * $scale;

    // Position scaled image on correct position
    $resizedStartX = $resizedImageWidth * $this->positionX - $this->width * $this->positionX;
    $resizedStartY = $resizedImageHeight * $this->positionY - $this->height * $this->positionY;

    $resizedStartX = min($resizedImageWidth - $this->width, max(0, $resizedStartX));
    $resizedStartY = min($resizedImageHeight - $this->height, max(0, $resizedStartY));

    // Compute back to real image coordinates
    return [
      abs(round($resizedStartX / $scale)),
      abs(round($resizedStartY / $scale)),
      ceil($this->width / $scale),
      ceil($this->height / $scale)
    ];
  }
}
