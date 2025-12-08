<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'function.php';?>

<h2>質問一覧</h2>

<?php 
$pdo = Connect();

foreach ($pdo->query('select * from question WHERE deleteFlg = 0') as $row){
    $userId = $row['userId'];
    $sql = $pdo->prepare('SELECT name FROM user WHERE id = ?');
    $sql->execute([$userId]);
    $user = $sql->fetch();   // 1行だけ取得
    $user_name = $user['name']; // 名前を取り出す

    echo '<p>';
    echo $userId = $user_name;
    echo '<br>';
    echo $row['question'];
    echo '<br>';
    echo $row['date'];
    echo '<form action="detail.php" method="GET">';
    echo '<input type="submit" value="詳細">';
    echo '</form>';
    echo '</p>';

 if ((isset($_SESSION['user']) && $_SESSION['user']['id'] == $row['userId'])) {
    echo '<form action="delete.php" method="POST">';
    echo '<input type="submit" name="delete" value="削除">';
    echo '</form>';
    }
}



if (isset($_SESSION['message'])) {
    echo '削除しました。';
}

if (isset($_SESSION['error'])) {
    echo '削除できませんでした。';
}

?>

