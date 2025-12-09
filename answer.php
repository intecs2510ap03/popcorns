<?php session_start(); ?>
<?php ob_start(); ?>
<?php require 'header.php'; ?>
<?php require 'function.php';?>
<link rel="stylesheet" href="./style/style.css"	>

<?php
    // PDO関数
    $pdo = Connect();

    // 質問Idを変数に格納
    $questionId = $_REQUEST['questionId'];

    // 質問内容取得
    $question = getQuestionById($questionId,$pdo);

    echo '<h1>質問</h1>';
    
    foreach ($question as $row) {
        echo '<p">';
        // ユーザの名前を取得する
        $name = getUserName($row['userId'],$pdo);
        echo $name, '<br>';
        echo $row['question'], '<br>';
        echo $row['date'];
        echo '</p>';
    }

    echo '回答';

    echo '<form action="answer.php" method="POST">';
    echo '<input type="text" name="answer">';
    echo '<input type="hidden" name="questionId" value="', $questionId ,'">';
    echo '<input type="submit" value="登録">';
    echo '</form>';

if (isset($_POST['answer'])) {
    $answer = $_POST['answer'];
    $userId = $_SESSION['user']['id'];
    $questionId = (int)$_POST['questionId']; 
    $answer = mb_convert_kana($answer, 's'); // 全角スペースを半角に変換
    if (trim($answer) === "") {
        echo '回答を入力してください';
    } elseif (mb_strlen($answer) > 250) {
        echo '回答は250文字以内で入力してください';
    } elseif (addAnswer($questionId,$userId,$answer)) {
        header('Location: detail.php?questionId=' . $questionId); 
    exit;     
} else {
    echo '回答の登録に失敗しました';
    }}

?>

<!-- 戻るボタン -->
<form action="detail.php" method="get">
<input type="submit" value="戻る">

<?php require 'footer.php'; ?>
