<?php
session_start();
require_once __DIR__ . '/../inc/function.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: news.php');
    exit;
}

// データ取得 + trim
$id       = (int)($_POST['id'] ?? 0);
$subject  = trim($_POST['subject'] ?? '');
$titletag = trim($_POST['titletag'] ?? '');
$text     = trim($_POST['text'] ?? '');

$errors = [];

// IDチェック
if ($id <= 0) {
    $errors[] = 'IDが不正です';
}

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

// 文字数例
if (mb_strlen($subject) > 100) {
    $errors[] = 'タイトルは100文字以内にしてください';
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = [
        'id' => $id,
        'subject' => $subject,
        'titletag' => $titletag,
        'text' => $text
    ];
    header('Location: news_edit.php?id=' . $id);
    exit;
}

$date = date("Y-m-d");

try {
    $db = db_connect();

    $sql = 'UPDATE news
            SET subject = :subject,
                titletag = :titletag,
                text = :text,
                date = :date
            WHERE id = :id';

    $stmt = $db->prepare($sql);

    $stmt->bindValue(':subject', $subject, PDO::PARAM_STR);
    $stmt->bindValue(':titletag', $titletag, PDO::PARAM_STR);
    $stmt->bindValue(':text', $text, PDO::PARAM_STR);
    $stmt->bindValue(':date', $date, PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    $stmt->execute();

    // 更新件数チェック
    if ($stmt->rowCount() === 0) {
        exit('更新対象が存在しません');
    }

    header('Location: news.php');
    exit;
} catch (PDOException $e) {
    error_log($e->getMessage());
    exit('システムエラーが発生しました');
}
