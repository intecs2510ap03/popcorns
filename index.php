<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'function.php';?>

<!--会員ログインチェック -->
<?php

        if (isset($_SESSION['user'])) {
            echo 'ログイン中です';
        } else {
            echo '<form action ="login.php" method="post">';
            echo 'ログイン名  <input type="text" name="userId"><br>';
            echo 'パスワード  <input type="password" name="userPw"><br>';
            echo '<input type="submit" value="ログイン">';
            echo '</form>';
        }

?>

<?php require 'footer.php'; ?>
