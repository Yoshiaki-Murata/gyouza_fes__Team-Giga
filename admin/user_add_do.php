<?php
session_start();
require_once '../inc/function.php';

check_array($_POST);

try{
    $db=db_connect();
    $sql="INSERT INTO users(username, password, role_id) VALUES ()";
    $stmt=$db->prepare($sql);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    exit("エラー".$e->getMessage());
}