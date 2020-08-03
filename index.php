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
    <title>くぼっちの掲示板</title>
</head>
<body>
    <h1>くぼっちの掲示板</h1>
    <section class="new-post">
        <h2>新規投稿</h2>
        <form action="" method="post">
            <div class="name"><span class="label">名前: </span><input type="text" name="name" value="" maxlength="20"></div>
            <div class="post"><span class="label">本文: </span><textarea name="comment" value="" maxlength="300" cols="50" rows="5" wrap="hard" placeholder="300字以内で入力してください"></textarea></div>
            <input class="post-button" type="submit" value="投稿">
        </form>
    </section>
    <section class="post-list">
        <h2>投稿一覧</h2>
 <?php if (!empty($rows)): ?>
    <ul>
<?php foreach ($rows as $row): ?>
    <?php if (!empty($row[0])): ?>
        <p><?=$row[0]?>さん [<?=date("Y/m/d H:i:s");?>]</p>
    <?php endif; ?>
    <?php if (!empty($row[1])): ?>
        <h3><?=$row[1]?></h3><hr>
    <?php endif; ?>
<?php endforeach; ?>
    </ul>
<?php else: ?>
        <p>まだ投稿はありません</p>
<?php endif; ?>
    </section>
</body>
</html>