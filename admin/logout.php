<?php
session_start();
require_once '../inc/function.php';

if(isset($_SESSION["id"])){
    $_SESSION=array();
    session_destroy();
}
header("location:login.php");
exit();