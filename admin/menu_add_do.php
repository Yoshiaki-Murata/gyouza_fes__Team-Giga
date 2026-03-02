<?php
session_start();
require_once '../inc/function.php';



// アップロードした画像をimageファイルに登録する。
if (!empty($_FILES)) {
    if (!empty($_FILES["image"]) && is_uploaded_file($_FILES["image"]["tmp_name"])) {
        $file_from = $_FILES["image"]["tmp_name"];

        // 元のファイルから拡張子を取得する
        $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        // ファイル名を生成する。
        $new_name = "menu00" . $_POST["shop_id"] . "." . $extension;
        // 保存場所を生成
        $save_path = "../img/" . $new_name;
        if (move_uploaded_file($file_from, $save_path)) {
            $_SESSION["menu_add_image_success"] = "画像の保存に成功しました";
            // DB登録時に使用するファイル名を定義
            $image_for_db = $new_name;
        } else {
            echo "画像の保存に失敗しました";
        }
    }
}


if (!empty($_POST)) {
    if (!empty($_POST["product"]) && !empty($_POST["pieces"]) && !empty($_POST["price"]) && !empty($_POST["product_details"]) && !empty($_POST["image"]) && !empty($_POST["alt"]) && !empty($_POST["shop_id"])) {
        $product = $_POST["product"];
        $pieces = $_POST["pieces"];
        $price = $_POST["price"];
        $product_details = $_POST["product_details"];
        $alt = $_POST["alt"];
        $shop_id = $_POST["shop_id"];
        // DB登録用の画像ファイル名を受け取る
        $image = $image_for_db;



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

            $_SESSION["menu_add_success"] = "商品の新規追加が完了しました‼";
            // メニューにもどる



        } catch (PDOException $e) {
            exit("エラー" . $e->getMessage());
        }
    }
}
