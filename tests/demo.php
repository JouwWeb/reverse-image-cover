<?php
  namespace ImageCoverTest;

  require '../vendor/autoload.php';

  $fixtures = require 'Fixture.php';
?>

<body style="width: 3000px">

<?php foreach ($fixtures as $fixture):?>

  <h2 style="clear: both"><?=$fixture[0]?></h2>

  <?php

  $viewport = new \ImageCover\BackgroundCoverViewport(
    $fixture[1][0],
    $fixture[1][1],
    isset($fixture[1][2]) ? $fixture[1][2] : null,
    isset($fixture[1][3]) ? $fixture[1][3] : null
  );

  $crop = $viewport->computeUsedCrop($fixture[2][0], $fixture[2][1]);

  ?>

  <div style="position: relative;">

    <div style="margin: 10px; float: left; width: <?=$fixture[1][0]?>px; height: <?=$fixture[1][1]?>px; background-image: url(image.php?width=<?=$fixture[2][0]?>&height=<?=$fixture[2][1]?>&bust=<?=time()?>); background-size: cover; background-position: <?=$fixture[1][2] * 100?>% <?=$fixture[1][3] * 100?>%"><span style="background-color: white;">orig</span></div>
    <div style="margin: 10px; float: left; width: <?=$fixture[1][0]?>px; height: <?=$fixture[1][1]?>px; background-image: url(image.php?width=<?=$fixture[2][0]?>&height=<?=$fixture[2][1]?>&crop=<?=implode(',', $crop)?>&bust=<?=time()?>); background-size: cover; background-position: 50% 50%"><span style="background-color: white;">crop</span></div>
    <div style="margin: 10px; float: left; width: <?=$fixture[1][0]?>px; height: <?=$fixture[1][1]?>px; background-image: url(image.php?width=<?=$fixture[2][0]?>&height=<?=$fixture[2][1]?>&crop=<?=implode(',', $fixture[3])?>&bust=<?=time()?>); background-size: cover; background-position: 50% 50%"><span style="background-color: white;">fixture</span></div>

  </div>

<?php endforeach?>

</body>
