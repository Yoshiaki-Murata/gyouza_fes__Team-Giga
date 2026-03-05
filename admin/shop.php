<?php
session_start();
require_once __DIR__ . '/../inc/function.php';

try {
  // PDO インスタンスの作成
  $db = db_connect();

  // プリペアードステートメントの作成
  $sql = 'SELECT id, shop, boos_number, shop_detail FROM shops ORDER BY boos_number ASC';
  $stmt = $db->prepare($sql);


  // SQLの実行
  $stmt->execute();

  // 取得したレコードを連想配列で1レコードずつ受け取る
  $shops = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  error_log($e->getMessage());
  exit('システムエラーが発生しました');
}
?>

<!DOCTYPE html>
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

  <main role="main" class="container l-header-margin">
    <section class="l-wrapper-second">
      <h1 class="c-title__main">SHOPS</h1>

      <!-- 処理結果を表示 （成功）-->
      <?php if (isset($_SESSION["msg"])): ?>
        <div class="alert alert-success text-center" role="alert">
          <?php echo h($_SESSION["msg"]); ?>
        </div>
        <?php unset($_SESSION["msg"]); ?>
      <?php endif; ?>

      <!-- 処理結果を表示 （エラー）-->
      <?php if (isset($_SESSION["err"])): ?>
        <div class="alert alert-danger text-center" role="alert">
          <?php echo h($_SESSION["err"]); ?>
        </div>
        <?php unset($_SESSION["err"]); ?>
      <?php endif;
      ?>

      <!-- 新規店舗追加 -->
      <div class="d-grid mx-auto">
        <a href="./shop_add.php" class="btn btn-primary">新規店舗追加</a>
      </div>
      <div class="l-wrapper-second">
        <table class="table table-striped-columns">
          <thead>
            <tr class="row">
              <th class="col">店舗名</th>
              <th class="col">ブース番号</th>
              <th class="col-6">店舗詳細</th>
              <th class="col">操作</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach ($shops as $shop): ?>
              <tr class="row">
                <th class="col">
                  <?php echo h($shop['shop']); ?>
                </th>
                <td class="col">
                  <?php echo h($shop['boos_number']); ?>
                </td>
                <td class="col-6">
                  <?php echo nl2br(h($shop['shop_detail'])); ?>
                </td>
                <td class="col">
                  <div class="mr-2">
                    <a href="./shop_edit.php?id=<?php echo h($shop['id']); ?>" class="btn btn-primary btn-sm m-2">編集</a>
                    <a href="./shop_del.php?id=<?php echo h($shop['id']); ?>" class="btn btn-danger btn-sm m-2">削除</a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>

          </tbody>
        </table>
      </div>
    </section>
  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>