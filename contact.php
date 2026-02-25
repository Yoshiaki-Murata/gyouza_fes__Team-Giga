<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="description" content="ふくおか餃子フェスに関する問い合わせページ。">
    <title>お問い合わせ｜ふくおか餃子FES</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@4.0.1/destyle.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Noto+Sans+JP:wght@100..900&family=Zen+Maru+Gothic&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body id="top">
    <header class="l-header l-header-margin">

        <?php include('inc/header.php');  ?>



    </header>
    <main>
        <section class="l-wrapper">
            <h1 class="c-title__main" data-sub-title="お問い合わせ">Contact</h1>
            <p class="c-contact__text">ふくおか餃子FESへは下記フォームから問い合わせ可能です。<br>
                お問い合わせ内容によっては、回答にお時間をいただく場合や、回答できかねる場合がございますので、ご了承ください。 </p>
            <form action="#" class="l-contact__form">
                <div class="l-form__item">
                    <label for="user_name">
                        お名前<span>（必須）</span>
                    </label>
                    <input type="text" name="user_name" id="user_name" required class="c-form__box">
                </div>
                <div class="l-form__item">
                    <label for="user_mail">
                        メールアドレス<span>（必須）</span>
                    </label>
                    <input type="email" name="user_mail" id="user_mail" required class="c-form__box">
                </div>
                <div class="l-form__item">
                    <label for="user_tel">お電話番号</label>
                    <input type="tel" name="user_tel" id="user_tel" class="c-form__box">
                </div>
                <div class="l-form__item">
                    <label for="message">
                        お問い合わせ内容<span>（必須）</span>
                    </label>
                    <textarea name="message" required id="message" class="c-form__box"></textarea>
                </div>
                <p class="c-contact__text"><a href="privacy.html">「個人情報保護方針」</a>をご確認・ご同意の上、「送信」ボタンを押してください。</p>
                <p class="c-btn--yellow"><input type="submit" value="送信"></p>
            </form>
        </section>
    </main>
    <footer class="l-footer">
        <?php include('inc/footer.php');  ?>
    </footer>
    <a href="#top" class="c-btn__top"><img src="./img/back-top.png" alt="topへ戻る"></a>


</body>

</html>