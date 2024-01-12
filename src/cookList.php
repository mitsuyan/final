<h1>料理一覧</h1>
<a href="cookRegist.php">新規登録</a>
<table>
    <tr>
        <th>料理ID</th>
        <th>料理名</th>
        <th>調理費用</th>
        <th>調理時間</th>
        <th>削除・更新</th>
    </tr>
    <?php
    require "db_connect.php";
    $pdo = new PDO($connect, USER, PASS);
    $sql = $pdo->query('SELECT * FROM CookingList');

    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
    ?>
        <tr id="row<?= $row['cook_id'] ?>">
            <td><?= $row['cook_id'] ?></td>
            <td><?= $row['cook_name'] ?></td>
            <td><?= $row['cook_price'] ?></td>
            <td><?= $row['cook_time'] ?></td>
            <td>
                <button onclick="deleteCook(<?= $row['cook_id'] ?>)">削除</button>
                <button onclick="updateCook(<?= $row['cook_id'] ?>)">更新</button>
            </td>
        </tr>
    <?php } ?>
</table>

<!--非同期を使用-->
<script>
    function deleteCook(cookId) {
        if (confirm('本当に削除しますか？')) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'cookDelete.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('row' + cookId).style.display = 'none';
                }
            };
            xhr.send('cook_id=' + cookId);
        }
    }
    function updateCook(cookId){
        window.location.href = "cookUpdate.php?id=" + cookId;
    }
</script>
