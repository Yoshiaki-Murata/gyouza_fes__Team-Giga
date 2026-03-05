<?php
session_start();
require_once '../inc/function.php';

// 役割がマスター出ない人は削除できないように
if (!isset($_SESSION["role_id"]) || $_SESSION["role_id"] !== 1) {
    $_SESSION["err"] = "削除権限がありません。役割がマスターの人に削除依頼をしてください";
    header("location:shop.php");
    exit();
}
// TODO: データ受け取り
if (!empty($_POST)) {
    // POST送信されたとき
    if (!empty($_POST['id'])) {
        // TODO: idのチェック（空の場合）
        $id = (int)($_POST['id'] ?? 0);

        if ($id <= 0) {
            err_msg('削除できませんでした');
            header('location:shop.php');
            exit();
        }
        // DBに接続
        try {
            $db = db_connect();
            // 1. まず、削除対象の店舗に紐づく「商品(menus)」をすべて削除する
            $sql_menus = 'DELETE FROM menus WHERE shop_id = :id';
            $stmt_menus = $db->prepare($sql_menus);
            $stmt_menus->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt_menus->execute();

            // 2. その後に「店舗(shops)」を削除する
            $sql_shop = 'DELETE FROM shops WHERE id = :id';
            $stmt_shop = $db->prepare($sql_shop);
            $stmt_shop->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt_shop->execute();

            // 店舗の削除に成功したか（rowCountが1か）を確認
            if ($stmt_shop->rowCount() > 0) {
                $_SESSION["msg"] = "店舗と関連商品を削除しました。";
            } else {
                $_SESSION["err"] = "対象の店舗が見つかりませんでした。";
            }
            // トップページへ画面遷移
            header('location:shop.php');
            exit();
        } catch (PDOException $e) {
            db_err_msg() . $e->getMessage();
            header('location:shop.php');
            exit();
        }
    }
}
