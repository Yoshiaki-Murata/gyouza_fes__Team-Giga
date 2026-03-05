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
            <table class="table">
                <thead>
                    <tr>
                        <th class="w-25">店舗名</th>
                        <th class="w-25">ブース番号</th>
                        <th class="w-50">店舗詳細</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php echo h($shop['shop']); ?>
                        </td>
                        <td>
                            <?php echo h($shop['boos_number']); ?>
                        </td>
                        <td>
                            <?php echo h($shop['shop_detail']); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-5 mb-5">
                <p class="text-center">この店舗を削除しますか？</p>
            </div>
            <form action="./shop_del_do.php" method="post">
                <div class="text-center mb-3">
                    <input type="hidden" name="id" value="<?php echo h($shop["id"]); ?>">
                    <input type="submit" value="削除" class="btn btn-danger m-3" onclick="return confirm('本当に削除しますか？');">
                    <a href="shop.php" class="btn btn-secondary">戻る</a>
                </div>
            </form>



            <!-- 本文ここまで -->
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>