<?php
include "dbsettings.php";

$USERID=$_SESSION['userid'];
$BasketPCS = $db->query("SELECT COUNT(DISTINCT SKU) FROM userproducts WHERE USERID = '$USERID'")->fetch();


 ?>


<div class="header">
  <div class="header-top">
    <a>Принимаем заказы на 2023 год!</a>

    <?php if(!empty($_SESSION['userid'])){ ?>
      <ul class="header-PA-list">
        <li><a href="/account">Личный кабинет</a></li>
        <li><a href="/logout">Выход</a></li>
      </ul>

    <?php }else { ?>

      <ul class="header-PA-list">
        <li><a href="/login">Вход</a></li>
        <li><a href="/registration">Регистрация</a> </li>
      </ul>


    <?php } ?>

  </div>
  <div class="header__middle">

    <div class="logo unselectable">
      <h1 class="site-title">
        <a href="/"><span class="site-name">РОСТОК</span> Калуга</a>
      </h1>
      <p class="site-description">питомник декоративных и плодовых культур г.Калуга</p>
    </div>

    <div class="search_box hide-placeholder">
      <form action="">
        <input type="text" name="search" id="search" placeholder="Поиск по сайту">
        <div class="search_loop__ico">
          <svg enable-background="new 0 0 32 32" id="Glyph" version="1.1" viewBox="0 0 32 32" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M27.414,24.586l-5.077-5.077C23.386,17.928,24,16.035,24,14c0-5.514-4.486-10-10-10S4,8.486,4,14  s4.486,10,10,10c2.035,0,3.928-0.614,5.509-1.663l5.077,5.077c0.78,0.781,2.048,0.781,2.828,0  C28.195,26.633,28.195,25.367,27.414,24.586z M7,14c0-3.86,3.14-7,7-7s7,3.14,7,7s-3.14,7-7,7S7,17.86,7,14z" id="XMLID_223_"/></svg>
        </div>
        <input type="submit">
      </form>
      <div id="search_box-result"></div>
    </div>

    <div class="b-h-contacts">
      <h4>7 993 232-50-96</h4>
      <a href="mailto:rostok.40@yandex.ru">rostok.40@yandex.ru</a>
    </div>
    <a href="/basket" class="b-h-cart_a">
    <div class="b-h-cart">
      <div class="b-h-cart__icon">
        <svg width="60" height="54" viewBox="0 0 482 436" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M106 23L56 165H104L143 58H339.5L376.5 161.5L377.5 166H427L377 26C371.643 16.2591 367.79 12.1055 356.5 11.5H124C113.612 12.8842 109.798 15.5193 106 23Z" fill="#455A64"/>
          <path d="M65 420L27.5 228L454.5 227L414.5 422.5C411.992 430.903 408.243 433.53 398.5 435.5H83C72.9651 433.212 68.995 429.856 65 420Z" fill="#43A047"/>
          <path d="M257.5 161H18C8.34925 164.661 4.30823 168.256 0.5 178.5V209.5C2.68119 221.03 6.98478 224.903 18 229H464C473.999 225.198 478.593 221.239 481.5 211V178C477.853 167.016 472.381 163.277 460 161H257.5Z" fill="#66BB6A"/>
          <path d="M321 392.5V271.5C322.377 267.178 323.937 265.564 328 264H336C340.777 265.471 342.574 267.178 344 272V394C342.97 398.598 341.239 399.914 337 401H328C323.092 399.31 321.718 397.33 321 392.5Z" fill="#1B5E20"/>
          <path d="M276 392.5V271.5C277.377 267.178 278.937 265.564 283 264H291C295.777 265.471 297.574 267.178 299 272V394C297.97 398.598 296.239 399.914 292 401H283C278.092 399.31 276.718 397.33 276 392.5Z" fill="#1B5E20"/>
          <path d="M230 392.5V271.5C231.377 267.178 232.937 265.564 237 264H245C249.777 265.471 251.574 267.178 253 272V394C251.97 398.598 250.239 399.914 246 401H237C232.092 399.31 230.718 397.33 230 392.5Z" fill="#1B5E20"/>
          <path d="M184 392.5V271.5C185.377 267.178 186.937 265.564 191 264H199C203.777 265.471 205.574 267.178 207 272V394C205.97 398.598 204.239 399.914 200 401H191C186.092 399.31 184.718 397.33 184 392.5Z" fill="#1B5E20"/>
          <path d="M138 392.5V271.5C139.377 267.178 140.937 265.564 145 264H153C157.777 265.471 159.574 267.178 161 272V394C159.97 398.598 158.239 399.914 154 401H145C140.092 399.31 138.718 397.33 138 392.5Z" fill="#1B5E20"/>
          <path d="M300.5 0.500031H180.5C174.158 1.41809 172.699 3.62487 172.5 9.50003V59.5C172.707 65.9332 174.495 67.8674 180.5 68.5H302C307.363 68.2156 309.083 66.6575 309.5 61V9.50003C309.21 2.65706 307.269 0.651645 300.5 0.500031Z" fill="#66BB6A"/>
        </svg>
        <div class="b-h-cart__value-m"><?php echo $BasketPCS[0]; ?></div>
      </div>
      <div class="b-h-cart__title">Корзина</div>
    </div>
    </a>
  </div>
</div>

<div class="nav unselectable">
  <ul>
    <li class="first">
      <a href="/">Главная</a>
    </li>
    <li>
      <a href="/about">О нас</a>
    </li>
    <li>
      <a href="/how-to-buy">Как купить</a>
    </li>
    <li class="last">
      <a href="/contacts">Контакты</a>
    </li>
  </ul>
  <br class="clear" />
</div>

<div class="wallpaper-up">
</div>
