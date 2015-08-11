<?php

namespace ImageCoverTest;

class BackgroundCoverViewportTest extends \PHPUnit_Framework_TestCase
{
  /**
   *@dataProvider cases
   */
  public function testCase($identifier, $viewport, $image, $expected)
  {
    $viewport = new \ImageCover\BackgroundCoverViewport(
      $viewport[0],
      $viewport[1],
      isset($viewport[2]) ? $viewport[2] : null,
      isset($viewport[3]) ? $viewport[3] : null
    );

    $result = $viewport->computeUsedCrop($image[0], $image[1]);

    $this->assertEquals(
      "({$expected[0]}, {$expected[1]})",
      "({$result[0]}, {$result[1]})",
      "[{$identifier}] position does not match"
    );

    $this->assertEquals(
      "({$expected[2]} x {$expected[3]})",
      "({$result[2]} x {$result[3]})",
      "[{$identifier}] size does not match"
    );
  }

  public function cases()
  {
    return require 'Fixture.php';
  }
}
