<?php
/* Запись статистики */
$sth = $db->prepare("SELECT * FROM statistics WHERE SKU = ".$SKU." AND DATE = CURDATE()");
$sth->execute(array($SKU));
$res = $sth->fetch(PDO::FETCH_ASSOC);
if (empty($res)) {
  $sth = $db->prepare("INSERT INTO statistics SET SKU = ".$SKU.", VIEWS = 1, DATE = CURDATE()");
  $sth->execute(array($SKU));
} else {
  $sth = $db->prepare("UPDATE statistics SET VIEWS = VIEWS + 1 WHERE SKU = ".$SKU."");
  $sth->execute(array($res['SKU']));
}
?>
