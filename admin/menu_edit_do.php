<?php
session_start();
require_once '../inc/function.php';

if (!empty($_POST)) {
    if (!empty($_POST["id"]) && !empty($_POST["product"]) && !empty($_POST["pieces"]) && !empty($_POST["price"]) && !empty($_POST["product_detail"]) && !empty($_POST["alt"]) && !empty($_POST["shop_id"])) {
        $product = $_POST["product"];
        $pieces = (int)$_POST["pieces"];
        $price = (int)$_POST["price"];
        $product_detail = $_POST["product_detail"];
        $alt = $_POST["alt"];
        $shop_id = (int)$_POST["shop_id"];
        $id = (int)$_POST["id"];

        try {
            $db = db_connect();
            $sql = "UPDATE menus SET product=:product,pieces=:pieces,price=:price,product_detail=:product_detail,alt=:alt,shop_id=:shop_id WHERE id=:id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":product", $product, PDO::PARAM_STR);
            $stmt->bindParam(":pieces", $pieces, PDO::PARAM_INT);
            $stmt->bindParam(":price", $price, PDO::PARAM_INT);
            $stmt->bindParam(":product_detail", $product_detail, PDO::PARAM_STR);
            $stmt->bindParam(":alt", $alt, PDO::PARAM_STR);
            $stmt->bindParam(":shop_id", $shop_id, PDO::PARAM_INT);
            $stmt->execute();
            $_SESSION["msg"] = "商品情報の編集が完了しました‼";

            header("location:menu.php");
            exit();
        } catch (PDOException $e) {
            $_SESSION["err"] = 'DBへの接続・送信が失敗しました。' . $e->getMessage();
            header('location:menu_edit.php?='.$id);
            exit();
        }
    }
}
