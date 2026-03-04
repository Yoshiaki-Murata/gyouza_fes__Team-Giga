<?php
session_start();
require_once __DIR__ . '/../inc/function.php';

// TODO: ID取得とバリデーション
$id = (int)($_GET['id'] ?? 0);

if ($id === 0) {
    err_msg('IDが不正です');
    header('location:news.php');
    exit();
}

// DB接続
try {
    $db = db_connect();
    $sql = 'SELECT * FROM news WHERE id=:id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // 結果セットを連想配列の形で取得
    $news = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$news) {
        err_msg('データが存在しません');
        header('location:news.php');
        exit();
    }
} catch (PDOException $e) {
    db_err_msg() . $e->getMessage();
    header('location:news.php');
    exit();
}
?>

<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo h($news['titletag']); ?>編集｜ふくおか餃子FES</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Noto+Sans+JP:wght@100..900&family=Zen+Maru+Gothic&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>


    <main role="main" class="container" style="padding:60px 15px 0">
        <div>
            <!-- ここから「本文」-->

            <h1 class="c-title__main">お知らせ編集</h1>
            <form action="./news_edit_do.php" method="post">
                <input type="hidden" name="id" value="<?php echo h($news['id']); ?>">
                <div class="form-group">
                    <label>記事タイトル</label>
                    <input type="text" name="subject" class="form-control" value="<?php echo h($news['subject']); ?>" required>
                </div>
                <div class="form-group">
                    <label>ページタイトル</label>
                    <input type="text" name="titletag" class="form-control" value="<?php echo h($news['titletag']); ?>" required>
                </div>
                <div class="form-group">
                    <label>本文</label>
                    <textarea name="text" class="form-control" rows="5" required><?= h($news['text']); ?></textarea>
                </div>

                <input type="submit" class="btn btn-primary" value="更新する">
            </form>
            <?php if (!empty($_SESSION["msg"])): ?>
                <p class="text-center bs-danger-text-emphasis">
                    <?php echo h($_SESSION["msg"]);
                    unset($_SESSION["msg"]);
                    ?>
                </p>
            <?php endif ?>
            <?php if (!empty($_SESSION["err"])): ?>
                <p class="text-center bs-danger-text-emphasis">
                    <?php echo h($_SESSION["err"]);
                    unset($_SESSION["err"]);
                    ?>
                </p>
            <?php endif ?>
            <!-- 本文ここまで -->
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>