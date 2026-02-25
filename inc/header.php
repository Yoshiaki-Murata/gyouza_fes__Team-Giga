<?php
$url = 'file:///C:/xampp/htdocs/gyouza_fes__Team-Giga/index.html';
$html = file_get_contents($url);
?>

    <div class="l-header-inner">
        <h1 class="c-logo">
            <a href="index.html"><img src="./img/logo-icon.png" alt="ふくおか餃子フェス"></a>
        </h1>
        <nav class="c-nav">
            <ul>
                <li><a href="#information">INFO</a></li>
                <li><a href="#access">ACCESS</a></li>
                <li><a href="news.html">NEWS</a></li>
                <li><a href="menu.html">MENU</a></li>
                <li><a href="faq.html">FAQ</a></li>
            </ul>
        </nav>
    </div>

    <!-- ハンバーガーメニュー ここから ↓ -->
    <div class="c-menu-wrapper">
        <input type="checkbox" id="menu-toggle" hidden>

        <label class="c-menu__icon" for="menu-toggle">
            <span></span>
            <span></span>
            <span></span>
        </label>

        <div class="overlay"></div>

        <nav class="c-menu-hamburger">
            <ul class="c-menu-hamburger-text">
                <li class="c-menu-hamburger-text-list">
                    <a href="news.html">
                        <p class="c-menu-hamburger-text-list__main">NEWS</p>
                        <p class="c-menu-hamburger-text-list__sub">お知らせ</p>
                    </a>
                </li>
                <li class="c-menu-hamburger-text-list">
                    <a href="index.html#information">
                        <p class="c-menu-hamburger-text-list__main">INFO</p>
                        <p class="c-menu-hamburger-text-list__sub">開催概要</p>
                    </a>
                </li>
                <li class="c-menu-hamburger-text-list">
                    <a href="menu.html">
                        <p class="c-menu-hamburger-text-list__main">MENU</p>
                        <p class="c-menu-hamburger-text-list__sub">メニュー</p>
                    </a>
                </li>
                <li class="c-menu-hamburger-text-list">
                    <a href="index.html#access">
                        <p class="c-menu-hamburger-text-list__main">ACCESS</p>
                        <p class="c-menu-hamburger-text-list__sub">アクセス</p>
                    </a>
                </li>
                <li class="c-menu-hamburger-text-list">
                    <a href="faq.html">
                        <p class="c-menu-hamburger-text-list__main">FAQ</p>
                        <p class="c-menu-hamburger-text-list__sub">よくある質問</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- ハンバーガーメニュークリックで消える -->
    <script>
        $(function() {
            $('.c-menu-hamburger-text-list a').on('click', function(event) {
                $('#menu-toggle').prop('checked', false);
            });
        });
    </script>
    <!-- ハンバーガーメニュー ここまで ↑ -->