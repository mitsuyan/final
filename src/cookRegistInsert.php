<?php
require "db_connect.php"; // require文は実行のみに使います
$pdo = new PDO($connect, USER, PASS);

$sql = $pdo->prepare('INSERT INTO CookingList (cook_name, cook_price, cook_time) VALUES (?, ?, ?)');
$sql->execute([$_POST['name'], $_POST['price'], $_POST['time']]);
echo 'お気に入り商品を追加しました。';
?>
