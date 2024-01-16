<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>
<body>
<h1>料理登録</h1>
<form action="cookRegistInsert.php" method="post">
<table>
    <tr>
        <th>料理名</th>
        <td><input type="text" name="name"></td>
    </tr>
    <tr>
        <th>調理費用</th>
        <td>約<input type="text" name="price">円</td>
    </tr>
    <tr>
        <th>調理時間</th>
        <td>約<input type="text" name="time">分</td>
    </tr>
</table>
<p><button type="submit" class='regiButton'>登録</button></p>
</form>
<a href="cookList.php">料理一覧に戻る</a>
</body>
</html>