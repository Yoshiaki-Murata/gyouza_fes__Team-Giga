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
    <title><?php echo $target['title']; ?>｜ふくおか餃子FES</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@4.0.1/destyle.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Noto+Sans+JP:wght@100..900&family=Zen+Maru+Gothic&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body id="top">

    <header class="l-header l-header-margin">

        <?php include('inc/header.php');  ?>

    </header>
    <main class="l-wrapper">
        <p class="c-title__main" data-sub-title="お知らせ">News</p>
        <section>
            <article class="l-article">
                <div class="c-article__title-area">
                    <h1><?php echo $target['subject']; ?></h1>
                    <p><time datetime="<?php echo $target['date']; ?>">
                            <?php echo $target['date']; ?>（土）
                        </time>
                    </p>
                </div>
                <p><?php echo $target['text']; ?></p>
            </article>
            <p class="c-news-return__link">
                <a href="./news.php">お知らせ一覧へ戻る</a>
            </p>
        </section>
    </main>
    <footer class="l-footer">
        <div class="l-fotter__contact">
            <a href="contact.html" class="c-btn--black"><img src="img/icon-mail.png" alt="">
                <p>Contact</p>
            </a>
            <a href="tel:XXX-XXX-XXX" class="c-btn--black"><img src="img/icon-tel.png" alt="">
                <p>XXX-XXX-XXX</p>
            </a>
        </div>
        <ul class="l-footer__sns">
            <li class="c-sns__link"><a href="#"><img src="img/sns-x.png" alt=""></a></li>
            <li class="c-sns__link"><a href="#"><img src="img/sns-insta.png" alt=""></a></li>
            <li class="c-sns__link"><a href="#"><img src="img/sns-facebook.png" alt=""></a></li>
        </ul>
        <div class="l-footer__text">
            <div class="c-footer__company">
                <p>主催：ふくおか餃子FES実行委員会</p>
                <p>製作協力：創造社リカレントスクール福岡校</p>
                <p>協賛：九州餃子部</p>
            </div>
            <a href="privacy.html">個人情報保護方針</a>
            <small>&copy;2030 福岡餃子FES実行委員会</small>
        </div>
    </footer>
    <a href="#top" class="c-btn__top"><img src="./img/back-top.png" alt="topへ戻る"></a>
</body>

</html>