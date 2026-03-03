<?php
session_start();
require_once '../inc/function.php';

// if (!empty($_POST)) {
//     if (!empty($_POST["id"]) && !empty($_POST["name"]) && !empty($_POST["pieces"]) && !empty($_POST["price"]) && !empty($_POST["product_detail"]) && !empty($_POST["alt"]) && !empty($_POST["shop_id"])) {
//         $product = $_POST["product"];
//         $pieces = (int)$_POST["pieces"];
//         $price = (int)$_POST["price"];
//         $product_detail = $_POST["product_detail"];
//         $alt = $_POST["alt"];
//         $shop_id = (int)$_POST["shop_id"];
//         $id=(int)$_POST["id"];

//         try {
//             $db = db_connect();
//             $sql = "UPDATE menus SET product=:product,pieces=:pieces,price=:price,product_detail=:product_detail,alt=:alt,shop_id=:shop_id WHERE id=:id";
//             $stmt = $db->prepare($sql);
//             $stmt->bindParam(":id", $id, PDO::PARAM_INT);
//             $stmt->bindParam(":product", $product, PDO::PARAM_STR);
//             $stmt->bindParam(":pieces", $pieces, PDO::PARAM_INT);
//             $stmt->bindParam(":price", $price, PDO::PARAM_INT);
//             $stmt->bindParam(":product_detail", $product_detail, PDO::PARAM_STR);
//             $stmt->bindParam(":alt", $alt, PDO::PARAM_STR);
//             $stmt->bindParam(":shop_id", $shop_id, PDO::PARAM_INT);
//             $stmt->execute();
//             $_SESSION["menu_edit_success"] = "商品情報の編集が完了しました‼";

//             header("location:menu.php");
//             exit();
//         } catch (PDOException $e) {
//             exit("エラー" . $e->getMessage());
//         }
//     }
// }

if (!empty($_POST)) {
    if (empty($_POST["id"]) && !empty($_POST["name"]) && !empty($_POST["mailaddress"]) && !empty($_POST["text"]) && !empty($_POST["status"])) {
        $name = $_POST['name'];
        $mailaddress = $_POST['mailaddress'];
        $text = $_POST['text'];
        $status= $_POST["status_id"];

        // 電話番号が入力されたときの処理
        if (!empty($_POST["phonenumber"])) {
            $phonenumber = $_POST['phonenumber'];
            if (!preg_match("/^[0-9]{10,11}$/", $phonenumber)) {
                header("location:confirm.php");
                $_SESSION["contact_err"] = "電話番号が不正です。数字のみ入力可能です";
                exit();
            }
        }

        try {
            $db = db_connect();
            if (!empty($_POST["phonenumber"])) {
                $sql = "INSERT INTO contact(name,mailaddress,phonenumber,text, date, status) VALUES (:name,:mailaddress,:phonenumber,:text,now(),1)";
            } else {
                $sql = "INSERT INTO contact(name,mailaddress,text, date, status) VALUES (:name,:mailaddress,:text,now(),1)";
            }

            $stmt = $db->prepare($sql);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":mailaddress", $mailaddress, PDO::PARAM_STR);
            if (!empty($_POST["phonenumber"])) {
                $stmt->bindParam(":phonenumber", $phonenumber, PDO::PARAM_STR);
            }
            $stmt->bindParam(":text", $text, PDO::PARAM_STR);
            $stmt->execute();
            $result = true;
        } catch (PDOException $e) {
            $result = false;
            exit("エラー" . $e->getMessage());
        }
    } else {
        header("location:confirm.php");
        $_SESSION["contact_err"] = "必須項目が入力されていません。入力してください";
        exit();
    }
}
