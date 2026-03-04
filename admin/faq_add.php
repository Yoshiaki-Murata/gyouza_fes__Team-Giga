<?php
require_once __DIR__ . '/../inc/function.php';

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

            <h1 class="c-title__main">FAQ新規投稿</h1>
            <form action="./faq_add_do.php" method="post">

                <div class="form-group">
                    <label>質問</label>
                    <input type="text"
                        name="question" class="form-control"
                        placeholder="質問"
                        required>
                </div>

                <div class="form-group">
                    <label>回答</label>
                    <textarea name="answer"
                        class="form-control"
                        rows="5"
                        placeholder="回答"
                        required></textarea>
                </div>

                <div class="mb-3">
                    <label>カテゴリー</label>
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
            <!-- 本文ここまで -->
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>