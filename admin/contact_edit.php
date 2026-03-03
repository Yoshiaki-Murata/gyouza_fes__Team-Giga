<?php
session_start();
require_once '../inc/function.php';

$target = []; // 初期化


if (!empty($_POST["id"])) {
    $id = (int)$_POST["id"];
    try {
        $db = db_connect();    
        $sql = "SELECT * FROM contact WHERE id=:id ";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $target = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        exit("エラー" . $e->getMessage());
    }
}

try {
    $db = db_connect();
    $sql2 = "SELECT * FROM status";
    $stmt2 = $db->prepare($sql2);
    $stmt2->execute();
    $result = $stmt2->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit("エラー" . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Noto+Sans+JP:wght@100..900&family=Zen+Maru+Gothic&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>商品編集・登録</title>
</head>

<body>
    <?php include('../inc/header_master.php');  ?>

    <main role="main" class="container" style="padding:60px 15px 0">
        <h1 class="my-5 text-center">お問い合わせ内容・編集</h1>
        <form action="./contact_edit_do.php" method="post" enctype="multipart/form-data">
            <div class="row justify-content-center">
                <div class="mb-3 col-6">
                    <label for="name" class="form-label">氏名</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($target["name"] ?? ''); ?>">
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="mb-5 col-6">
                    <label for="mailaddress" class="form-label">メールアドレス</label>
                    <input type="email" name="mailaddress" id="mailaddress" class="form-control" value="<?php echo htmlspecialchars($target["mailaddress"] ?? ''); ?>">
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="mb-5 col-6">
                    <label for="phonenumber" class="form-label">電話番号</label>
                    <input type="text" name="phonenumber" id="phonenumber" class="form-control" value="<?php echo htmlspecialchars($target["phonenumber"] ?? ''); ?>">
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="mb-5 col-6">
                    <label for="text" class="form-label">お問い合わせ内容</label>
                    <textarea name="text" id="text" class="form-control"><?php echo htmlspecialchars($target["text"] ?? ''); ?></textarea>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="mb-5 col-6">
                    <label for="text" class="form-label">送信日時</label>
                    <input type="time" name="date" id="date" class="form-control" value="<?php echo htmlspecialchars($target["date"] ?? ''); ?>" readonly tabindex="-1"></input>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="mb-5 col-6">
                    <label for="shop_id" class="form-label">対応ステータス</label>
                    <select name="status_id" id="status_id" class="form-select">
                        <?php foreach ($result as $row): ?>
                            <option value="<?php echo $row["id"]; ?>" <?php echo (isset($target["status"]) && $row["id"] == $target["status"]) ? "selected" : ""; ?>>
                                <?php echo htmlspecialchars($row["status"]); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="mb-5 text-center">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($target["id"] ?? ''); ?>">
                <input type="submit" value="編集" class="btn btn-primary">
            </div>
        </form>
        <?php if (!empty($_SESSION["contact_edit_err"])): ?>
            <p class="text-center bs-danger-text-emphasis"><?php echo htmlspecialchars($_SESSION["contact_edit_err"], ENT_QUOTES, "UTF-8");
                                                            unset($_SESSION["contact_edit_err"]);
                                                            ?>
            </p>
        <?php endif ?>
    </main>
</body>

</html>