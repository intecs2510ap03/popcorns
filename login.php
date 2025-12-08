<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'function.php';?>

<!--会員ログインチェック -->
<?php
    $msg = '';

    if (isset($_REQUEST['userId']) && isset($_REQUEST['userPw'])) {
        
        // 変数を格納する
        $userId = $_REQUEST['userId'];
        $userPw = $_REQUEST['userPw'];

        // PDOコネクション
        $pdo = Connect();

        // User取得
        $sql = getUser($userId, $userPw, $pdo);

        // User結果取得
        foreach ($sql as $row){
            $_SESSION['user']=[
                'id'=>$row['id'],
                'login'=>$row['loginId'],   
                'pass'=>$row['password'],
                'name'=>$row['name']
            ];
        }

        // 本文編集
        if (isset($_SESSION['user'])) {
            $msg = 'ログインに成功しました。';
        } else {
            $msg = 'ログインまたはパスワードが違います。';
        }
    }

    // 会員登録チェック
    if (isset($_SESSION['user'])) {
        // ログイン成功時はIndex.phpに戻る
        echo $msg;
        header('Location: index.php');
    } else {
        // ログイン失敗時はlogin.phpに戻る
        echo $msg;
        echo '<form action ="login.php" method="post">';
        echo 'ログイン名  <input type="text" name="userId"><br>';
        echo 'パスワード  <input type="password" name="userPw"><br>';
        echo '<input type="submit" value="ログイン">';
        echo '</form>';
    }
?>

<?php require 'footer.php'; ?>
