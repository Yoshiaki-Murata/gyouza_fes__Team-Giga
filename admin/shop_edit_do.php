<?php

require_once __DIR__ . '/../inc/function.php';


if (!empty($_POST)) {

    $id = (int)($_POST['id'] ?? 0);

    if ($id === 0) {
        exit('IDが不正です');
    }
    if (!empty($_POST['shop']) && !empty($_POST['boos_number']) && !empty($_POST['shop_detail'])) {
        // データのうけとり
        $shop = $_POST['shop'];
        $boos_number = $_POST['boos_number'];
        $shop_detail = $_POST['shop_detail'];


        try {
            $db = db_connect();

            $sql = 'UPDATE shops SET shop=:shop, boos_number=:boos_number,shop_detail =:shop_detail WHERE id=:id';
            $stmt = $db->prepare($sql);

            $stmt->bindParam(':shop', $shop, PDO::PARAM_STR);
            $stmt->bindParam(':boos_number', $boos_number, PDO::PARAM_STR);
            $stmt->bindParam(':shop_detail', $shop_detail, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();


            header('location:shop.php');
            exit();
        } catch (PDOException $e) {
            exit("Error:" . $e->getMessage());
        }
    }
}
