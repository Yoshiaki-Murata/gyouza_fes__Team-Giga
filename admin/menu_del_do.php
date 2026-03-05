<?php
session_start();
require_once '../inc/function.php';
login_session();

// マスター以外は削除出来ない仕様
if (!isset($_SESSION["role_id"]) || $_SESSION["role_id"] !== 1) {
    $_SESSION["err"] = "削除権限がありません。役割がマスターの人に削除依頼をしてください";
    header('location:menu_del.php?='.$_POST["id"]);
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

            $_SESSION["msg"] = "メニューを削除しました";
            header("location:menu.php");
            exit();
        } catch (PDOException $e) {
             $_SESSION["err"] = 'DBへの接続・送信が失敗しました。' . $e->getMessage();
            header('location:menu_del.php?='.$id);
            exit();
        }
       
    }
}
