<?php
session_start();
require_once '../inc/function.php';

// check_array($_SESSION);

try {
    $db = db_connect();
    $sql = "SELECT users.id AS user_id,users.username,users.password,users.role_id,roles.role FROM users INNER JOIN roles ON users.role_id=roles.id;";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@4.0.1/destyle.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Noto+Sans+JP:wght@100..900&family=Zen+Maru+Gothic&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="../css/style.css">

    <title>ユーザー管理画面</title>
</head>

<body>
    <?php include('../inc/header_master.php');  ?>
    <main role="main" class="container " style="padding:60px 15px 0">

        <h1 class="my-5 text-center c-title__main">ユーザー管理画面</h1>
        <h2>ユーザー新規追加</h2>
        <a href="user_add.php" class="mb-5">新規登録はこちらより</a>

        <h2 class="mt-5">ユーザー一覧</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>名前</th>
                    <th>役割</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo h($row["user_id"]); ?></td>
                        <td><?php echo h($row["username"]); ?></td>
                        <td><?php echo h($row["role"]); ?></td>
                        <td class="row">
                            <form action="user_edit.php" method="post" class="col">
                                <input type="hidden" name="id" value="<?php echo h($row["user_id"]); ?>">
                                <input type="submit" value="編集" class="btn  btn-primary">
                            </form>
                            <form action="user_del.php" method="post" class="col">
                                <input type="hidden" name="id" value="<?php echo h($row["user_id"]); ?>">
                                <input type="submit" value="削除" class="btn  btn-danger">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if (!empty($_SESSION["del_err"])): ?>
            <p class="text-center bs-danger-text-emphasis">
                <?php echo h($_SESSION["del_err"]);
                unset($_SESSION["del_err"]);
                ?>
            </p>
        <?php endif ?>
        <?php if (!empty($_SESSION["del_msg"])): ?>
            <p class="text-center bs-primary-text-emphasis">
                <?php echo h($_SESSION["del_msg"]);
                unset($_SESSION["del_msg"]);
                ?>
            </p>
        <?php endif ?>
    </main>

</body>

</html>