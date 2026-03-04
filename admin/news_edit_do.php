<?php
session_start();
require_once __DIR__ . '/../inc/function.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: news.php');
    exit();
}

// データ取得 + trim
$id       = (int)($_POST['id'] ?? 0);
$subject  = trim($_POST['subject'] ?? '');
$titletag = trim($_POST['titletag'] ?? '');
$text     = trim($_POST['text'] ?? '');

$errors = [];

// IDチェック
if ($id <= 0) {
    err_msg('IDが不正です');
    header('Location: news_edit.php?id=' . $id);
    exit();
}

// 必須チェック
if ($subject === '') {
    err_msg('タイトルを入力してください');
    header('Location: news_edit.php?id=' . $id);
    exit();
}
if ($titletag === '') {
    err_msg('ページタイトルを入力してください');
    header('Location: news_edit.php?id=' . $id);
    exit();
}
if ($text === '') {
    err_msg('本文を入力してください');
    header('Location: news_edit.php?id=' . $id);
    exit();
}

// 文字数例
if (mb_strlen($subject) > 100) {
    err_msg('タイトルは100文字以内にしてください');
    header('Location: news_edit.php?id=' . $id);
    exit();
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
        err_msg('更新対象が存在しません');
        header('Location: news_edit.php?id=' . $id);
        exit();
    }
    edit_msg();
    header('Location: news.php');
    exit;
} catch (PDOException $e) {
    db_err_msg(). $e->getMessage();
    header('Location: news_edit.php?id=' . $id);
    exit();
}
