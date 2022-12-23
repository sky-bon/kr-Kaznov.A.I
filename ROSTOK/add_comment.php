<?php
include 'dbsettings.php';

  /* Принимаем данные из формы */
  $SKU = $_POST["page_id"];
  $NAME = $_POST["name"];
  $TEXT = $_POST["text_comment"];
  $name = htmlspecialchars($name);// Преобразуем спецсимволы в HTML-сущности
  $text_comment = htmlspecialchars($text_comment);// Преобразуем спецсимволы в HTML-сущности
  $sth = $db->exec("INSERT INTO `comments` (`NAME`, `SKU`, `TEXT`, `MODERATION`, `DATE`) VALUES ('$NAME', '$SKU', '$TEXT', 0, CURRENT_TIMESTAMP())");// Добавляем комментарий в таблицу
  header("Location: ".$_SERVER["HTTP_REFERER"]);// Делаем реридект обратно
?>
