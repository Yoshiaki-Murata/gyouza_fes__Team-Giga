<?php
session_start();
require_once '../inc/function.php';

// check_array($_SESSION);

try {
    $db = db_connect();
    $sql = "SELECT menus.id AS menu_id, menus.product,menus.pieces,menus.price, shops.shop FROM menus INNER JOIN shops ON menus.shop_id = shops.id;";
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
    <title>商品管理画面</title>
</head>

<body>
    <main role="main" class="container" style="padding:60px 15px 0">

        <h1 class="my-5 text-center">商品管理画面</h1>
        <h2>商品新規追加</h2>
        <a href="menu_add.php" class="mb-5">新規登録はこちらより</a>
        <?php if (!empty($_SESSION["menu_edit_success"])): ?>
            <div>
                <p>
                    <?php echo $_SESSION["menu_edit_success"];
                            $_SESSION["menu_edit_success"]="";
                    ?>
                </p>
            </div>
        <?php endif; ?>
        <h2 class="mt-5">商品一覧</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>商品名</th>
                    <th>個数</th>
                    <th>値段</th>
                    <th>店舗名</th>
                    <th>操作</th>
                </tr>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo $row["menu_id"]; ?></td>
                        <td><?php echo $row["product"]; ?></td>
                        <td><?php echo $row["pieces"] . "個"; ?></td>
                        <td><?php echo $row["price"] . "円（税込み）"; ?></td>
                        <td><?php echo $row["shop"]; ?></td>
                        <td class="row">
                            <form action="menu_edit.php" method="post" class="col">
                                <input type="hidden" name="id" value="<?php echo $row["menu_id"] ?>">
                                <input type="submit" value="編集" class="btn  btn-primary">
                            </form>
                            <form action="menu_del.php" method="post" class="col">
                                <input type="hidden" name="id" value="<?php echo $row["menu_id"] ?>">
                                <input type="submit" value="削除" class="btn  btn-danger">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </thead>
        </table>

        <?php if (!empty($_SESSION["del_err"])): ?>
            <p class="text-center bs-danger-text-emphasis"><?php echo htmlspecialchars($_SESSION["del_err"], ENT_QUOTES, "UTF-8");
                                                            unset($_SESSION["del_err"]);
                                                            ?>
            </p>
        <?php endif ?>
        <?php if (!empty($_SESSION["del_msg"])): ?>
            <p class="text-center bs-primary-text-emphasis"><?php echo htmlspecialchars($_SESSION["del_msg"], ENT_QUOTES, "UTF-8");
                                                            unset($_SESSION["del_msg"]);
                                                            ?>
            </p>
        <?php endif ?>
    </main>

</body>

</html>