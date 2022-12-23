<?php
include 'dbsettings.php';
if (!$_SESSION['name']) {
  header('Refresh: 0; url=/login');
}
$USERID=$_SESSION['userid'];


if ($query = $db->query(" SELECT SKU, PCS FROM userproducts WHERE USERID = '$USERID'")){
  $BasketItems = $query->fetchAll(PDO::FETCH_ASSOC);
} else {
  print_r($db->errorInfo());}


if ($query = $db->query(" SELECT NAME, NUMBER, EMAIL FROM users WHERE USERID = '$USERID'")){
  $UserInfo = $query->fetchAll(PDO::FETCH_ASSOC);
} else {
  print_r($db->errorInfo());}

  foreach ($UserInfo as $UserInfo) {
    $USERNAME = $UserInfo['NAME'];
    $USERNUMBER = $UserInfo['NUMBER'];
    $USEREMAIL = $UserInfo['EMAIL'];
  }

?>
<!DOCTYPE html>
<html lang="RU">
<head>
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>Личный кабинет</title>
  <!-- Подключаем JS счетчика -->
  <script defer src="/assets/js/amount-controller.js"></script>

  <script src="/assets/js/collapse.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="/assets/css/collapse.css">
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
          <h2 style="padding-left: 20px;">Корзина</h2>
        </div>
        <div style="width:1000px ;"class="center">
          <table id="table-price-box" class="basket_table">
            <thead>
              <tr>
                <th><input id="rootcheckbox" class="root_custom-checkbox" name='remember' type='checkbox' value='0'></th>
                <th>Товар</th>
                <th>Количество</th>
                <th>Цена за штуку</th>
                <th>Цена</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($BasketItems as $BasketItem):
                $PCS = $BasketItem['PCS'];
                $SKU = $BasketItem['SKU'];
                $query = $db->query(" SELECT NAME, PRICE FROM products WHERE SKU = '$SKU'");
                $InfoProduct = $query->fetchAll(PDO::FETCH_ASSOC);
              ?>
              <tr>
                  <th style="text-align:center;">
                    <input class="custom-checkbox" name='remember' type='checkbox' value='<?php echo $SKU; ?>'>
                  </th>
                  <td style="text-align:left;"><?php echo $InfoProduct[0]['NAME']; ?></td>
                  <td>
                  <input style="text-align:center;" type="number" class="basket_input-pcs" value="<?php echo $PCS; ?>" min="4" max="500" onchange="isright(this);" >
                  </td>
                  <td class="price">
                    <?php echo $InfoProduct[0]['PRICE']; ?>
                  </td>
                  <td class="sum"></td>
              </tr>
              <?php endforeach; ?>
              <tr>
                <td colspan="3" style="text-align:left;">
                  <input id="deleteButton" class="defaultButton" type="submit" value="Удалить выбранные товары" name="deleteButton">
                </td>
                <td colspan="3" style="text-align:right;">Итог: <span id="total">0</span> ₽</td>
              </tr>
            </tbody>
          </table>

          <div class="basket_order-data">
            <div class="basket_order-delivery">
              <h4>Оплата и доставка</h4>
              <form style="margin-top: 20px;" id="basket_order-delivery-form" onsubmit="return cteateOrder();" novalidate class="center" >
                <p style="padding: 0 0 0 0;"class="content-text">ФИО: <span>(укажите полностью фамилию, имя и отчество)<span></p>
                <input required style="margin-top: 0; margin-bottom: 8px; width:100%; height:50px;"class="input_box" type="text" id="name" value="<?php echo $USERNAME ?>">

                <div class="basket_order-delivery-split">
                  <div style="width:49%;">
                    <p style="padding: 0 0 0 0;"class="content-text">Телефон:</p>
                    <input required style="margin-top: 0; margin-bottom: 8px; width:100%; height:50px;"class="input_box" type="text" id="number" value="<?php echo $USERNUMBER ?>">

                    <p style="padding: 0 0 0 0;"class="content-text">Почтовый индекс </p>
                    <input required style="margin-top: 0; margin-bottom: 8px; width:100%; height:50px;"class="input_box" type="text" pattern="^[ 0-9]+$" id="postcode">


                  </div>
                  <div style="width:49%;">
                    <p style="padding: 0 0 0 0;"class="content-text">Email: </p>
                    <input required style="margin-top: 0; margin-bottom: 8px; width:100%; height:50px;"class="input_box" type="email" name="email" value="<?php echo $USEREMAIL ?>">

                    <p style="padding: 0 0 0 0;"class="content-text">Страна </p>
                    <input required style="margin-top: 0; margin-bottom: 8px; width:100%; height:50px;"class="input_box" type="text" id="country">
                  </div>

                  </div>

                  <p style="padding: 0 0 0 0;"class="content-text">Область / район </p>
                  <input required style="margin-top: 0; margin-bottom: 8px; width:100%; height:50px;"class="input_box" type="text" id="state">

                  <p style="padding: 0 0 0 0;"class="content-text">Населенный пункт </p>
                  <input required style="margin-top: 0; margin-bottom: 8px; width:100%; height:50px;"class="input_box" type="text" id="city">

                  <p style="padding: 0 0 0 0;"class="content-text">Адрес </p>
                  <input required style="margin-top: 0; margin-bottom: 8px; width:100%; height:50px;"class="input_box" type="text" id="adress">




            </div>
            <div class="basket_order-details">
              <h4>Детали</h4>

              <p style="padding: 0 0 0 0; margin-top: 20px;"class="content-text">Примечание к заказу  </p>
              <textarea style="width: 100%;margin-bottom: -17px;" name="text_comment" cols="100" id="note" rows="5"></textarea>
              <div style="width:100%;"class="collapse">
                <div class="collapse__body order-accept">
                  <p><span style="font-size: 24px;">Ваш заказ оформлен</span><br>Мы свяжемся с вами в ближайшее время<br>Вы можете увидеть статус вашего заказа в разделе <a href="/orders">ЗАКАЗЫ</a></p>
                </div>
              </div>
              <input style="height: 50px; font-size: 22px; margin-bottom: 20px; margin-top: 44px; width:100%;" id="CteateOrder" class="defaultButton" type="submit" value="Оформить заказ" >
          </div>
          </form>
        </div>
      </div>
      <br class="clear unselectable" />
    </div>
  </div>
</div>

  <?php include 'footer.php'; ?>
</body>
<script>

$('document').ready(function() {
  $('#CteateOrder').on('click', function() {
    $('input[required]').addClass('req');
  });
});

$('#rootcheckbox').click(function(){
	if ($(this).is(':checked')){
    $('body input:checkbox').prop('checked', true);
	} else {
    $('body input:checkbox').prop('checked', false);
	}
});


$('#deleteButton').click(function(){
  var DeleteProductSKU=[];
  for(var i = $(".custom-checkbox:checked").length-1; i >= 0 ; i--) {
      if($(".custom-checkbox:checked")[i].value!=0){
          DeleteProductSKU[i]=$(".custom-checkbox:checked")[i].value;

          var inp = $(".custom-checkbox:checked")[i];
          var tr = inp.parentElement.parentElement;
          tr.remove();
       }
    }
    DeleteUserProduct(DeleteProductSKU);
    RefreshAll();
});


function cteateOrder(){
  form = document.forms['basket_order-delivery-form'];
  if (form.checkValidity()) {
    // Обновление данных пользователя
    UserName = form.elements['name'].value;
    UserNumber = form.elements['number'].value;

    // Данные заказа
    //IdOrder
    //IdUser
    OrderPostcode = form.elements['postcode'].value;
    OrderCountry = form.elements['country'].value;
    OrderState = form.elements['state'].value;
    OrderCity = form.elements['city'].value;
    OrderAdress = form.elements['adress'].value;
    OrderNote = form.elements['note'].value;

    var ProductSKU=[];
    var ProductPCS=[];
    for(var i = $(".custom-checkbox:checked").length-1; i >= 0 ; i--) {
      if($(".custom-checkbox:checked")[i].value!=0){
        ProductSKU[i]=$(".custom-checkbox:checked")[i].value;
        var inp = $(".custom-checkbox:checked")[i];
        var tr = inp.parentElement.parentElement;
        ProductPCS[i]=tr.querySelector(".basket_input-pcs").value;
        ProductSKU[i]=$(".custom-checkbox:checked")[i].value;
      }
    }
    ProductPCS = ProductPCS.join('-');
    ProductSKU = ProductSKU.join('-');
    console.log(ProductSKU);
    console.log(ProductPCS);
    $.ajax({
      url:"/route-basket.php",
      type: "POST",
      data: {
        action: "create-order",
        userid: <?php echo $_SESSION['userid'] ?>,
        username: UserName,                 // Обновление
        usernumber: UserNumber,             // Обновление
        postcode: OrderPostcode,
        country: OrderCountry,
        state: OrderState,
        city: OrderCity,
        adress: OrderAdress,
        note: OrderNote,
        sku: ProductSKU,
        pcs: ProductPCS
      }
    });
    const el = document.querySelector('.collapse');
    const collapse = new ItcCollapse(el);
    collapse.toggle();
  }

  return false;
}


function UpdateUserProduct(sku, pcs){
  $.ajax({
    url:"/route-basket.php",
    type: "POST",
    data: {
      action: "update",
      userid: <?php echo $_SESSION['userid'] ?>,
      sku: sku,
      pcs: pcs
    }
  });
}

function DeleteUserProduct(sku){
  var StrSku = sku.join('-');
  console.log(StrSku);
  $.ajax({
    url:"/route-basket.php",
    type: "POST",
    data: {
      action: "delete",
      userid: <?php echo $_SESSION['userid'] ?>,
      sku: StrSku
    }
  });
}

function calculateSum(inp,tr) {
 if (inp.className === "basket_input-pcs") {
      tr.querySelector(".sum").textContent = tr.querySelector(".price").textContent * inp.value;
      UpdateUserProduct(tr.querySelector(".custom-checkbox").value, inp.value);
  }
}

function total() {
  table = document.getElementById('table-price-box').getElementsByTagName('tr');
  var sum = 0;
  for(var i = 0; i < table.length; i++) {
    if(table[i].querySelector('.sum') && table[i].querySelector('.sum').textContent && table[i].querySelector('.custom-checkbox').checked) {
      sum +=parseInt(table[i].querySelector('.sum').textContent);
    }
  }
  return sum;
}


document.getElementById("table-price-box").addEventListener("input", function (e) {
  var inp = event.target;
  var tr = inp.parentElement.parentElement;
  calculateSum(inp, tr);
  document.getElementById("total").textContent = total();
});

function RefreshAll(){
  var pcs = document.getElementById("table-price-box").getElementsByClassName("basket_input-pcs");
  var tr = document.getElementById('table-price-box').getElementsByTagName('tr');
  for(var i = 0; i < pcs.length; i++) {
    calculateSum(pcs[i], tr[i+1]);
  }
  document.getElementById("total").textContent = total();
}

$(document).ready(function() {
    RefreshAll();
});


function isright(obj){
    var value= +obj.value.replace(/\D/g,'')||0;
    var min = +obj.getAttribute('min');
    var max = +obj.getAttribute('max');
    obj.value = Math.min(max, Math.max(min, value));
}





</script>
</html>
