<?php
session_start();
require_once '../inc/function.php';

try {
    $db = db_connect();
    $sql = "SELECT users.id AS user_id,users.username,users.password,roles.role FROM users INNER JOIN roles ON users.role_id=roles.id;";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit("エラー" . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>ユーザー新規登録</title>
</head>

<body>

    <main role="main" class="container" style="padding:60px 15px 0">

        <h1 class="my-5 text-center">ユーザー新規登録</h1>
        <form action="./user_add_do.php" method="post">
            <div class="row justify-content-center">
                <div class="mb-3 col-6">
                    <label for="username" class="form-label">ユーザー名</label>
                    <input type="text" name="username" id="username" class="form-control">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="mb-5 col-6">
                    <label for="password" class="form-label">パスワード</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
            </div>


            <div class="mb-5 text-center">
                <input type="submit" value="登録" class="btn btn-primary">
            </div>
        </form>
    </main>

</body>

</html>