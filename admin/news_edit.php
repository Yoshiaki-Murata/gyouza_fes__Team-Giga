<?php
session_start();
require_once __DIR__ . '/../inc/function.php';
login_session();

// TODO: ID取得とバリデーション
$id = (int)($_GET['id'] ?? 0);

if ($id === 0) {
    err_msg('IDが不正です');
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
    }
} catch (PDOException $e) {
    db_err_msg() . $e->getMessage();
    header('location:news.php');
    exit();
}
?>

<!doctype html>
<html lang="ja">
<?php include('../inc/header_master.php'); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo h($news['titletag']); ?>編集｜ふくおか餃子FES</title>
    <?php include('../inc/link_master.php');  ?>
</head>

<body>


    <main role="main" class="container" style="padding:60px 15px 0">
        <div>
            <!-- ここから「本文」-->

            <h1 class="c-title__main my-5">お知らせ編集</h1>
            <form action="./news_edit_do.php" method="post">
                <input type="hidden" name="id" value="<?php echo h($news['id']); ?>">
                <div class="form-group">
                    <label class="mb-2">記事タイトル</label>
                    <input type="text" name="subject" class="form-control mb-3" value="<?php echo h($news['subject']); ?>" required>
                </div>
                <div class="form-group">
                    <label class="mb-2">ページタイトル</label>
                    <input type="text" name="titletag" class="form-control mb-3" value="<?php echo h($news['titletag']); ?>" required>
                </div>
                <div class="form-group">
                    <label class="mb-2">本文</label>
                    <textarea name="text" class="form-control mb-3" rows="5" required><?= h($news['text']); ?></textarea>
                </div>

                <input type="submit" class="btn btn-primary mb-3" value="更新する">
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

        <p><a href="news.php" class="mb-5 text-reset">一覧へ戻る</a></p>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>