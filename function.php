<?php
    // Connect関数
    // 書き方　$pdo = Connect();
    function Connect() {
        return new PDO('mysql:host=localhost;dbname=ideastock;charset=utf8', 'staff', 'password');
    }

    // isUser関数
    // 書き方　isUser($userid, $userpw, $pdo)
    function isUser($userid, $userpw, $pdo){
        $sql = $pdo->prepare('select * from user where loginId=? and password=?');
        $sql->execute([$userid, $userpw]);
        return $sql;
    }
	//addQuestion
    //書き方　addQuestion($_SESSION['user']['id'], $_POST['question'])
    function addQuestion($userId, $question){
    $pdo = Connect();
    $sql = $pdo->prepare('INSERT INTO question VALUES (null, ?, ?, now(), 0)');
    return $sql->execute([$userId,$question]);
    }

    // function addQuestion($questionId,$userId, $answer){
    // $pdo = Connect();
    // $sql = $pdo->prepare('INSERT INTO answer VALUES (null, ?, ?, ?, now(), 0)');
    // return $sql->execute([$questionId,$userId,$answer]);
    // }
?>
