<?php

class BackgroundCoverViewport
{
  protected $viewportWidth, $viewportHeight;

  public function __construct($viewportWidth, $viewportHeight)
  {
    $this->viewportWidth = $viewportWidth;
    $this->viewportHeight = $viewportHeight;
  }

  public function computeUsedCrop($imageX, $imageY)
  {
    return [0, 0, $imageX, $imageY]; // TODO improve
  }
}
