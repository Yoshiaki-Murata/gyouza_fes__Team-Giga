<?php

require_once __DIR__ . '/../inc/function.php';

try {
    // PDO インスタンスの作成
    $db = db_connect();

    // プリペアードステートメントの作成
    $sql = 'SELECT id,subject,date FROM news ORDER BY date DESC ';
    $stmt = $db->prepare($sql);

    // SQLの実行
    $stmt->execute();

    // 取得したレコードを連想配列で1レコードずつ受け取る
    $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit("Error:" . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="description" content="ふくおか餃子フェスに関するお知らせの一覧を掲載">
    <title>お知らせ一覧｜ふくおか餃子FES</title>
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

    <main class="l-header-margin">
        <section class="l-wrapper-second">
            <h1 class="c-title__main" data-sub-title="お知らせ一覧">News</h1>

            <div class="d-grid mx-auto">
                <!-- <button class="btn btn-primary" type="button">新規お知らせ投稿</button> -->
                <a href="./news_add.php" class="btn btn-primary" type="button">新規お知らせ投稿</a>
            </div>

            <?php if (count($news) > 0): ?>

                <dl class="l-news__list">
                    <?php foreach ($news as $article): ?>
                        <div class="c-news__detail">
                            <div class="mr-2">
                                <a href="./news_edit.php?id=<?php echo h($article['id']); ?>" class="btn btn-primary btn-sm">修正</a>
                                <a href="./news_del.php?id=<?php echo h($article['id']); ?>" class="btn btn-danger btn-sm">削除</a>
                            </div>
                            <dt>
                                <time datetime="<?php echo h($article['date']); ?>">
                                    <?php echo format_jp_date(h($article['date'])); ?>
                                </time>
                            </dt>
                            <dd>
                                <a href="./news_detail.php?id=<?php echo h($article['id']) ?>" class="text-reset">
                                    <?php echo h($article['subject']); ?>
                                </a>
                            </dd>

                        </div>
                    <?php endforeach; ?>

                </dl>

            <?php else: ?>
                <p>お知らせはありません</p>

            <?php endif; ?>
        </section>
    </main>
    <!-- footer -->
    <?php include('../inc/footer_master.php');  ?>

    <a href="#top" class="c-btn__top text-reset"><img src="../img/back-top.png" alt="topへ戻る"></a>
</body>

</html>