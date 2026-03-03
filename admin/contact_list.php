<?php
require_once '../inc/function.php';

try {
    $dbh = db_connect();
    $sql = 'SELECT contact.name, contact.mailaddress, contact.phonenumber,contact.text,contact.date,status.status FROM contact INNER JOIN status ON contact.status=status.id;';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit('データベースに接続できませんでした。' . $e->getMessage());
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@4.0.1/destyle.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Noto+Sans+JP:wght@100..900&family=Zen+Maru+Gothic&display=swap"
        rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <link rel="stylesheet" href="../css/style.css">
</head>

<body id="top">

    <?php include('../inc/header_master.php');  ?>

    <main role="main" class="container l-header-margin">
        <section class="l-wrapper-second">
            <h1 class="c-title__main" data-sub-title="お問い合わせ一覧">CONTACT LIST</h1>

            <div class="d-grid mx-auto">
                <a href="./contact.php" class="btn btn-primary" type="button">お問い合わせ情報追加</a>
            </div>

            <div class="l-wrapper-second">
                <table class="c-contact-table">
                    <thead>
                        <tr>
                            <th>お名前</th>
                            <th>メールアドレス</th>
                            <th>電話番号</th>
                            <th>お問い合わせ内容</th>
                            <th>お問い合わせ日時</th>
                            <th>対応状況</th>
                            <th>操作</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($result as $row): ?>
                            <tr class="<?php echo $row['status'] === '対応済み' ? 'contact-responded' : ''; ?>">
                                <td><?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($row['mailaddress'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($row['phonenumber'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo nl2br(htmlspecialchars($row['text'], ENT_QUOTES, 'UTF-8')); ?></td>
                                <td><?php echo htmlspecialchars($row['date'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8'); ?></td>

                                <td><a href="contact_edit.php?id=<?php echo ($row['status']); ?>" class="btn btn-primary btn-sm">編集</a></td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>