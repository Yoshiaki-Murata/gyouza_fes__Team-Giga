<?php
require_once __DIR__ . '/../inc/function.php';

if (!empty($_POST)) {

    $id = (int)($_POST['id'] ?? 0);
    if ($id === 0) {
        exit('IDが不正です');
    }

    $question = trim($_POST['question'] ?? '');
    $answer = trim($_POST['answer'] ?? '');
    $category_id = (int)($_POST['category_id'] ?? 0);

    if ($question === '' || $answer === '' || $category_id === 0) {
        exit('必要項目が未入力、またはカテゴリーが不正です');
    }

    try {
        $db = db_connect();

        $sql = 'UPDATE questions 
                SET question = :question, answer = :answer, category_id = :category_id 
                WHERE id = :id';
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':question', $question, PDO::PARAM_STR);
        $stmt->bindParam(':answer', $answer, PDO::PARAM_STR);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            exit('更新できませんでした');
        }

        header('Location: faq.php');
        exit();
    } catch (PDOException $e) {
        error_log($e->getMessage());
        exit('システムエラーが発生しました');
    }
}
