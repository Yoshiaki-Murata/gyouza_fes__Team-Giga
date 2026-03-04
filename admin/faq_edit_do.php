<?php
require_once __DIR__ . '/../inc/function.php';

if (!empty($_POST)) {

    $id = (int)($_POST['id'] ?? 0);
    if ($id === 0) {
        $_SESSION["err"] = 'IDが不正です';
        header('location:faq_edit.php');
        exit();
    }

    $question = trim($_POST['question'] ?? '');
    $answer = trim($_POST['answer'] ?? '');
    $category_id = (int)($_POST['category_id'] ?? 0);

    if ($question === '' || $answer === '' || $category_id === 0) {
        $_SESSION["err"] = '必要項目が未入力、またはカテゴリーが不正です';
        header('location:contact_edit.php');
        exit();
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
            $_SESSION["err"] = ('更新できませんでした');
            header('location:faq_edit.php');
            exit();
        }

        $_SESSION["msg"] = "編集が完了しました";
        header('Location: faq.php');
        exit();
    } catch (PDOException $e) {
        $_SESSION["err"] = 'DBへの接続・送信が失敗しました。' . $e->getMessage();
        header('location:faq_edit.php');
        exit();
    }
}
