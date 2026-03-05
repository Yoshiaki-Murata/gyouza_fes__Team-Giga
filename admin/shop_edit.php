<?php
session_start();
require_once __DIR__ . '/../inc/function.php';

// TODO: ID取得とバリデーション
$id = (int)($_GET['id'] ?? 0);

if ($id === 0) {
    exit('IDが不正です');
}

// DB接続
try {
    $db = db_connect();
    $sql = 'SELECT id, shop, boos_number, shop_detail FROM shops WHERE id=:id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // 結果セットを連想配列の形で取得
    $shop = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$shop) {
        exit('データが存在しません');
    }
} catch (PDOException $e) {
    error_log($e->getMessage());
    exit('システムエラーが発生しました');
}
?>

<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo h($shop['shop']); ?>店舗編集｜ふくおか餃子FES</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Noto+Sans+JP:wght@100..900&family=Zen+Maru+Gothic&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>


    <main role="main" class="container" style="padding:60px 15px 0">
        <div>
            <!-- ここから「本文」-->

            <h1 class="c-title__main">店舗情報編集</h1>
            <form action="./shop_edit_do.php" method="post">
                <input type="hidden" name="id" value="<?php echo h($shop['id']); ?>">
                <div class="form-group">
                    <label>店舗名</label>
                    <input type="text" name="shop" class="form-control" value="<?php echo h($shop['shop']); ?>" required>
                </div>
                <div class="form-group">
                    <label>ブース番号</label>
                    <input type="text" name="boos_number" class="form-control" value="<?php echo h($shop['boos_number']); ?>" required>
                </div>
                <div class="form-group">
                    <label>店舗詳細</label>
                    <textarea name="shop_detail" class="form-control" rows="5" required><?php echo h($shop['shop_detail']); ?></textarea>
                </div>

                <input type="submit" class="btn btn-primary" value="更新する">
            </form>



            <!-- 本文ここまで -->
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>