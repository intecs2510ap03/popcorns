<?php
    // Connect関数
    // 書き方　$pdo = Connect();
    function Connect() {
        return new PDO('mysql:host=localhost;dbname=ideastock;charset=utf8', 'staff', 'password');
    }

    // getUser関数
    // 書き方　getUser($userid, $userpw, $pdo);
    function getUser($userid, $userpw, $pdo){
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

    // getQuestion関数
    // 書き方　getQuestion($pdo);
    function getQuestion($pdo){
        $sql = $pdo->query('select * from question');
        $user_All = $sql->fetchAll();
        return $user_All;
    }

    // getUserName関数
    // 書き方　getUserName($id,$pdo);
    function getUserName($id,$pdo){
        $sql = $pdo->prepare('select name from user where id=?');
        $sql->execute([$id]);
        $name = $sql->fetchColumn(); 
        return $name;
    }

    // getAnswersByQuestionId関数
    // 書き方　getAnswersByQuestionId($id,$pdo);
    function getAnswersByQuestionId($id,$pdo){
        $sql = $pdo->prepare('select * from answer where questionId=? order by date desc, id');
        $sql->execute([$id]);
        $answer_All = $sql->fetchAll();
        return $answer_All;
    }
	
    // getQuestionById関数
    // getQuestionById($id,$pdo);
    function getQuestionById($id,$pdo){
        $sql = $pdo->prepare('select * from question where id=?');
        $sql->execute([$id]);
        return $sql;
    }

?>
