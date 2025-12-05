<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'function.php';?>

<!--会員ログインチェック -->
<?php
    $msg = '';

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
    }

    // 本文編集
    if (isset($msg)) {
        echo $msg;
    }

    if (isset($_SESSION['user'])) {
        // header('Location: questions.php');
        echo '<a href="questionInput.php">質問入力</a><br>';
        echo '<a href="userAdd.php">ログアウト</a>';
    } else {
        $msg = 'ログインまたはパスワードが違います。';
        echo '<form action ="index.php" method="post">';
        echo 'ログイン名<input type="text" name="userId"><br>';
        echo 'パスワード<input type="password" name="userPw"><br>';
        echo '<input type="submit" value="ログイン">';
        echo '</form>';
    }
?>

<?php require 'footer.php'; ?>
