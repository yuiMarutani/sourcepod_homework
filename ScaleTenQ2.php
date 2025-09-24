<?php
require_once ("jpgraph/src/jpgraph.php");
require_once ("jpgraph/src/jpgraph_bar.php");

class ScaleTenQ2{

    function showScaleTenQ2($filename = 'graph_q2.png'){
        /* 
        入力作成した配列から各点数の数を数える
        0- 10 : ##
        11- 20 : 
        21- 30 : ##
        31- 40 : 
        41- 50 : ##
        51- 60 : ###
        61- 70 : ######
        71- 80 : #####
        81- 90 : ###
        91-100 : ####
        */

        //各数値別の人数の格納用配列を作成、初期化
        $array_list = array(
            '0-10' => 0,
            '11-20' => 0,
            '21-30' => 0,
            '31-40' => 0,
            '41-50' => 0,
            '51-60' => 0,
            '61-70' => 0,
            '71-80' => 0,
            '81-90' => 0,
            '91-100' => 0
        );

        //点数を入力(配列キーを各点数別に分けて作成)
        $input_array = array(62,75,78,96,8,63,55,64,44,70,30,0,58,24,68,88,56,80,92,71,64,98,48,75,82,84,100);
        foreach($input_array as $value){
            if ($value <= 10) {
                $key = '0-10';
            } elseif ($value >= 91) {
                $key = '91-100';
            } else {
                $start = floor(($value - 1) / 10) * 10 + 1;
                $key = "{$start}-" . ($start + 9);
            }

            if (isset($array_list[$key])) {
                $array_list[$key]++;
            }
        }
        
        //bar plot value the lowest(this time none)
        $data1y = array(0,0,0,0,0,0,0,0,0,0);

        //bar plot value the highest(quantity of person)
        $data2y = array_values($array_list);

        // Create the graph. These two calls are always required
        $graph = new Graph(500,400);
        $graph->SetScale("textlin", 0, max(array_values($array_list)));
        $graph->yaxis->scale->ticks->Set(1);

        $graph->SetShadow();
        $graph->img->SetMargin(40,30,20,40);

        // Create the bar plots
        $b1plot = new BarPlot($data1y);
        $b1plot->SetFillColor("orange");
        $b1plot->value->Show();
        $b2plot = new BarPlot($data2y);
        $b2plot->SetFillColor("blue");
        $b2plot->value->Show();

        // Create the grouped bar plot
        $gbplot = new AccBarPlot(array($b1plot,$b2plot));

        // ...and add it to the graPH
        $graph->Add($gbplot);
        if (ob_get_level() > 0) {
            ob_end_clean();
        }
        mb_http_output("pass"); // データをそのまま出力する

        //タイトル
        $title = "学生のテストの成績（10点単位）";
        $graph->title->Set($title);
        $graph->title->SetFont(FF_MINCHO);

        //x軸タイトル
        $title_x = "点数";
        $graph->xaxis->title->Set($title_x);
        $graph->xaxis->title->SetFont(FF_MINCHO);

        //y軸のタイトル
        $title_y = "人数";
        $graph->yaxis->title->Set($title_y);
        $graph->yaxis->title->SetFont(FF_MINCHO);

        //文字の太さの調整
        $graph->title->SetFont(FF_MINCHO,FS_NORMAL,20);

        //x軸のメモリを手動で調整
        $graph->xaxis->SetTickLabels(array("0-10", "11-20", "21-30", "31-40", "41-50", "51-60", "61-70","71-80", "81-90", "91-100"));
        if (file_exists($filename)) {
            unlink($filename); // 既存ファイルを削除
        }
        // Display the graph
        $graph->Stroke($filename);
        return $filename;
    }
}