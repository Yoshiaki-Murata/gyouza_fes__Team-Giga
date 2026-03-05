<?php
session_start();
require_once __DIR__ . '/../inc/function.php';


try {
  $db = db_connect();

  // questions
  $sql = 'SELECT id, category_id, question, answer FROM questions ORDER BY category_id, id';
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $question = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // categories
  $sql_2 = 'SELECT id, category FROM categories ORDER BY id';
  $stmt_2 = $db->prepare($sql_2);
  $stmt_2->execute();
  $category = $stmt_2->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  error_log($e->getMessage());
  $_SESSION["err"] = 'DBへの接続・送信が失敗しました。' . $e->getMessage();
  header('location:index.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="ふくおか餃子フェスに関するよくある質問を掲載">

  <title>よくある質問｜ふくおか餃子FES</title>
  <?php include('../inc/link_master.php');  ?>
</head>

<body id="top">

  <!-- header -->
  <?php include('../inc/header_master.php');  ?>

  <main class="container mb-5" style="padding:60px 15px 0">

    <div class="l-wrapper-child">
      <h1 class="c-title__main my-5">FAQ</h1>

      <?php if (!empty($_SESSION["msg"])): ?>
        <p class="alert alert-success text-center" role="alert">
          <?php echo h($_SESSION["msg"]);
          unset($_SESSION["msg"]);
          ?>
        </p>
      <?php endif ?>
      <?php if (!empty($_SESSION["err"])): ?>
        <p class="alert alert-danger text-center" role="alert">
          <?php echo h($_SESSION["err"]);
          unset($_SESSION["err"]);
          ?>
        </p>
      <?php endif ?>

    </div>

    <div class="l-container-second l-wrapper-child">

      <div class="d-grid mx-auto">
        <a href="./faq_add.php" class="btn btn-primary">新規FAQ投稿</a>
      </div>

      <?php foreach ($category as $category_title): ?>
        <section class="l-faq-section">
          <h2 class="l-faq-section__title"><?php echo h($category_title['category']); ?></h2>
          <?php foreach ($question as $qa): ?>
            <?php if ((int)$category_title['id'] === (int)$qa['category_id']): ?>
              <div class="l-faq-section-parent">
                <h3 class="l-faq-section__question">
                  Q.<?php echo h($qa['question']); ?>
                </h3>
                <p class="l-faq-section__answer">
                  <?php echo nl2br(h($qa['answer'])); ?>
                </p>
                <div class="mr-2">
                  <a href="faq_edit.php?id=<?php echo $qa['id']; ?>" class="btn btn-primary btn-sm">編集</a>
                  <form action="faq_del.php?id=<?php echo $qa['id']; ?>" method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $qa['id']; ?>">
                    <button type="submit" class="btn btn-danger btn-sm">削除</button>
                  </form>
                </div>

              </div>
          <?php endif;
          endforeach;
          ?>
        </section>
      <?php endforeach; ?>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>