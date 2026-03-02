<?php
session_start();
require_once '../inc/function.php';

try {
    $db = db_connect();
    $sql = "SELECT menus.shop_id,shops.shop FROM menus INNER JOIN shops ON menus.shop_id = shops.id";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>商品新規登録</title>
</head>

<body>
    <main role="main" class="container" style="padding:60px 15px 0">
        <!-- <?php check_array($result); ?> -->

        <h1 class="my-5 text-center">商品新規登録</h1>
        <form action="./menu_add_do.php" method="post" enctype="multipart/form-data">
            <div class="row justify-content-center">
                <div class="mb-3 col-6">
                    <label for="product" class="form-label">商品名</label>
                    <input type="text" name="product" id="product" class="form-control">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="mb-5 col-6">
                    <label for="pieces" class="form-label">個数</label>
                    <input type="number" name="pieces" id="pieces" class="form-control" min="1" max="100" placeholder="数値のみを入力">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="mb-5 col-6">
                    <label for="price" class="form-label">値段</label>
                    <input type="number" name="price" id="price" class="form-control" placeholder="数値のみを入力">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="mb-5 col-6">
                    <label for="product_details" class="form-label">商品詳細</label>
                    <textarea name="product_details" id="product_details" class="form-control"></textarea>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="mb-5 col-6">
                    <label for="image" class="form-label">商品画像</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="mb-5 col-6">
                    <label for="alt" class="form-label">画像説明</label>
                    <textarea name="alt" id="alt" class="form-control"></textarea>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="mb-5 col-6">
                    <label for="shop_id" class="form-label">店舗名</label>
                    <select name="shop_id" id="shop_id" class="form-select form-select-sm mb-5" aria-label="Small select example">
                        <?php foreach ($result as  $row): ?>
                            <option value="<?php echo $row["shop_id"]; ?>">
                                <?php echo $row["shop"]; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="mb-5 text-center">
                <input type="submit" value="登録" class="btn btn-primary">
            </div>
        </form>
    </main>

</body>

</html>