<?php
session_start();
require_once __DIR__ . '/../inc/function.php';
login_session();

?>


<!doctype html>
<html lang="ja">
<?php include('../inc/header_master.php'); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お知らせ新規投稿｜ふくおか餃子FES</title>
    <?php include('../inc/link_master.php');  ?>
</head>

<body>


    <main role="main" class="container" style="padding:60px 15px 0">
        <div>
            <!-- ここから「本文」-->

            <h1 class="c-title__main my-5">新規お知らせ投稿</h1>

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



            <form action="./news_add_do.php" method="post">

                <div class="form-group">
                    <label>記事タイトル</label>
                    <input type="text" name="subject" class="form-control" maxlength="255" placeholder="お知らせタイトル" required>
                </div>
                <div class="form-group">
                    <label>ページタイトル</label>
                    <input type="text" name="titletag" class="form-control" maxlength="255" placeholder="ページタイトル(ここのみ記入)｜ふくおか餃子FES" required>
                </div>
                <div class="form-group">
                    <label>本文</label>
                    <textarea name="text" class="form-control" rows="5" placeholder="お知らせ本文" required></textarea>
                </div>

                <input type="submit" class="btn btn-primary" value="投稿する">
            </form>
            

            <!-- 本文ここまで -->
        </div>
        <p><a href="news.php" class="mb-5 text-reset">一覧へ戻る</a></p>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>