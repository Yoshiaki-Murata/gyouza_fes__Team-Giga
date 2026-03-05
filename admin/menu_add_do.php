<?php
session_start();
require_once '../inc/function.php';

// CSRF対策
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    exit("不正なリクエストです。");
}
// 初期化
$image_for_db = "";

// アップロードした画像をimageファイルに登録する。
if (!empty($_FILES)) {
    if (!empty($_FILES["image"]) && is_uploaded_file($_FILES["image"]["tmp_name"])) {
        $file_from = $_FILES["image"]["tmp_name"];

        // 許可する拡張子を定義する
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        // 元のファイルから拡張子を取得する
        $extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        if (!in_array($extension, $allowed_extensions)) {
            exit("許可されていないファイル形式です。");
        }

        // $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

        // ファイル名を生成する
        $new_name = "menu0" . (int)$_POST["shop_id"] . "-" . bin2hex(random_bytes(8)) . "." . $extension;
        // 保存場所を生成
        $save_path = "../img/" . $new_name;
        if (move_uploaded_file($file_from, $save_path)) {
            $_SESSION["msg"] = "画像の保存に成功しました";
            // DB登録時に使用するファイル名を定義
            $image_for_db = $new_name;
        } else {
            $_SESSION["err"] = "画像の保存に失敗しました";
            header('location:menu_add.php');
            exit();
        }
    }
}


if (!empty($_POST)) {
    if (!empty($_POST["product"]) && !empty($_POST["pieces"]) && !empty($_POST["price"]) && !empty($_POST["product_details"]) && !empty($_POST["alt"]) && !empty($_POST["shop_id"]) && !empty($image_for_db)) {
        $product = $_POST["product"];
        $pieces = (int)$_POST["pieces"];
        $price = (int)$_POST["price"];
        $product_details = $_POST["product_details"];
        $alt = $_POST["alt"];
        $shop_id = (int)$_POST["shop_id"];
        // DB登録用の画像ファイル名を受け取る
        $image = $image_for_db ?? "";



        // DBに情報を登録する
        try {
            $db = db_connect();
            $sql = "INSERT INTO `menus`(product, pieces, price, product_detail, image, alt, shop_id) VALUES (:product,:pieces,:price,:product_detail,:image,:alt,:shop_id)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":product", $product, PDO::PARAM_STR);
            $stmt->bindParam(":pieces", $pieces, PDO::PARAM_INT);
            $stmt->bindParam(":price", $price, PDO::PARAM_INT);
            $stmt->bindParam(":product_detail", $product_details, PDO::PARAM_STR);
            $stmt->bindParam(":image", $image, PDO::PARAM_STR);
            $stmt->bindParam(":alt", $alt, PDO::PARAM_STR);
            $stmt->bindParam(":shop_id", $shop_id, PDO::PARAM_INT);
            $stmt->execute();

            $_SESSION["msg"] = "商品の新規追加が完了しました‼";
            // メニューにもどる

            header('location:menu.php');
            exit();
        } catch (PDOException $e) {
            $_SESSION["err"] = 'DBへの接続・送信が失敗しました。' . $e->getMessage();
            header('location:menu_add.php');
            exit();
        }
    }
}
err_msg("追加できませんでした。");
header('location:menu_add.php');
exit();
