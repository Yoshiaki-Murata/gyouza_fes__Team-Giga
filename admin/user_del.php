<?php
session_start();
require_once '../inc/function.php';

// if(isset($_SESSION["role_id"]){
//     $_SESSION["del_err"]="削除権限がありません。役割がマスターの人に削除依頼をしてください";
//     header("location:user.php");
//     exit();
// }

if (!empty($_POST)) {
    if (!empty($_POST["id"])) {
        $userid = (int)$_POST["id"];
        try {
            $db = db_connect();
            $sql = "SELECT users.id AS user_id,users.username,users.password,users.role_id,roles.role FROM users INNER JOIN roles ON users.role_id=roles.id WHERE users.id = :userid";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
            $stmt->execute();
            $target = "";
            $target = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>ユーザー削除 ‐確認‐</title>
</head>

<body>
    <main role="main" class="container" style="padding:60px 15px 0">
        <h1 class="my-5 text-center">ユーザー削除 -確認-</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>ユーザー名</th>
                    <th>役割</th>
                </tr>
                <tr>
                    <td><?php echo $target["user_id"]; ?></td>
                    <td><?php echo $target["username"]; ?></td>
                    <td><?php echo $target["role"]; ?></td>
                </tr>
            </thead>
        </table>
        <div class="mt-5 mb-5">
            <p class="text-center">こちらのユーザーをほんとに削除しますか？</p>
        </div>

        <form action="./user_del_do.php" method="post">
            <div class="mb-5 text-center">
                <input type="hidden" name="id" value="<?php echo $target["user_id"]; ?>">
                <input type="submit" value="削除" class="btn btn-danger">
            </div>
        </form>

</body>

</html>