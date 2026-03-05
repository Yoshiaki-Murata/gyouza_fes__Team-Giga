<?php
session_start();
require_once __DIR__ . '/../inc/function.php';

// TODO: ID取得とバリデーション
$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {
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
    $target = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$target) {
        err_msg('記事が存在しません');
        header('location:news.php');
        exit();
    }
} catch (PDOException $e) {
    db_err_msg() . $e->getMessage();
    header('location:news.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="description" content="ふくおか餃子フェスに関するお知らせの一覧を掲載">
    <title><?php echo h($target['titletag']); ?>｜ふくおか餃子FES</title>
    <?php include('../inc/link_master.php');  ?>
</head>

<body id="top">
    <!-- header -->
    <?php include('../inc/header_master.php');  ?>

    <main class="l-wrapper container" style="padding:60px 15px 0">

        <p class="c-title__main" data-sub-title="お知らせ">News</p>
        <section>
            <article class="l-article">
                <div class="c-article__title-area">
                    <h1><?php echo h($target['subject']); ?></h1>
                    <p><time datetime="<?php echo h($target['date']); ?>">
                            <?php echo format_jp_date(h($target['date'])); ?>
                        </time>
                    </p>
                    <div class="d-grid gap-2 d-md-block mr-2">
                        <a href="./news_edit.php?id=<?php echo h($target['id']); ?>" class="btn btn-primary btn-sm">修正</a>
                        <form action="news_del.php?id=<?php echo $target['id']; ?>" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $target['id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">削除</button>
                        </form>
                    </div>
                </div>
                <p><?php echo nl2br(h($target['text'])); ?></p>
            </article>
            <p class="c-news-return__link">
                <a href="./news.php">お知らせ一覧へ戻る</a>
            </p>
        </section>
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
    </main>

    <!-- footer -->

    <a href="#top" class="c-btn__top"><img src="../img/back-top.png" alt="topへ戻る"></a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>