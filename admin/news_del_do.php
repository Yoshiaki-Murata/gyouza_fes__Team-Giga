<?php
session_start();
require_once '../inc/function.php';

// 役割がマスター出ない人は削除できないように
if (!isset($_SESSION["role_id"]) || $_SESSION["role_id"] !== 1) {
    err_msg("削除権限がありません。役割がマスターの人に削除依頼をしてください");
    header("location:news.php");
    exit();
}
// TODO: データ受け取り
if (!empty($_POST)) {
    // POST送信されたとき
    if (!empty($_POST['id'])) {
        // TODO: idのチェック（空の場合）
        $id = (int)($_POST['id'] ?? 0);

        if ($id === 0) {
            err_msg('IDが不正です');
            header("location:news_del.php?=".$id);
            exit();
        }
        // DBに接続
        try {
            $db = db_connect();

            // 存在確認
            $sql = 'SELECT id FROM news WHERE id=:id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if (!$stmt->fetch()) {
                err_msg("対象データが存在しません");
                header("location:news_del.php?=".$id);
                exit();
            }

            // infoテーブルから1行削除するSQL
            $sql = 'DELETE FROM news WHERE id=:id';
            $stmt = $db->prepare($sql);
            // idをプレースホルダへバインド
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            del_msg();
            // トップページへ画面遷移
            header('location:news.php');
            exit();
        } catch (PDOException $e) {
            db_err_msg(). $e->getMessage();
            header('location:news_del.php');
            exit();
        }
    }
}
