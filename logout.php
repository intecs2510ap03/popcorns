<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'function.php';?>

<!--会員ログアウト -->
<?php

    if (isset($_SESSION['user'])) {
        echo 'ログアウト中';
        unset($_SESSION['user']);
        header('Location: index.php');
    }
?>

<?php require 'footer.php'; ?>
