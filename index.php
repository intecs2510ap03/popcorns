<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'function.php';?>

<!--会員ログインチェック -->
<?php
    $msg = '';
    if (isset($_SESSION['user'])) {
        header('Location: questions.php');
    } 

    if (isset($_REQUEST['userId']) && isset($_REQUEST['userPw'])) {
        
        $userId = $_REQUEST['userId'];
        $userPw = $_REQUEST['userPw'];
        // PDOコネクション
        $pdo = Connect();

        // userチェック
        $sql = isUser($userId, $userPw, $pdo);

        // 結果取得
        foreach ($sql as $row){
            $_SESSION['user']=[
                'id'=>$row['id'],
                'login'=>$row['loginId'],
                'pass'=>$row['password'],
                'name'=>$row['name']
            ];
        }

        // ログイン判定
        if (isset($_SESSION['user'])) {
            header('Location: questions.php');
        } else {
            $msg = 'ログインまたはパスワードが違います。';
        }
    }
?>

<?php
    if (isset($msg)) {
        echo $msg;
    }
?>

<form action ="index.php" method="post">
    ログイン名<input type="text" name="userId"><br>
    パスワード<input type="password" name="userPw"><br>
    <input type="submit" value="ログイン">
</form>
<a href="userAdd.php">新規登録</a>

<form action ="index.php" method="post">
    <input type="submit" value="ログアウト">
</form>


<?php require 'footer.php'; ?>
