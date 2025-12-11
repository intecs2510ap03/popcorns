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

    $err = "";
    // 削除
    if(isset($_POST['delete']) && $_POST['delete']==="削除") {
        
        //回答削除
        if(deleteAnswer($_POST['answerId'])){
            $err = "回答を削除しました。";
        }else{
            $err = "回答の削除に失敗しました。";
        }
        }else{
            $err = "不正アクセスです。";
    }
     
    // 表示
    if (isset($question)) {
        //質問IDが正しく取得できた場合のみ表示する
        foreach ($question as $row) {

            //削除対象の質問IDが選択されたときは一覧画面に戻る
            if ($row['deleteFlg'] == 1) {
                header('Location: questions.php'); 
            }

            echo '<p">';
            // ユーザの名前を取得する
            $name = getUserName($row['userId'],$pdo);
            echo $name, '<br>';
            echo $row['question'], '<br>';
            echo $row['date'];
        }

        // 回答ボタン
        echo '<form action="answer.php" method="get">';
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

                if ($row['deleteFlg'] == 0) {
                echo '<p class="answer-box">';
                // ユーザの名前を取得する
                $name = getUserName($row['userId'],$pdo);
                echo $name, '<br>';
                echo $row['answer'], '<br>';
                echo $row['date'];

                // ユーザーの投稿内容なら削除ボタンの表示
                if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $row['userId']) {
                    echo '<form action="detail.php?questionId=', $questionId ,'" method="post">';

                    echo '<input type="hidden" name="answerId" value="', $row['id'] ,'">';

                    echo '<input type="submit" name="delete" value="削除">';
                    echo '</form>';
                }
                echo '</p>';
                }            
            }
        }

    } else {
        // 登録されていない質問IDの場合、一覧画面にも度折る
        header('Location: questions.php'); 
    }

?>

<!-- 戻るボタン -->
<form action="questions.php" method="get">
<input type="submit" value="戻る">

<?php require 'footer.php'; ?>
