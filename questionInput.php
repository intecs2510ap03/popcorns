<?php require 'header.php'; ?>
<?php require 'function.php';?>
<?php
session_start();
echo '<th>質問を投稿する</th>';
echo '<br>';
echo '<form action="questionInput.php" method="post">';
echo '<textarea name="question" cols="70" rows="4">';
echo '</textarea>';
echo '<br>';
echo '<input type="submit" value="登録">';
echo '</form>';

if (isset($_POST['question'])) {
    $question = mb_convert_kana($_POST['question'], "s");
    if (trim($question)==="") {
        $err = '質問を入力してください';
    } elseif (mb_strlen($question) > 250) {
        $err = '質問は250文字以内で入力してください';
    } elseif (addQuestion($_SESSION['user']['id'], htmlspecialchars($question))) {
        header('Location: questions.php');
        exit();
    }
    echo $err;
}
echo '<br>';
echo '<form action="questions.php" method="GET">';
echo '<input type="submit" value="戻る">';
echo '</form>';
?>
<?php require 'footer.php'; ?>
