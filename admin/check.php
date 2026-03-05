<?php
session_start();
require_once '../inc/function.php';

if (!empty($_POST)) { //ポスト送信ができたら
    if (!empty($_POST["username"]) && !empty($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        try {
            // DB接続
            $db = db_connect();
            $sql = "SELECT * FROM users WHERE username=:username";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $result["password"])) {
                $_SESSION["id"] = session_id();
                $_SESSION["username"] = $result["username"];
                $_SESSION["role_id"] = $result["role_id"];
                header("location:index.php");
                exit();
            }
        } catch (PDOException $e) {
            $_SESSION["err"] = 'DBへの接続・送信が失敗しました。' . $e->getMessage();
            header('location:login.php');
            exit();
        }
    }
}
login_session();
header("location:login.php");
