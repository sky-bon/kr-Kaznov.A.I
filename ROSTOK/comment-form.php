<div class="product-pg-comments">
  <h4>Комментарии</h4>

  <?php foreach ($comments as $comment): ?>
    <div class="product-pg-comment">
      <ul class="comment-info">
        <li class="comment-name"><?php echo $comment['NAME']; ?></li>
        <li class="comment-time"><?php echo $comment['DATE']; ?></li>
      </ul>
      <div class="comment-text">
        <span><?php echo nl2br($comment['TEXT']); ?></span>
      </div>
    </div>
  <?php endforeach; ?>

</div>
<form name="comment" action="add_comment.php" method="post">
  <p>
    <label>Имя:</label>
    <input class="input_box" type="text" name="name" />
  </p>
  <p>
    <label>Комментарий:</label>
    <br />
    <textarea style="width: 100%" name="text_comment" cols="100" rows="5"></textarea>
  </p>
  <p>
    <input type="hidden" name="page_id" value="<?php echo $ProductSKU; ?>" />
    <input type="submit" value="Отправить" />
  </p>
</form>
