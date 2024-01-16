<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>料理一覧</title>
</head>
<body>
    <h1>料理一覧</h1>
    <a class="regiButton" href="cookRegist.php">新規登録</a>
    <input type="text" id="searchInput" placeholder="商品名を入力">
    <button onclick="searchByName()" class="sortButton">商品名で検索</button>
    <button onclick="sortByName()" class="sortButton">調理費用の安い順で並び替え</button>
    <table>
        <tr>
            <th>料理ID</th>
            <th>料理名</th>
            <th>調理費用</th>
            <th>調理時間</th>
            <th class="del">削除・更新</th>
        </tr>
        <?php
        require "db_connect.php";
        $pdo = new PDO($connect, USER, PASS);

        // 商品名の検索クエリ
        if(isset($_GET['search']) && !empty($_GET['search'])){
            $searchTerm = $_GET['search'];
            $sql = $pdo->prepare('SELECT * FROM CookingList WHERE cook_name LIKE ?');
            $sql->execute(["%$searchTerm%"]);
        } else {
            // 通常の一覧表示
            $sql = $pdo->query('SELECT * FROM CookingList');
        }

        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        ?>
            <tr id="row<?= $row['cook_id'] ?>">
                <td><?= $row['cook_id'] ?></td>
                <td><?= $row['cook_name'] ?></td>
                <td><?= $row['cook_price'] ?></td>
                <td><?= $row['cook_time'] ?></td>
                <td>
                    <button class="deleteButton" onclick="deleteCook(<?= $row['cook_id'] ?>)">削除</button>
                    <button class="updateButton" onclick="updateCook(<?= $row['cook_id'] ?>)">更新</button>
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

        function updateCook(cookId) {
            window.location.href = "cookUpdate.php?id=" + cookId;
        }

        function sortByName() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'sortByName.php', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.querySelector('table').innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }

        function searchByName() {
            var searchTerm = document.getElementById('searchInput').value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'cookList.php?search=' + searchTerm, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.querySelector('body').innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }
    </script>
</body>
</html>
