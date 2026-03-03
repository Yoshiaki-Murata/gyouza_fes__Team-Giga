<?php
session_start();

$errors = $_SESSION['errors'] ?? [];
$old    = $_SESSION['old'] ?? [];

// 一度表示したら消す
unset($_SESSION['errors'], $_SESSION['old']);
?>

<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お知らせ新規投稿｜ふくおか餃子FES</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Noto+Sans+JP:wght@100..900&family=Zen+Maru+Gothic&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>


    <main role="main" class="container" style="padding:60px 15px 0">
        <div>
            <!-- ここから「本文」-->

            <h1 class="c-title__main">新規お知らせ投稿</h1>
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error): ?>
                        <div><?= h($error) ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form action="./news_add_do.php" method="post">

                <div class="form-group">
                    <label>記事タイトル</label>
                    <input type="text" name="subject" class="form-control <?= isset($errors['subject']) ? 'is-invalid' : '' ?>" value="<?= h($old['subject'] ?? '') ?>" maxlength="255" placeholder="お知らせタイトル" required>
                </div>
                <div class="form-group">
                    <label>ページタイトル</label>
                    <input type="text" name="titletag" class="form-control <?= isset($errors['subject']) ? 'is-invalid' : '' ?>" value="<?= h($old['titletag'] ?? '') ?>" maxlength="255" placeholder="ページタイトル(ここのみ記入)｜ふくおか餃子FES" required>
                </div>
                <div class="form-group">
                    <label>本文</label>
                    <textarea name="text" class="form-control <?= isset($errors['subject']) ? 'is-invalid' : '' ?>" rows="5" placeholder="お知らせ本文" required><?= h($old['text'] ?? '') ?></textarea>
                </div>

                <input type="submit" class="btn btn-primary" value="投稿する">
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