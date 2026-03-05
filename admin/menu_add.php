<?php
session_start();
require_once '../inc/function.php';

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

try {
    $db = db_connect();
    $sql = "SELECT * FROM shops";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION["err"] = 'DBへの接続・送信が失敗しました。' . $e->getMessage();
    header('location:menu.php');
    exit();
}



?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品新規登録</title>
    <?php include('../inc/link_master.php');  ?>
</head>

<body>
    <?php include('../inc/header_master.php');  ?>

    <main role="main" class="container" style="padding:60px 15px 0">
        <!-- <?php check_array($result); ?> -->

        <h1 class="my-5 c-title__main">商品新規登録</h1>
        <form action="./menu_add_do.php" method="post" enctype="multipart/form-data">
            <div class="row justify-content-center">
                <div class="mb-3 col-6">
                    <label for="product" class="form-label">商品名</label>
                    <input type="text" name="product" id="product" class="form-control" required>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="mb-5 col-6">
                    <label for="pieces" class="form-label">個数</label>
                    <input type="number" name="pieces" id="pieces" class="form-control" min="1" max="100" placeholder="数値のみを入力" required>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="mb-5 col-6">
                    <label for="price" class="form-label">値段</label>
                    <input type="number" name="price" id="price" class="form-control" placeholder="数値のみを入力" required>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="mb-5 col-6">
                    <label for="product_details" class="form-label">商品詳細</label>
                    <textarea name="product_details" id="product_details" class="form-control" required></textarea>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="mb-5 col-6">
                    <label for="image" class="form-label">商品画像</label>
                    <input type="file" name="image" id="image" class="form-control" required>
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
                    <select name="shop_id" id="shop_id" class="form-control form-control-sm mb-5" aria-label="Small select example" required>
                        <option value="">店舗名を選択してください</option>
                        <?php foreach ($result as  $row): ?>
                            <option value="<?php echo h($row["id"]); ?>">
                                <?php echo h($row["shop"]); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="mb-5 text-center">
                <!-- CSRFトークン -->
                <input type="hidden" name="csrf_token" value="<?php echo h($_SESSION['csrf_token']); ?>">
                <input type="submit" value="登録" class="btn btn-primary">
            </div>
        </form>
        <?php if (!empty($_SESSION["msg"])): ?>
            <p class="text-center bs-danger-text-emphasis">
                <?php echo h($_SESSION["msg"]);
                unset($_SESSION["msg"]);
                ?>
            </p>
        <?php endif ?>
        <?php if (!empty($_SESSION["err"])): ?>
            <p class="text-center bs-danger-text-emphasis">
                <?php echo h($_SESSION["err"]);
                unset($_SESSION["err"]);
                ?>
            </p>
        <?php endif ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>