<?php
session_start();
require_once '../inc/function.php';

// 役割がマスター出ない人は削除できないように
if (!isset($_SESSION["role_id"]) || $_SESSION["role_id"] !== 1) {
    $_SESSION["del_err"] = "削除権限がありません。役割がマスターの人に削除依頼をしてください";
    header("location:user.php");
    exit();
}

$id = (int)($_GET['id'] ?? 0);

if ($id === 0) {
    exit('IDが不正です');
}

// DB接続
try {
    $db = db_connect();
    $sql = 'SELECT * FROM shops WHERE id=:id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // 結果セットを連想配列の形で取得
    $shop = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit('エラー: ' . $e->getMessage());
}

?>

<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo h($news['titletag']); ?>店舗削除｜ふくおか餃子FES</title>
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

            <h1 class="c-title__main">店舗 - 削除確認</h1>
            <form action="./shop_del_do.php" method="post">

                <div class="form-group">
                    <label>店舗名</label>
                    <input type="text" name="shop" class="form-control" value="<?php echo h($shop['shop']); ?>" required>
                </div>
                <div class="form-group">
                    <label>ブース番号</label>
                    <input type="text" name="boos_number" class="form-control" value="<?php echo h($shop['boos_bumber']); ?>" required>
                </div>
                <div class="form-group">
                    <label>店舗詳細</label>
                    <textarea name="shop_detail" class="form-control" rows="5" value="<?php echo h($shop['shop_detail']); ?>" required></textarea>
                </div>

                <input type="submit" class="btn btn-primary" value="削除する">
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