<?php require 'header.php'; ?>
<?php require 'function.php';?>

<div class="main">
 <div class="question-section">

<?php
session_start();
if (!isset($_SESSION['user'])) {
    // 登録されていない質問IDの場合、一覧画面に戻る
    header('Location: questions.php');
}
echo '<h2>質問を編集する</h2>';
echo '<br>';
echo '<form action="edit.php" method="post">';
echo '<textarea name="update" cols="70" rows="4" div class="questionInputbox">';
echo '</textarea>';
echo '<input type="hidden" name=questionId value="', $_POST['questionId'] ,'">';
echo '<div class="btn-line">';
echo '<input type="submit" value="登録" class="touroku-btn">';

if (isset($_POST['update'])) {
    $question = mb_convert_kana($_POST['update'], "s");
    if (trim($question)==="") {
        $err = '編集内容を入力してください';
    } elseif (mb_strlen($question) > 250) {
        $err = '編集内容は250文字以内で入力してください';
    } elseif (edit($_POST['update'], $_POST['questionId'])) {
        header('Location: questions.php');
        exit();
    }
    echo '<span class="error-message">'.$err. '</span>';
}
echo '</div></form>';

echo '<br>';
echo '<form action="questions.php" method="GET">';
echo '<input type="submit" value="戻る" class="btn">';
echo '</form>';
?>

</div>
</div>
<?php require 'footer.php'; ?>
