<?php
session_start();
require_once __DIR__ . '/../inc/function.php';

if (!empty($_POST)) {
    if (!empty($_POST['subject']) && !empty($_POST['titletag']) && !empty($_POST['text'])) {
        // データ受け取り + trim
        $subject  = trim($_POST['subject'] ?? '');
        $titletag = trim($_POST['titletag'] ?? '');
        $text     = trim($_POST['text'] ?? '');

        // 必須チェック
        if ($subject === '') {
            err_msg('タイトルを入力してください');
            header('Location: news.php');
            exit;
        }
        if ($titletag === '') {
            err_msg('ページタイトルを入力してください');
            header('Location: news.php');
            exit;
        }
        if ($text === '') {
            err_msg('本文を入力してください');
            header('Location: news.php');
            exit;
        }

        // 文字数制限（例）
        if (mb_strlen($subject) > 250) {
            err_msg('タイトルは100文字以内にしてください');
            header('Location: news.php');
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

            del_msg();
            header('location:news.php');
            exit();
        } catch (PDOException $e) {
            db_err_msg() . $e->getMessage();
            header('location:news.php');
            exit();
        }
    }
}
