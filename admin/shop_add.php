<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規店舗追加｜ふくおか餃子FES</title>
    <?php include('../inc/link_master.php');  ?>
</head>

<body>
    <?php include('../inc/header_master.php'); ?>

    <main role="main" class="container" style="padding:60px 15px 0">
        <div>
            <!-- ここから「本文」-->

            <h1 class="c-title__main my-5">新規店舗追加</h1>
            <form action="./shop_add_do.php" method="post">

                <div class="form-group">
                    <label>店舗名</label>
                    <input type="text" name="shop"
                        class="form-control" required>
                </div>
                <div class="form-group">
                    <label>ブース番号</label>
                    <input type="text" name="boos_number"
                        class="form-control" required>
                </div>
                <div class="form-group">
                    <label>店舗詳細</label>
                    <textarea name="shop_detail"
                        class="form-control" rows="5" required></textarea>
                </div>

                <input type="submit" class="btn btn-primary" value="追加する">
            </form>

            <p><a href="shop.php" class="mb-5 text-reset">一覧へ戻る</a></p>


            <!-- 本文ここまで -->
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>