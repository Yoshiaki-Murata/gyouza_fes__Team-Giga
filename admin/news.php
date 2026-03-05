<?php
session_start();
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
    db_err_msg() . $e->getMessage();
    header('location:index.php');
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
    <title>お知らせ一覧｜ふくおか餃子FES</title>
    <?php include('../inc/link_master.php');  ?>
</head>

<body id="top">
    <!-- header -->
    <?php include('../inc/header_master.php');  ?>

    <main class="container">
        <section class="l-wrapper-second mb-5">
            <h1 class="c-title__main my-5">News</h1>

            <?php if (!empty($_SESSION["msg"])): ?>
                <p class="alert alert-success text-center" role="alert">
                    <?php echo h($_SESSION["msg"]);
                    unset($_SESSION["msg"]);
                    ?>
                </p>
            <?php endif ?>
            <?php if (!empty($_SESSION["err"])): ?>
                <p class="alert alert-danger text-center" role="alert">
                    <?php echo h($_SESSION["err"]);
                    unset($_SESSION["err"]);
                    ?>
                </p>
            <?php endif ?>


            <div class="d-grid mx-auto">
                <a href="./news_add.php" class="btn btn-primary" type="button">新規お知らせ投稿</a>
            </div>

            <?php if (count($news) > 0): ?>

                <dl class="l-news__list">
                    <?php foreach ($news as $article): ?>

                        <div class="c-news__detail">

                            <div class="me-2">
                                <a href="./news_edit.php?id=<?php echo h($article['id']); ?>" class="btn btn-primary btn-sm mr-3">編集</a>

                                <form action="news_del.php?id=<?php echo $article['id']; ?>" method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">削除</button>
                                </form>
                            </div>
                            <dt>
                                <time datetime="<?php echo h($article['date']); ?>">
                                    <?php echo h(format_jp_date($article['date'])); ?>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>