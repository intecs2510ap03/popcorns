<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'function.php';?>
<link rel="stylesheet" href="./style/style.css"	>

<div class="main">
 
<!--会員ログインチェック -->
<?php

        if (isset($_SESSION['user'])) {
            echo 'ログイン中です';
        } else {
            echo '<form action ="login.php" method="post">';
            echo 'ログイン名  <input type="text" name="userId" class="login-name"><br>';
            echo 'パスワード  <input type="password" name="userPw" class="login-pass"><br>';
            echo '<input type="submit" value="ログイン" class="login-btn">';
            echo '</form>';
        }

?>

<?php require 'footer.php'; ?>
