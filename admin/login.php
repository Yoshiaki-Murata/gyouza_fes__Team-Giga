<?php
require_once '../inc/function.php';
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/style.css">

    <title>-管理者ログイン-福岡餃子FES</title>
</head>

<body>
    <main role="main" class="container" style="padding:60px 15px 0">
        
        <h1 class="my-5 text-center">ログイン</h1>
        <form action="./check.php" method="post">
            <div class="row justify-content-center">
                <div class="mb-3 col-6">
                    <label for="username" class="form-label">ユーザー名</label>
                    <input type="text" name="username" id="username" class="form-control">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="mb-3 col-6">
                    <label for="password" class="form-label">パスワード</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
            </div>
            <div class="mb-3 text-center">
                <input type="submit" value="ログイン" class="btn btn-primary">
            </div>
    </main>
</body>
</body>

</html>