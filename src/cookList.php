<h1>料理一覧</h1>
<table>
    <tr>
        <th>料理ID</th>
        <th>料理名</th>
        <th>作成費用</th>
        <th>作成時間</th>
    </tr>
    <?php
    require "db_connect.php";
    $pdo = new PDO($connect, USER, PASS);
    $sql = $pdo->query('SELECT * FROM CookingList');

    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
    ?>
        <tr>
            <td><?= $row['cook_id'] ?></td>
            <td><?= $row['cook_name'] ?></td>
            <td><?= $row['cook_price'] ?></td>
            <td><?= $row['cook_time'] ?></td>
        </tr>
    <?php } ?>
</table>
