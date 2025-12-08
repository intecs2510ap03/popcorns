<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'function.php';?>

<?php 
$pdo = Connect();


 if ((isset($_SESSION['user']))) {
    echo '削除しました。';
    echo '<form action="questions.php" method="POST">';
}else{
    echo '削除できませんでした。';
    echo '<form action="questions.php" method="POST">';
}

?>

