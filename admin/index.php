<?php
require_once __DIR__ . '/../inc/function.php';

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

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

  <link rel="stylesheet" href="../css/style.css">



</head>

<body id="top">

  <!--  ヘッダー -->
  <?php include('../inc/header_master.php');  ?>

  <main class="l-header-margin">
    <h1 class="c-title__main">管理画面</h1>

    <section class="l-wrapper-second">
      <ul class="list-group w-100">
        <li class="list-group-item">
          <a href="index.php" class="text-reset">TOP</a>
        </li>
        <li class="list-group-item">
          <a href="user.php" class="text-reset">USER</a>
        </li>
        <li class="list-group-item">
          <a href="news.php" class="text-reset">NEWS</a>
        </li>
        <li class="list-group-item">
          <a href="menu.php" class="text-reset">MENU</a>
        </li>
        <li class="list-group-item">
          <a href="shop.php" class="text-reset">SHOP</a>
        </li>
        <li class="list-group-item">
          <a href="./../admin/faq.php" class="text-reset">FAQ</a>
        </li>
        <li class="list-group-item">
          <a href="./../admin/./logout.php" class="text-reset">LOGOUT</a>
        </li>
      </ul>
    </section>

</body>

</html>