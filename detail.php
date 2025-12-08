<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'function.php';?>

<?php
    // PDO関数
    $pdo = Connect();

    echo '<p>質問</p>';

    // 質問を全部取得
    $question_all = getQuestion($pdo);
    
    echo '<p>';
    // 質問内容
    $name = getUserName($question_all[$_REQUEST['questionId']]['userId'],$pdo);
    echo $name, '<br>';
    echo $question_all[$_REQUEST['questionId']]['id'], '<br>';
    echo $question_all[$_REQUEST['questionId']]['question'], '<br>';

    // 回答ボタン
    echo '<form action="answer.php" method="post">';
    echo '<input type="hidden" name="questionId" value="', $row['id'] ,'">';
    echo '<input type="submit" value="詳細">';
    echo '</form>';
    echo '</p>';

    // 回答内容


    // foreach ($question_all as $row) {
    //     echo '<p>';
    //     // ユーザの名前を取得する
    //     $name = getUserName($row['userId'],$pdo);
    //     echo $name, '<br>';
    //     echo $row['question'], '<br>';
    //     echo $row['date'];
    //     echo '<form action="detail.php" method="post">';
    //     echo '<input type="hidden" name="questionId" value="', $row['id'] ,'">';
    //     echo '<input type="submit" value="詳細">';
    //     echo '</form>';
    //     echo '</p>';
    // }



    // echo $user_name;
    // echo '<br>';
    // echo $question_question;
    // echo '<br>';
    // echo $question_date;
    // echo '<br>';

?>

<?php require 'footer.php'; ?>
