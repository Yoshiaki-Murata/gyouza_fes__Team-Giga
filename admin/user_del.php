<?php
session_start();
require_once '../inc/function.php';

// 役割がマスター出ない人は削除できないように
if (!isset($_SESSION["role_id"]) || (int)$_SESSION["role_id"] !== 1) {
    err_msg("削除権限がありません。役割がマスターの人に削除依頼をしてください");
    header("location:user.php");
    exit();
}

if (!empty($_POST)) {
    if (!empty($_POST["id"])) {
        $userid = (int)$_POST["id"];
        try {
            $db = db_connect();
            $sql = "SELECT users.id AS user_id,users.username,users.password,users.role_id,roles.role FROM users INNER JOIN roles ON users.role_id=roles.id WHERE users.id = :userid";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
            $stmt->execute();
            $target = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$target) {
                err_msg("指定されたユーザーが見つかりません");
                header("location:user.php");
                exit();
            }
        } catch (PDOException $e) {
            db_err_msg() . $e->getMessage();
            header("location:user.php");
            exit();
        }
    }
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

    <title>ユーザー削除 ‐確認‐</title>
</head>

<body>
    <?php include('../inc/header_master.php');  ?>

    <main role="main" class="container" style="padding:60px 15px 0">
        <h1 class="my-5 text-center">ユーザー削除 -確認-</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>ユーザー名</th>
                    <th>役割</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo h($target["user_id"]); ?></td>
                    <td><?php echo h($target["username"]); ?></td>
                    <td><?php echo h($target["role"]); ?></td>
                </tr>
            </tbody>
        </table>
        <div class="mt-5 mb-5">
            <p class="text-center">こちらのユーザーをほんとに削除しますか？</p>
        </div>

        <form action="./user_del_do.php" method="post">
            <div class="mb-5 text-center">
                <input type="hidden" name="id" value="<?php echo $target["user_id"]; ?>">
                <input type="submit" value="削除" class="btn btn-danger" onclick="return confirm('本当に削除しますか？');">
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

</body>

</html>