-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2026-03-02 06:53:21
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
CREATE DATABASE IF NOT EXISTS `gyoza_giga` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `gyoza_giga`;

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
(1, '村田　よしあき', 'murata.123@gmail.com', '080-1234-5678', '財布を落としました。１０兆円入ってます。早く探してください', '2026-02-25 15:56:40', 1);

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
(7, 'しびうまラー油餃子', 6, 620, '自家製の花椒ラー油をたっぷり絡めた、刺激的な一皿。\r\nひと口食べれば、山椒のしびれと唐辛子の辛味がじわっと広がり、\r\nジューシーな肉餡の旨味が後を引きます。\r\n辛党必食！ 病みつきになる辛さでリピーター続出。', 'menu07.jpg', 'しびうまラー油餃子の商品画像', 7);

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
(1, 'ふくおか餃子FES開催決定！', '開催決定のお知らせ｜ふくおか餃子FES', '2030-02-16', '福岡餃子FES開催が決定しました。皆様のお越しをお待ちしております。');

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
(14, '問い合わせ先を教えてください。', '「お問い合わせ」ページのフォームまたは事務局メール宛にご連絡ください。', 3);

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
(7, '辛味房 赤龍（しんみぼう せきりゅう）', '本格四川の技を受け継ぐ辛味料理専門店。花椒を効かせた「しびうまラー油餃子」が人気で、辛党ファンが多数来店。', 'B-07');

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
(3, 'tanaka123', '$2y$10$U3jbyoBQ69ZhXZaWJBhZlOKhrpTaSS5Qgjh3SDd1Xv94qXLgmSaTO', 2);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- テーブルの AUTO_INCREMENT `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- テーブルの AUTO_INCREMENT `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルの AUTO_INCREMENT `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- テーブルの AUTO_INCREMENT `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
--
-- データベース: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- テーブルの構造 `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- テーブルの構造 `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- テーブルの構造 `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- テーブルの構造 `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- テーブルの構造 `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

--
-- テーブルのデータのダンプ `pma__export_templates`
--

INSERT INTO `pma__export_templates` (`id`, `username`, `export_type`, `template_name`, `template_data`) VALUES
(1, 'root', 'database', 'gyouza_giga', '{\"quick_or_custom\":\"quick\",\"what\":\"sql\",\"structure_or_data_forced\":\"0\",\"table_select[]\":[\"categories\",\"contact\",\"menus\",\"news\",\"questions\",\"roles\",\"shops\",\"status\",\"users\"],\"table_structure[]\":[\"categories\",\"contact\",\"menus\",\"news\",\"questions\",\"roles\",\"shops\",\"status\",\"users\"],\"table_data[]\":[\"categories\",\"contact\",\"menus\",\"news\",\"questions\",\"roles\",\"shops\",\"status\",\"users\"],\"aliases_new\":\"\",\"output_format\":\"sendit\",\"filename_template\":\"@DATABASE@\",\"remember_template\":\"on\",\"charset\":\"utf-8\",\"compression\":\"none\",\"maxsize\":\"\",\"codegen_structure_or_data\":\"data\",\"codegen_format\":\"0\",\"csv_separator\":\",\",\"csv_enclosed\":\"\\\"\",\"csv_escaped\":\"\\\"\",\"csv_terminated\":\"AUTO\",\"csv_null\":\"NULL\",\"csv_columns\":\"something\",\"csv_structure_or_data\":\"data\",\"excel_null\":\"NULL\",\"excel_columns\":\"something\",\"excel_edition\":\"win\",\"excel_structure_or_data\":\"data\",\"json_structure_or_data\":\"data\",\"json_unicode\":\"something\",\"latex_caption\":\"something\",\"latex_structure_or_data\":\"structure_and_data\",\"latex_structure_caption\":\"テーブル @TABLE@ の構造\",\"latex_structure_continued_caption\":\"テーブル @TABLE@ の構造 (続き)\",\"latex_structure_label\":\"tab:@TABLE@-structure\",\"latex_relation\":\"something\",\"latex_comments\":\"something\",\"latex_mime\":\"something\",\"latex_columns\":\"something\",\"latex_data_caption\":\"テーブル @TABLE@ の内容\",\"latex_data_continued_caption\":\"テーブル @TABLE@ の内容 (続き)\",\"latex_data_label\":\"tab:@TABLE@-data\",\"latex_null\":\"\\\\textit{NULL}\",\"mediawiki_structure_or_data\":\"structure_and_data\",\"mediawiki_caption\":\"something\",\"mediawiki_headers\":\"something\",\"htmlword_structure_or_data\":\"structure_and_data\",\"htmlword_null\":\"NULL\",\"ods_null\":\"NULL\",\"ods_structure_or_data\":\"data\",\"odt_structure_or_data\":\"structure_and_data\",\"odt_relation\":\"something\",\"odt_comments\":\"something\",\"odt_mime\":\"something\",\"odt_columns\":\"something\",\"odt_null\":\"NULL\",\"pdf_report_title\":\"\",\"pdf_structure_or_data\":\"structure_and_data\",\"phparray_structure_or_data\":\"data\",\"sql_include_comments\":\"something\",\"sql_header_comment\":\"\",\"sql_use_transaction\":\"something\",\"sql_compatibility\":\"NONE\",\"sql_structure_or_data\":\"structure_and_data\",\"sql_create_table\":\"something\",\"sql_auto_increment\":\"something\",\"sql_create_view\":\"something\",\"sql_procedure_function\":\"something\",\"sql_create_trigger\":\"something\",\"sql_backquotes\":\"something\",\"sql_type\":\"INSERT\",\"sql_insert_syntax\":\"both\",\"sql_max_query_size\":\"50000\",\"sql_hex_for_binary\":\"something\",\"sql_utc_time\":\"something\",\"texytext_structure_or_data\":\"structure_and_data\",\"texytext_null\":\"NULL\",\"xml_structure_or_data\":\"data\",\"xml_export_events\":\"something\",\"xml_export_functions\":\"something\",\"xml_export_procedures\":\"something\",\"xml_export_tables\":\"something\",\"xml_export_triggers\":\"something\",\"xml_export_views\":\"something\",\"xml_export_contents\":\"something\",\"yaml_structure_or_data\":\"data\",\"knjenc\":\"\",\"\":null,\"lock_tables\":null,\"as_separate_files\":null,\"csv_removeCRLF\":null,\"excel_removeCRLF\":null,\"json_pretty_print\":null,\"htmlword_columns\":null,\"ods_columns\":null,\"sql_dates\":null,\"sql_relation\":null,\"sql_mime\":null,\"sql_disable_fk\":null,\"sql_views_as_tables\":null,\"sql_metadata\":null,\"sql_create_database\":null,\"sql_drop_table\":null,\"sql_if_not_exists\":null,\"sql_simple_view_export\":null,\"sql_view_current_user\":null,\"sql_or_replace_view\":null,\"sql_truncate\":null,\"sql_delayed\":null,\"sql_ignore\":null,\"texytext_columns\":null,\"xkana\":null}');

-- --------------------------------------------------------

--
-- テーブルの構造 `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- テーブルの構造 `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- テーブルの構造 `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- テーブルの構造 `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- テーブルの構造 `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- テーブルのデータのダンプ `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"gyoza_giga\",\"table\":\"categories\"},{\"db\":\"gyoza_giga\",\"table\":\"users\"},{\"db\":\"gyoza_giga\",\"table\":\"status\"},{\"db\":\"gyoza_giga\",\"table\":\"shops\"},{\"db\":\"gyoza_giga\",\"table\":\"roles\"},{\"db\":\"gyoza_giga\",\"table\":\"questions\"},{\"db\":\"gyoza_giga\",\"table\":\"news\"},{\"db\":\"gyoza_giga\",\"table\":\"menus\"},{\"db\":\"gyoza_giga\",\"table\":\"contact\"},{\"db\":\"quiz_app\",\"table\":\"questions\"}]');

-- --------------------------------------------------------

--
-- テーブルの構造 `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- テーブルの構造 `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- テーブルの構造 `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- テーブルの構造 `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

--
-- テーブルのデータのダンプ `pma__table_info`
--

INSERT INTO `pma__table_info` (`db_name`, `table_name`, `display_field`) VALUES
('gyoza_giga', 'contact', 'name'),
('gyoza_giga', 'menus', 'product'),
('gyoza_giga', 'questions', 'question'),
('gyoza_giga', 'users', 'username'),
('tennis_plus', 'users', 'name');

-- --------------------------------------------------------

--
-- テーブルの構造 `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- テーブルのデータのダンプ `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'gyoza_giga', 'questions', '{\"sorted_col\":\"`questions`.`category_id` ASC\"}', '2026-02-25 06:16:19'),
('root', 'tennis_plus', 'info', '{\"sorted_col\":\"`info`.`id` DESC\"}', '2026-02-17 02:18:14');

-- --------------------------------------------------------

--
-- テーブルの構造 `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- テーブルの構造 `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- テーブルのデータのダンプ `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2026-02-25 07:09:38', '{\"Console\\/Mode\":\"collapse\",\"lang\":\"ja\",\"NavigationWidth\":752}');

-- --------------------------------------------------------

--
-- テーブルの構造 `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- テーブルの構造 `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- テーブルのインデックス `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- テーブルのインデックス `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- テーブルのインデックス `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- テーブルのインデックス `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- テーブルのインデックス `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- テーブルのインデックス `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- テーブルのインデックス `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- テーブルのインデックス `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- テーブルのインデックス `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- テーブルのインデックス `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- テーブルのインデックス `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- テーブルのインデックス `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- テーブルのインデックス `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- テーブルのインデックス `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- テーブルのインデックス `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- テーブルのインデックス `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- テーブルのインデックス `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- データベース: `quiz_app`
--
CREATE DATABASE IF NOT EXISTS `quiz_app` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `quiz_app`;

-- --------------------------------------------------------

--
-- テーブルの構造 `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$DKJLYZ6kuOkq7ooTyENx.OffoKvKAFnrDKlFXE4R3oK39qn4m1WcG', '2026-02-19 16:08:01');

-- --------------------------------------------------------

--
-- テーブルの構造 `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `choice1` varchar(255) NOT NULL,
  `choice2` varchar(255) NOT NULL,
  `choice3` varchar(255) NOT NULL,
  `choice4` varchar(255) NOT NULL,
  `correct_choice` int(11) NOT NULL COMMENT '1~4の正解番号',
  `explanation` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `questions`
--

INSERT INTO `questions` (`id`, `question_text`, `choice1`, `choice2`, `choice3`, `choice4`, `correct_choice`, `explanation`, `created_at`) VALUES
(1, 'PHPにおいて、変数の前に付ける記号は？', '@', '$', '#', '&', 2, 'PHPの変数はドル記号($)で始まります。', '2026-02-19 16:08:01'),
(2, 'データベースとの接続によく使われるPHPの拡張モジュールは？', 'PDO', 'DB Connect', 'MySQL_Link', 'SQL_Standard', 1, 'PDO (PHP Data Objects) は、様々なデータベースに統一的なインターフェースでアクセスするための拡張モジュールです。', '2026-02-19 16:08:01'),
(3, 'HTTPメソッドのうち、主に「データの作成」に使われるのは？', 'GET', 'DELETE', 'POST', 'HEAD', 3, 'POSTメソッドは、サーバーにデータを送信してリソースを作成または更新する場合に使用されます。', '2026-02-19 16:08:01'),
(4, '配列の要素数を取得するPHP関数は？', 'length()', 'size()', 'count()', 'num()', 3, 'count() 関数は、配列またはCountableオブジェクトに含まれる要素の数を返します。', '2026-02-19 16:08:01'),
(5, 'XSS（クロスサイトスクリプティング）を防ぐために使用すべき関数は？', 'htmlspecialchars()', 'strip_tags()', 'urlencode()', 'base64_encode()', 1, 'htmlspecialchars() は、特殊文字をHTMLエンティティに変換し、スクリプトの実行を防ぐために重要です。', '2026-02-19 16:08:01');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- テーブルのインデックス `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- データベース: `security_lesson_db`
--
CREATE DATABASE IF NOT EXISTS `security_lesson_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `security_lesson_db`;

-- --------------------------------------------------------

--
-- テーブルの構造 `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `posts`
--

INSERT INTO `posts` (`id`, `username`, `content`, `created_at`) VALUES
(1, 'admin', 'ようこそ！ここは安全な掲示板ではありません。', '2026-02-19 01:24:52'),
(2, 'user1', 'こんにちは。', '2026-02-19 01:24:52');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', 'admin123', '2026-02-19 01:24:51'),
(2, 'user1', 'password123', '2026-02-19 01:24:52'),
(3, 'victim', 'victim123', '2026-02-19 01:24:52');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- データベース: `tennis`
--
CREATE DATABASE IF NOT EXISTS `tennis` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tennis`;

-- --------------------------------------------------------

--
-- テーブルの構造 `bbs`
--

CREATE TABLE `bbs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `pass` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `bbs`
--

INSERT INTO `bbs` (`id`, `name`, `title`, `body`, `date`, `pass`) VALUES
(2, '山田', '2回目の投稿', 'INSERTの練習です', '2026-02-13 12:26:32', '5678'),
(6, 'たなか', 'IDは何番？', '気になる', '2026-02-13 12:57:03', '1234'),
(9, '佐藤', '今週の練習日程', '今週の土曜日は13時から市民コートのA面とB面を確保しています。参加できる方はスタンプお願いします！', '2026-01-15 09:30:00', '1234'),
(10, '田中', '【急募】ラケット譲ります', '買い替えのため、以前使っていたBabolatのラケットを格安で譲ります。興味ある方は練習の時に声かけてください。', '2026-01-16 18:45:00', '1234'),
(11, '鈴木', '昨日の試合結果', '昨日の市民大会、ダブルスでベスト4に入りました！応援ありがとうございました！次は優勝目指します。', '2026-01-17 20:10:00', '1234'),
(12, '高橋', '合宿の場所について', '春合宿の場所ですが、軽井沢か山中湖で迷っています。アンケートを取りたいのでグループLINEを確認してください。', '2026-01-18 12:05:00', '1234'),
(13, '管理者', 'サイトリニューアルのお知らせ', 'サークルのホームページを少しリニューアルしました。掲示板も見やすくなったと思います。', '2026-01-19 10:00:00', '1234'),
(14, '伊藤', '雨天中止の連絡', '本日の練習ですが、雨のため中止とします。次回は来週の日曜日です。よろしくお願いします。', '2026-01-20 08:00:00', '1234'),
(15, '渡辺', '新しいガット', '最近ポリのガットに変えたんですが、手首への負担が少し気になります。おすすめのナイロンガットありますか？', '2026-01-21 21:30:00', '1234'),
(16, '山本', '飲み会のお知らせ', '来月の練習後に新年会をやりたいと思います！場所は駅前の居酒屋を予定しています。出欠は調整さんに入力お願いします。', '2026-01-22 19:00:00', '1234'),
(17, '中村', '迷子のお知らせ', '先週の練習で青いタオルを忘れてしまいました。見かけた方いらっしゃいますか？', '2026-01-23 07:45:00', '1234'),
(18, '小林', 'Re: 迷子のお知らせ', 'あ、部室のロッカーの上に置いておきましたよ！', '2026-01-23 12:20:00', '1234'),
(19, '加藤', '対抗戦メンバー募集', '隣のサークルから練習試合の申し込みがありました。ダブルス3ペア募集します。出たいペアは連絡ください！', '2026-01-24 15:00:00', '1234'),
(20, '吉田', 'サーブのコツ', '最近セカンドサーブが安定しません。スピンサーブを安定させるコツがあれば教えてください。', '2026-01-25 22:15:00', '1234'),
(21, '山田', 'Re: サーブのコツ', 'トスを少し後ろに上げると背中を反りすぎてしまうので、頭の真上くらいを意識するといいかもです。今度見てみますね！', '2026-01-26 09:10:00', '1234'),
(22, '佐々木', 'ボール当番', '来月のボール当番表を更新しました。トップページから確認しておいてください。', '2026-01-27 11:50:00', '1234'),
(23, '山口', '新しいメンバー紹介', '先週見学に来ていた松本さんが正式に入会することになりました！皆さんよろしくお願いします。', '2026-01-28 14:30:00', '1234'),
(24, '松本', 'よろしくお願いします！', '新しく入りました松本です。テニス歴は3年ですがブランクがあります。楽しく打ちたいです！', '2026-01-28 18:00:00', '1234'),
(25, '井上', '週末の天気', '週末の予報が雨マークに変わってますね…。なんとか晴れてほしい！', '2026-01-29 08:30:00', '1234'),
(26, '木村', 'グリップテープ', 'グリップテープのまとめ買いをしようと思うんですが、一緒に買いたい人いますか？少し安くなります。', '2026-01-30 13:40:00', '1234'),
(27, '林', 'ミックスダブルス大会', '来月開催される区民大会のミックスダブルス、まだエントリー間に合うみたいです。誰か出ませんか？', '2026-01-31 20:00:00', '1234'),
(28, '清水', '部費の集金について', '半期分の部費の集金期間です。来週末までに会計係までお願いします。', '2026-02-01 10:15:00', '1234'),
(29, '山崎', 'シューズの買い替え', 'オムニコート用のシューズでおすすめのメーカーありますか？アシックスかヨネックスで迷ってます。', '2026-02-02 23:05:00', '1234'),
(30, '森', 'Re: シューズの買い替え', '幅広ならヨネックスが楽ですよ。フィット感重視ならアシックスのゲルレゾリューションが良い感じです。', '2026-02-03 07:50:00', '1234'),
(31, '阿部', '忘れ物', '更衣室に白いキャップ忘れてませんか？', '2026-02-04 16:20:00', '1234'),
(32, '池田', 'テニスキャンプ', '夏休みのテニスキャンプの幹事をやることになりました。行きたい場所のリクエストあれば教えてください！', '2026-02-05 19:45:00', '1234'),
(33, '橋本', '自主練', '明日の午前中、壁打ちに行こうと思ってます。もし暇な人いたら軽くラリーしませんか？', '2026-02-06 21:10:00', '1234'),
(34, '山下', '動画アップしました', '先週の練習試合の動画を共有フォルダにアップしました。パスワードはいつものやつです。', '2026-02-07 11:00:00', '1234'),
(35, '石川', 'ガット張り機', '個人的にガット張り機を買いました！お店より安く張るので、張り替えたい人は言ってください笑', '2026-02-08 14:00:00', '1234'),
(36, '中島', '花見の日程', '少し気が早いですが、お花見テニスを開催したいと思います。3月最終週あたりいかがでしょうか？', '2026-02-09 17:30:00', '1234'),
(37, '小川', 'グリップの巻き方', 'YouTubeで新しいグリップの巻き方を見つけました。これ試したらマメができなくなりました！URL貼っておきます。', '2026-02-10 12:45:00', '1234'),
(38, '岡田', 'サークルTシャツ', 'そろそろ新しいサークルTシャツ作りませんか？デザイン案募集します！', '2026-02-11 09:15:00', '1234'),
(39, '野生爆弾　クッキー', 'クッキーのテスト', 'クッキーが保存されているか確認します', '2026-02-16 11:56:36', '1234');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `password`) VALUES
(1, 'yamada', 'ae70abc5a365b918447bc7548963fbd5802ac8b78544126a5107fb87ba96e81b'),
(2, 'tanaka', '5faeffd0e4ed67b317be7def06689af7d3a3cb759539dbbb1c9fb4b8699170dc'),
(3, 'kikuchi', '65fbd8c8fe689b50d6e2cb270e26abd01daa449c9f9bb1ba8d072da9befafaaf');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `bbs`
--
ALTER TABLE `bbs`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `bbs`
--
ALTER TABLE `bbs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- データベース: `tennis_plus`
--
CREATE DATABASE IF NOT EXISTS `tennis_plus` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tennis_plus`;

-- --------------------------------------------------------

--
-- テーブルの構造 `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `info`
--

INSERT INTO `info` (`id`, `author`, `title`, `body`, `date`) VALUES
(4, 'たなか', '転職しました', 'DBを使いこなして魔法使いになれました。プログラマーは諦めます。', '2026-02-17'),
(5, 'たなか', '気づきました', 'どうやら魔法使いと思ってたのは自分だけでした。ＤＢ使ってもファイヤ使えませんでした。ただ人生はＦＩＲＥしました', '2026-04-02');

-- --------------------------------------------------------

--
-- テーブルの構造 `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `roles`
--

INSERT INTO `roles` (`id`, `name`, `date`) VALUES
(1, '管理者', '2026-02-17 14:10:57'),
(2, '一般', '2026-02-17 14:10:57');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(1) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `role`, `date`) VALUES
(4, 'tanaka', '$2y$10$MntbSZ3m0PQpQhp06cWEkOwrw8FY/LyebR1sKAkJIBrHHih6mfeAq', 1, '2026-02-18 10:50:06'),
(6, 'akaza123', '$2y$10$0toirH/NLPlDb2UoT0fAU.JrmaIEWgsJTUAukkNrGBqDzo1gAJAJK', 1, '2026-02-18 10:50:37'),
(7, 'nakata', '$2y$10$Ayu.jEFJgIs3jNUJSSlI7ujHAPuvbAJtxi7t/.AvWSj4BQeZkHNLm', 1, '2026-02-18 11:58:20'),
(8, 'hakata', '$2y$10$3pCB25vr9Os2fJiJD.7JkebJ9Ypf/fnoQbRVivLrdRlf6iPCvVBYO', 2, '2026-02-18 11:58:30'),
(9, 'kobayakawa', '$2y$10$oQRjG.U4C4wmjl.wG9x63.EsbMzGkDLG57Pgr0VcGL761EU2O8282', 2, '2026-02-18 11:58:41'),
(10, 'nakasu', '$2y$10$kqJ4j10rnAYAwkm6S4IPleTmKp14PvghO8IOe3crUebN21o9p3WUG', 2, '2026-02-18 11:59:05');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `role` (`role`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `roles` (`id`);
--
-- データベース: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
