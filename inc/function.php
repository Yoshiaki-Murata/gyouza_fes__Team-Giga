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
function check_array($array)
{
    echo "<pre>";
    echo var_dump($array);
    echo "</pre>";
}

// エスケープ処理
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// 日付曜日処理
function format_jp_date($datetime)
{
    $date = new DateTime($datetime);
    $week = ['日', '月', '火', '水', '木', '金', '土'];
    $weekday = $week[$date->format('w')];
    return $date->format('n月j日') . "($weekday)";
}

function del_msg()
{
    return $_SESSION["msg"] = "削除完了しました";
}
function add_msg()
{
    return $_SESSION["msg"] = "新規追加が完了しました";
}
function edit_msg()
{
    return $_SESSION["msg"] = "編集が完了しました";
}

function db_err_msg()
{
    return  $_SESSION["err"] = "DBへの接続・送信が失敗しました。";
}

function err_msg($a)
{
    return $_SESSION["err"] = $a;
}

function login_session(){
    if(empty($_SESSION["id"])){
        err_msg("あなたはハッカーですか？もはやバッカーですねw
        正規の方法でおいでやす💛");
        header("location:login.php");
        exit();
    }
}

function n($a){
    return nl2br("$a");
}