userAdd.php<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'function.php';?>
<?php
    $loginId=$password=$name=$err="";

    if(!isset($_SESSION['user'])){
        // $sql=$pdo->prepare('insert into user values(null,?,?,?)');
        // $sql->execute([$_POST['name'],$_POST['loginId'],$_POST['password']]);
        // $name=$_POST['name'];
    echo '<form action="userAdd.php" method="post">';
    echo '<h1>利用者登録</h1>';
    echo '<table>';
    echo '<tr><th>表示名</th>';
    echo '<td><input type="text" name="viewName">';
    echo '</td></tr>';
    echo '<tr><th>ユーザーID</th>';
    echo '<td><input type="text" name="userId">';
    echo '</td></tr>';
    echo '<tr><th>パスワード</th>';
    echo '<td><input type="text" name="pass">';
    echo '</td></tr>';
    echo '<tr><td>';
    echo '<input type="submit" value="登録">';
    echo '</td>';
    } else {
        echo 'あなたはすでに会員です。';
    }
    if (isset($_POST['pass']) && isset($_POST['userId'])) {
        $password=$_POST['pass'];
        $userId=$_POST['userId'];
    
     if (preg_match('/^(?=.*[a-z])(?=.*[0-9])[a-z0-9]{6,10}$/',$password)) {
            if (preg_match('/^(?=.*[a-z])[a-z]{8,10}$/',$userId)) {
            // $err='成功';
            $result = isUser($userId,$password);
            if ($result) {
                $err= 'このユーザーIDまたはパスワードは使用できません';
            } else {
                $err= '登録できるよ';
            }
        } else {
        $err='ユーザーIDは8文字以上10文字以下で入力してください。';
     }
        } else {
        $err='利用パスワードは6文字以上10文字以下で入力してください。';
     }
    }

            echo '<td>', $err ,'</td>';
?>
        </tr>
        <tr>
            <td> <a href="index.php"><input type="submit" value="戻る"></a></td>
        </tr>
    </table>
    </form>

    <!-- if (isset($_POST['userId'])) {
    $question = mb_convert_kana($_POST['question'], "s");
    if (trim($question)==="") {
        $err = '質問を入力してください';
    } elseif (mb_strlen($question) > 250) {
        $err = '質問は250文字以内で入力してください';
    } elseif (addQuestion($_SESSION['user']['id'], htmlspecialchars($question))) {
        header('Location: questions.php');
        exit();
    }
    echo $err; -->

<?php echo 'userAdd.php'; ?>
以下機能を追加してください<br>
・利用者IDは8文字以上10文字以下<br>
・パスワードは6文字以上10文字以下<br>
・利用者IDとパスワードは半角英数字のみ使用<br>
・重複した利用者IDは登録不可<br>
・重複したパスワードも登録不可<br>
・htmlspecialchars()関数を使用する<br>

<?php require 'footer.php'; ?>
