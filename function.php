<?php
    // Connect関数
    // 書き方　$pdo = Connect();
    function Connect() {
        return new PDO('mysql:host=localhost;dbname=ideastock;charset=utf8', 'staff', 'password');
    }

    // isUser関数
    // 書き方　isUser($userId, $userPw);
    function isUser($userId, $userPw){
        $pdo = Connect();
        //ユーザID,パスワードの重複チェック
        $sql = $pdo->prepare('SELECT * FROM user WHERE loginId=? or password=?');
        $sql->execute([$userId,$userPw]);
        // 結果判定
        if ($sql->rowCount() > 0) {
            return true; // 重複あり
        }else {
            return false; // 重複なし
        }
    }

    // getUser関数
    // 書き方　getUser($userid, $userpw, $pdo);
    function getUser($userid, $userpw, $pdo){
        $sql = $pdo->prepare('select * from user where loginId=? and password=?');
        $sql->execute([$userid, $userpw]);
        return $sql;
    }

    // addUser関数
    // 書き方　addUser($_POST['loginId'],$_POST['password'],$_POST['name']);
    function addUser($userId,$userPw,$viewName){
    $pdo = Connect();
    $sql = $pdo->prepare('INSERT INTO user(id, loginId, password, name) VALUES (null, ?, ?, ?)');
    return $sql->execute([$userId,$userPw,$viewName]);
    }

  // getQuestion関数
    // 書き方　getQuestion($order);
    function getQuestion($order){
        $pdo = Connect();
        $sql = $pdo->prepare("SELECT * FROM question $order");
        $sql->execute();
        return $sql;
    }

	// addQuestion関数
    // 書き方　addQuestion($_SESSION['user']['id'], $_POST['question']);
    function addQuestion($userId, $question){
    $pdo = Connect();
    $sql = $pdo->prepare('INSERT INTO question VALUES (null, ?, ?, now(), 0)');
    return $sql->execute([$userId,$question]);
    }

    // deleteQuestion関数
    // 書き方　deleteQuestion($_POST['questionId']);
    function deleteQuestion($questionId){
        $pdo = Connect();
        $sql1 = $pdo->prepare('UPDATE answer SET deleteFlg=1 WHERE questionId=?');
        $answerDeleteFlgOn = $sql1->execute([$questionId]);
        $sql2 = $pdo->prepare('UPDATE question SET deleteFlg=1 WHERE Id=?');
        $questionDeleteFlgOn = $sql2->execute([$questionId]);
        if($answerDeleteFlgOn && $questionDeleteFlgOn) {
            return true;
        }else{
            return false;
        }
    }

    // getQuestionById関数
    // 書き方　getQuestionById($id,$pdo);
    function getQuestionById($id,$pdo){
        $sql = $pdo->prepare('select * from question where id=?');
        $sql->execute([$id]);
		// 結果判定
		if ($sql->rowCount() > 0) {	
            return $sql; // データあり	
		}else {	
			return false; // データなし	
		}
    }

    // getAnswersByQuestionId関数
    // 書き方　getAnswersByQuestionId($id,$pdo);
    function getAnswersByQuestionId($id,$pdo){
        $sql = $pdo->prepare('select * from answer where questionId=? order by date desc, id');
        $sql->execute([$id]);
        $answer_All = $sql->fetchAll();
        return $answer_All;
    }

    // addAanswer関数
    // 書き方　addAnswer($questionId,$userId,$answer);
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

    // deleteAnswer関数
    // 書き方　deleteAnswer($answerId);
    function deleteAnswer($answerId) {
    try{
        // コネクト
        $pdo = Connect();
        // 削除クエリ
        $sql = $pdo->prepare('UPDATE answer SET deleteFlg=1 WHERE id=?;');
        $sql = $sql->execute([$answerId]);
        // 戻り値
        return $sql;
    } catch (PDOException $e) {
        // ここでエラーメッセージを出力することで、失敗原因がわかる
        error_log('DB更新エラー: ' . $e->getMessage() . ' SQLSTATE: ' . $e->getCode());
        echo "エラーが発生しました。";
    return false;
    }}

    // getUserName関数
    // 書き方　getUserName($id,$pdo);
    function getUserName($id,$pdo){
        $sql = $pdo->prepare('select name from user where id=?');
        $sql->execute([$id]);
        $name = $sql->fetchColumn(); 
        return $name;
    }

    // edit関数
    // 書き方　edit($_POST['update'], $_POST['questionId']);
    function edit($question, $questionId){
    $pdo = Connect();
    $sql = $pdo->prepare('update question set question = ? where id = ?');
    return $sql->execute([$question, $questionId]);
    }
?>
