<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'function.php';?>

<div class="main">
    <h2>ログイン</h2>
<!--会員ログインチェック -->
<div class="login-section">
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
            $msg = '<h3>ログインまたはパスワードが違います。</h3>';
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
        echo '<div class="user"> ログイン名  </div><input type="text" name="userId" class="login-name"><br>';
        echo '<div class="pass"> パスワード  </div><input type="password" name="userPw" class="login-pass"><br>';
        echo '<input type="submit" value="ログイン" class="login-btn">';
       // echo 'ログイン名  <input type="text" name="userId"><br>';
        //echo 'パスワード  <input type="password" name="userPw"><br>';
        // echo '<input type="submit" value="ログイン">';
        echo '</form>';
    }
?>

</div>
</div>
<?php require 'footer.php'; ?>
