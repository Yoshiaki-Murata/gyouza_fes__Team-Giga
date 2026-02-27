<?php
require_once __DIR__ . '/../inc/function.php';

if (!empty($_POST)) {
    if (!empty($_POST['question']) && !empty($_POST['answer'])) {
        // データのうけとり
        $question = $_POST['question'];
        $answer = $_POST['answer'];
        $category_id = (int)($_POST['category_id'] ?? 0);

        if ($category_id === 0) {
            exit('カテゴリーが不正です');
        }

        try {
            $db = db_connect();

            $sql = 'INSERT INTO questions(question, answer, category_id)VALUES(:question, :answer, :category_id)';
            $stmt = $db->prepare($sql);

            $stmt->bindParam(':question', $question, PDO::PARAM_STR);
            $stmt->bindParam(':answer', $answer, PDO::PARAM_STR);
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);

            $stmt->execute();


            header('location:faq.php');
            exit();
        } catch (PDOException $e) {
            exit("Error:" . $e->getMessage());
        }
    }
}
