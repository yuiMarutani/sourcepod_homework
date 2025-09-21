<?php
require_once('ScaleTen.php');
require_once('ScaleFive.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学生の成績（10単位、5単位）</title>
</head>
<body>
    <div>
        <!--10単位の表示-->

        <?php 
            $show_scale_ten = new ScaleTen();//10単位の学生の成績の表示
            $image_path = $show_scale_ten->showScaleTen('graph.png'); //表示ファンクション呼び出し
        ?>
        <img src="<?= $image_path ?>" alt="グラフ">&nbsp;

        <!--5単位の表示-->

        <?php
            $show_scale_five = new ScaleFive();//10単位の学生の成績の表示
            $image_path_2 = $show_scale_five->showScaleFive('graph2.png'); //表示ファンクション呼び出し
        ?>
        <img src="<?= $image_path_2 ?>" alt="グラフ2">
    </div>
   
</body>
</html>