<?php
session_start();
require_once '../inc/function.php';

// 役割がマスター出ない人は削除できないように
if (!isset($_SESSION["role_id"]) || $_SESSION["role_id"] !== 1) {
    $_SESSION["del_err"] = "削除権限がありません。役割がマスターの人に削除依頼をしてください";
    header("location:user.php");
    exit();
}

$id = (int)($_GET['id'] ?? 0);

if ($id === 0) {
    exit('IDが不正です');
}

// DB接続
try {
    $db = db_connect();
    $sql = 'SELECT * FROM news WHERE id=:id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // 結果セットを連想配列の形で取得
    $news = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit('エラー: ' . $e->getMessage());
}

?>

<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo h($news['titletag']); ?>削除｜ふくおか餃子FES</title>
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

            <h1 class="c-title__main">お知らせ - 削除確認</h1>
            <form action="./news_del_do.php" method="post">
                <input type="hidden" name="id" value="<?php echo h($news['id']); ?>">
                <div class="form-group">
                    <label>記事タイトル</label>
                    <input type="text" name="subject" class="form-control" value="<?php echo h($news['subject']); ?>" required>
                </div>
                <div class="form-group">
                    <label>ページタイトル</label>
                    <input type="text" name="titletag" class="form-control" value="<?php echo h($news['titletag']); ?>" required>
                </div>
                <div class="form-group">
                    <label>本文</label>
                    <textarea name="text" class="form-control" rows="5" required><?php echo nl2br(h($news['text'])); ?></textarea>
                </div>

                <input type="submit" class="btn btn-danger" value="削除する">
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