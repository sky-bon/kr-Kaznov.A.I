<?php include 'dbsettings.php'; ?>

  <!DOCTYPE html>
  <html lang="RU">
  <head>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Агрокомпания | Каталог | Саженцы почтой </title>



    <link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Philosopher:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>




  </head>
  <body>
    <?php include 'header.php'; ?>
    <div class="outer">
      <div id="main">

        <div class="sidebar">
          <?php include 'sidebar_catalog.php'; ?>
          <?php include 'sidebar_mailing-list.php'; ?>
        </div>

          <div class="content">
            <div class="content_box">

              <fieldset>
                <legend align="left">О нас</legend>
                <div><span><p class="content-text">
                  Питомник занимается разведением разнообразных декоративных и плодовых культур, способных произростать в средней полосе России.
                  <br>
                  Питомник находится в окрестностях города Калуга.</p>
                  <p class="content-text">
                    Заказать товары можно здесь на сайте или по телефону +7(993)232-5096 (WhatsApp, Viber, Telegram).<br>
                    Сроки поставки уточняйте по телефону, т.к. сезонность товара и погода могут вносить свои коррективы.<br>
                    Оплата товара при получении в г. Калуга.<br>
                    В случае доставки транспортной компанией производится предоплата.</p></span></div>
                  </fieldset>
                </div>

                <div class="content_box">
                  <h2>
                    Самые популярные товары
                  </h2>
                  <ul class="products clearfix">
                    <li class="product-wrapper">
                      <a href="" class="product">
                        <div class="product-photo">
                          <img src="/assets/images/kl.jpg" alt="">
                          <div class="product-tags">
                            <div class="top-tag">Новинка</div>
                            <div class="top-tag">Очень вкусная</div>
                          </div>
                        </div>
                        <div class="product-info">
                          <div class="product-price-info">
                            <span class="product-oldprice">200 руб.</span>
                            <span class="product-price">150 руб.</span>
                          </div>
                          <button class="product-cart-btn-buy"><span>В кoрзину</span></button>
                          <h4 class="product-name">Клубника МАРШМЕЛЛОУ ("Marshmallow", Пастила, Великобритания)</h4>
                          <strong><center>Цена за 1 сажанец</center></strong>
                        </div>
                      </a>
                    </li>


                    <li class="product-wrapper">
                      <a href="" class="product">
                        <div class="product-photo">
                          <img src="/assets/images/salsa.jpg" alt="">
                          <div class="product-tags">
                            <div class="top-tag">Новинка</div>
                            <div class="top-tag"></div>
                          </div>
                        </div>
                        <div class="product-info">
                          <div class="product-price-info">
                            <span class="product-oldprice"></span>
                            <span class="product-price">200 руб.</span>
                          </div>
                          <button class="product-cart-btn-buy"><span>В кoрзину</span></button>
                          <h4 class="product-name">Клубника Сальса</h4>
                          <strong><center>Цена за 1 сажанец</center></strong>
                        </div>
                      </a>
                    </li>


                    <li class="product-wrapper">
                      <a href="" class="product">
                        <div class="product-photo">
                          <img src="/assets/images/asia.jpg" alt="">
                          <div class="product-tags">
                            <div class="top-tag">Крупная</div>
                            <div class="top-tag">Очень вкусная</div>
                          </div>
                        </div>
                        <div class="product-info">
                          <div class="product-price-info">
                            <span class="product-oldprice">200 руб.</span>
                            <span class="product-price">120 руб.</span>
                          </div>
                          <button class="product-cart-btn-buy"><span>В кoрзину</span></button>
                          <h4 class="product-name">Клубника Азия</h4>
                          <strong><center>Цена за 1 сажанец</center></strong>
                        </div>
                      </a>
                    </li>
                  </ul>
                </div>


                <?php include 'slider.php'; ?>

                <br class="clear unselectable" />
              </div>
            </div>
          </div>
          <?php include 'footer.php'; ?>
        </body>

        </html>
