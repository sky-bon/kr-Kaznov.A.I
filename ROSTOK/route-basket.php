<?php
include 'dbsettings.php';
$USERID = $_POST['userid'];
$SKU = $_POST['sku'];
$PCS = $_POST['pcs'];
$ACTION = $_POST['action'];

if (!strcmp($ACTION,"update")){
  $sth = $db->prepare("SELECT * FROM userproducts WHERE USERID = '$USERID' AND SKU = '$SKU'");
  $sth->execute(array($SKU));
  $res = $sth->fetch(PDO::FETCH_ASSOC);
  if (empty($res)) {
    $sth = $db->prepare("INSERT INTO userproducts SET USERID = '$USERID', SKU = '$SKU', PCS = '$PCS'");
    $sth->execute(array($SKU));
  } else {
    $sth = $db->prepare("UPDATE userproducts SET PCS = '$PCS' WHERE USERID = '$USERID' AND SKU = ".$SKU."");
    $sth->execute(array($res['SKU']));
  }
}



if (!strcmp($ACTION,"delete")){
  $ArSKU = str_replace('-', ',', $SKU);
  $db->exec("DELETE FROM `userproducts` WHERE SKU IN (".$ArSKU.") AND USERID = '$USERID'");
}




if (!strcmp($ACTION,"create-order")){

  do {
    $OrderId = rand(10000, 99999);
    $chek_id = $db->query("SELECT EXISTS (SELECT 1 FROM orders WHERE ORDERID = '$OrderId')")->fetch();
  } while ($chek_id[0]==1);
  $OrderPostcode = $_POST['postcode'];
  $OrderCountry = $_POST['country'];
  $OrderState = $_POST['state'];
  $OrderCity = $_POST['city'];
  $OrderAdress = $_POST['adress'];
  $OrderNote = $_POST['note'];

  $ArSKU = explode("-", $SKU);
  $ArPCS = explode("-", $PCS);


  $Order=$db->exec("INSERT INTO `orders`(`ORDERID`, `USERID`, `DATE`, `POSTCODE`, `COUNTRY`, `STATE`, `CITY`, `ADRESS`, `NOTE`, `STATUS`) VALUES ('$OrderId','$USERID',CURRENT_TIMESTAMP(),'$OrderPostcode','$OrderCountry','$OrderState','$OrderCity','$OrderAdress','$OrderNote','1')");
  //создание заказа

  if($Order!==0){
    for ($i = 0; $i < count($ArSKU); $i++) {
      $ThisSKU = $ArSKU[$i];
      $ThisPCS = $ArPCS[$i];
      $ThisPrice = $db->query("SELECT PRICE FROM `products` WHERE SKU = '$ThisSKU'")->fetch(PDO::FETCH_ASSOC);
      $ThisPrice = $ThisPrice['PRICE'];
      $db->exec("INSERT INTO `order_item`(`ORDERID`, `SKU`, `PCS`, `PRICE`) VALUES ('$OrderId','$ThisSKU','$ThisPCS','$ThisPrice')"); //создание позиций заказа
    }
    
    $ArSKU = str_replace('-', ',', $SKU);
    $db->exec("DELETE FROM `userproducts` WHERE SKU IN (".$ArSKU.") AND USERID = '$USERID'"); //удаление из корзины
  }
}




?>
