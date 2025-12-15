<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'function.php';?>
<link rel="stylesheet" href="./style/style.css"	>

<div class="main">
 
<!--会員ログインチェック -->
<div class="login-section">
<?php

        if (isset($_SESSION['user'])) {
            echo '<div class="login-now"> ログイン中です</div>';
            echo '<div class="questionInput-btn">';
            echo '<a href=questionInput.php>質問する</a>';
            echo '</div><br>';
            echo '<div class="questions-btn">';
            echo '<a href="questions.php">質問一覧</a>';
            echo '</div><br>';
            echo '</div>';
            echo '<div class="questions-btn">';
            echo '<a href="omikuji.php">おみくじ</a>';
            echo '</div>';
            echo '</div>';

        } else {
            echo '<form action ="login.php" method="post">';
            echo '<div class="user"> ログイン名  </div><input type="text" name="userId" class="login-name"><br>';
            echo '<div class="pass"> パスワード  </div><input type="password" name="userPw" class="login-pass"><br>';
            echo '<input type="submit" value="ログイン" class="login-btn">';
            echo '</form>';
        }

?>
</div>

<?php require 'footer.php'; ?>
