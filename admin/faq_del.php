<?php
session_start();
require_once '../inc/function.php';

// 役割がマスター出ない人は削除できないように
if (!isset($_SESSION["role_id"]) || $_SESSION["role_id"] !== 1) {
    $_SESSION["err"] = "削除権限がありません。役割がマスターの人に削除依頼をしてください";
    header("location:faq.php");
    exit();
}

$id = (int)($_POST['id'] ?? 0);

if ($id === 0) {
    $_SESSION["err"] = 'IDが不正です';
    header('location:faq.php');
    exit();
}

try {
    $db = db_connect();
    $sql = 'SELECT id, question, answer, category_id FROM questions WHERE id=:id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $question = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$question) {
        $_SESSION["err"] = 'データが存在しません';
        header('location:faq.php');
        exit();
    }

    // カテゴリーを取得
    $sql_cat = 'SELECT id, category FROM categories';
    $stmt_cat = $db->prepare($sql_cat);
    $stmt_cat->execute();
    $categories_data = $stmt_cat->fetchAll(PDO::FETCH_ASSOC);

    $categories = [];
    foreach ($categories_data as $category) {
        $categories[$category['id']] = $category['category'];
    }
} catch (PDOException $e) {
    error_log($e->getMessage());
    $_SESSION["err"] = 'DBへの接続・送信が失敗しました。' . $e->getMessage();
    header('location:faq.php');
    exit();
}

?>

<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ削除｜ふくおか餃子FES</title>
    <?php include('../inc/link_master.php');  ?>
</head>

<body>

    <?php include('../inc/header_master.php');  ?>
    <main role="main" class="container" style="padding:60px 15px 0">
        <div>
            <!-- ここから「本文」-->

            <h1 class="c-title__main">FAQ削除</h1>
            <form action="./faq_del_do.php" method="post">
                <input type="hidden" name="id" value="<?php echo (int)$question['id']; ?>">
                <p>質問：<?php echo h($question['question']); ?></p>
                <p>回答：<?php echo nl2br(h($question['answer'])); ?></p>
                <p>カテゴリー：<?php echo h($categories[$question['category_id']] ?? ''); ?></p>

                <div class="text-center">
                    <input type="submit" class="btn btn-danger mt-5" value="削除" onclick="return confirm('本当に削除しますか？');">
                </div>
            </form>



            <!-- 本文ここまで -->
        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>