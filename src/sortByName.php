<?php
require "db_connect.php";
$pdo = new PDO($connect, USER, PASS);

// 料理名で昇順にソートして取得
$sql = $pdo->query('SELECT * FROM CookingList ORDER BY cook_price ASC');
    echo '<table>';
    echo '<tr>';
    echo '<th>料理ID</th>';
    echo '<th>料理名</th>';
    echo '<th>調理費用</th>';
    echo '<th>調理時間</th>';
    echo '<th class="del">削除・更新</th>';
    echo '</tr>';
// 結果を HTML として構築
while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr id="row' . $row['cook_id'] . '">';
    echo '<td>' . $row['cook_id'] . '</td>';
    echo '<td>' . $row['cook_name'] . '</td>';
    echo '<td>' . $row['cook_price'] . '</td>';
    echo '<td>' . $row['cook_time'] . '</td>';
    echo '<td>';
    echo '<button class="deleteButton" onclick="deleteCook(' . $row['cook_id'] . ')">削除</button>';
    echo '<button class="updateButton" onclick="updateCook(' . $row['cook_id'] . ')">更新</button>';
    echo '</td>';
    echo '</tr>';
    echo '</table>';
}
?>
