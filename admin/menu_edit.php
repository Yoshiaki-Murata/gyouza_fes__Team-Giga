<?php
session_start();
require_once '../inc/function.php';

$target = []; // 初期化


if (!empty($_POST["id"])) {
    $id = (int)$_POST["id"];
    try {
        $db = db_connect();
        $sql = "SELECT * FROM menus WHERE id=:id ";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $target = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        exit("エラー" . $e->getMessage());
    }
}

try {
    $sql2 = "SELECT * FROM shops";
    $stmt2 = $db->prepare($sql2);
    $stmt2->execute();
    $result = $stmt2->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit("エラー" . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Noto+Sans+JP:wght@100..900&family=Zen+Maru+Gothic&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>商品編集・登録</title>
</head>

<body>
    <?php include('../inc/header_master.php');  ?>

    <main role="main" class="container" style="padding:60px 15px 0">
        <h1 class="my-5 text-center">商品登録・編集</h1>
        <form action="./menu_edit_do.php" method="post" enctype="multipart/form-data">
            <div class="row justify-content-center">
                <div class="mb-3 col-6">
                    <label for="product" class="form-label">商品名</label>
                    <input type="text" name="product" id="product" class="form-control" value="<?php echo h($target["product"] ?? ''); ?>">
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="mb-5 col-6">
                    <label for="pieces" class="form-label">個数</label>
                    <input type="number" name="pieces" id="pieces" class="form-control" min="1" max="100" value="<?php echo h($target["pieces"] ?? ''); ?>">
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="mb-5 col-6">
                    <label for="price" class="form-label">値段</label>
                    <input type="number" name="price" id="price" class="form-control" value="<?php echo h($target["price"] ?? ''); ?>">
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="mb-5 col-6">
                    <label for="product_details" class="form-label">商品詳細</label>
                    <textarea name="product_detail" id="product_detail" class="form-control"><?php echo h($target["product_detail"] ?? ''); ?></textarea>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="mb-5 col-6">
                    <label for="alt" class="form-label">画像説明</label>
                    <textarea name="alt" id="alt" class="form-control"><?php echo h($target["alt"] ?? ''); ?></textarea>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="mb-5 col-6">
                    <label for="shop_id" class="form-label">店舗名</label>
                    <select name="shop_id" id="shop_id" class="form-select">
                        <?php foreach ($result as $row): ?>
                            <option value="<?php echo $row["id"]; ?>" <?php echo (isset($target["shop_id"]) && $row["id"] == $target["shop_id"]) ? "selected" : ""; ?>>
                                <?php echo h($row["shop"]); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="mb-5 text-center">
                <input type="hidden" name="id" value="<?php echo h($target["id"] ?? ''); ?>">
                <input type="submit" value="編集" class="btn btn-primary">
            </div>
        </form>
    </main>
</body>

</html>