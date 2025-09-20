<?php
require_once ("jpgraph/src/jpgraph.php");
require_once ("jpgraph/src/jpgraph_bar.php");

class ScaleTen{

    function showScaleTen($filename = 'graph.png'){
        /* 
        入力作成した配列から各点数の数を数える
        0-  9 : ## 
        10- 19 :  
        20- 29 : # 
        30- 39 : # 
        40- 49 : ## 
        50- 59 : ### 
        60- 69 : ##### 
        70- 79 : ##### 
        80- 89 : #### 
        90- 99 : ### 
        100     : # 
        */

        //各数値別の人数の格納用配列を作成、初期化
        $array_list = array(
            '0-9' => 0,
            '10-19' => 0,
            '20-29' => 0,
            '30-39' => 0,
            '40-49' => 0,
            '50-59' => 0,
            '60-69' => 0,
            '70-79' => 0,
            '80-89' => 0,
            '90-99' => 0,
            '100' => 0
        );

        //点数を入力(配列キーを各点数別に分けて作成)
        $input_array = array(62,75,78,96,8,63,55,64,44,70,30,0,58,24,68,88,56,80,92,71,64,98,48,75,82,84,100);
        foreach($input_array as $value){
            if ($value === 100) {
                $array_list['100']++;
            } else {
                $index = floor($value / 10) * 10;
                $key = "{$index}-" . ($index + 9);
                $array_list[$key]++;
            }
        }

        //bar plot value the lowest(this time none)
        $data1y = array(0,0,0,0,0,0,0,0,0,0,0);

        //bar plot value the highest(quantity of person)
        $data2y = array_values($array_list);

        // Create the graph. These two calls are always required
        $graph = new Graph(500,400);
        $graph->SetScale("textlin");

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
        ob_end_clean(); // 出力バッファを無効
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
        $graph->xaxis->SetTickLabels(array("0-9", "10-19", "20-29", "30-39", "40-49", "50-59", "60-69", "70-79","80-89", "90-99", "100"));
        
        // Display the graph
        $graph->Stroke($filename);
        return $filename;
    }
}