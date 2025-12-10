<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'function.php';?>

<main>
    <form action="/userAdd.php" method="post">
    <h2>利用者登録</h2>
    <table>
        <tr>
            <th>表示名</th>
            <td><input type="text" name="viewName" placeholder=""></td>
        </tr>
        <tr>
            <th>ユーザーID</th>
            <td><input type="text" name="userId" placeholder=""></td>
        </tr>
        <tr>
            <th>パスワード</th>
            <td><input type="text" name="pass" placeholder=""></td>
        </tr>
        <tr>
            <td> <p class="submit"><input type="submit" value="登録"></p></td>
            <td>エラーメッセージ</td>
        </tr>
        <tr>
            <td> <a href="index.php"><input type="submit" value="戻る"></a></td>
        </tr>
    </table>
    </form>
</main>
<?php echo 'userAdd.php'; ?>
以下機能を追加してください<br>
・利用者IDは8文字以上10文字以下<br>
・パスワードは6文字以上10文字以下<br>
・利用者IDとパスワードは半角英数字のみ使用<br>
・重複した利用者IDは登録不可<br>
・重複したパスワードも登録不可<br>
・htmlspecialchars()関数を使用する<br>

<?php require 'footer.php'; ?>
