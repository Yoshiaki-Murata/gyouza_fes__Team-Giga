<?php
session_start();
require_once __DIR__ . '/../inc/function.php';
login_session();

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="福岡の人気餃子が一堂に集結！ご当地餃子や創作餃子が楽しめる、エネルギッシュでモダンなフードフェス。">

  <title>ふくおか餃子FES｜公式サイト</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@4.0.1/destyle.min.css">
  <?php include('../inc/link_master.php');  ?>



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
          <a href="contact_list.php" class="text-reset">CONTACT</a>
        </li>
        <li class="list-group-item">
          <a href="./../admin/faq.php" class="text-reset">FAQ</a>
        </li>
        <li class="list-group-item">
          <a href="./../admin/./logout.php" class="text-reset">LOGOUT</a>
        </li>
      </ul>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>