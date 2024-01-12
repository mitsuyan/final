<?php
require "db_connect.php";

$pdo = new PDO($connect, USER, PASS);

// POSTデータの取得
$cookId = $_POST['cook_id'];
$cookName = $_POST['cook_name'];
$cookPrice = $_POST['cook_price'];
$cookTime = $_POST['cook_time'];

// 料理情報の更新
$stmt = $pdo->prepare('UPDATE CookingList SET cook_name = :name, cook_price = :price, cook_time = :time WHERE cook_id = :id');
$stmt->bindParam(':id', $cookId);
$stmt->bindParam(':name', $cookName);
$stmt->bindParam(':price', $cookPrice);
$stmt->bindParam(':time', $cookTime);

// 更新の実行
if ($stmt->execute()) {
    // 更新成功時の処理
    header("Location: cookList.php"); // 更新後に一覧画面にリダイレクト
    exit();
} else {
    // 更新失敗時の処理
    echo "更新に失敗しました。";
}
?>
