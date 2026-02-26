<?php
// 丸裸phpファイルには↓↓
require_once __DIR__ . '/db_info.php';



// DB接続
function db_connect()
{
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
    $db = new PDO($dsn, DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    return $db;
}


// var_dump関数
function check_array($array){
    echo "<pre>";
    echo var_dump($array);
    echo "</pre>";
}