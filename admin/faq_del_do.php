<?php
require_once __DIR__ . '/../inc/function.php';

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

    header('Location: faq.php');
    exit();
} catch (PDOException $e) {
    exit('エラー: ' . $e->getMessage());
}
