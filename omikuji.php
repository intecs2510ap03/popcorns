<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'function.php';?>
<link rel="stylesheet" href="./style/style.css"	>

<div class="main">
 
<!--おみくじ内容 -->
<?php
        $namber0=rand(1,5);
        echo '今日の ',$_SESSION['user']['name'];
        echo ' さんは<BR>';
        echo '<p/>';
            switch ($namber0) {
                case '1';
                echo '<img src="./img/mirakul.png" alt="ミラクルラッキー" style="width: 600px; height: 250px;"><BR>';
                echo 'あなたが存在してることがもう最高！';
                break;
                case '2';
                echo '<img src="./img/haipa.jpg" alt="ハイパーラッキー" style="width: 600px; height: 250px;"><BR>';
                echo '今日はいつも以上に前向きに過ごせちゃうね！';
                break;
                case '3';
                echo '<img src="./img/supesyaru.jpg" alt="スペシャルラッキー" style="width: 600px; height: 250px;"><BR>';
                echo 'あなたの笑顔がさらに世界を幸せにするよ！';
                break;
                case '4';
                echo '<img src="./img/super.jpg" alt="スーパーラッキー" style="width: 600px; height: 250px;"><BR>';
                echo '息をするだけで幸運の連鎖が待ってる！';
                break;
                case '5';
                echo '<img src="./img/lucky.jpg" alt="ラッキーラッキー" style="width: 600px; height: 250px;"><BR>';
                echo '人に優しくすると最高に最高が重なる！';
                break;
               }
               echo '<BR><BR>';
               echo 'そんなあなたに贈る言葉<BR><BR>';

        $namber1=rand(1,5);
            switch ($namber1) {
                case '1';
                echo 'ウォルト・ディズニー (Walt Disney)<BR>';
                echo '「夢を追い続ける勇気さえあれば、全ての夢は必ず実現できる。」<BR>';
                break;
                case '2';
                echo 'ヘレン・ケラー (Helen Keller)<BR>';
                echo '「顔を太陽に向けていれば、影を見ることはない。」<BR>';
                break;
                case '3';
                echo 'ネルソン・マンデラ (Nelson Mandela)<BR>';
                echo '「物事は、それが達成されるまでは、常に不可能に見えるものである。」<BR>';
                break;
                case '4';
                echo 'アルベルト・アインシュタイン (Albert Einstein)<BR>';
                echo '「困難のさなかにこそ、好機がある。」<BR>';
                break;
                case '5';
                echo 'ウィンストン・チャーチル(Winston Churchill)<BR>';
                echo '「悲観主義者は全ての好機の中に困難を見つける。楽観主義者は全ての困難の中に好機を見つける。」<BR>';
                break;
               }
            echo '<BR>';
            echo '今日も一日頑張りましょう！';
               
?>
<?php require 'footer.php'; ?>