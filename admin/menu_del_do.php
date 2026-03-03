<?php
session_start();
require_once '../inc/function.php';

if (!isset($_SESSION["role_id"]) || $_SESSION["role_id"] !== 1) {
    $_SESSION["menu_del_err"] = "削除権限がありません。役割がマスターの人に削除依頼をしてください";
    header("location:menu.php");
    exit();
}

if (!empty($_POST)) {
    if (!empty($_POST["id"])) {
        $id = (int)$_POST["id"];
        try {
            $db = db_connect();
            $sql = "DELETE FROM menus WHERE id=:id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            $_SESSION["menu_del_msg"] = "メニューを削除しました";
            header("location:menu.php");
            exit();
        } catch (PDOException $e) {
            exit("エラー" . $e->getMessage());
        }
       
    }
}
