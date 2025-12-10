<?php session_start(); ?>
<?php ob_start(); ?>
<?php require 'header.php'; ?>
<?php require 'function.php';?>
<link rel="stylesheet" href="./style/style.css"	>


<div class="main">
<?php
    // PDO関数
    $pdo = Connect();

    // 質問Idを変数に格納
    $questionId = $_REQUEST['questionId'];

    // 質問内容取得
    $question = getQuestionById($questionId,$pdo);
?>
    
 <div class="question-section">
    
    <?php
    echo '<h1>質問</h1>';
    
    foreach ($question as $row) {
        echo '<div class="questionbox">';
        // ユーザの名前を取得する
        $name = getUserName($row['userId'],$pdo);
        echo '<div class="name">',$name, '<br></div>';
        echo $row['question'], '<br>';
        echo '<div class="date">',$row['date'],'</div>';
        echo '</div>';
    }
    ?>
</div>
   
    <div class="answer-section">
<?php
    echo '<h2>回答</h2>';

    echo '<form action="answer.php" method="POST">';
    echo '<textarea name="answer" cols="70" rows="4" div class="anstexbox">';
    echo '</textarea>';
    echo '<br>';
    echo '<input type="hidden" name="questionId" value="', $questionId ,'">';
    echo '<input type="submit" value="登録" class="touroku-btn">';
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
</div>

<!-- 戻るボタン -->

<form action="detail.php" method="get">

<input type="submit" value="戻る" class="btn">
</form>

</div>
<?php require 'footer.php'; ?>
