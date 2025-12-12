<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'function.php';?>

<div class="main">
 <div class="question-section">

<?php
if (!isset($_SESSION['user'])) {
    // 登録されていない質問IDの場合、一覧画面に戻る
    header('Location: questions.php');
}
echo '<h2>質問を投稿する</h2>';
echo '<br>';
echo '<form action="questionInput.php" method="post">';
echo '<textarea name="question" cols="70" rows="4" div class="questionInputbox">';
echo '</textarea>';
// echo '<br>';
echo '<div class="btn-line">';
echo '<input type="submit" value="登録" class="touroku-btn">';

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
