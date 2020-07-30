<?php
$fp = fopen('data.csv', 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    fputcsv($fp, [$_POST['name'], $_POST['comment']]);
    rewind($fp);
}
while ($row = fgetcsv($fp)) {
    $rows[] = $row;
}
fclose($fp);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="stylesheet.css">
    <title>掲示板</title>
</head>
<body>
    <h1>くぼっちの掲示板</h1>
    <section class="new-post">
        <h2>新規投稿</h2>
        <form action="" method="post">
            <div class="name"><span class="label">名前: </span><input type="text" name="name" value="" maxlength="20"></div>
            <div class="post"><span class="label">本文: </span><textarea name="text" value="" maxlength="300" cols="50" rows="5" wrap="hard" placeholder="300字以内で入力してください"></textarea></div>
            <input type="submit" value="投稿">
        </form>
    </section>
    <section class="post-list">
        <h2>投稿一覧</h2>
     <?php if (!empty($rows)): ?>
        <ul>
    <?php foreach ($rows as $row): ?>
            <li><?=$row[1]?> (<?=$row[0]?>)</li>
    <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>まだ投稿はありません</p>
    </section>
   
</body>
</html>