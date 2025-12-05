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
	
?>