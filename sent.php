<?php
// データの受け取り
$name = $_POST['name'];
$mailaddress = $_POST['mailaddress'];
$phonenumber = $_POST['tel'];
$text = $_POST['text'];


// 必須項目のチェック(名前・本文)
if ($name === '' || $body === '' || $text === "") {
    header('location: contact.php'); // 空だったら入力ページへ戻す
    exit();
}

// 電話番号のチェック
if (!preg_match('/^[0-9]{4}$/', $pass)) {
    header('location: bbs.php'); // 書式が違うとき入力ページへ戻す
    exit();
}

$dsn = 'mysql:host=localhost;dbname=YOUR_DB_NAME;charset=utf8';
$user = 'YOUR_USER_NAME';
$password = 'YOUR_PASSWORD';

try {
    $pdo = new PDO($dsn, $user, $password);
    $sql = "INSERT INTO inquiries (user_name, mailaddress, user_tel, message) 
            VALUES (:user_name, :mailaddress, :user_tel, :message)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
    $stmt->bindValue(':mailaddress', $mailaddress, PDO::PARAM_STR);
    $stmt->bindValue(':user_tel', $user_tel, PDO::PARAM_STR);
    $stmt->bindValue(':message', $message, PDO::PARAM_STR);

    $stmt->execute();

    $result = true;
} catch (PDOException $e) {
    $result = false;
    echo 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>送信完了｜ふくおか餃子FES</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body id="top">
    <?php include('inc/header.php'); ?>

    <main>
        <section class="l-wrapper">
            <h1 class="c-title__main" data-sub-title="送信完了">Thank you</h1>

            <div class="c-contact__thanks">
                <?php if ($result): ?>
                    <p class="c-contact__text">お問い合わせありがとうございました。<br>
                        内容を確認の上、担当者より折り返しご連絡いたします。</p>
                <?php else: ?>
                    <p class="c-contact__text">申し訳ございません。送信中にエラーが発生しました。<br>
                        お手数ですが、時間をおいて再度お試しください。</p>
                <?php endif; ?>

                <p class="c-btn--yellow" style="margin-top: 40px;">
                    <a href="index.php" style="display: block; text-align: center; line-height: 60px; color: #fff; text-decoration: none;">トップページへ戻る</a>
                </p>
            </div>
        </section>
    </main>

    <?php include('inc/footer.php'); ?>
</body>

</html>