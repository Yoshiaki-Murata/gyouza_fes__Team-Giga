<?php
session_start();
require_once './inc/function.php';

if (!empty($_POST)) {
    if (!empty($_POST['name']) && !empty($_POST['mailaddress']) && !empty($_POST['text'])) {
        $name = $_POST['name'];
        $mailaddress = $_POST['mailaddress'];
        $text = $_POST['text'];

        // 電話番号が入力されたときの処理
        if (!empty($_POST["phonenumber"])) {
            $phonenumber = $_POST['phonenumber'];
            if (!preg_match("/^[0-9]{10,11}$/", $phonenumber)) {
                header("location:confirm.php");
                $_SESSION["contact_err"] = "電話番号が不正です。数字のみ入力可能です";
                exit();
            }
        }

        try {
            $db = db_connect();
            if (!empty($_POST["phonenumber"])) {
                $sql = "INSERT INTO contact(name,mailaddress,phonenumber,text, date, status) VALUES (:name,:mailaddress,:phonenumber,:text,now(),1)";
            } else {
                $sql = "INSERT INTO contact(name,mailaddress,text, date, status) VALUES (:name,:mailaddress,:text,now(),1)";
            }

            $stmt = $db->prepare($sql);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":mailaddress", $mailaddress, PDO::PARAM_STR);
            if (!empty($_POST["phonenumber"])) {
                $stmt->bindParam(":phonenumber", $phonenumber, PDO::PARAM_STR);
            }
            $stmt->bindParam(":text", $text, PDO::PARAM_STR);
            $stmt->execute();
            $result = true;
        } catch (PDOException $e) {
            $result = false;
            exit("エラー" . $e->getMessage());
        }
    } else {
        header("location:confirm.php");
        $_SESSION["contact_err"] = "必須項目が入力されていません。入力してください";
        exit();
    }
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