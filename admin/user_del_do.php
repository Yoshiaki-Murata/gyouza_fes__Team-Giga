<?php
session_start();
require_once '../inc/function.php';

check_array($_POST);
if (!isset($_SESSION["role_id"]) || $_SESSION["role_id"] !== 1) {
    $_SESSION["err"] = "削除権限がありません。役割がマスターの人に削除依頼をしてください";
    header("location:user.php");
    exit();
}

if(!empty($_POST)){
    if(!empty($_POST["id"])){
        $id=(int)$_POST["id"];
        try{
            $db=db_connect();
            $sql="DELETE FROM users WHERE id=:id";
            $stmt=$db->prepare("$sql");
            $stmt->bindParam(":id",$id,PDO::PARAM_INT);
            $stmt->execute();
            
            $_SESSION["msg"]="削除完了しました";
            header("location:user.php");
            exit();
        }catch(PDOException $e){
            db_err_msg(). $e->getMessage();
            header('location:user.php');
            exit();
        }
    }
}
?>