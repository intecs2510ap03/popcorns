<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'function.php';?>

<?php
    // PDO関数
    $pdo = Connect();

    $err = "";
    // 削除
    if(isset($_POST['delete']) && $_POST['delete']==="削除") {
        
        //回答削除
        if(deleteQuestion($_POST['questionId'])){
            $err = "質問を削除しました。";
        }else{
            $err = "質問の削除に失敗しました。";
        }
        }else{
            $err = "不正アクセスです。";
    }

    // 質問を全部取得
    $question_all = getQuestion($pdo);

    if (isset($_SESSION['user'])) {
        echo '<a href=questionInput.php>質問する</a>';
    }
    
    if (isset($question_all)) {
        foreach ($question_all as $row) {

            // deleteFlg判定
            if ($row['deleteFlg']==0) {
                echo '<p>';
                // ユーザの名前を取得する
                $name = getUserName($row['userId'],$pdo);
                echo $name, '<br>';
                echo $row['question'], '<br>';
                echo $row['date'];

                // 詳細ボタン
                echo '<form action="detail.php" method="get">';
                echo '<input type="hidden" name="questionId" value="', $row['id'] ,'">';
                echo '<input type="submit" value="詳細">';
                echo '</form>';

                // 削除ボタン
                if ((isset($_SESSION['user']) && $_SESSION['user']['id'] == $row['userId'])) {
                    echo '<form action="questions.php" method="POST">';
                    echo '<input type="hidden" name=questionId value="', $row['id']  ,'">';
                    echo '<input type="submit" name="delete" value="削除">';
                    echo '</form>';
                }

                echo '</p>';
            }
        }
    }

?>

<?php require 'footer.php'; ?>
