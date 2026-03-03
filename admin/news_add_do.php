<?php
require_once __DIR__ . '/../inc/function.php';

if (!empty($_POST)) {
    if (!empty($_POST['subject']) && !empty($_POST['titletag']) && !empty($_POST['text'])) {
        // データ受け取り + trim
        $subject  = trim($_POST['subject'] ?? '');
        $titletag = trim($_POST['titletag'] ?? '');
        $text     = trim($_POST['text'] ?? '');

        $errors = [];

        // 必須チェック
        if ($subject === '') {
            $errors[] = 'タイトルを入力してください';
        }
        if ($titletag === '') {
            $errors[] = 'ページタイトルを入力してください';
        }
        if ($text === '') {
            $errors[] = '本文を入力してください';
        }

        // 文字数制限（例）
        if (mb_strlen($subject) > 250) {
            $errors[] = 'タイトルは100文字以内にしてください';
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = [
                'subject' => $subject,
                'titletag' => $titletag,
                'text' => $text
            ];
            header('Location: news_add.php');
            exit;
        }

        $date = date("Y-m-d");

        try {
            $db = db_connect();

            $sql = 'INSERT INTO news(subject,titletag,text,date) VALUES(:subject,:titletag,:text,:date)';
            $stmt = $db->prepare($sql);

            $stmt->bindParam(':subject', $subject, PDO::PARAM_STR);
            $stmt->bindParam(':titletag', $titletag, PDO::PARAM_STR);
            $stmt->bindParam(':text', $text, PDO::PARAM_STR);
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);

            $stmt->execute();


            header('location:news.php');
            exit();
        } catch (PDOException $e) {
            // 本番ではログに書く
            error_log($e->getMessage());
            exit('システムエラーが発生しました');
        }
    }
}
