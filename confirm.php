<?php include('inc/header.php'); ?>
<?php

$user_name   = isset($_POST['name']) ? $_POST['name'] : '';
$mailaddress = isset($_POST['mailaddress']) ? $_POST['mailaddress'] : '';
$user_tel    = isset($_POST['phonenumber']) ? $_POST['phonenumber'] : '';
$message     = isset($_POST['text']) ? $_POST['text'] : '';
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
    <link rel="stylesheet" href="css/style.css">
</head>

<body id="top">
    <header class="l-header l-header-margin">
        <?php include('inc/header.php'); ?>
    </header>

    <main>
        <section class="l-wrapper">
            <h1 class="c-title__main" data-sub-title="お問い合わせ内容確認">Confirm</h1>
            <p class="c-contact__text">入力内容をご確認ください。<br>
                修正する場合は「戻る」ボタン、この内容で送信する場合は「送信」ボタンを押してください。</p>

            <form method="post" action="./thanks.php" class="l-contact__form">

                <div class="l-form__item">
                    <label>お名前</label>
                    <input type="text" name="user_name" value="<?php echo htmlspecialchars($user_name, ENT_QUOTES, 'UTF-8'); ?>" readonly class="c-form__box is-readonly">
                </div>

                <div class="l-form__item">
                    <label>メールアドレス</label>
                    <input type="email" name="mailaddress" value="<?php echo htmlspecialchars($mailaddress, ENT_QUOTES, 'UTF-8'); ?>" readonly class="c-form__box is-readonly">
                </div>

                <div class="l-form__item">
                    <label>お電話番号</label>
                    <input type="tel" name="user_tel" value="<?php echo htmlspecialchars($user_tel, ENT_QUOTES, 'UTF-8'); ?>" readonly class="c-form__box is-readonly">
                </div>

                <div class="l-form__item">
                    <label>お問い合わせ内容</label>
                    <textarea name="message" readonly class="c-form__box is-readonly" style="height: 150px;"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></textarea>
                </div>

                <div class="c-btn-group" style="display: flex; gap: 20px; justify-content: center; margin-top: 40px;">
                    <p class="c-btn--gray" style="background: #ccc; padding: 10px 40px; border-radius: 50px;">
                        <input type="button" value="戻る" onclick="history.back()">
                    </p>
                    <p class="c-btn--yellow">
                        <input type="submit" value="送信">
                    </p>
                </div>

            </form>
        </section>
    </main>

    <footer class="l-footer">
        <?php include('inc/footer.php'); ?>
    </footer>
</body>

</html>