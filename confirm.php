<?php
session_start();
require_once './inc/function.php';

$name = isset($_POST['name']) ? $_POST['name'] : '';
$mailaddress = isset($_POST['mailaddress']) ? $_POST['mailaddress'] : '';
$phonenumber = isset($_POST['phonenumber']) ? $_POST['phonenumber'] : '';
$text = isset($_POST['text']) ? $_POST['text'] : '';
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>内容確認｜ふくおか餃子FES</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@4.0.1/destyle.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Noto+Sans+JP:wght@100..900&family=Zen+Maru+Gothic&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style.css">
</head>

<body id="top">
    <?php include('inc/header.php'); ?>
    <main>
        <section class="l-wrapper">
            <h1 class="c-title__main" data-sub-title="お問い合わせ内容確認">Confirm</h1>
            <p class="c-contact__text">入力内容をご確認ください。<br>
                修正する場合は「修正する」ボタン、<br>この内容で送信する場合は「送信する」ボタンを押してください。</p>

            <form method="post" action="./sent.php" class="l-contact__form">

                <div class="l-form__item">
                    <label>お名前</label>
                    <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>" readonly class="c-form__box is-readonly">
                </div>

                <div class="l-form__item">
                    <label>メールアドレス</label>
                    <input type="email" name="mailaddress" id="mailaddress" value="<?php echo htmlspecialchars($mailaddress, ENT_QUOTES, 'UTF-8'); ?>" readonly class="c-form__box is-readonly">
                </div>

                <div class="l-form__item">
                    <label>お電話番号</label>
                    <input type="tel" name="phonenumber" id="phonenumber" value="<?php echo htmlspecialchars($phonenumber, ENT_QUOTES, 'UTF-8'); ?>" readonly class="c-form__box is-readonly">
                </div>

                <div class="l-form__item">
                    <label>お問い合わせ内容&nbsp;</label>
                    <textarea name="text" id="text" readonly class="c-form__box is-readonly" style="height: 150px;"><?php echo htmlspecialchars($text, ENT_QUOTES, 'UTF-8'); ?></textarea>
                </div>

                <div class="c-contact__btn-group">
                    <p class="c-btn--gray">
                        <input type="button" value="修正する" onclick="history.back()">
                    </p>
                    <p class="c-btn--yellow">
                        <input type="submit" value="送信する">
                    </p>
                </div>
                 <?php if (!empty($_SESSION["contact_err"])): ?>
                        <p class="bs-danger-text-emphasis">
                            <?php
                            echo  $_SESSION["contact_err"];
                            unset($_SESSION["contact_err"]);
                            ?>
                        </p>
                    <?php endif; ?>
                </div>

            </form>
        </section>
    </main>
    <?php include('inc/footer.php'); ?>
</body>

</html>