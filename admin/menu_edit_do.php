<?php
session_start();
require_once '../inc/function.php';

$id = (int)($_POST["id"] ?? 0); // idが存在しない場合

if (!empty($_POST)) {
    if (!empty($_POST["id"]) && !empty($_POST["product"]) && !empty($_POST["pieces"]) && !empty($_POST["price"]) && !empty($_POST["product_detail"]) && !empty($_POST["alt"]) && !empty($_POST["shop_id"])) {
        $product = $_POST["product"];
        $pieces = (int)$_POST["pieces"];
        $price = (int)$_POST["price"];
        $product_detail = $_POST["product_detail"];
        $alt = $_POST["alt"];
        $shop_id = (int)$_POST["shop_id"];
        $id = (int)$_POST["id"];
        // 現在の画像情報
        $image_name = $_POST["old_image"];

        // 新しい画像がアップロードされているか確認
        if (!empty($_FILES["image"]["tmp_name"]) && is_uploaded_file($_FILES["image"]["tmp_name"])) {

            $file_from = $_FILES["image"]["tmp_name"];
            $extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

            // 1. 拡張子などのチェック（ここでは省略）

            // 2. 新しいファイル名を生成
            $new_name = "menu0" .$_POST["shop_id"]."-". bin2hex(random_bytes(8)) . "." . $extension;
            $save_path = "../img/" . $new_name;

            // 3. サーバーへ保存
            if (move_uploaded_file($file_from, $save_path)) {

                // 新しい画像の保存に成功したら、古い画像を削除する
                if (!empty($_POST["old_image"])) {
                    $old_path = "../img/" . $_POST["old_image"];

                    // ファイルが実際に存在するか確認してから消す
                    if (file_exists($old_path)) {
                        unlink($old_path);
                    }
                }

                // DBに登録する変数名を新しい名前に書き換える
                $image_name = $new_name;
            } else {
                $_SESSION["err"] = "画像の保存に失敗しました。";
                header("location:menu_edit.php?id=" . $_POST["id"]);
                exit();
            }
        }

        try {
            $db = db_connect();
            $sql = "UPDATE menus SET product=:product, pieces=:pieces, price=:price, 
                product_detail=:product_detail, image=:image, alt=:alt, shop_id=:shop_id 
                WHERE id=:id";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":product", $product, PDO::PARAM_STR);
            $stmt->bindParam(":pieces", $pieces, PDO::PARAM_INT);
            $stmt->bindParam(":price", $price, PDO::PARAM_INT);
            $stmt->bindParam(":product_detail", $product_detail, PDO::PARAM_STR);
            $stmt->bindParam(":alt", $alt, PDO::PARAM_STR);
            $stmt->bindParam(":shop_id", $shop_id, PDO::PARAM_INT);
            $stmt->bindParam(":image", $image_name, PDO::PARAM_STR);
            $stmt->execute();

            $_SESSION["msg"] = "商品情報の編集が完了しました‼";
            header("location:menu.php");
            exit();
        } catch (PDOException $e) {
            $_SESSION["err"] = 'DBへの接続・送信が失敗しました。' . $e->getMessage();
            header('location:menu_edit.php?id=' . $id);
            exit();
        }
    } else {
        $_SESSION["err"] = "全ての項目を入力してください。";
        header('location:menu_edit.php?id=' . $id);
        exit();
    }
}
header('location:menu.php');
exit();
