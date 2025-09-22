<?php

include "jpgraph/src/jpgraph.php";
include "jpgraph/src/jpgraph_canvas.php";
include "jpgraph/src/jpgraph_canvtools.php";


class Canvas{
    public function createPolygon($filename = 'polygon.png'){
        // Define work space
        $xmax = $ymax = 0;

        // Setup a basic canvas we can work
        $g = new CanvasGraph(500,300,'auto');
        $g->SetFrame(false); //set off the frame
    
        // Create a new scale
        $scale = new CanvasScale($g);
        $scale->Set(0, 130, 0, 90);
        //入力
        $points = array(60,20, 80,45, 120,10, 110,40, 120,60, 100,75, 50,80, 35,50);
        
        $shape = new Shape($g,$scale);
        $shape->SetColor('blue');
        $shape->Polygon($points, true); // trueで閉じた形にする

        $shape->SetColor('black');
        /*
        x軸とY軸のminとmaxを調べる 
         */
        $array_dinstinguish = array_chunk($points,2);
        /*
        array_distinguish中身
         Array ( 
            [0] => Array ( [0] => 60 [1] => 20 )
            [1] => Array ( [0] => 80 [1] => 45 )
            [2] => Array ( [0] => 120 [1] => 10 )
            [3] => Array ( [0] => 110 [1] => 40 )
            [4] => Array ( [0] => 120 [1] => 60 )
            [5] => Array ( [0] => 100 [1] => 75 )
            [6] => Array ( [0] => 50 [1] => 80 )
            [7] => Array ( [0] => 35 [1] => 50 ) ) 
        */
        $array_y = array();//xのみの配列
        $array_x = array();//yのみの配列
        foreach($array_dinstinguish as $point_array){
            $x = $point_array[0];
            //xだけの配列作成
            array_push($array_x,$x);
            $y = $point_array[1];
            //yだけの配列作成
            array_push($array_y,$y);
        }
        //最小の枠を作成するために、ＸＹそれぞれ最小と最大を求める
        $xmin = min($array_x);
        $ymin = min($array_y);
        $xmax = max($array_x);
        $ymax = max($array_y);

        $shape->Rectangle($xmin, $ymin, $xmax, $ymax);
        // Stroke the graph
        if (file_exists($filename)) {
            unlink($filename); // 既存ファイルを削除
        }
        $g->Stroke($filename);
        return $filename;
    }
}
