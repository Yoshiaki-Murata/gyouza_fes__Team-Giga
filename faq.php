<?php

require_once __DIR__ . '/inc/function.php';


try {
  $db = db_connect();

  // questions
  $sql = 'SELECT question,answer,category_id FROM questions';
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $question = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // categories
  $sql_2 = 'SELECT * FROM categories';
  $stmt_2 = $db->prepare($sql_2);
  $stmt_2->execute();
  $category = $stmt_2->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  exit("Error:" . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="ふくおか餃子フェスに関するよくある質問を掲載">

  <title>よくある質問｜ふくおか餃子FES</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@4.0.1/destyle.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Noto+Sans+JP:wght@100..900&family=Zen+Maru+Gothic&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>

<body id="top">

  <!-- header -->
  <?php include('inc/header.php');  ?>

  <main class="l-faq l-faq-wrapper l-wrapper l-header-margin">

    <div class="l-wrapper-child">
      <h1 class="c-title__main" data-sub-title="よくある質問">FAQ</h1>
    </div>

    <div class="l-container l-wrapper-child">

      <?php foreach ($category as $category_title): ?>
        <section class="l-faq-section">
          <h2 class="l-faq-section__title"><?php echo $category_title['category']; ?></h2>
          <?php foreach ($question as $qa): ?>
            <?php if ($category_title['id'] === $qa['category_id']): ?>
              <div class="l-faq-section-parent">
                <h3 class="l-faq-section__question">
                  Q.<?php echo $qa['question']; ?>
                </h3>
                <p class="l-faq-section__answer">
                  <?php echo $qa['answer']; ?>
                </p>
              </div>
          <?php endif;
          endforeach;
          ?>

        </section>
      <?php endforeach; ?>



      <section class="l-faq-section">
        <h2 class="l-faq-section__title">イベントに関して</h2>
        <div class="l-faq-section-parent">
          <h3 class="l-faq-section__question">Q.入場料はかかりますか？</h3>
          <p class="l-faq-section__answer">入場は<span
              class="l-faq-section__answer--bold">無料</span>です。どなたでもご自由にお楽しみいただけます。<br>飲食の購入は各店舗でお支払いください。
          </p>
        </div>
        <div class="l-faq-section-parent">
          <h3 class="l-faq-section__question">Q.開催時間を教えてください。</h3>
          <p class="l-faq-section__answer">開催時間は<span
              class="l-faq-section__answer--bold">平日16:00〜22:00、土日祝11:00~22:00</span>を予定しています。<br>最終日は終了時間が早まる場合があります。
          </p>
        </div>
        <div class="l-faq-section-parent">
          <h3 class="l-faq-section__question">Q.雨天の場合も開催されますか？</h3>
          <p class="l-faq-section__answer">雨天決行ですが、荒天の場合は安全を考慮し中止となる場合があります。<br><span
              class="l-faq-section__answer--bold">最新情報はSNS</span>でお知らせします。</p>
        </div>
        <div class="l-faq-section-parent">
          <h3 class="l-faq-section__question">Q.支払い方法を教えてください。</h3>
          <p class="l-faq-section__answer"><span class="l-faq-section__answer--bold">現金</span>のほか、主要な<span
              class="l-faq-section__answe--bold">電子マネー・QRコード決済</span>がご利用いただけます。</p>
        </div>
      </section>
      <section class="l-faq-section">
        <h2 class="l-faq-section__title">会場に関して</h2>
        <div class="l-faq-section-parent">
          <h3 class="l-faq-section__question">Q.喫煙所はありますか？</h3>
          <p class="l-faq-section__answer">会場内は全面禁煙ですが、敷地外に指定の喫煙エリアを設けています。<br>スタッフの案内に従ってご利用ください。</p>
        </div>
        <div class="l-faq-section-parent">
          <h3 class="l-faq-section__question">Q.授乳室やおむつ替えスペースはありますか？</h3>
          <p class="l-faq-section__answer">はい、<span class="l-faq-section__answer--bold">メインゲート付近</span>に<span
              class="l-faq-section__answer--bold">授乳室</span>と<span
              class="l-faq-section__answer--bold">おむつ替え台</span>を設置しています。<br>小さなお子様連れでも安心してご利用いただけます。</p>
        </div>
        <div class="l-faq-section-parent">
          <h3 class="l-faq-section__question">Q.駐車場はありますか？</h3>
          <p class="l-faq-section__answer">専用駐車場はございません。公共交通機関のご利用をおすすめします。</p>
        </div>
        <div class="l-faq-section-parent">
          <h3 class="l-faq-section__question">Q.ペットを連れて入場できますか？</h3>
          <p class="l-faq-section__answer">混雑が予想されるため、ペットの同伴はご遠慮ください。
            <br>※ただし補助犬は入場可能です。
          </p>
        </div>
        <div class="l-faq-section-parent">
          <h3 class="l-faq-section__question">Q.ゴミはどうすればよいですか？</h3>
          <p class="l-faq-section__answer">会場内に<span
              class="l-faq-section__answer--bold">分別ゴミ箱を設置</span>しています。リサイクルにご協力をお願いします。</p>
        </div>
        <a class="l-faq-section--venue-map" href="./menu.php#venue-map">会場マップはこちら</a>
      </section>
      <section class="l-faq-section">
        <h2 class="l-faq-section__title">その他</h2>
        <div class="l-faq-section-parent">
          <h3 class="l-faq-section__question">Q.忘れ物をした場合はどうすればよいですか？</h3>
          <p class="l-faq-section__answer"><span
              class="l-faq-section__answer--bold">会場本部</span>でお預かりしています。<br>※イベント終了後は実行委員会までお問い合わせください。
          </p>
        </div>
        <div class="l-faq-section-parent">
          <h3 class="l-faq-section__question">トイレはどこにありますか？</h3>
          <p class="l-faq-section__answer">会場内に複数の<span
              class="l-faq-section__answer--bold">仮設トイレを設置</span>しています。<a class="l-faq-section--venue-map"
              href="./menu.php#venue-map">マップ</a>の「トイレ」アイコンをご確認ください。</p>
        </div>
        <div class="l-faq-section-parent">
          <h3 class="l-faq-section__question">Q.SNSで写真を投稿しても良いですか？</h3>
          <p class="l-faq-section__answer">はい、大歓迎です！<br>公式ハッシュタグ「<span
              class="l-faq-section__answer--bold">#ふくおか餃子FES</span>」をつけて投稿してください。</p>
        </div>
        <div class="l-faq-section-parent">
          <h3 class="l-faq-section__question">Q.開催中止の場合はどうなります</h3>
          <p class="l-faq-section__answer">安全を最優先に判断し、中止の場合は公式サイトとSNSでお知らせします。</p>
        </div>
        <div class="l-faq-section-parent">
          <h3 class="l-faq-section__question">Q.問い合わせ先を教えてください。</h3>
          <p class="l-faq-section__answer"><a href="./contact.php"><span
                class="l-faq-section__answer--under">CONTACT</span>ページ</a>のフォーム、または事務局メール宛にご連絡ください。</p>
        </div>
      </section>
    </div>

  </main>

  <!-- footer -->
  <?php include('inc/footer.php');  ?>

  <a href="#top" class="c-btn__top"><img src="./img/back-top.png" alt="topへ戻る"></a>
</body>

</html>