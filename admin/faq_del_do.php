<?php
session_start();
require_once '../inc/function.php';

// 役割がマスター出ない人は削除できないように
if (!isset($_SESSION["role_id"]) || $_SESSION["role_id"] !== 1) {
    $_SESSION["del_err"] = "削除権限がありません。役割がマスターの人に削除依頼をしてください";
    header("location:user.php");
    exit();
}

$id = (int)($_POST['id'] ?? 0);
if ($id === 0) {
    exit('IDが不正です');
}

try {
    $db = db_connect();
    $sql = 'DELETE FROM questions WHERE id=:id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $_SESSION["del_msg"] = "削除完了しました";
    header('Location: faq.php');
    exit();
} catch (PDOException $e) {
    exit('エラー: ' . $e->getMessage());
}
