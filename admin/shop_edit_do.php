<?php
require_once __DIR__ . '/../inc/function.php';
session_start();

$id = (int)($_POST['id'] ?? 0);

if ($id <= 0) {
    exit('IDが不正です');
}

$shop = trim($_POST['shop'] ?? '');
$boos_number = trim($_POST['boos_number'] ?? '');
$shop_detail = trim($_POST['shop_detail'] ?? '');

$errors = [];

if ($shop === '') {
    $errors[] = '店舗名を入力してください';
}

if ($boos_number === '' || !ctype_digit($boos_number)) {
    $errors[] = 'ブース番号は数字で入力してください';
}

if ($shop_detail === '') {
    $errors[] = '店舗詳細を入力してください';
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = compact('shop', 'boos_number', 'shop_detail');
    header("Location: shop_edit.php?id={$id}");
    exit;
}

try {
    $db = db_connect();

    // 存在確認
    $check = $db->prepare('SELECT id FROM shops WHERE id=:id');
    $check->bindParam(':id', $id, PDO::PARAM_INT);
    $check->execute();

    if (!$check->fetch()) {
        exit('データが存在しません');
    }

    $sql = 'UPDATE shops 
            SET shop=:shop, 
                boos_number=:boos_number, 
                shop_detail=:shop_detail 
            WHERE id=:id';

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':shop', $shop, PDO::PARAM_STR);
    $stmt->bindParam(':boos_number', $boos_number, PDO::PARAM_INT);
    $stmt->bindParam(':shop_detail', $shop_detail, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: shop.php');
    exit;
} catch (PDOException $e) {
    error_log($e->getMessage());
    exit('システムエラーが発生しました');
}
