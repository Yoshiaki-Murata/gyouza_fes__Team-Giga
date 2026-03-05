<?php
session_start();
require_once __DIR__ . '/../inc/function.php';

$id = (int)($_GET['id']);
$categories = [];

if ($id === 0) {
    $_SESSION["err"] = 'IDが不正です。';
    header('location:faq.php');
    exit();
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
        $_SESSION["err"] = '質問が存在しません。';
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
    <title>FAQ修正｜ふくおか餃子FES</title>
    <?php include('../inc/link_master.php');  ?>
</head>

<body>

    <?php include('../inc/header_master.php');  ?>
    <main role="main" class="container mb-3" style="padding:60px 15px 0">
        <div>
            <!-- ここから「本文」-->

            <h1 class="c-title__main">FAQ編集</h1>
            <form action="./faq_edit_do.php" method="post">
                <input type="hidden" name="id" value="<?php echo (int)$question['id']; ?>">
                <div class="form-group">
                    <label class="mb-2">質問</label>
                    <input type="text" name="question" class="form-control mb-3" value="<?php echo h($question['question']); ?>" required>
                </div>

                <div class="form-group">
                    <label class="mb-2">回答</label>
                    <textarea name="answer" class="form-control mb-3" rows="5" required><?php echo h($question['answer']); ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="mb-2">カテゴリー</label>
                    <select name="category_id" class="form-control mb-3" required>
                        <?php foreach ($categories as $key => $faqCategory): ?>
                            <option value="<?php echo (int)$key; ?>" <?php if ((int)$question['category_id'] === (int)$key) echo 'selected'; ?>>
                                <?php echo h($faqCategory); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <input type="submit" class="btn btn-primary mb-3" value="更新する">
            </form>
            <?php if (!empty($_SESSION["err"])): ?>
                <p class="text-center bs-danger-text-emphasis">
                    <?php echo h($_SESSION["err"]);
                    unset($_SESSION["err"]);
                    ?>
                </p>
            <?php endif ?>


            <!-- 本文ここまで -->
            <p><a href="faq.php" class="mb-5 text-reset">一覧へ戻る</a></p>

        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>