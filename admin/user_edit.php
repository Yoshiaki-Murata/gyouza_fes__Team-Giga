<?php
session_start();
require_once '../inc/function.php';
login_session();

if (!isset($_SESSION['csrf_token'])) {
    // 安全なランダム文字列を生成してセッションに保存
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

try {
    $db = db_connect();
    $sql2 = "SELECT * FROM roles";
    $stmt2 = $db->prepare($sql2);
    $stmt2->execute();
    $result = $stmt2->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit("エラー" . $e->getMessage());
}

// POST送信方受け取ったIDとおなじユーザー情報を取得
if (!empty($_POST)) {
    if (!empty($_POST["id"])) {
        $userid = (int)$_POST["id"];
        try {
            $db = db_connect();
            $sql = "SELECT * FROM users WHERE id = :userid";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
            $stmt->execute();
            $target = "";
            $target = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            db_err_msg() . $e->getMessage();
            header('location:user.php');
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
    <?php include('../inc/link_master.php');  ?>
    <title>ユーザー編集</title>
</head>

<body>
    <?php include('../inc/header_master.php');  ?>

    <main role="main" class="container" style="padding:60px 15px 0">
        <h1 class="my-5 c-title__main">ユーザー編集</h1>
        <form action="./user_edit_do.php" method="post">
            <div class="row justify-content-center">
                <div class="mb-3 col-6">
                    <label for="username" class="form-label">ユーザー名（半角英数８文字以上）</label>
                    <input type="text" name="username" id="username" class="form-control" value="<?php echo h($target["username"]); ?>">
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
                    <select name="role_id" id="role_id" class="form-control form-control-sm mb-5" aria-label="Small select example">
                        <?php foreach ($result as  $row): ?>
                            <option value="<?php echo h($row["id"]); ?>" <?php echo (int)$row["id"] === (int)$target["role_id"] ? "selected" : "" ?>>
                                <?php echo h($row["role"]); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="mb-5 text-center">
                <input type="hidden" name="id" value="<?php echo h($target["id"]); ?>">
                <!-- CSRF対策 -->
                <input type="hidden" name="csrf_token" value="<?php echo h($_SESSION['csrf_token']); ?>">
                <input type="submit" value="登録" class="btn btn-primary">
            </div>
        </form>

        <p><a href="user.php" class="mb-5 text-reset">一覧へ戻る</a></p>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>