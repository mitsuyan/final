<?php
require "db_connect.php"; // require文は実行のみに使います
$pdo = new PDO($connect, USER, PASS);

// データの挿入
$sql = $pdo->prepare('INSERT INTO CookingList (cook_name, cook_price, cook_time) VALUES (?, ?, ?)');
$sql->execute([$_POST['name'], $_POST['price'], $_POST['time']]);
echo 'お気に入り商品を追加しました。';

// 全データの取得
$Allsql = $pdo->query('SELECT * FROM CookingList');
$rows = $Allsql->fetchAll(PDO::FETCH_ASSOC);
?>
<table>
    <tr>
        <th>料理ID</th>
        <th>料理名</th>
        <th>調理費用</th>
        <th>調理時間</th>
    </tr>
<?php foreach ($rows as $row) { ?>
    <tr>
        <td><?= $row['cook_id'] ?></td>
        <td><?= $row['cook_name'] ?></td>
        <td><?= $row['cook_price'] ?></td>
        <td><?= $row['cook_time'] ?></td>
    </tr>
<?php } ?>
</table>
<a href="cookList.php">料理一覧に戻る</a>
