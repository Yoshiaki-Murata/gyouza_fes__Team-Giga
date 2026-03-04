<?php
session_start();
require_once '../inc/function.php';

// 役割がマスター出ない人は削除できないように
if (!isset($_SESSION["role_id"]) || $_SESSION["role_id"] !== 1) {
    $_SESSION["err"] = "削除権限がありません。役割がマスターの人に削除依頼をしてください";
    header("location:faq.php");
    exit();
}

$id = (int)($_GET['id'] ?? 0);

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@4.0.1/destyle.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Noto+Sans+JP:wght@100..900&family=Zen+Maru+Gothic&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="../css/style.css">
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
                <input type="submit" class="btn btn-danger" value="削除する" onclick="return confirm('本当に削除しますか？');">
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>