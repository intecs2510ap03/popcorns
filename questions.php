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
    if (isset($_SESSION['user'])) {
        echo '<a href=questionInput.php>質問する</a><br>';
    }
    // ソートリンク
    echo ' 並び替え: <a href="?sort=new">新着順</a> |
          <a href="?sort=old">古い順</a>';

    // ソート機能
    $sort = $_GET['sort'] ?? 'new';

    switch ($sort) {
        case 'old':
            $order = "ORDER BY date ASC";
            break;
        default:
            $order = "ORDER BY date DESC"; // 新着順
    }
    // 質問を全部取得
    $question_all = getQuestion($order);

    echo '<form action="questions.php" method="GET">';
    echo '<input type="text" name="keyword"><br>';
    echo '<input type="submit" value="検索">';
    echo '</form>';

    echo '<form action="questions.php" method="GET">';
    echo '<input type="submit" value="クリア">';
    echo '</form>';

    if(isset($_GET['keyword'])){
        $pdo = Connect();
        $sql = $pdo->prepare('select * from question where deleteFlg=0 and question like ?');
        $sql->execute(['%'.$_GET['keyword'].'%']);
        $serch_All = $sql->fetchAll();
        if(!empty($serch_All)){
            foreach ($serch_All as $row) {
                if ($row['deleteFlg']==0) {
                    echo '<p>';
                    // ユーザの名前を取得する
                    $name = getUserName($row['userId'],$pdo);
                    echo $name, '<br>';
                    echo mb_strimwidth($row['question'], 0, 60, "...") , '<br>';
                    echo $row['date'];

                    $count = $row['id'];
                    $sql1 = $pdo->prepare('SELECT questionId, COUNT(questionId) FROM answer WHERE deleteFlg = 0 and questionId=?');
                    $sql1->execute([$count]);
                    $answerCount = $sql1->fetch();
                    echo '<br>';
                    echo '回答数:',$answerCount['COUNT(questionId)'];

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
        }else{
            echo '該当の質問は見つかりませんでした。';
        }
    }
    if(!isset($_GET['keyword'])){
    if (isset($question_all)) {
        foreach ($question_all as $row) {

            // deleteFlg判定
            if ($row['deleteFlg']==0) {
                echo '<p>';
                // ユーザの名前を取得する
                $name = getUserName($row['userId'],$pdo);
                echo $name, '<br>';
                 echo mb_strimwidth($row['question'], 0, 60, "...") , '<br>';
                echo $row['date'];

                $count = $row['id'];
                $sql1 = $pdo->prepare('SELECT questionId, COUNT(questionId) FROM answer WHERE deleteFlg = 0 and questionId=?');
                $sql1->execute([$count]);
                $answerCount = $sql1->fetch();
                echo '<br>';
                echo '回答数:',$answerCount['COUNT(questionId)'];
                
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

                    echo '<form action="qqq.php" method="post">';
                    echo '<input type="hidden" name="questionId" value="', $row['id']  ,'">';
                    echo '<input type="submit" value="編集">';
                    echo '</form>';
                }
                }

                echo '</p>';
            }
        }
        }
    

?>