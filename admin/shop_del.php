<?php
session_start();
require_once '../inc/function.php';

// 役割がマスター出ない人は削除できないように
if (!isset($_SESSION["role_id"]) || $_SESSION["role_id"] !== 1) {
    $_SESSION["err"] = "削除権限がありません。役割がマスターの人に削除依頼をしてください";
    header("location:user.php");
    exit();
}

$id = (int)($_POST['id'] ?? 0);

if ($id <= 0) {
    err_msg('IDが不正です');
    header('location:shop.php');
    exit();
}

try {
    $db = db_connect();

    $sql = 'SELECT id, shop, boos_number, shop_detail 
            FROM shops 
            WHERE id=:id';

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $shop = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$shop) {
        err_msg('データが存在しません');
        header('location:shop.php');
        exit();
    }
} catch (PDOException $e) {
    db_err_msg() . $e->getMessage();
    header('location:shop.php');
    exit();
}

?>

<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= h($shop['shop']); ?>店舗削除｜ふくおか餃子FES</title>
    <?php include('../inc/link_master.php');  ?>
</head>

<body>
    <?php include('../inc/header_master.php'); ?>

    <main role="main" class="container" style="padding:60px 15px 0">
        <div>
            <!-- ここから「本文」-->

            <h1 class="c-title__main my-5">店舗 - 削除確認</h1>
            <form action="./shop_del_do.php" method="post">
                <input type="hidden" name="id" value="<?= h($shop['id']); ?>">
                <div class="form-group">
                    <label>店舗名</label>
                    <div class="form-control-plaintext">
                        <?php echo h($shop['shop']); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>ブース番号</label>
                    <div class="form-control-plaintext">
                        <?php echo h($shop['boos_number']); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>店舗詳細</label>
                    <div class="form-control-plaintext">
                        <?php echo h($shop['shop_detail']); ?>
                    </div>
                </div>

                <div class="text-center">
                    <input type="submit" class="btn btn-danger mt-5" value="削除" onclick="return confirm('本当に削除しますか？');">
                </div>
            </form>

            <p><a href="shop.php" class="mb-5 text-reset">一覧へ戻る</a></p>


            <!-- 本文ここまで -->
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>