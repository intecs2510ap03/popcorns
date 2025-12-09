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
	
    // addAanswer関数
    // 書き方　addAnswer($questionId,$userId,$answer)
    function addAnswer($questionId,$userId,$answer){
        try{
    $pdo = Connect();
    $sql = $pdo->prepare('INSERT INTO answer VALUES (null,?,?,?,now(),0)');
    $return = $sql->execute([$questionId,$userId,$answer]);
    return $return;
    } catch (PDOException $e) {
        // ここでエラーメッセージを出力することで、失敗原因がわかる
        error_log('DB登録エラー: ' . $e->getMessage() . ' SQLSTATE: ' . $e->getCode());
        echo "エラーが発生しました。";
    return false; 
}}

?>