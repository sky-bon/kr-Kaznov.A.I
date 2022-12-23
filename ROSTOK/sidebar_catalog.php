<?php
include 'dbsettings.php';

$infoProduct=[];
if ($query = $db->query("SELECT * FROM SECTIONS ORDER BY PRIORITY,NAME")){
  $infoProduct = $query->fetchAll(PDO::FETCH_ASSOC);
} else {
  print_r($db->errorInfo());}
?>

<div class="sidebar_box sb-catalog">
  <h3>
    Каталог
  </h3>
  <ul class="linkedList">
    <?php foreach ($infoProduct as $sections): ?>
      <li>
        <a href="/<?php echo $sections['4PU'] ?>">
          <?php echo $sections['NAME'] ?></a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
