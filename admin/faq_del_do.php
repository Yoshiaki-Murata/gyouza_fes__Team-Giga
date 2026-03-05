<?php
session_start();
require_once '../inc/function.php';
login_session();

// 役割がマスター出ない人は削除できないように
if (!isset($_SESSION["role_id"]) || $_SESSION["role_id"] !== 1) {
    $_SESSION["err"] = "削除権限がありません。役割がマスターの人に削除依頼をしてください";
    header("location:faq.php");
    exit();
}

$id = (int)($_POST['id'] ?? 0);
if ($id <= 0) {
    $_SESSION["err"] = ('IDが不正です');
    header('location:faq_del.php'.$_POST["id"]);
    exit();
}

try {
    $db = db_connect();
    $sql = 'DELETE FROM questions WHERE id=:id';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() === 0) {
        $_SESSION["err"] = "削除対象が存在しませんでした";
        header('location:faq_del.php?id='.$_POST["id"]);
        exit();
    } else {
        $_SESSION["msg"] = "削除完了しました";
    }
    header('Location: faq.php');
    exit();
} catch (PDOException $e) {
    error_log($e->getMessage());
    $_SESSION["err"] = 'DBへの接続・送信が失敗しました。' . $e->getMessage();
    header('location:faq_del.php?id='.$_POST["id"]);
    exit();
}
