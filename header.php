<!DOCTYPE html>
<html lang="ja">
<meta charset="UTF-8">
<head>
	<div class="header-top">
	<title>アイデア倉庫</title>
<link rel="stylesheet" href="./style/style.css"	>

<h1><a href="index.php" title="ホームに戻る">
    アイデア倉庫</a></h1>

<nav><!-- 　　　メニューバー -->
	<ul>
		<li><a href="index.php">ログイン</a></li>
		<li><a href="userAdd.php">会員登録</a></li>
		<li><a href="questions.php">質問一覧</a></li>

		<?php
			if (isset($_SESSION['user'])) {
				echo '<li><a href="logout.php">ログアウト</a></li>';
			}
		?>

	</ul>
</nav>
</div>

</head>
<body>