<?php
// require_once __DIR__ . '/menu.php';

// function db_connect()
// {
//     $host = 'localhost';
//     $dbname = 'gyouza_gigagiga';
//     $username = 'root';
//     $password = '';
//     $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     return $pdo;
// }

// function get_menu_by_id($id)
// {
//     $pdo = db_connect();
//     $sql = "SELECT * FROM menus WHERE id = :id";
//     $stmt = $pdo->prepare($sql);
//     $stmt->bindParam(':id', $id, PDO::PARAM_INT);
//     $stmt->execute();
//     return $stmt->fetch(PDO::FETCH_ASSOC);
// }
