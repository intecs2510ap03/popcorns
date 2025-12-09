<?php session_start(); ?>
<?php ob_start(); ?>
<?php require 'header.php'; ?>
<?php require 'function.php';?>

<?php

$pdo = Connect();


    echo '<p>質問</p>';

    // 名前取得
    $sql=$pdo->prepare('select * from user where id=?');
    $sql->execute([1]);
    foreach($sql as $row) {
        $user_id = $row['id'];
        $user_loginId = $row['loginId'];
        $user_password = $row['password'];
        $user_name = $row['name'];
    }

    // 質問内容取得
    $sql=$pdo->prepare('select * from question where userId=?');
    $sql->execute([$user_id]);
    foreach($sql as $row) {
        $question_id = $row['id'];
        $question_userId = $row['userId'];
        $question_question = $row['question'];
        $question_date = $row['date'];
        $question_delFlg = $row['deleteFlg'];
    }

    echo $user_name;
    echo '<br>';
    echo $question_question;
    echo '<br>';
    echo $question_date;
    echo '<br>';



echo '回答';

echo '<form action="answer.php" method="POST">';
echo '<input type="text" name="answer">';
echo '<input type="hidden" name="question_id" value="1">';
echo '<input type="submit" value="登録">';


if (isset($_POST['answer'])) {
    $answer = $_POST['answer'];
    $userId = $_SESSION['user']['id'];
    $questionId = (int)$_POST['question_id']; // 空白除去_
    $answer = mb_convert_kana($answer, 's'); // 全角スペースを半角に変換
    if (trim($answer) === "") {
        echo '回答を入力してください';
    } elseif (mb_strlen($answer) > 250) {
        echo '回答は250文字以内で入力してください';
    } elseif (addAnswer($questionId,$userId,$answer)) {
    header('Location: detail.php?question_id=' . $questionId); 
    exit;     
} else {
    echo '回答の登録に失敗しました';
    }}

?>

<!-- 戻るボタン -->
<form action="detail.php" method="get">
<input type="submit" value="戻る">

<?php require 'footer.php'; ?>
