<?php session_start(); ?> <!-- /*sessionでデータを繋げてる* -->
<?php require 'header.php'; ?>
<?php require 'function.php';?>
<?php
    // 空にしてる
    $loginId=$password=$name=$err=""; 
    // もしユーザーが空なら登録（ログインしてない）、ユーザーが有なら会員です。　
    if(isset($_SESSION['user'])){//
        echo 'あなたはすでに会員です。';
    } else {
        echo '<form action="userAdd.php" method="post">';
        echo '<h1>利用者登録</h1>';
        echo '表示名';
        echo '<input type="text" name="viewName" required maxlength="10"><BR>';
        echo 'ユーザーID';
        echo '<input type="text" name="userId" required maxlength="10"><BR>';
        echo 'パスワード';
        echo '<input type="text" name="pass" required maxlength="10"><BR>';
        echo '<input type="submit" value="登録">';
        echo '</form>';
        echo '<form action="index.php" method="GET">';
        echo '<input type="submit" value="戻る">';
        echo '</form>';
    }
    // 入力された内容　パス　かつ　ID　が入力されていたら　TR
    if (isset($_POST['pass']) && isset($_POST['userId']) && isset($_POST['viewName'])) {
        $password=htmlspecialchars($_POST['pass']);
        $userId=htmlspecialchars($_POST['userId']);
        $viewName=htmlspecialchars($_POST['viewName']);
        // 入力ルールに沿っているかパスの次にIDチェック

  //ファンクションキーのisUser関数の処理を行っている
                // function isUser($userId, $userPw){
                //     $pdo = Connect();
                //    ユーザID,パスワードの重複チェック
                //     $sql = $pdo->prepare('SELECT * FROM user WHERE loginId=? or password=?');
                //     $sql->execute([$userId,$userPw]);
                //     // 結果判定
                //     if ($sql->rowCount() > 0) {
                //         return true; // 重複あり
                //     }else {
                //         return false; // 重複なし
                //     }
                // 帰ってきた結果が$resultに入って処理が進む
    
    if (preg_match_all('/[ぁ-んァ-ヶ亜-熙]{1,10}$/u', $viewName, $matches)) {
        if (preg_match('/^(?=.*[a-z])(?=.*[0-9])[a-z0-9]{6,10}$/',$password)) {
            if (preg_match('/^(?=.*[a-z])[a-z]{8,10}$/',$userId)) {
                $result = isUser($userId,$password);
                if ($result) {
                    $err= 'このユーザーIDまたはパスワードは使用できません';
                } else {
                    $err= '登録できるよ';
                    addUser($userId,$password,$viewName);
                    header('Location: index.php');
                }
            } else {
            $err='ユーザーIDは半角英字8文字以上10文字以下で入力してください。';
            }
        } else {
        $err='利用パスワードは半角英数字6文字以上10文字以下で入力してください。';
        }
    }else{
    $err='表示名は10文字以下の日本語で入力してください。';
    }}
            echo $err ;


?>
<?php require 'footer.php';?>