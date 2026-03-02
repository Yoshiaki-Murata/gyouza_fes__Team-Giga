<?php
require_once './inc/function.php';

try {
  $db = db_connect();
  $sql = "SELECT menus.id AS menu_id, menus.product, menus.pieces, menus.price, menus.product_detail, menus.image, menus.alt, menus.shop_id,shops.shop,shops.shop_detail,shops.boos_number FROM menus INNER JOIN shops ON menus.shop_id=shops.id;";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  exit("エラー" . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">

  <!-- 検索結果から隠す⽅法 -->
  <meta name="robots" content="noindex, nofollow">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="ふくおか餃子フェスに出店されるメニューや店舗の紹介ページ。出店情報・メニュー一覧・ブース番号を掲載。アクセスしやすい導線で当日の回遊をサポート。">
  <title>出店メニュー・店舗｜ふくおか餃子FES</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@4.0.1/destyle.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Noto+Sans+JP:wght@100..900&family=Zen+Maru+Gothic&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <link rel="stylesheet" href="css/admin.css">
</head>

<body id="top">

  <!-- header -->
  <?php include('inc/header.php');  ?>

  <!-- <?php check_array($result); ?> -->

  <main class="l-menu-main l-wrapper l-header-margin">
    <section class="l-menu l-menu-wrapper">
      <div class="c-menu-title c-menu-title--menuGap">
        <h1 class="c-title__main" data-sub-title="メニュー">Menu</h1>
      </div>
      <ul class="l-menu-list ">
        <?php foreach ($result as $row): ?>
          <li id="b-01" class="c-menu-card">
            <div class="c-menu-card-top">
              <p class="c-menu-card-top__number c-menu-card-top__number--padding"><?php echo $row["boos_number"] ?></p>
              <div class="c-menu-card-top-text">
                <h2 class="c-menu-card-top-text__item"><?php echo $row["product"] ?></h2>
                <p class="c-menu-card-top-text__price"><?php echo $row["pieces"] ?>個入り <?php echo $row["price"] ?>円（税込）</p>
              </div>
            </div>
            <div class="c-menu-card-bottom <?php echo $row["menu_id"] % 2 === 0 ? "c-menu-card-bottom--reverse" : ""; ?>">
              <div class="c-menu-card-bottom-container">
                <img class="c-menu-card-bottom-container__img" src="./img/<?php echo $row["image"] ?>" alt="<?php echo $row["alt"] ?>">
              </div>
              <div class="c-menu-card-bottom-text">
                <p class="c-menu-card-bottom-text__itemDesc"><?php echo $row["product_detail"] ?></p>
                <div class="c-menu-card-bottom-text-shop">
                  <p class="c-menu-card-bottom-text__shopName"><?php echo $row["shop"] ?></p>
                  <p class="c-menu-card-bottom-text__shopDesc">
                    <?php echo $row["shop_detail"] ?>
                  </p>
                </div>
              </div>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
    </section>

    <section class="l-map" id="venue-map">
      <div class="c-menu-title">
        <h1 class="c-title__main" data-sub-title="会場マップ">MAP</h1>
      </div>
      <div class="l-map-img-wrapper">
        <img class="c-map-img" src="./img/map.png" alt="会場の地図">
      </div>
      <ol class="l-map-list l-map-list-wrapper">
        <li class="c-map-card">
          <a href="#b-01">
            <div class="c-map-card-list">
              <p class="c-map-card-list__number c-map-card-list__number--padding">B-01</p>
              <p class="c-map-card-list__item">肉汁あふれる焼き餃子</p>
            </div>
          </a>
        </li>
        <li class="c-map-card">
          <a href="#b-02">
            <div class="c-map-card-list">
              <p class="c-map-card-list__number c-map-card-list__number--padding">B-02</p>
              <p class="c-map-card-list__item">ふっくら蒸しあげ餃子</p>
            </div>
          </a>
        </li>
        <li class="c-map-card">
          <a href="#b-03">
            <div class="c-map-card-list">
              <p class="c-map-card-list__number c-map-card-list__number--padding">B-03</p>
              <p class="c-map-card-list__item">中華風スープ餃子</p>
            </div>
          </a>
        </li>
        <li class="c-map-card">
          <a href="#b-04">
            <div class="c-map-card-list">
              <p class="c-map-card-list__number c-map-card-list__number--padding">B-04</p>
              <p class="c-map-card-list__item">カリもち！揚げ餃子</p>
            </div>
          </a>
        </li>
        <li class="c-map-card">
          <a href="#b-05">
            <div class="c-map-card-list">
              <p class="c-map-card-list__number c-map-card-list__number--padding">B-05</p>
              <p class="c-map-card-list__item">お口に広がる地中海の風</p>
            </div>
          </a>
        </li>
        <li class="c-map-card">
          <a href="#b-06">
            <div class="c-map-card-list">
              <p class="c-map-card-list__number c-map-card-list__number--padding">B-06</p>
              <p class="c-map-card-list__item">素材の旨味ひきたつ水餃子</p>
            </div>
          </a>
        </li>
        <li class="c-map-card">
          <a href="#b-07">
            <div class="c-map-card-list">
              <p class="c-map-card-list__number c-map-card-list__number--padding">B-07</p>
              <p class="c-map-card-list__item">しびうまラー油餃子</p>
            </div>
          </a>
        </li>
      </ol>
    </section>


  </main>

  <!-- footer -->
  <?php include('inc/footer.php');  ?>


  <a href="#top" class="c-btn__top"><img src="./img/back-top.png" alt="topへ戻る"></a>

</body>

</html>