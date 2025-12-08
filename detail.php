<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'function.php';?>

<?php
    // PDO関数
    $pdo = Connect();

    // 質問を全部取得
    $question_all = getQuestion($pdo);
    

    echo '<p>質問</p>';
    echo '<p>';
    $questionId = $_REQUEST['questionId'] -1;
    // 質問内容
    $name = getUserName($question_all[$questionId]['userId'],$pdo);
    echo $name, '<br>';
    echo $question_all[$questionId]['question'], '<br>';
    echo $question_all[$questionId]['date'], '<br>';

    // 回答ボタン
    echo '<form action="answer.php" method="post">';
    echo '<input type="hidden" name="questionId" value="', $questionId ,'">';
    echo '<input type="submit" value="回答">';
    echo '</form>';
    echo '</p>';

    // 回答内容
    echo '<p class="answer-box">回答</p>';

    $sql = $pdo->prepare('select * from answer where questionId=?');
    $sql->execute([$_REQUEST['questionId']]);
    $answer_All = $sql->fetchAll();
    
    foreach ($answer_All as $row) {
        echo '<p class="answer-box">';
        // ユーザの名前を取得する
        $name = getUserName($row['userId'],$pdo);
        echo $name, '<br>';
        echo $row['answer'], '<br>';
        echo $row['date'];
        echo '<form action="detail.php" method="post">';
        echo '<input type="hidden" name="questionId" value="', $row['id'] ,'">';
        echo '<input type="submit" value="詳細">';
        echo '</form>';
        echo '</p>';
    }

?>

<?php require 'footer.php'; ?>
