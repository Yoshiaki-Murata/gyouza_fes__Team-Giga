<?php
session_start();
require_once '../inc/function.php';

try {
    $db = db_connect();
    $sql = "SELECT menus.id AS menu_id, menus.product,menus.pieces,menus.price, shops.shop FROM menus INNER JOIN shops ON menus.shop_id = shops.id";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION["err"] = 'DBへの接続・送信が失敗しました。' . $e->getMessage();
    header('location:index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('../inc/link_master.php');  ?>
    <title>商品管理画面</title>
</head>

<body>
    <?php include('../inc/header_master.php');  ?>

    <main role="main" class="container" style="padding:60px 15px 0">

        <h1 class="my-5 c-title__main">商品管理画面</h1>

        <!--アラート -->
        <?php if (!empty($_SESSION["msg"])): ?>
            <p class="alert alert-success text-center mx-auto col-6" role="alert">
                <?php echo h($_SESSION["msg"]);
                unset($_SESSION["msg"]);
                ?>
            </p>
        <?php endif ?>
        <?php if (!empty($_SESSION["err"])): ?>
            <p class="alert alert-danger text-center mx-auto col-6" role="alert">
                <?php echo h($_SESSION["err"]);
                unset($_SESSION["err"]);
                ?>
            </p>
        <?php endif ?>

        <h2>商品新規追加</h2>
        <a href="menu_add.php" class="mb-5">新規登録はこちらより</a>
        <?php if (!empty($_SESSION["menu_edit_success"])): ?>
            <div>
                <p>
                    <?php echo h($_SESSION["menu_edit_success"]);
                    $_SESSION["menu_edit_success"] = "";
                    ?>
                </p>
            </div>
        <?php endif; ?>
        <h2 class="mt-5">商品一覧</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>商品名</th>
                    <th>個数</th>
                    <th>値段</th>
                    <th>店舗名</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo h($row["product"]); ?></td>
                        <td><?php echo $row["pieces"] . "個"; ?></td>
                        <td><?php echo $row["price"] . "円（税込み）"; ?></td>
                        <td><?php echo h($row["shop"]); ?></td>
                        <td class="row">
                            <form action="menu_edit.php" method="get" class="col">
                                <input type="hidden" name="id" value="<?php echo $row["menu_id"] ?>">
                                <input type="submit" value="編集" class="btn  btn-primary">
                            </form>
                            <form action="menu_del.php" method="get" class="col">
                                <input type="hidden" name="id" value="<?php echo $row["menu_id"] ?>">
                                <input type="submit" value="削除" class="btn  btn-danger">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>