<?php

require_once __DIR__ . '/../inc/function.php';


if (!empty($_POST)) {

    $id = (int)($_POST['id'] ?? 0);

    if ($id === 0) {
        exit('IDが不正です');
    }
    if (!empty($_POST['subject']) && !empty($_POST['titletag']) && !empty($_POST['text'])) {
        // データのうけとり
        $subject = $_POST['subject'];
        $titletag = $_POST['titletag'];
        $text = $_POST['text'];

        $date = date("Y-m-d");

        try {
            $db = db_connect();

            $sql = 'UPDATE news SET subject=:subject, titletag=:titletag,text =:text,date=:date WHERE id=:id';
            $stmt = $db->prepare($sql);

            $stmt->bindParam(':subject', $subject, PDO::PARAM_STR);
            $stmt->bindParam(':titletag', $titletag, PDO::PARAM_STR);
            $stmt->bindParam(':text', $text, PDO::PARAM_STR);
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();


            header('location:news.php');
            exit();
        } catch (PDOException $e) {
            exit("Error:" . $e->getMessage());
        }
    }
}
