<?php
include 'dbsettings.php';
if (!$_SESSION['name']) {
  header('Refresh: 0; url=/login');
}
$USERID=$_SESSION['userid'];


if ($query = $db->query("SELECT * FROM orders WHERE USERID = '$USERID'")){
  $Orders = $query->fetchAll(PDO::FETCH_ASSOC);
} else {
  print_r($db->errorInfo());}

?>
<!DOCTYPE html>
<html lang="RU">
<head>
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>Заказы</title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/css/style-slider-product.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Philosopher:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>




</head>
<body>
  <?php include 'header.php'; ?>
  <div class="outer">
    <div id="main">
      <div class="content_box-center center">
        <div style="width:1000px ;"class="page-title center">
          <h2 style="padding-left: 20px;">Ваши заказы</h2>
        </div>
        <div style="width:1000px;"class="center">
          <div style="margin-top: 40px;"class="orders-box">

            <?php foreach ($Orders as $Order):
              $ORDERID=$Order['ORDERID'];
              ?>
          <button class="orders_accordion">Заказ <?php echo $ORDERID; ?>, от  <?php echo $Order['DATE']; ?></button>
          <div class="orders_accordion-panel">
            <table id="" class="order_table">
              <tbody>
                <?php

                if ($query = $db->query("SELECT * FROM order_item WHERE ORDERID = '$ORDERID'")){
                  $Order_items = $query->fetchAll(PDO::FETCH_ASSOC);
                } else {
                  print_r($db->errorInfo());}
                 foreach ($Order_items as $Order_item):
                   $Order_total += $Order_item['PCS']*$Order_item['PRICE'];
                 ?>
                <tr>
                    <td style="">арт.<?php echo $Order_item['SKU']; ?></td>
                    <td style="">Вкусная клубника</td>
                    <td><?php echo $Order_item['PCS']; ?> шт</td>
                    <td class="price"><?php echo $Order_item['PRICE'] ?> ₽</td>
                    <td class="sum"><?php echo $Order_item['PCS']*$Order_item['PRICE']; ?> ₽</td>
                </tr>
                <?php endforeach; ?>
                <tr>
                  <td colspan="3" style="text-align:left;">

                  </td>
                  <td colspan="2" style="text-align:right;">Итог: <span id="total"><?php echo $Order_total; $Order_total=0;?></span> ₽</td>
                </tr>
              </tbody>
            </table>






          </div>
            <?php endforeach; ?>



          </div>
        </div>
        <br class="clear unselectable" />
      </div>
    </div>
  </div>
  <?php include 'footer.php'; ?>
</body>
<script>
var acc = document.getElementsByClassName("orders_accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("accordion-active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}
</script>
</html>
