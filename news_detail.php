<?php
require_once __DIR__ . '/inc/function.php';

// TODO: ID取得とバリデーション
$id = (int)$_GET['id'];

// DB接続
try {
    $db = db_connect();
    $sql = 'SELECT * FROM news WHERE id=:id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // 結果セットを連想配列の形で取得
    $target = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit('エラー: ' . $e->getMessage());
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
    <?php include('inc/link.php');  ?>
</head>

<body id="top">
    <!-- header -->
    <?php include('inc/header.php');  ?>

    <main class="l-wrapper l-header-margin">
        <p class="c-title__main" data-sub-title="お知らせ">News</p>
        <section>
            <article class="l-article">
                <div class="c-article__title-area">
                    <h1><?php echo h($target['subject']); ?></h1>
                    <p><time datetime="<?php echo h($target['date']); ?>">
                            <?php echo h(format_jp_date($target['date'])); ?>
                        </time>
                    </p>
                </div>
                <p><?php echo h($target['text']); ?></p>
            </article>
            <p class="c-news-return__link">
                <a href="./news.php">お知らせ一覧へ戻る</a>
            </p>
        </section>
    </main>

    <!-- footer -->
    <?php include('inc/footer.php');  ?>

    <a href="#top" class="c-btn__top"><img src="./img/back-top.png" alt="topへ戻る"></a>
</body>

</html>