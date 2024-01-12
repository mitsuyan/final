<?php
require "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cookId = $_POST["cook_id"];
    $pdo = new PDO($connect, USER, PASS);
    $deleteSql = $pdo->prepare('DELETE FROM CookingList WHERE cook_id = ?');
    $deleteSql->execute([$cookId]);
    echo "success";
} else {
    http_response_code(405);
    exit();
}
?>
