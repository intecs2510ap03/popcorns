<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'function.php';?>

<div class="main">
<!--会員パスワード変更 -->
<?php
    // PDO関数
    $pdo = Connect();

    $userPw=$_SESSION['user']['pass'];
    $loginId = $_SESSION['user']['login'];

    $msg = "";
    $successFlg = 0;
    if (isset($_POST['userOldPw']) && isset($_POST['userNewPw'])) {
        $userOldPw=htmlspecialchars($_POST['userOldPw']);
        $userNewPw=htmlspecialchars($_POST['userNewPw']);

        // フォームの空欄チェック
        if (empty($userOldPw) || empty($userNewPw)) {
            $msg = 'フォームが空欄です';
            // 前回のパスワードと入力された前回のパスワードが一致しているか確認
        }elseif ($userOldPw == $userPw) {
            //　パスワードの入力値が一致しない場合
            if ($userOldPw !== $userNewPw) {
                // パスワードの文字制限チェック
                if (preg_match('/^(?=.*[a-z])(?=.*[0-9])[a-z0-9]{6,10}$/',$userNewPw)) {
                    # パスワードのアップデート
                    $pdo = Connect();
                    $sql = $pdo->prepare('UPDATE user SET password=? WHERE loginId=?');
                    $result=$sql->execute([$userNewPw,$loginId]);
                    if ($result) {
                        $successFlg = 1;
                        $msg =  'パスワードを変更しました。再度ログインをおねがいします';
                    } else {
                        $msg = 'パスワードの変更が失敗しました';
                    }
                } else {
                    $msg = 'パスワードは半角英数混在で6～10文字で入力してください';
                }
            } else {
                $msg = '新旧のパスワードが一緒です';
            } 
        } else {
            $msg = '前回のパスワードが一致しません';
        }
    }    
    echo '<span class="error-message">'.$msg.'</span>';

    if (isset($_SESSION['user'])) {
        if (!$successFlg) {
            // パスワード変更が成功しなかったときの処理
            echo '<form action=userPwChg.php method="post">';
            echo '<div class="newpass">旧パスワード </div><input type="password" name="userOldPw"><br>';
            echo '<div class="oldpass">新パスワード  </div><input type="password" name="userNewPw"><br>';
            echo '<input type="submit" value="変更" class="touroku-btn">';
            echo '</form>';
        } else {
            // パスワード変更が成功したときの処理
            echo '<meta http-equiv="refresh" content="3;url=logout.php">';
        }
    } else {
        header('Location: index.php');
    }
?>

<?php require 'footer.php'; ?>
