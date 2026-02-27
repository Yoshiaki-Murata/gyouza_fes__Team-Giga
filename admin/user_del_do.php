<?php
session_start();
require_once '../inc/function.php';

check_array($_POST);

if(!empty($_POST)){
    if(!empty($_POST["id"])){
        $id=(int)$_POST["id"];
        try{
            $db=db_connect();
            $sql="DELETE FROM users WHERE id=:id";
            $stmt=$db->prepare("$sql");
            $stmt->bindParam(":id",$id,PDO::PARAM_INT);
            $stmt->execute();
            
            $_SESSION["del_msg"]="削除完了しました";
            header("location:user.php");
            exit();
        }catch(PDOException $e){
            exit("エラー".$e->getMessage());
        }
    }
}
?>