<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'function.php';?>


<?php
    // PDO関数
    $pdo = Connect();


    // 質問Idを変数に格納
    $questionId = $_REQUEST['questionId'];
    
    // 質問内容取得
    $question = getQuestionById($questionId,$pdo);
    if (!$question) {
         // 登録されていない質問IDの場合、一覧画面にも度折る
        header('Location: questions.php'); 
        exit;
    } 

    echo '<div class="main">';

    // 質問タイトル
    echo '<h2>質問</h2>'; 

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
    
        //質問IDが正しく取得できた場合のみ表示する
        foreach ($question as $row) {

            //削除対象の質問IDが選択されたときは一覧画面に戻る
            if ($row['deleteFlg'] == 1) {
                header('Location: questions.php'); 
            }

        
            echo '<div class="questionbox">';
        // ユーザの名前を取得する
        $name = getUserName($row['userId'],$pdo);
        echo '<div class="name">',$name, '<br></div>';
        echo '<div class="question">',$row['question'], '<br></div>';
        echo '<div class="date">',$row['date'],'</div>';
        echo '</div>';
        }

        // 回答ボタン
       // if (!isset($_SESSION['user'])) {
        // ログイン成功時はIndex.phpに戻る
        //header('Location: detail.php');}
			if (!isset($_SESSION['user'])) {
			}
        else{
        echo '<form action="answer.php" method="get">';
        echo '<input type="hidden" name="questionId" value="', $questionId ,'">';
        echo '<input type="submit" value="回答" class="answer-btn">';
        echo '</form>';
        }
        // 回答内容一覧取得
        $answer_All = getAnswersByQuestionId($questionId,$pdo);
        
        
        echo '<div class="answers-section">';
        if (!empty($answer_All)) {
            
            // 回答タイトル
            echo '<h2>回答</h2>';

            // 回答内容
            foreach ($answer_All as $row) {

                if ($row['deleteFlg'] == 0) {
                    echo '<div class="answer-container">';
                // ユーザの名前を取得する
                $name = getUserName($row['userId'],$pdo);
                echo '<div class="answerbox">';
        // ユーザの名前を取得する
            $name = getUserName($row['userId'],$pdo);
                echo '<div class="name">',$name, '<br></div>';
                echo '<div class="answer">',$row['answer'], '<br></div>';
                echo '<div class="date">',$row['date'],'</div>';
                echo '</div>';

                // ユーザーの投稿内容なら削除ボタンの表示
                if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $row['userId']) {
                    echo '<form action="detail.php?questionId=', $questionId ,'" method="post">';

                    echo '<input type="hidden" name="answerId" value="', $row['id'] ,'">';

                    echo '<input type="submit" name="delete" value="削除" class="delete-btn">';
                    echo '</form>';
                }
                echo '</div>';
                }            
            }
        }


?>

</div>

<!-- 戻るボタン -->
<form action="questions.php" method="get">
<input type="submit" value="戻る" class="btn">

<?php require 'footer.php'; ?>
