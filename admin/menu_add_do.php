<?php
session_start();
require_once '../inc/function.php';

check_array($_POST);
check_array($_FILES);

// アップロードした画像をimageファイルに登録する。
if(!empty($_FILES)){
    if(!empty($_FILES("image"))&&is_uploaded_file($_FILES["image"]["name"]))
}


if(!empty($_POST)){
    if(!empty($_POST["product"])&&!empty($_POST["pieces"])&&!empty($_POST["price"])&&!empty($_POST["product_details"])&&!empty($_POST["image"])&&!empty($_POST["alt"])&&!empty($_POST["shop_id"])){
        $product=$_POST["product"];
        $pieces=$_POST["pieces"];
        $price=$_POST["price"];
        $product_details=$_POST["product_details"];
        $image=$_POST["image"];
        $alt=$_POST["alt"];
        $shop_id=$_POST["shop_id"];



//     // DBに情報を登録する
//     try{
//         $db=db_connect();
//         $sql="INSERT INTO `menus`(product, pieces, price, product_detail, image, alt, shop_id) VALUES (:product,:pieces,:price,:product_detail,:image,:alt,:shop_id)";
//         $stmt=$db->prepare($sql);
//         $stmt->bindParam(":product",$product,PDO::PARAM_STR);
//         $stmt->bindParam(":pieces",$pieces,PDO::PARAM_INT);
//         $stmt->bindParam(":price",$price,PDO::PARAM_INT);
//         $stmt->bindParam(":product_detail",$product_details,PDO::PARAM_STR);
//         $stmt->bindParam(":image",$image,PDO::PARAM_STR);
//         $stmt->bindParam(":alt",$alt,PDO::PARAM_STR);
//         $stmt->bindParam(":shop_id",$shop_id,PDO::PARAM_INT);
//         $stmt->execute();

//         $_SESSION["menu_add_success"]="商品の新規追加が完了しました‼";
//         // メニューにもどる



//     }catch(PDOException $e){
//         exit("エラー".$e->getMessage());
//     }
    }
}