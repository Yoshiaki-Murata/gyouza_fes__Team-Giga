<?php
require_once __DIR__ . '/../inc/function.php';

$id = (int)($_GET['id'] ?? 0);
$categories = [];

if ($id === 0) {
    exit('IDが不正です。');
}

try {
    $db = db_connect();

    // 編集する質問を取得
    $sql = 'SELECT id, question, answer, category_id FROM questions WHERE id=:id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $question = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$question) {
        exit('質問が存在しません。');
    }

    // カテゴリーを取得
    $sql_cat = 'SELECT * FROM categories';
    $stmt_cat = $db->prepare($sql_cat);
    $stmt_cat->execute();
    $categories_data = $stmt_cat->fetchAll(PDO::FETCH_ASSOC);

    $categories = [];
    foreach ($categories_data as $category) {
        $categories[$category['id']] = $category['category'];
    }
} catch (PDOException $e) {
    error_log($e->getMessage());
    exit('システムエラーが発生しました');
}

?>

<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ修正｜ふくおか餃子FES</title>
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

            <h1 class="c-title__main">FAQ修正</h1>
            <form action="./faq_edit_do.php" method="post">
                <input type="hidden" name="id" value="<?php echo (int)$question['id']; ?>">
                <div class="form-group">
                    <label>質問</label>
                    <input type="text" name="question" class="form-control" value="<?php echo h($question['question']); ?>" required>
                </div>

                <div class="form-group">
                    <label>回答</label>
                    <textarea name="answer" class="form-control" rows="5" required><?php echo h($question['answer']); ?></textarea>
                </div>

                <div class="mb-3">
                    <label>カテゴリー</label>
                    <select name="category_id" class="form-control" required>
                        <?php foreach ($categories as $key => $faqCategory): ?>
                            <option value="<?php echo (int)$key; ?>" <?php if ((int)$question['category_id'] === (int)$key) echo 'selected'; ?>>
                                <?php echo h($faqCategory); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>



                <input type="submit" class="btn btn-primary" value="修正する">
            </form>



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