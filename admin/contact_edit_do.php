<?php
session_start();
require_once '../inc/function.php';
login_session();

if (!empty($_POST)) {
    // status_id は 0 を考慮して !== "" でチェック
    if (!empty($_POST["id"]) && !empty($_POST["name"]) && !empty($_POST["mailaddress"]) && !empty($_POST["text"]) && isset($_POST["status_id"]) && $_POST["status_id"] !== "") {

        $id = (int)$_POST["id"];
        $name = $_POST['name'];
        $mailaddress = $_POST['mailaddress'];
        $text = $_POST['text'];
        $status = (int)$_POST["status_id"];
        $phonenumber = !empty($_POST["phonenumber"]) ? $_POST['phonenumber'] : null;

        // 電話番号バリデーション
        if ($phonenumber) {
            if (!preg_match("/^[0-9]{10,11}$/", $phonenumber)) {
                $_SESSION["err"] = "電話番号が不正です。数字のみ10〜11文字で入力してください";
                header("location:contact_edit.php?id=" . $id);
                exit();
            }
        }

        try {
            $db = db_connect();

            // SQLの組み立て
            if ($phonenumber) {
                $sql = "UPDATE contact SET name=:name, mailaddress=:mailaddress, phonenumber=:phonenumber, text=:text, date=now(), status=:status WHERE id=:id";
            } else {
                // WHERE を1つに修正、さらに電話番号をNULLで上書きしたい場合は phonenumber=:phonenumber を残してNULLをバインドします
                $sql = "UPDATE contact SET name=:name, mailaddress=:mailaddress, text=:text, date=now(), status=:status WHERE id=:id";
            }

            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":mailaddress", $mailaddress, PDO::PARAM_STR);
            $stmt->bindParam(":text", $text, PDO::PARAM_STR);
            $stmt->bindParam(":status", $status, PDO::PARAM_INT);

            if ($phonenumber) {
                $stmt->bindParam(":phonenumber", $phonenumber, PDO::PARAM_STR);
            }

            $stmt->execute();
            header("location:contact_list.php");
            exit();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            $_SESSION["err"] = 'DBへの接続・送信が失敗しました。' . $e->getMessage();
            header('location:contact_list.php');
            exit();
        }
    } else {
        $_SESSION["err"] = '必須項目が入力されていません。';
        header('location:contact_edit.php?id=' . ($_POST["id"] ?? ""));
        exit();
    }
}
