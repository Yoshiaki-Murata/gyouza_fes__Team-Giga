<?php
require_once __DIR__ . '/../inc/function.php';

if (!empty($_POST)) {
    if (!empty($_POST['shop']) && !empty($_POST['shop_detail']) && !empty($_POST['boos_number'])) {
        $shop = $_POST['shop'];
        $boos_number = $_POST['boos_number'];
        $shop_detail = $_POST['shop_detail'];

        try {
            $db = db_connect();

            $sql = 'INSERT INTO shops(shop,boos_number,shop_detail) VALUES(:shop,:boos_number,:shop_detail)';
            $stmt = $db->prepare($sql);

            $stmt->bindParam(':shop', $shop, PDO::PARAM_STR);
            $stmt->bindParam(':boos_number', $boos_number, PDO::PARAM_STR);
            $stmt->bindParam(':shop_detail', $shop_detail, PDO::PARAM_STR);

            $stmt->execute();


            header('location:shop.php');
            exit();
        } catch (PDOException $e) {
            exit("Error:" . $e->getMessage());
        }
    }
}
