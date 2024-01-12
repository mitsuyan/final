<?php
require "db_connect.php";
$pdo = new PDO($connect, USER, PASS);
if (isset($_GET['id'])) {
    $cookId = $_GET['id'];
    $stmt = $pdo->prepare('SELECT * FROM CookingList WHERE cook_id = :id');
    $stmt->bindParam(':id', $cookId);
    $stmt->execute();
    $cook = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($cook) {
?>
        <!DOCTYPE html>
        <html lang="ja">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="./css/style.css">
            <title>更新画面</title>
        </head>
        <body>
            <h1>料理更新</h1>
            <form action="updateProcess.php" method="post">
                <input type="hidden" name="cook_id" value="<?= $cook['cook_id'] ?>">
                <label for="cook_name">料理名:</label>
                <input type="text" id="cook_name" name="cook_name" value="<?= $cook['cook_name'] ?>" required>
                <label for="cook_price">調理費用:</label>
                <input type="text" id="cook_price" name="cook_price" value="<?= $cook['cook_price'] ?>" required>
                <label for="cook_time">調理時間:</label>
                <input type="text" id="cook_time" name="cook_time" value="<?= $cook['cook_time'] ?>" required>
                <button type="submit">更新</button>
            </form>
        </body>
        </html>
<?php
    } else {
        echo "指定された料理が見つかりません。";
    }
} else {
    echo "料理IDが指定されていません。";
}
?>
