<?php require 'header.php'; ?>
<?php require 'function.php';?>

<?php 

/* 
echo '<input type="submit" value="ログアウト">'

if(isset($_SESSION['user'])){
    unset($_SESSION['user']);
    header('Location:index.php');
    exit;
}
*/

/*
・アンセット、でログアウトする機能を作る→インデックスに戻る

・質問内容を引っ張ってくる
→質問IDを質問内容を引っ張ってくる（

function addAnswer($['id],questionID,userID,answer){

}return ;

$row['question']/* 質問内容の関数 
$row['questionID']

$row['answer']['id'] /* 回答のID 
$row['answer'] /* 回答の内容 */
/*
・回答欄のフォームをつくる
・input type="text"で入力欄
・登録はsubmit value="登録"
・使用する関数＝addAnswer（DBに回答を登録）

 */


?>

<!-- 戻るボタン -->
<form action="detail.php" method="get">
<input type="submit" value="戻る">

<?php require 'footer.php'; ?>
