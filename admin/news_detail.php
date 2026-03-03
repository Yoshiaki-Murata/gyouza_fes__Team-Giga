<?php
require_once __DIR__ . '/../inc/function.php';

// TODO: ID取得とバリデーション
$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {
    exit('IDが不正です');
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
        exit('記事が存在しません');
    }
} catch (PDOException $e) {
    error_log($e->getMessage());
    exit('システムエラーが発生しました');
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@4.0.1/destyle.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Noto+Sans+JP:wght@100..900&family=Zen+Maru+Gothic&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="../css/style.css">
</head>

<body id="top">
    <!-- header -->
    <?php include('../inc/header_master.php');  ?>

    <main class="l-wrapper l-header-margin">

        <p class="c-title__main" data-sub-title="お知らせ">News</p>
        <section>
            <article class="l-article">
                <div class="c-article__title-area">
                    <div class="d-grid gap-2 d-md-block mr-2">
                        <a href="./news_edit.php?id=<?php echo h($target['id']); ?>" class="btn btn-primary btn-sm">修正</a>
                        <a href="./news_del.php?id=<?php echo h($target['id']); ?>" class="btn btn-danger btn-sm">削除</a>
                    </div>
                    <h1><?php echo h($target['subject']); ?></h1>
                    <p><time datetime="<?php echo h($target['date']); ?>">
                            <?php echo format_jp_date(h($target['date'])); ?>
                        </time>
                    </p>
                </div>
                <p><?php echo nl2br(h($target['text'])); ?></p>
            </article>
            <p class="c-news-return__link">
                <a href="./news.php">お知らせ一覧へ戻る</a>
            </p>
        </section>
    </main>

    <!-- footer -->

    <a href="#top" class="c-btn__top"><img src="../img/back-top.png" alt="topへ戻る"></a>
</body>

</html>