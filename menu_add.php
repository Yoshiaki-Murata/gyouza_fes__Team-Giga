<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">

    <!-- 検索結果から隠す⽅法 -->
    <meta name="robots" content="noindex, nofollow">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ふくおか餃子フェスに出店されるメニューや店舗の紹介ページ。出店情報・メニュー一覧・ブース番号を掲載。アクセスしやすい導線で当日の回遊をサポート。">
    <title>出店メニュー・店舗｜ふくおか餃子FES</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@4.0.1/destyle.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Noto+Sans+JP:wght@100..900&family=Zen+Maru+Gothic&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <style>
        .form-group {
            margin-bottom: 1em;
        }

        .form h1 {
            margin-bottom: 1em;
            text-align: center;
            font-size: 2em;
        }

        label {
            display: block;
            margin-bottom: 0.5em;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 0.5em;
            box-sizing: border-box;
        }

        button {
            padding: 0.5em 1em;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>

</head>

<!-- <body id="top">
    <a href="edit.php?id=<?php echo $menu['id']; ?>">編集</a>
    <a href="delete.php?id=<?php echo $menu['id']; ?>" onclick="return confirm('削除しますか？')">削除</a> -->


<?php include './inc/header.php'; ?>

<h1 class="my-5">メニュー追加</h1>
<form action="menu_add_do.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="product">商品名</label>
        <input type="text" name="product" id="product" required>
    </div>
    <div class="form-group">
        <label for="pieces">個数</label>
        <input type="number" name="pieces" id="pieces" required>
    </div>
    <div class="form-group">
        <label for="price">価格</label>
        <input type="number" name="price" id="price" required>
    </div>
    <div class="form-group">
        <label for="product_detail">商品詳細</label>
        <textarea name="product_detail" id="product_detail"></textarea>
    </div>
    <div class="form-group">
        <label for="image">画像</label>
        <input type="file" name="image" id="image">
    </div>
    <div class="form-group">
        <label for="alt">代替テキスト</label>
        <input type="text" name="alt" id="alt">
    </div>
    <div class="form-group">
        <label for="shop_id">店舗ID</label>
        <input type="number" name="shop_id" id=shop_id required>
    </div>
    <button type="submit">追加</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product = $_POST['product'] ?? '';
    $pieces = $_POST['pieces'] ?? 0;
    $price = $_POST['price'] ?? 0;
    $product_detail = $_POST['product_detail'] ?? '';
    $image = $_FILES['image'] ?? '';
    $alt = $_POST['alt'] ?? '';
    $id = $_POST['shop_id'] ?? '';




    if (empty($product)) {
        exit("エラー：全ての項目を入力してください。");
    }
    // データベースに保存
    try {
        $sql = "INSERT INTO menus (product, pieces, price, product_detail, image, alt, shop_id) VALUES (:product, :pieces, :price, :product_detail, :image, :alt, :shop_id)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':product', $product);
        $stmt->bindParam(':pieces', (int)$pieces);
        $stmt->bindParam(':price', (int)$price);
        $stmt->bindParam(':product_detail', $product_detail);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':alt', $alt);
        $stmt->bindParam(':shop_id', $id);

        $stmt->execute();
        echo "メニューが追加されました。";
    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }
} else {
    echo "";
} ?>

<?php include './inc/footer.php'; ?>

</body>