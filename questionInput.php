<?php require 'header.php'; ?>
<?php require 'function.php';?>
<?php
echo '<th>質問を投稿する</th>';
echo '<br>';
echo '<form acion="questionInput.php" method="post">';
echo '<input type="textarea" name="question" cols="40" rows="4" value= "">';
echo '<br>';
echo '<input type="submit" value="登録">';

if(isset($_SESSION['user'])) {
    $pdo = Connect();
    $sql=$pdo->prepare('insert into question values (null,?,?,now(),0)');
    $sql->execute([
        $_REQUEST['userId'],$_REQUEST['question'],$_REQUEST['date']
    ]);
}else{
    echo '質問を投稿できませんでした。';
}
echo '<br>';
echo '<input type="submit" value="戻る">';
?>
<?php require 'footer.php'; ?>
