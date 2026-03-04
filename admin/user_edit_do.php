<?php
session_start();
require_once '../inc/function.php';

check_array($_POST);

// CSRF対策
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    exit("不正なリクエストです。");
}
// 使用したトークンを削除
unset($_SESSION['csrf_token']);

if (!empty($_POST)) {
    if (!empty($_POST["username"]) && !empty($_POST["role_id"]) && !empty($_POST["id"])) {
        $username = $_POST["username"];
        $role_id = (int)$_POST["role_id"];
        $id = (int)$_POST["id"];
        $password = $_POST["password"];

        // ユーザー名が半角英数８文字以上か確認
        if (!preg_match("/^[a-zA-Z0-9_-]{8,}$/", $username)) {
            header("location:user_edit.php?id=" . $id);
            exit();
        }
        // パスワードの変更があるときは半角英数８文字以上か確認
        if (!empty($password)) {
            if (!preg_match("/^[a-zA-Z0-9_-]{8,}$/", $password)) {
                header("location:user_edit.php?id=" . $id);
                exit();
            }
        }

        // ユーザー名が重複していないか確認
        try {
            // DB接続～同じ名前が無いか確認
            $db = db_connect();
            $sql = "SELECT COUNT(username) FROM users WHERE username = :username AND id != :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_NUM);
            // 同じ名前があったらuser_add.phpに返す。
            if ($result[0] !== 0) {
                header("location:user_edit.php?id=" . $id);
                exit();
            }

            // 変更内容をDBに修正する
            // パスワードの変更があるときはパスワードハッシュ化する
            if (!empty($password)) {
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
            }
            // パスワードがあるときとない時のSQL文を分岐する
            if (!empty($password)) {
                $sql2 = "UPDATE users SET username=:username,password=:password,role_id=:role_id WHERE id=:id";
            } else {
                $sql2 = "UPDATE users SET username=:username,role_id=:role_id WHERE id=:id";
            }

            $stmt2 = $db->prepare("$sql2");
            $stmt2->bindParam(":username", $username, PDO::PARAM_STR);
            // パスワードの変更があるかチェック
            if (!empty($password)) {
                $stmt2->bindParam(":password", $password_hash, PDO::PARAM_STR);
            }
            $stmt2->bindParam(":role_id", $role_id, PDO::PARAM_INT);
            $stmt2->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt2->execute();
            header("location:user.php");
            exit();
        } catch (PDOException $e) {
            exit("エラー" . $e->getMessage());
        }
    }
}
