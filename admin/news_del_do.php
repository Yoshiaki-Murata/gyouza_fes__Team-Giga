<?php
require_once __DIR__ . '/../inc/function.php';

// TODO: データ受け取り
if (!empty($_POST)) {
    // POST送信されたとき
    if (!empty($_POST['id'])) {
        // TODO: idのチェック（空の場合）
        $id = $_POST['id'];
        // DBに接続
        try {
            $db = db_connect();
            // infoテーブルから1行削除するSQL
            $sql = 'DELETE FROM news WHERE id=:id';
            $stmt = $db->prepare($sql);
            // idをプレースホルダへバインド
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // トップページへ画面遷移
            header('location:news.php');
            exit();
        } catch (PDOException $e) {
            exit('エラー: ' . $e->getMessage());
        }
    }
}
