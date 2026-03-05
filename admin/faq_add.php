<?php
session_start();
require_once __DIR__ . '/../inc/function.php';
login_session();

$categories = array();

try {
    $db = db_connect();
    $sql = 'SELECT id, category FROM categories ORDER BY id';
    $stmt = $db->prepare($sql);
    $stmt->execute();

    $categories_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>FAQ新規投稿｜ふくおか餃子FES</title>
    <?php include('../inc/link_master.php');  ?>
</head>

<body>

    <?php include('../inc/header_master.php');  ?>
    <main role="main" class="container" style="padding:60px 15px 0">
        <div>
            <!-- ここから「本文」-->

            <h1 class="c-title__main">FAQ新規投稿</h1>

            <?php if (!empty($_SESSION["msg"])): ?>
                <p class="alert alert-success text-center" role="alert">
                    <?php echo h($_SESSION["msg"]);
                    unset($_SESSION["msg"]);
                    ?>
                </p>
            <?php endif ?>
            <?php if (!empty($_SESSION["err"])): ?>
                <p class="alert alert-danger text-center" role="alert">
                    <?php echo h($_SESSION["err"]);
                    unset($_SESSION["err"]);
                    ?>
                </p>
            <?php endif ?>

            <form action="./faq_add_do.php" method="post" class="mb-5">

                <div class="form-group">
                    <label class="mb-2">質問</label>
                    <input type="text"
                        name="question" class="mb-3 form-control"
                        placeholder="質問"
                        required>
                </div>

                <div class="form-group">
                    <label class="mb-2">回答</label>
                    <textarea name="answer"
                        class="form-control mb-3"
                        rows="5"
                        placeholder="回答"
                        required></textarea>
                </div>

                <div class="mb-3">
                    <label class="mb-2">カテゴリー</label>
                    <select name="category_id" class="form-control" required>
                        <?php foreach ($categories as $key => $faqCategory): ?>
                            <option value="<?php echo (int)$key; ?>">
                                <?php echo h($faqCategory); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <input type="submit" class="btn btn-primary" value="投稿する">
            </form>
            <!-- 本文ここまで -->
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>