<?php

class BackgroundCoverViewportTest extends PHPUnit_Framework_TestCase
{
  public function testFitsExactly()
  {
    $viewport = new BackgroundCoverViewport(500, 200);
    $result = $viewport->computeUsedCrop(500, 200);
    $this->assertEquals([0, 0, 500, 200], $result);
  }

  public function testFitsExactlyLarger()
  {
    $viewport = new BackgroundCoverViewport(500, 200);
    $result = $viewport->computeUsedCrop(1000, 400);
    $this->assertEquals([0, 0, 1000, 400], $result);
  }

  public function testFitsExactlySmaller()
  {
    $viewport = new BackgroundCoverViewport(500, 200);
    $result = $viewport->computeUsedCrop(250, 100);
    $this->assertEquals([0, 0, 250, 100], $result);
  }

  public function testTranslationOnly()
  {
    $viewport = new BackgroundCoverViewport(500, 200, 1, 0);
    $result = $viewport->computeUsedCrop(200, 200);
    $this->assertEquals([300, 0, 200, 200], $result);
  }
}
