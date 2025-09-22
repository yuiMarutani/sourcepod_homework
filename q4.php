<?php
require_once("Account.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q4集計（データベースなし）</title>
</head>
<body>
    <div>
        <!--支店ごとの売り上げ総額-->
        <span>支店ごとの売り上げ総額</span>
        <table border="1" cellspacing="0">
            <tr>
                <th>支店</th>
                <th>売上総額</th>
            </tr>
            <tr>
                <td>本店</td>
                <td>  
                    <?php
                        $account_object = new Account(); 
                        $records = $account_object->salesAccount();
                        list($a_price,$hon_price,$b_price) =  array_values($records);
                        echo $hon_price;
                    ?>
                </td>
            </tr>
            <tr>
                <td>支店A</td>
                <td>
                    <?php
                        echo $a_price;
                    ?>
                </td>
            </tr>
            <tr>
                <td>支店B</td>
                <td>
                    <?php
                        echo $b_price;
                    ?>
                </td>
            </tr>
            
        </table>
        <br/>
        <br/>
        <!--商品ごとの売り上げ総額-->
        <span>商品ごとの売り上げ総額</span>
        <table border="1" cellspacing="0">
            <tr>
                <th>商品</th>
                <th>売上総額</th>
            </tr>
            <tr>
                <td>商品A</td>
                <td>  
                    <?php
                        $account_object = new Account(); 
                        $records = $account_object->commodityAccount();
                        list($a_price,$b_price,$c_price,$d_price,$e_price) =  array_values($records);
                        echo $a_price;
                    ?>
                </td>
            </tr>
            <tr>
                <td>商品B</td>
                <td>
                    <?php
                        echo $b_price;
                    ?>
                </td>
            </tr>
            <tr>
                <td>商品C</td>
                <td>
                    <?php
                        echo $c_price;
                    ?>
                </td>
            </tr>
            <tr>
                <td>商品D</td>
                <td>
                    <?php
                        echo $d_price;
                    ?>
                </td>
            </tr>
            <tr>
                <td>商品E</td>
                <td>
                    <?php
                        echo $e_price;
                    ?>
                </td>
            </tr>
        </table>
        <br/>
        <br/>
        <!--⽀店ごとの商品売上ランキング-->
        <?php  
        $records = $account_object->branchCommodityAccount();
        ?>
        <!--本店-->
        <span>支店ごとの商品ランキング</span>
        <span>本店</span>
        <table border="1" cellspacing="0">
            <tr>
                <th>商品ランキング</th>
                <th>売上総額</th>
            </tr>
            <?php 
                $honten = $records[1];
                foreach($honten as $k=>$v){
            ?>
            <tr>
                <td><?php echo $k;?></td>
                <td><?php echo number_format($v);?></td>
            </tr>
            <?php } ?>
        </table>
        <!--支店A-->
        <span>支店A</span>
        <table border="1" cellspacing="0">
            <tr>
                <th>商品ランキング</th>
                <th>売上総額</th>
            </tr>
            <?php 
                $branchA = $records[0];
                foreach($branchA as $k=>$v){
            ?>
            <tr>
                <td><?php echo $k;?></td>
                <td><?php echo number_format($v);?></td>
            </tr>
            <?php } ?>
        </table>
        <!--支店B-->
        <span>支店B</span>
        <table border="1"  cellspacing="0">
            <tr>
                <th>商品ランキング</th>
                <th>売上総額</th>
            </tr>
            <?php 
                $branchB = $records[2];
                foreach($branchB as $k=>$v){
            ?>
            <tr>
                <td><?php echo $k;?></td>
                <td><?php echo number_format($v);?></td>
            </tr>
            <?php } ?>
        </table>
        <br/>
        <br/>
        <!--スタッフ別売上ランキング--->
        <span>スタッフ売り上げランキング</span>
        <?php 
            $records = $account_object->staffAccount();        
        ?>
        <table border="1"  cellspacing="0">
            <tr>
                <th>ランク</th>
                <th>担当者名</th>
                <th>売上総額</th>
            <tr>
            <?php
            $count = 1;
            foreach($records as $name => $price){
            ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $name;?></td>
                <td><?php echo number_format($price);?></td>
            </tr>
            <?php  }  ?>
        </table>
    </div>
</body>
</html>