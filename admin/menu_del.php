<?php
session_start();
require_once '../inc/function.php';

// マスター以外は削除出来ない仕様

// if (!isset($_SESSION["role_id"]) || $_SESSION["role_id"] !== 1) {
//     $_SESSION["del_err"] = "削除権限がありません。役割がマスターの人に削除依頼をしてください";
//     header("location:menu.php");
//     exit();
// }

if (!empty($_POST)) {
    if (!empty($_POST["id"])) {
        $menuid = (int)$_POST["id"];

        try {
            $db = db_connect();
            $sql = "SELECT menus.id AS menu_id,
            menus.product,
            menus.pieces,
            menus.price,
            menus.product_detail,
            CAST(shop_id AS CHAR) AS shop_id_str
             FROM menus WHERE menus.id = :menuid";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(":menuid", $menuid, PDO::PARAM_INT);
            $stmt->execute();
            $target = "";
            $target = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$target) {
                $_SESSION["del_err"] = "指定されたメニューが見つかりません";
                header("location:menu.php");
                exit();
            }
        } catch (PDOException $e) {
            exit("エラー" . $e->getMessage());
        }
    }
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
    <title>メニュー削除 ‐確認‐</title>
</head>

<body>
    <main role="main" class="container" style="padding:60px 15px 0">
        <h1 class="my-5 c-title__main">メニュー削除 -確認-</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>商品名</th>
                    <th>個数</th>
                    <th>価格</th>
                    <th>商品説明</th>
                    <th>店舗名</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $target["product"]; ?></td>
                    <td><?php echo $target["pieces"]; ?>個入り</td>
                    <td><?php echo $target["price"]; ?>円</td>
                    <td><?php echo $target["product_detail"]; ?></td>
                    <td><?php echo $target["shop_id_str"]; ?></td>
                </tr>
            </tbody>
        </table>
        <div class="mt-5 mb-5">
            <p class="text-center">このメニューを削除しますか？</p>
        </div>

        <form action="./menu_del_do.php" method="post">
            <div class="mb-5 text-center">

                <input type="hidden" name="id" value="<?php echo $target["menu_id"]; ?>">

                <input type="submit" value="削除する
                " class="btn btn-danger me-5" onclick="return confirm('本当に削除しますか？');">
                <a href="menu.php" class="btn btn-secondary">戻る</a>
            </div>
        </form>
    </main>
</body>

</html>