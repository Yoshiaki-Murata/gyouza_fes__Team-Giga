<?php
session_start();
require_once __DIR__ . '/../inc/function.php';

$shop = trim($_POST['shop'] ?? '');
$boos_number = trim($_POST['boos_number'] ?? '');
$shop_detail = trim($_POST['shop_detail'] ?? '');



try {
    $db = db_connect();
    $sql = 'INSERT INTO shops(shop, boos_number, shop_detail) 
            VALUES(:shop, :boos_number, :shop_detail)';

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':shop', $shop, PDO::PARAM_STR);
    $stmt->bindParam(':boos_number', $boos_number, PDO::PARAM_INT);
    $stmt->bindParam(':shop_detail', $shop_detail, PDO::PARAM_STR);
    $stmt->execute();

    $_SESSION["msg"] = "新規追加が完了しました";
    header('Location: shop.php');
    exit;
} catch (PDOException $e) {
    error_log($e->getMessage());
    exit('システムエラーが発生しました');
}
