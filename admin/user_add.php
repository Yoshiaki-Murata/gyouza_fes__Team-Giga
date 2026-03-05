<?php
session_start();
require_once '../inc/function.php';

try {
    $db = db_connect();
    $sql = "SELECT * FROM roles";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION["err"] = 'DBへの接続・送信が失敗しました。' . $e->getMessage();
    header('location:login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="ja">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('../inc/link_master.php');  ?>
    <title>ユーザー新規登録</title>
</head>

<body>
    <?php include('../inc/header_master.php');  ?>
    <main role="main" class="container" style="padding:60px 15px 0">

        <h1 class="my-5 text-center c-title__main">ユーザー新規登録</h1>
        <form action="./user_add_do.php" method="post">
            <div class="row justify-content-center">
                <div class="mb-3 col-6">
                    <label for="username" class="form-label">ユーザー名（半角英数８文字以上）</label>
                    <input type="text" name="username" id="username" class="form-control">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="mb-5 col-6">
                    <label for="password" class="form-label">パスワード（半角英数８文字以上）</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="mb-5 col-6">
                    <label for="role_id" class="form-label">権限</label>
                    <select name="role_id" id="role_id" class="form-select form-select-sm mb-5" aria-label="Small select example">
                        <?php foreach ($result as  $row): ?>
                            <option value="<?php echo h($row["id"]); ?>">
                                <?php echo h($row["role"]); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="mb-5 text-center">
                <input type="submit" value="登録" class="btn btn-primary">
            </div>
        </form>
        <?php if (!empty($_SESSION["msg"])): ?>
            <p class="text-center bs-danger-text-emphasis">
                <?php echo h($_SESSION["msg"]);
                unset($_SESSION["msg"]);
                ?>
            </p>
        <?php endif ?>
        <?php if (!empty($_SESSION["err"])): ?>
            <p class="text-center bs-danger-text-emphasis">
                <?php echo h($_SESSION["err"]);
                unset($_SESSION["err"]);
                ?>
            </p>
        <?php endif ?>
    </main>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>