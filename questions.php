<?php require 'header.php'; ?>
<?php require 'function.php';?>
<?php 
$pdo = Connect();

foreach ($pdo->query('select * from question') as $row)
    echo $row['userId'];
    echo $row['question'];
    echo $row['date'];
     



