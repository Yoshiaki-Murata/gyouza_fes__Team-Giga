<?php
session_start();
require_once '../inc/function.php';

// 役割がマスター出ない人は削除できないように
if (!isset($_SESSION["role_id"]) || (int)$_SESSION["role_id"] !== 1) {
    $_SESSION["del_err"] = "削除権限がありません。役割がマスターの人に削除依頼をしてください";
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
                $_SESSION["del_err"] = "指定されたユーザーが見つかりません";
                header("location:user.php");
                exit();
            }
        } catch (PDOException $e) {
            exit("エラー" . $e->getMessage());
        }
    }
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('../inc/link_master.php');  ?>

    <title>ユーザー削除 ‐確認‐</title>
</head>

<body>
    <?php include('../inc/header_master.php');  ?>

    <main role="main" class="container" style="padding:60px 15px 0">
        <h1 class="my-5 c-title__main">ユーザー削除 -確認-</h1>
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

        <p><a href="user.php" class="mb-5 text-reset">一覧へ戻る</a></p>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>