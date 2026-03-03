<?php

require_once __DIR__ . '/inc/function.php';


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
  exit('システムエラーが発生しました');
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="ふくおか餃子フェスに関するよくある質問を掲載">

  <title>よくある質問｜ふくおか餃子FES</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@4.0.1/destyle.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Noto+Sans+JP:wght@100..900&family=Zen+Maru+Gothic&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>

<body id="top">

  <!-- header -->
  <?php include('inc/header.php');  ?>

  <main class="l-faq l-faq-wrapper l-wrapper l-header-margin">

    <div class="l-wrapper-child">
      <h1 class="c-title__main" data-sub-title="よくある質問">FAQ</h1>
    </div>

    <div class="l-container l-wrapper-child">

      <?php foreach ($category as $category_title): ?>
        <section class="l-faq-section">
          <h2 class="l-faq-section__title"><?php echo $category_title['category']; ?></h2>
          <?php foreach ($question as $qa): ?>
            <?php if ($category_title['id'] === $qa['category_id']): ?>
              <div class="l-faq-section-parent">
                <h3 class="l-faq-section__question">
                  Q.<?php echo $qa['question']; ?>
                </h3>
                <p class="l-faq-section__answer">
                  <?php echo $qa['answer']; ?>
                </p>
              </div>
          <?php endif;
          endforeach;
          ?>

        </section>
      <?php endforeach; ?>




  </main>

  <!-- footer -->
  <?php include('inc/footer.php');  ?>

  <a href="#top" class="c-btn__top"><img src="./img/back-top.png" alt="topへ戻る"></a>
</body>

</html>