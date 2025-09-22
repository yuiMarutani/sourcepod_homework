<?php
    require_once('Canvas.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ポリゴン</title>
</head>
<body>
    <?php 
    $canvas = new Canvas();
    $image_path = $canvas->createPolygon('polygon.png');
    ?>
    <img src="<?= $image_path ?>" alt="グラフ">&nbsp;
</body>
</html>