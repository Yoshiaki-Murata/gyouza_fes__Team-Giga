<?php
require_once '../inc/function.php';

try {
    $dbh = db_connect();
    $sql = 'SELECT contact.id,contact.name, contact.mailaddress, contact.phonenumber,contact.text,contact.date,status.status FROM contact INNER JOIN status ON contact.status=status.id;';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION["err"] = 'DBへの接続・送信が失敗しました。' . $e->getMessage();
    header('location:index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">

    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ふくおか餃子フェスに関する管理者用のお問い合わせページ。">
    <title>お問い合わせ｜ふくおか餃子FES</title>

    <?php include('../inc/link_master.php');  ?>
</head>

<body id="top">

    <?php include('../inc/header_master.php');  ?>

    <main role="main" class="container-fluid px-md-5">
        <section class="py-5">
            <h1 class="text-center mb-4">
                <span class="text-danger d-block mb-0 c-title__main">CONTACT LIST</span>
                <small class="text-muted h6">お問い合わせ一覧</small>
            </h1>

            <div class="d-grid gap-2 col-md-4 mx-auto mb-5">
                <a href="./contact.php" class="btn btn-primary" type="button">お問い合わせ情報追加</a>
            </div>

            <div class="table-responsive shadow-sm bg-white rounded">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-light text-center text-nowrap">
                        <tr>
                            <th>お名前</th>
                            <th>メールアドレス</th>
                            <th>電話番号</th>
                            <th style="min-width: 250px;">内容</th>
                            <th>日時</th>
                            <th>対応状況</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $row): ?>
                            <tr>
                                <td class="text-nowrap"><?php echo h($row['name']); ?></td>
                                <td><?php echo h($row['mailaddress']); ?></td>
                                <td class="text-nowrap"><?php echo h($row['phonenumber']); ?></td>
                                <td class="small"><?php echo nl2br(h($row['text'])); ?></td>
                                <td class="text-nowrap small"><?php echo h($row['date']); ?></td>
                                <td class="text-center">
                                    <?php
                                    $statusColor = ($row['status'] === '対応済み') ? 'text-bg-secondary' : 'text-bg-warning';
                                    ?>
                                    <span class="badge rounded-pill <?php echo h($statusColor); ?>">
                                        <?php echo h($row['status']); ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <form action="contact_edit.php" method="get" class="m-0">
                                        <input type="hidden" name="id" value="<?php echo $row["id"] ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-primary text-nowrap">編集</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
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