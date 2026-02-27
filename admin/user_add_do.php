<?php
session_start();
require_once '../inc/function.php';

check_array($_POST);

if (!empty($_POST)) {
    if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["role_id"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $role_id = (int)$_POST["role_id"];

        // ユーザー名が半角英数８文字以上か確認
        if (!preg_match("/^[a-zA-Z0-9_-]{8,}$/", $username)) {
            header("location:user_add.php");
            exit();
        }
        // パスワードが半角英数８文字以上か確認
        if (!preg_match("/^[a-zA-Z0-9_-]{8,}$/", $password)) {
            header("location:user_add.php");
            exit();
        }

        try {
            // DB接続～同じ名前が無いか確認
            $db = db_connect();
            $sql = "SELECT COUNT(username) FROM users WHERE username = :username";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":username", $username,PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_NUM);
            // 同じ名前があったらuser_add.phpに返す。
            if ($result[0] !== 0) {
                header("location:user_add.php");
                exit();
            }
            // パスワードハッシュ化
            $password_hash=password_hash($password,PASSWORD_DEFAULT);


            // 追加作業
            $sql2 = "INSERT INTO users(username, password, role_id) VALUES (:username,:password,:role_id)";
            $stmt2 = $db->prepare($sql2);
            $stmt2->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt2->bindParam(":password", $password_hash, PDO::PARAM_STR);
            $stmt2->bindParam(":role_id", $role_id, PDO::PARAM_INT);
            $stmt2->execute();

            header("location:user.php");
            exit();
        } catch (PDOException $e) {
            exit("エラー" . $e->getMessage());
        }
    }
}
