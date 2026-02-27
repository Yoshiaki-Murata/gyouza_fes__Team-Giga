<?php
require_once __DIR__ . '/../inc/function.php';
?>


<!doctype html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="福岡の人気餃子が一堂に集結！ご当地餃子や創作餃子が楽しめる、エネルギッシュでモダンなフードフェス。">

  <title>店舗一覧|ふくおか餃子FES</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@4.0.1/destyle.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Noto+Sans+JP:wght@100..900&family=Zen+Maru+Gothic&display=swap"
    rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

  <link rel="stylesheet" href="../css/style.css">

<body>

  <?php include('../inc/header_master.php');  ?>

  <main role="main" class="container" style="padding:60px 15px 0">
    <h1 class="c-title__main" data-sub-title="店舗一覧">SHOPS</h1>


    <div class="l-wrapper-second">
      <table class="table table-striped-columns">
        <thead>
          <tr class="row">
            <th class="col">店舗名</th>
            <th class="col">ブース番号</th>
            <th class="col-6">店舗詳細</th>
          </tr>
        </thead>
        <tbody>
          <tr class="row">
            <th class="col">博多ぎょうざ堂</th>
            <td class="col">B-01</td>
            <td class="col-6">福岡を代表する老舗餃子専門店。国産豚とキャベツを使用し、ひとつひとつ手包みで仕上げています。外はカリッと、中は肉汁たっぷりの博多スタイルが人気。</td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>