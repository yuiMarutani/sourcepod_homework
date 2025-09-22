<?php
require_once('ScaleTenQ2.php');
require_once('ScaleFiveQ2.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q2学生の成績（10単位、5単位）</title>
</head>
<body>
    <div style="display:flex;">
        <!--10単位の表示-->

        <?php 
            $show_scale_ten = new ScaleTenQ2();//10単位の学生の成績の表示
            $image_path = $show_scale_ten->showScaleTenQ2('graph_q2.png'); //表示ファンクション呼び出し
        ?>
        <img src="<?= $image_path ?>" alt="グラフ">&nbsp;

        <!--5単位の表示-->

        <?php
            $show_scale_five = new ScaleFiveQ2();//10単位の学生の成績の表示
            $image_path_2 = $show_scale_five->showScaleFiveQ2('graph2_q2.png'); //表示ファンクション呼び出し
        ?>
        <img src="<?= $image_path_2 ?>" alt="グラフ2">
    </div>
   
</body>
</html>