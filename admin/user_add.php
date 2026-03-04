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
    exit("エラー" . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="ja">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@4.0.1/destyle.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Noto+Sans+JP:wght@100..900&family=Zen+Maru+Gothic&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="./../css/style.css">
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
            <?php if (!empty($_SESSION["user_add_pass_err"])): ?>
                <p class="text-center bs-danger-text-emphasis">
                    <?php echo h($_SESSION["user_add_pass_err"]);
                    unset($_SESSION["user_add_pass_err"]);
                    ?>
                </p>
            <?php endif ?>
            <?php if (!empty($_SESSION["user_add_name_err"])): ?>
                <p class="text-center bs-primary-text-emphasis">
                    <?php echo h($_SESSION["user_add_name_err"]);
                    unset($_SESSION["user_add_name_err"]);
                    ?>
                </p>
            <?php endif ?>

            <div class="mb-5 text-center">
                <input type="submit" value="登録" class="btn btn-primary">
            </div>
        </form>
    </main>

</body>

</html>