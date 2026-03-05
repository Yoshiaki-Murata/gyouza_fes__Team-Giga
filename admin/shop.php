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
  <?php include('../inc/link_master.php');  ?>

<body>

  <?php include('../inc/header_master.php');  ?>

  <main role="main" class="container" style="padding:60px 15px 0">
    <section class="l-wrapper-second">
      <h1 class="my-5 c-title__main">SHOPS</h1>

      <!-- 削除エラーを表示 -->
      <?php if (isset($_SESSION["msg"])): ?>
        <div class="alert alert-success text-center" role="alert">
          <?php echo h($_SESSION["msg"]); ?>
        </div>
        <?php unset($_SESSION["msg"]); ?>
      <?php endif; ?>
      <?php if (isset($_SESSION["err"])): ?>
        <div class="alert alert-danger text-center" role="alert">
          <?php echo h($_SESSION["err"]); ?>
        </div>
        <?php unset($_SESSION["err"]); ?>
      <?php endif;

      // テスト ↓
      // $_SESSION["msg"] = "テスト表示です";
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

                    <form action="shop_del.php?id=<?php echo $shop['id']; ?>" method="post" style="display:inline;">
                      <input type="hidden" name="id" value="<?php echo $shop['id']; ?>">
                      <button type="submit" class="btn btn-danger btn-sm">削除</button>
                    </form>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>

          </tbody>
        </table>
      </div>

  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>