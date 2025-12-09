<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'function.php';?>

<?php echo 'userAdd.php'; ?>
以下機能を追加してください<br>
・利用者IDは8文字以上10文字以下<br>
・パスワードは6文字以上10文字以下<br>
・利用者IDとパスワードは半角英数字のみ使用<br>
・重複した利用者IDは登録不可<br>
・重複したパスワードも登録不可<br>
・htmlspecialchars()関数を使用する<br>

<?php require 'footer.php'; ?>
