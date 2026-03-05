<?php
session_start();
require_once '../inc/function.php';
login_session();

// 役割がマスター出ない人は削除できないように
if (!isset($_SESSION["role_id"]) || $_SESSION["role_id"] !== 1) {
    err_msg("削除権限がありません。役割がマスターの人に削除依頼をしてください");
    header("location:news.php");
    exit();
}

$id = (int)($_POST['id'] ?? 0);

if ($id === 0) {
    err_msg('IDが不正です');
    header("location:news.php");
    exit();
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

    // 存在しないIDをはじく
    if (!$news) {
        err_msg('データが存在しません');
        header("location:news.php");
        exit();
    }
} catch (PDOException $e) {
    db_err_msg() . $e->getMessage();
    header('location:news.php');
    exit();
}

?>

<!doctype html>
<html lang="ja">
<?php include('../inc/header_master.php'); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo h($news['titletag']); ?>削除｜ふくおか餃子FES</title>
    <?php include('../inc/link_master.php');  ?>
</head>

<body>


    <main role="main" class="container" style="padding:60px 15px 0">
        <div>
            <!-- ここから「本文」-->

            <h1 class="c-title__main my-5">お知らせ - 削除確認</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th class="w-25">記事タイトル</th>
                        <th class="w-25">ページタイトル</th>
                        <th class="w-50">本文</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php echo h($news['subject']); ?>
                        </td>
                        <td>
                            <?php echo h($news['titletag']); ?>
                        </td>
                        <td>
                            <?php echo h($news['text']); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-5 mb-5">
                <p class="text-center">このお知らせを削除しますか？</p>
            </div>
            <form action="./news_del_do.php" method="post">
                <div class="text-center mb-3">
                    <input type="hidden" name="id" value="<?php echo h($news["id"]); ?>">
                    <input type="submit" value="削除" class="btn btn-danger m-3" onclick="return confirm('本当に削除しますか？');">
                    <a href="news.php" class="btn btn-secondary">戻る</a>
                </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>