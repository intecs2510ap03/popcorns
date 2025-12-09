<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'function.php';?>

<?php
    // PDO関数
    $pdo = Connect();

    // 質問Idを変数に格納
    $questionId = $_REQUEST['questionId'];
    
    // 質問タイトル
    echo '<p>質問</p>';

    // 質問内容取得
    $question = getQuestionById($questionId,$pdo);    
    
    foreach ($question as $row) {
        echo '<p">';
        // ユーザの名前を取得する
        $name = getUserName($row['userId'],$pdo);
        echo $name, '<br>';
        echo $row['question'], '<br>';
        echo $row['date'];
    }

    // 回答ボタン
    echo '<form action="answer.php" method="post">';
    echo '<input type="hidden" name="questionId" value="', $questionId ,'">';
    echo '<input type="submit" value="回答">';
    echo '</form>';
    echo '</p>';
    
    // 回答内容一覧取得
    $answer_All = getAnswersByQuestionId($questionId,$pdo);
    
    if (!empty($answer_All)) {
        
        // 回答タイトル
        echo '<p class="answer-box">回答</p>';

        // 回答内容
        foreach ($answer_All as $row) {
            echo '<p class="answer-box">';
            // ユーザの名前を取得する
            $name = getUserName($row['userId'],$pdo);
            echo $name, '<br>';
            echo $row['answer'], '<br>';
            echo $row['date'];

            // ユーザーの投稿内容なら削除ボタンの表示
            if ($_SESSION['user']['id'] == $row['userId']) {
                echo '<form action="delete.php" method="post">';
                echo '<input type="hidden" name="questionId" value="', $row['id'] ,'">';
                echo '<input type="submit" value="削除">';
                echo '</form>';
            }
            
            echo '</p>';
        }
    }

?>

<?php require 'footer.php'; ?>
