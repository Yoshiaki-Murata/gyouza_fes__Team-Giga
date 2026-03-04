<?php
session_start();
require_once '../inc/function.php';

if (!empty($_POST)) {
    if (!empty($_POST["id"]) && !empty($_POST["name"]) && !empty($_POST["mailaddress"]) && !empty($_POST["text"]) && !empty($_POST["status_id"])) {
        $id = (int)$_POST["id"];
        $name = $_POST['name'];
        $mailaddress = $_POST['mailaddress'];
        $text = $_POST['text'];
        $status = (int)$_POST["status_id"];

        // 電話番号が入力されたときの処理
        if (!empty($_POST["phonenumber"])) {
            $phonenumber = $_POST['phonenumber'];
            if (!preg_match("/^[0-9]{10,11}$/", $phonenumber)) {
                $_SESSION["err"] = "電話番号が不正です。数字のみ入力可能です";
                header("location:contact_edit.php?id=".$_POST["id"]);
                exit();
            }
        }

        try {
            $db = db_connect();
            if (!empty($_POST["phonenumber"])) {
                $sql = "UPDATE contact SET name=:name,mailaddress=:mailaddress,phonenumber=:phonenumber,text=:text,date=now(),status=:status WHERE id=:id ;";
            } else {
                $sql = "UPDATE contact SET name=:name,mailaddress=:mailaddress,text=:text,date=now(),status=:status WHERE WHERE id=:id;";
            }

            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":mailaddress", $mailaddress, PDO::PARAM_STR);
            if (!empty($_POST["phonenumber"])) {
                $stmt->bindParam(":phonenumber", $phonenumber, PDO::PARAM_STR);
            }
            $stmt->bindParam(":text", $text, PDO::PARAM_STR);
            $stmt->bindParam(":status", $status, PDO::PARAM_INT);
            $stmt->execute();

            header("location:contact_list.php");
        } catch (PDOException $e) {
            exit("エラー" . $e->getMessage());
        }
    } else {
        error_log($e->getMessage());
        $_SESSION["err"] = 'DBへの接続・送信が失敗しました。' . $e->getMessage();
        header('location:contact_edit.php?id=' . $_POST["id"]);
        exit();
    }
}
