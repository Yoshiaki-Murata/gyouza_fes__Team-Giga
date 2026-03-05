-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2026-03-05 07:52:44
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gyoza_giga`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(1, 'イベントに関して'),
(2, '会場に関して'),
(3, 'その他');

-- --------------------------------------------------------

--
-- テーブルの構造 `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mailaddress` varchar(255) NOT NULL,
  `phonenumber` varchar(255) DEFAULT NULL,
  `text` text NOT NULL,
  `date` datetime DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `contact`
--

INSERT INTO `contact` (`id`, `name`, `mailaddress`, `phonenumber`, `text`, `date`, `status`) VALUES
(1, 'たなかたろう', 'murata.123@gmail.com', '08012345678', '財布を落としました。１０兆円入ってます。早く探してください', '2026-03-05 12:48:39', 3),
(2, '麻生太郎', 'aso.taro@gmail.com', '08001190110', '総理大臣になりたいです。\r\nちなみに石破は好きになりました。', '2026-03-05 12:52:06', 1),
(3, '山田太郎', 'yamada_t@gmail.com', '08011112222', 'ドカベンと呼ばれます。\r\n身長195㎝、体重56㎏です。\r\nちなみにサッカーやってます。', '2026-03-05 12:48:23', 2);

-- --------------------------------------------------------

--
-- テーブルの構造 `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `product` varchar(255) NOT NULL,
  `pieces` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `product_detail` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `alt` text NOT NULL,
  `shop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `menus`
--

INSERT INTO `menus` (`id`, `product`, `pieces`, `price`, `product_detail`, `image`, `alt`, `shop_id`) VALUES
(1, '肉汁あふれる焼き餃子', 6, 580, '香ばしく焼き上げた皮の中には、あふれんばかりの肉汁がぎっしり。\r\n厳選された国産豚とキャベツの旨味が広がる、満足感たっぷりの一品です。\r\n一口噛めば、ジュワッとした肉汁が口いっぱいに広がります。', 'menu01.jpg', '肉汁あふれる焼き餃子の商品画像', 1),
(2, 'ふっくら蒸しあげ餃子', 8, 520, 'もちもちの皮で包んだ餃子を、丁寧に蒸し上げた優しい味わいの一皿。\r\n蒸気でふっくら仕上げた皮はとろけるようにやわらかく、\r\n野菜と肉の旨味がじんわり広がります。\r\n特製のポン酢だれをつけて、さっぱりとお召し上がりください。', 'menu02.jpg', 'ふっくら蒸しあげ餃子の商品画像', 2),
(3, '中華風スープ餃子', 5, 680, '鶏ガラと香味野菜をじっくり煮込んだ特製スープに、\r\nつるりとした水餃子を浮かべた人気メニュー。\r\n旨味たっぷりのスープと、もちもち食感の餃子が絶妙に絡み合います。\r\n彩り豊かな野菜とご一緒に、ほっと温まる一杯をどうぞ。', 'menu03.jpg', '中華風スープ餃子の商品画像', 3),
(4, 'カリもち！揚げ餃子', 5, 600, '外はカリッ、中はもちっと食感が楽しい、人気の揚げ餃子。\r\n特製スパイスを混ぜ込んだ肉餡は、香ばしい皮と相性抜群。\r\nおつまみとしても、おやつ感覚でも楽しめるクセになる味です。\r\n熱々のうちに、レモンを絞ってどうぞ！', 'menu04.jpg', 'カリもち！揚げ餃子の商品画像', 4),
(5, 'お口に広がる地中海の風', 5, 720, 'オリーブオイルとハーブで仕上げた、地中海スタイルの創作餃子。\r\nしっとりとした皮に包まれた具材は、チーズ・オリーブ・トマトの香りが絶妙なバランス。\r\n芳醇なオイルソースとハーブの香りが口いっぱいに広がります。\r\nワインにもぴったりな、上品な一皿。', 'menu05.jpg', 'お口に広がる地中海の風の商品画像', 5),
(6, '素材の旨味ひきたつ水餃子', 8, 550, '国産野菜と豚肉の旨味をぎゅっと閉じ込めた、つるんと食感の水餃子。\r\n素材本来の味を生かすため、化学調味料を使わず丁寧に手包み。\r\nあっさりとした特製だれで、いくつでも食べられる軽やかな味わいです。\r\n熱々のままでも、冷やしてもおいしい万能餃子。', 'menu06.jpg', '素材の旨味ひきたつ水餃子の商品画像', 6),
(7, 'しびうまラー油餃子', 6, 620, '自家製の花椒ラー油をたっぷり絡めた、刺激的な一皿。\r\nひと口食べれば、山椒のしびれと唐辛子の辛味がじわっと広がり、\r\nジューシーな肉餡の旨味が後を引きます。\r\n辛党必食！ 病みつきになる辛さでリピーター続出。', 'menu07.jpg', 'しびうまラー油餃子の商品画像', 7),
(13, 'インドカレーpiza', 1, 980, 'ネパール人が作ったインドカレーをトッピングしたピザです', 'menu07-63cd96a1f145e709.webp', '餃子じゃない？', 10);

-- --------------------------------------------------------

--
-- テーブルの構造 `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `titletag` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `news`
--

INSERT INTO `news` (`id`, `subject`, `titletag`, `date`, `text`) VALUES
(1, 'ふくおか餃子FES開催決定！', '開催決定のお知らせ｜ふくおか餃子FES', '2026-03-03', '福岡餃子FES開催が決定しました。皆様のお越しをお待ちしております。');

-- --------------------------------------------------------

--
-- テーブルの構造 `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `questions`
--

INSERT INTO `questions` (`id`, `question`, `answer`, `category_id`) VALUES
(1, '入場料はかかりますか？', '入場は無料です。どなたでもご自由にお楽しみいただけます。飲食の購入は各店舗でお支払いください。', 1),
(2, '開催時間を教えてください。', '入開催時間は各日10:00〜20:00を予定しています。最終日は終了時間が早まる場合があります。', 1),
(3, '雨天の場合も開催されますか？', '雨天決行ですが、荒天の場合は安全を考慮し中止となる場合があります。最新情報はSNSでお知らせします。', 1),
(4, '支払い方法を教えてください。', '現金のほか、主要な電子マネー・QRコード決済がご利用いただけます。', 1),
(5, '喫煙所はありますか？', '会場内は全面禁煙ですが、敷地外に指定の喫煙エリアを設けています。スタッフの案内に従ってご利用ください。', 2),
(6, '授乳室やおむつ替えスペースはありますか？', 'はい、メインゲート付近に授乳室とおむつ替え台を設置しています。小さなお子様連れでも安心してご利用いただけます。', 2),
(7, '駐車場はありますか？', '専用駐車場はございません。公共交通機関のご利用をおすすめします。', 2),
(8, 'ペットを連れて入場できますか？', '混雑が予想されるため、ペットの同伴はご遠慮ください。ただし補助犬は入場可能です。', 2),
(9, 'ゴミはどうすればよいですか？', '会場内に分別ゴミ箱を設置しています。リサイクルにご協力をお願いします。', 2),
(10, '忘れ物をした場合はどうすればよいですか？', '会場本部でお預かりしています。イベント終了後は実行委員会までお問い合わせください。', 3),
(11, 'トイレはどこにありますか？', '会場内に複数の仮設トイレを設置しています。マップの「トイレ」アイコンをご確認ください。', 3),
(12, 'SNSで写真を投稿しても良いですか？', 'はい、大歓迎です！公式ハッシュタグ「#ふくおか餃子FES」をつけて投稿してください。', 3),
(13, '開催中止の場合はどうなりますか？', '安全を最優先に判断し、中止の場合は公式サイトとSNSでお知らせします。', 3),
(14, '問い合わせ先を教えてください。', '「お問い合わせ」ページのフォームまたは事務局メール宛にご連絡ください。', 3),
(15, '会場にインド人がカレーを売ってます。これって大丈夫ですか？', 'はい、大丈夫です！！\r\nカレーも餃子の一種です。', 2),
(17, 'ああああああああああああ', 'ああああああああああ', 2);

-- --------------------------------------------------------

--
-- テーブルの構造 `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'マスター'),
(2, '管理者');

-- --------------------------------------------------------

--
-- テーブルの構造 `shops`
--

CREATE TABLE `shops` (
  `id` int(11) NOT NULL,
  `shop` varchar(255) NOT NULL,
  `shop_detail` text NOT NULL,
  `boos_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `shops`
--

INSERT INTO `shops` (`id`, `shop`, `shop_detail`, `boos_number`) VALUES
(1, '博多ぎょうざ堂', '福岡を代表する老舗餃子専門店。国産豚とキャベツを使用し、ひとつひとつ手包みで仕上げています。外はカリッと、中は肉汁たっぷりの博多スタイルが人気。', 'B-01'),
(2, '中華食堂 蒸々屋（むしむしや）', '優しい味わいの蒸し料理を得意とする中華食堂。ふっくら蒸し上げた餃子や点心が好評で、家族連れにも人気。手作りの皮が自慢です。', 'B-02'),
(3, '餃子茶寮 彩香（さいか）', '和のテイストを取り入れた創作中華が魅力の茶寮。旨味たっぷりのスープ餃子をはじめ、彩り豊かなメニューを提供しています。', 'B-03'),
(4, '餃子バル 風雷坊（ふうらいぼう）', 'スタイリッシュな餃子バルとして若者に人気。ビールやワインとの相性を考えたスパイシーな揚げ餃子が名物。夜の一杯にぴったり。', 'B-04'),
(5, 'Mediterraneo Gyoza（メディテラネオ ギョウザ）', '地中海の食文化を融合した創作餃子専門店。オリーブやハーブを使った新感覚の餃子で女性客に人気。見た目も華やか。', 'B-05'),
(6, '餃子処 湯心（ゆごころ）', '素材の味を大切にした、体にやさしい餃子を提供。化学調味料不使用の水餃子が看板商品。シンプルながら深い味わいです。', 'B-06'),
(7, '辛味房 赤龍（しんみぼう せきりゅう）', '本格四川の技を受け継ぐ辛味料理専門店。花椒を効かせた「しびうまラー油餃子」が人気で、辛党ファンが多数来店。', 'B-07'),
(10, '餃子の王将　平壌店', '餃子の王将をパロッタお店です。あの人も気になっているらしい・・・', 'B-08');

-- --------------------------------------------------------

--
-- テーブルの構造 `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
(1, '未対応'),
(2, '対応中'),
(3, '対応済');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role_id`) VALUES
(1, 'aluckyyo', '$2y$10$bEAMkvEGaw0UkoZBsa6Dwubcl2U1prDh5sxVAL8ODK.Sv/bPcTgbW', 1),
(6, 'tanaka1234', '$2y$10$vkpGtHtIgc9OR5CRiwuN3uo8rD2Bs4bXQ07Up22pSfCYMPR70tvDK', 1);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- テーブルのインデックス `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_id` (`shop_id`);

--
-- テーブルのインデックス `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- テーブルのインデックス `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- テーブルの AUTO_INCREMENT `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- テーブルの AUTO_INCREMENT `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルの AUTO_INCREMENT `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- テーブルの AUTO_INCREMENT `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`status`) REFERENCES `status` (`id`);

--
-- テーブルの制約 `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`);

--
-- テーブルの制約 `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- テーブルの制約 `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
