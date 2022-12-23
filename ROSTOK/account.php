<?php
include 'dbsettings.php';
if (!$_SESSION['name']) {
  header('Refresh: 0; url=/login');
}
?>
<!DOCTYPE html>
<html lang="RU">
<head>
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>Личный кабинет</title>

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
          <h2 style="padding-left: 20px;"><?php echo $_SESSION['name']; ?>, здравствуйте</h2>
        </div>

        <div style="width:1000px ;"class="center">

          <div class="account-user_box">
            <ul class="account-action_list">
            <a href="basket">
              <li>
                <svg width="110px" height="115px" viewBox="0 0 482 436" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M106 23L56 165H104L143 58H339.5L376.5 161.5L377.5 166H427L377 26C371.643 16.2591 367.79 12.1055 356.5 11.5H124C113.612 12.8842 109.798 15.5193 106 23Z" fill="#455A64"></path>
                  <path d="M65 420L27.5 228L454.5 227L414.5 422.5C411.992 430.903 408.243 433.53 398.5 435.5H83C72.9651 433.212 68.995 429.856 65 420Z" fill="#43A047"></path>
                  <path d="M257.5 161H18C8.34925 164.661 4.30823 168.256 0.5 178.5V209.5C2.68119 221.03 6.98478 224.903 18 229H464C473.999 225.198 478.593 221.239 481.5 211V178C477.853 167.016 472.381 163.277 460 161H257.5Z" fill="#66BB6A"></path>
                  <path d="M321 392.5V271.5C322.377 267.178 323.937 265.564 328 264H336C340.777 265.471 342.574 267.178 344 272V394C342.97 398.598 341.239 399.914 337 401H328C323.092 399.31 321.718 397.33 321 392.5Z" fill="#1B5E20"></path>
                  <path d="M276 392.5V271.5C277.377 267.178 278.937 265.564 283 264H291C295.777 265.471 297.574 267.178 299 272V394C297.97 398.598 296.239 399.914 292 401H283C278.092 399.31 276.718 397.33 276 392.5Z" fill="#1B5E20"></path>
                  <path d="M230 392.5V271.5C231.377 267.178 232.937 265.564 237 264H245C249.777 265.471 251.574 267.178 253 272V394C251.97 398.598 250.239 399.914 246 401H237C232.092 399.31 230.718 397.33 230 392.5Z" fill="#1B5E20"></path>
                  <path d="M184 392.5V271.5C185.377 267.178 186.937 265.564 191 264H199C203.777 265.471 205.574 267.178 207 272V394C205.97 398.598 204.239 399.914 200 401H191C186.092 399.31 184.718 397.33 184 392.5Z" fill="#1B5E20"></path>
                  <path d="M138 392.5V271.5C139.377 267.178 140.937 265.564 145 264H153C157.777 265.471 159.574 267.178 161 272V394C159.97 398.598 158.239 399.914 154 401H145C140.092 399.31 138.718 397.33 138 392.5Z" fill="#1B5E20"></path>
                  <path d="M300.5 0.500031H180.5C174.158 1.41809 172.699 3.62487 172.5 9.50003V59.5C172.707 65.9332 174.495 67.8674 180.5 68.5H302C307.363 68.2156 309.083 66.6575 309.5 61V9.50003C309.21 2.65706 307.269 0.651645 300.5 0.500031Z" fill="#66BB6A"></path>
                </svg>
                <p>Корзина</p>
              </li>
            </a>
            <a href="edit-account">
              <li>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="110px" height="110px"><path fill="#607D8B" d="M39.6,27.2c0.1-0.7,0.2-1.4,0.2-2.2s-0.1-1.5-0.2-2.2l4.5-3.2c0.4-0.3,0.6-0.9,0.3-1.4L40,10.8c-0.3-0.5-0.8-0.7-1.3-0.4l-5,2.3c-1.2-0.9-2.4-1.6-3.8-2.2l-0.5-5.5c-0.1-0.5-0.5-0.9-1-0.9h-8.6c-0.5,0-1,0.4-1,0.9l-0.5,5.5c-1.4,0.6-2.7,1.3-3.8,2.2l-5-2.3c-0.5-0.2-1.1,0-1.3,0.4l-4.3,7.4c-0.3,0.5-0.1,1.1,0.3,1.4l4.5,3.2c-0.1,0.7-0.2,1.4-0.2,2.2s0.1,1.5,0.2,2.2L4,30.4c-0.4,0.3-0.6,0.9-0.3,1.4L8,39.2c0.3,0.5,0.8,0.7,1.3,0.4l5-2.3c1.2,0.9,2.4,1.6,3.8,2.2l0.5,5.5c0.1,0.5,0.5,0.9,1,0.9h8.6c0.5,0,1-0.4,1-0.9l0.5-5.5c1.4-0.6,2.7-1.3,3.8-2.2l5,2.3c0.5,0.2,1.1,0,1.3-0.4l4.3-7.4c0.3-0.5,0.1-1.1-0.3-1.4L39.6,27.2z M24,35c-5.5,0-10-4.5-10-10c0-5.5,4.5-10,10-10c5.5,0,10,4.5,10,10C34,30.5,29.5,35,24,35z"/><path fill="#455A64" d="M24,13c-6.6,0-12,5.4-12,12c0,6.6,5.4,12,12,12s12-5.4,12-12C36,18.4,30.6,13,24,13z M24,30c-2.8,0-5-2.2-5-5c0-2.8,2.2-5,5-5s5,2.2,5,5C29,27.8,26.8,30,24,30z"/></svg>
                <p>Настройки</p>
              </li>
            </a>
            <a href="orders">
              <li>
                <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 128 120" width="128px" height="120px"><path fill="#FFF" d="M94.5,112h-61c-5.5,0-10-4.5-10-10V22c0-5.5,4.5-10,10-10h61c5.5,0,10,4.5,10,10v80C104.5,107.5,100,112,94.5,112z"/><path fill="#C7D7E2" d="M33.5 22H94.5V37H33.5zM88.5 57h-51c-1.7 0-3-1.3-3-3s1.3-3 3-3h51c1.7 0 3 1.3 3 3S90.2 57 88.5 57zM88.5 72h-51c-1.7 0-3-1.3-3-3s1.3-3 3-3h51c1.7 0 3 1.3 3 3S90.2 72 88.5 72zM64 87H37.5c-1.7 0-3-1.3-3-3s1.3-3 3-3H64c1.7 0 3 1.3 3 3S65.7 87 64 87z"/><path fill="#454B54" d="M94.5,115h-61c-7.2,0-13-5.8-13-13V22c0-7.2,5.8-13,13-13h61c7.2,0,13,5.8,13,13v80C107.5,109.2,101.7,115,94.5,115z M33.5,15c-3.9,0-7,3.1-7,7v80c0,3.9,3.1,7,7,7h61c3.9,0,7-3.1,7-7V22c0-3.9-3.1-7-7-7H33.5z"/></svg>
                <p>История заказов</p>
              </li>
            </a>
            </ul>
          </div>

          <?php
          $id=$_SESSION['userid'];
          $admin = $db->query("SELECT ADMIN FROM users WHERE USERID = '$id' AND ADMIN = 1")->fetch(PDO::FETCH_ASSOC);
          if (!empty($admin)) {
            ?>

          <div class="account-user_box">
            <ul class="account-action_list">
              <a href="/create_product"><li><p>Добавить товар</p></li></a>
              <a href="/edit_product"><li><p>Редактировать товары</p></li></a>
              <a href="/"><li><p>Скрыть/удалить товары</p></li></a>
            </ul>
            <ul class="account-action_list">
              <a href="/statistic"><li><p>Статистика</p></li></a>
              <a href="/comment_edit"><li><p>Модерация комментариев</p></li></a>
            </ul>
          </div>

          <?php } ?>
        </div>

      </div>
      <br class="clear unselectable" />
    </div>
  </div>

  <?php include 'footer.php'; ?>
</body>
</html>
