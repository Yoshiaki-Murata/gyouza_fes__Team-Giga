<?php
require_once __DIR__ . '/inc/function.php';

try {
  // PDO インスタンスの作成
  $db = db_connect();

  // プリペアードステートメントの作成
  $sql = 'SELECT id,subject,date FROM news ORDER BY date DESC ';
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $news = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $sql_2 = 'SELECT id,product,pieces,price,image,alt FROM menus ORDER BY id DESC ';
  $stmt_2 = $db->prepare($sql_2);
  $stmt_2->execute();
  $menu = $stmt_2->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  exit("Error:" . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="福岡の人気餃子が一堂に集結！ご当地餃子や創作餃子が楽しめる、エネルギッシュでモダンなフードフェス。">

  <title>ふくおか餃子FES｜公式サイト</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@4.0.1/destyle.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Noto+Sans+JP:wght@100..900&family=Zen+Maru+Gothic&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">



</head>

<body id="top">

  <!--  ヘッダー -->
  <?php include('inc/header.php');  ?>


  <main>
    <section class="l-hero l-header-margin">
      <div class="c-gray-area">
        <p class="c-gray-area__top"><time datetime="2030-04-27">2030.4.27<span
              class="c-gray-area_top_sun">sun</span></time> - <time datetime="2030-05-12">5.12
            <span class="c-gray-area_top_sun">sun</span></time>
        </p>
        <div class="c-gray-area__bottom">
          <div class="c-gray-area__item">
            <p class="c-gray-area__location"><img src="./img/place-logo.svg" alt="">長浜公園</p>
          </div>
          <dl class="c-gray-area__item">
            <dt class="c-gray-area--black">平日</dt>
            <dd><time datetime="16:00">16:00</time>-<time datetime="22:00">22:00</time></dd>
          </dl>
          <dl class="c-gray-area__item">
            <dt><span class="c-gray-area--blue">土</span><span class="c-gray-area--red">日祝</span></dt>
            <dd><time datetime="11:00">11:00</time>-<time datetime="22:00">22:00</time></dd>
          </dl>
        </div>
      </div>
    </section>

    <div class="l-container">
      <section id="l-catchcopy" class="l-catchcopy">
        <h2 class="c-catchcopy-title">\ ひとくちごとに、新しい体験。/
          <img src="./img/logo-text.png" alt="ふくおか餃子フェス">
        </h2>
        <div class="l-catchcopy-text">
          <p class="c-catchcopy-text--bold">福岡の餃子文化が一堂に集結！</p>
          <p>定番の<span class="c-catchcopy-text--big">ご当地餃子</span>から、驚きの<span
              class="c-catchcopy-text--big">創作餃子</span>まで、<br>
            ここはまるで <span class="c-catchcopy-text--bold c-catchcopy-text--red">餃子のテーマパーク</span>。</p>
          <p>香ばしく焼き上げられた皮のパリッとした食感、<br>
            ジューシーな肉汁、<br>個性あふれるタレのハーモニー…</p>
          <p>ひとくち食べるたびに、<br>
            新しい<span class="c-catchcopy-text--big">味</span>、新しい<span
              class="c-catchcopy-text--big">驚き</span>、新しい<span
              class="c-catchcopy-text--big">発見</span>が待っています。</p>
          <p class="c-catchcopy-text--bold">さあ、あなたもこの美味しい冒険に出かけませんか？</p>
        </div>
      </section>

      <section class="c-topnews l-top-box">
        <h2 class="c-sec-title">News</h2>
        <div class="c-topnews_dl-link">
          <?php if (count($news) > 0): ?>
            <dl class="l-topnews-inner">

              <?php foreach ($news as $article): ?>

                <div class="c-topnews-list">
                  <dt class="c-news-date">
                    <time datetime="<?php echo $article['date']; ?>">
                      <?php echo $article['date']; ?>（月）
                    </time>
                  </dt>
                  <dd class="c-news-detail">
                    <a href="news_detail.php?id=<?php echo $article['id'] ?>">
                      <?php echo $article['subject']; ?>
                    </a>
                  </dd>
                </div>

              <?php endforeach; ?>

            </dl>
            <p class="c-topnews-link"><a href="news.php">過去のお知らせ一覧はこちら</a></p>

          <?php else: ?>
            <p>お知らせはありません</p>

          <?php endif; ?>
        </div>
      </section>

      <section class="l-top-box" id="information">
        <h2 class="c-sec-title">Information</h2>

        <dl class="c-info">
          <div class="c-info-inner">
            <dt class="c-info-title">期間</dt>
            <dd class="c-info-detail c-info--bold"><time datetime="2030-04-27">2030年<br>
                4月27日(日)</time> ～ <time datetime="05-12">5月12日(日)</time></dd>
          </div>

          <div class="c-info-inner">
            <dt class="c-info-title">会場</dt>
            <dd class="c-info-detail">
              <p class="c-info--bold">長浜公園 <a href="#access"
                  class="c-info--small c-info__map-link">会場へのマップはこちら</a></p>

            </dd>
          </div>

          <div class="c-info-inner">
            <dt class="c-info-title">営業時間</dt>
            <dd class="c-info-detail">
              <p class="c-info--bold">平日 <time datetime="16:00">16:00</time>～<time
                  datetime="22:00">22:00</time>／<br class="c__br--sponly">土日祝 <time
                  datetime="11:00">11:00</time>～<time datetime="22:00">22:00</time></p>
              <P class="c-info--small">最終入場受付 <time datetime="21:00">21:00</time> L.O. <time
                  datetime="21:15">21:15</time></P>
            </dd>
          </div>

          <div class="c-info-inner">
            <dt class="c-info-title">料金</dt>
            <dd class="c-info-detail">
              <p class="c-info--bold">入場料無料</p>
              <p class="c-info--small">※飲食代別途（食券、電子マネー利用可能）</p>
            </dd>
          </div>
        </dl>

      </section>

      <section class="l-topmenu l-top-box">
        <h2 class="c-sec-title">Menu</h2>

        <?php if (count($menu) > 0): ?>

          <ul class="c-topmenu">

            <?php foreach ($menu as $menuIcon): ?>
              <li class="c-topmenu__card">
                <img src="./img/<?php echo $menuIcon['image']; ?>" alt="<?php echo $menuIcon['alt']; ?>">
                <div class="c-topmenu__name-price">
                  <p class="c-topmenu__name"><?php echo $menuIcon['product']; ?></p>
                  <p class="c-topmenu__price">
                    <?php echo $menuIcon['pieces']; ?>個入り<?php echo $menuIcon['price']; ?>円(税込)</p>
                </div>
              </li>
            <?php endforeach; ?>

          </ul>

        <?php else: ?>
          <p>メニュー情報はありません</p>

        <?php endif; ?>
        <a href="menu.html" class="c-btn--yellow">メニュー・店舗の詳細はこちら</a>
      </section>
      <section class="c-access l-top-box" id="access">
        <h2 class="c-sec-title">Access</h2>
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6646.910095870736!2d130.39412999999996!3d33.59349580000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3541918916ac1a97%3A0x38ef1af8385772cc!2z6ZW35rWc5YWs5ZyS!5e0!3m2!1sja!2sjp!4v1768534928306!5m2!1sja!2sjp"
          width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade" class="c-map"></iframe>
        <dl class="c-access-text">
          <dt class="c-access-text__title">会場</dt>
          <dd class="c-access-text__detail">長浜公園<br>
            〒810-0073 福岡県福岡市中央区舞鶴１丁目７</dd>
          <dt>アクセス</dt>
          <dd>西鉄バス『長浜一丁目・福祉センター前・浜の町病院入口』から徒歩２分<br>
            地下鉄・西鉄『天神駅』から徒歩１０分</dd>
        </dl>
      </section>
      <div class="c-btn--yellow c-btn__faq">
        <a href="faq.html">
          <p class="c-btn__faq--bold">FAQ</p>
          <p class="c-btn__faq--small">よくある質問はこちら</p>
        </a>
      </div>
    </div>
  </main>

  <!-- footer -->
  <?php include('inc/footer.php');  ?>

  <a href="#top" class="c-btn__top"><img src="./img/back-top.png" alt="topへ戻る"></a>
</body>

</html>