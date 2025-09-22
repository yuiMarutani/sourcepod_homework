<?php

class Account{
    /* 
    *＜支店＞(branch)
        00 : 本店
        01 : 支店 A
        02 : 支店 B
        ＜担当者＞(staff)
        001 : 安藤
        002 : 伊藤
        003 : 内田
        004 : 江藤
        005 : 尾崎
        ＜商品＞(commodity)
        0001 : 商品 A
        0002 : 商品 B
        0003 : 商品 C
        0004 : 商品 D
        0005 : 商品 E
     */
    private $branches;
    private $staffs;
    private $commodities;
    private $input;
    private $records = [];

    function __construct() {
        $this->branches = [
            '00' => '本店',
            '01' => '支店 A',
            '02' => '支店 B'
        ];

        $this->staffs = [
            '001' => '安藤',
            '002' => '伊藤',
            '003' => '内田',
            '004' => '江藤',
            '005' => '尾崎'
        ];

        $this->commodities = [
            '0001' => '商品 A',
            '0002' => '商品 B',
            '0003' => '商品 C',
            '0004' => '商品 D',
            '0005' => '商品 E'
        ];
        // 入力データ(すべてのデータの結合)
        $this->input = [
            "01,003,0003,3000",
            "00,001,0005,3000",
            "01,003,0003,10000",
            "02,005,0001,2000",
            "01,003,0001,5000",
            "00,001,0004,1800",
            "00,001,0004,5400",
            "00,001,0002,30000",
            "00,001,0001,1500",
            "02,004,0003,7000",
            "01,003,0003,2000",
            "02,004,0003,4000",
            "02,004,0002,18000",
            "00,003,0002,21000",
            "01,003,0001,2500",
            "02,005,0001,3500",
            "01,003,0005,6750",
            "02,004,0005,4500",
            "00,002,0003,1000",
            "01,003,0004,9000"
        ];
        $this->parseInput();
    }

    /* 
    *分解してキーを付け、全体を見やすいデータにする
    *$this->records[]に
    */
    private function parseInput() {
        foreach ($this->input as $line) {
            list($branch, $staff, $commodity, $price) = explode(',', $line);
            $this->records[] = [
                'branch' => $this->branches[$branch],
                'staff' => $this->staffs[$staff],
                'commodity' => $this->commodities[$commodity],
                'price' => (int)$price
            ];
        }
    }

    /* 
        ・⽀店ごとの売上総額
    */

    public function salesAccount(){
        $records = $this->records;
        $a_price = 0;
        $b_price = 0;
        $hon_price = 0;

        foreach($records as $k){
            $branch = $k['branch'];
            $price = $k['price'];
            
            switch($branch){
                case "支店 A":
                    $a_price = $a_price + $price;
                    break;
                case "本店":
                    $hon_price = $hon_price + $price;
                    break;
                case "支店 B":
                    $b_price = $b_price + $price;
                    break;
            }
        }
           
        $array_list = [
            'a_price'=>number_format($a_price),
            'hon_price'=>number_format($hon_price),
            'b_price'=>number_format($b_price)
        ]; 
        return $array_list;
    }

    /* 
        ・商品ごとの売上総額
    */

    public function commodityAccount(){
        $a_price = 0;
        $b_price = 0;
        $c_price = 0;
        $d_price = 0;
        $e_price = 0;

        $records = $this->records;
        foreach($records as $k){
            $commodity = $k['commodity'];
            $price = $k['price'];

            switch($commodity){
                case "商品 A":
                    $a_price = $a_price + $price;
                    break;
                case "商品 B":
                    $b_price = $b_price + $price;
                    break;
                case "商品 C":
                    $c_price = $c_price + $price;
                    break;
                case "商品 D":
                    $d_price = $d_price + $price;
                    break;
                case "商品 E":
                    $e_price = $e_price + $price;
                    break;
                
            }
        }
    
        $array_list = [
            'a_price'=>number_format($a_price),
            'b_price'=>number_format($b_price),
            'c_price'=>number_format($c_price),
            'd_price'=>number_format($d_price),
            'e_price'=>number_format($e_price)
        ];
           
        return $array_list; 
    }
    /*  
        ・⽀店ごとの商品売上ランキング
    */
    public function branchCommodityAccount() {
        $records = $this->records;

        // 支店ごとの商品売上初期化
        $branchA = ['商品 A'=>0, '商品 B'=>0, '商品 C'=>0, '商品 D'=>0, '商品 E'=>0];
        $honten  = ['商品 A'=>0, '商品 B'=>0, '商品 C'=>0, '商品 D'=>0, '商品 E'=>0];
        $branchB = ['商品 A'=>0, '商品 B'=>0, '商品 C'=>0, '商品 D'=>0, '商品 E'=>0];

        foreach($records as $k){
            $branch = $k['branch'];
            $price = $k['price'];
            $commodity = $k['commodity'];

            switch($branch){
                case "支店 A":
                    $this->switchCommodities($commodity, $branchA, $price);
                    break;
                case "本店":
                    $this->switchCommodities($commodity, $honten, $price);
                    break;
                case "支店 B":
                    $this->switchCommodities($commodity, $branchB, $price);
                    break;
            }
        }

        // ランキング順に並び替え（売上高の降順）
        arsort($branchA);
        arsort($honten);
        arsort($branchB);

        // 整形（3桁区切り）
        foreach([$branchA, $honten, $branchB] as &$branch){
            foreach($branch as &$val){
                $val = number_format($val);
            }
        }

        return [$branchA, $honten, $branchB];
    }

    
    public function switchCommodities($commodity, &$com_list, $price) {
        if (isset($com_list[$commodity])) {
            $com_list[$commodity] += $price;
        }
    }

    /* 
        ・担当者ごとの売上ランキング
    */
    public function staffAccount(){
        $records = $this->records;
        $ando_price = 0;
        $ito_price = 0;
        $uchida_price = 0;
        $eto_price = 0;
        $ozaki_price = 0;

        foreach($records as $k){
            $commodity = $k['commodity'];
            $price = $k['price'];
            $staff = $k['staff'];

            switch($staff){
                case "安藤":
                    $ando_price = $ando_price + $price;
                    break;
                case "伊藤":
                    $ito_price = $ito_price + $price;
                    break;
                case "内田":
                    $uchida_price = $uchida_price + $price;
                    break;
                case "江藤":
                    $eto_price = $eto_price + $price;
                    break;
                case "尾崎":
                    $ozaki_price = $ozaki_price + $price;
                    break;
                
            }
        }
        $tanto = array('伊藤'=>$ito_price,'安藤'=>$ando_price,'内田'=>$uchida_price,'江藤'=>$eto_price, '尾崎'=>$ozaki_price);
       
        arsort($tanto);

        return $tanto;
    }

  
} 