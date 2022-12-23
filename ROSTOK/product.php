<?php include 'dbsettings.php';

$url = explode('/', $_SERVER['REQUEST_URI']);
$Page4PU = $url[2];


/* Загружаем информацию о товаре */
if ($query = $db->query(" SELECT SKU,SECTION,NAME,OLDPRICE,PRICE,4PU,ORIGIN FROM PRODUCTS WHERE STOCK=1")){
  $products = $query->fetchAll(PDO::FETCH_ASSOC);
} else {
  print_r($db->errorInfo());}

  foreach ($products as $product):
    if (strcasecmp($product['4PU'], $url[2]) == 0){
      $ProductSKU = $product['SKU'];
      $ProductName = $product['NAME'];
      $ProductPrice = $product['PRICE'];
      $ProductOrigin = $product['ORIGIN'];
      $ProductOldprice = $product['OLDPRICE'];
    }
  endforeach;
  $SKU=$ProductSKU;

  /* Загружаем товары */
  if ($query = $db->query("SELECT TEXT,NAME,DATE FROM COMMENTS WHERE MODERATION = 0 AND SKU = ".$SKU." ORDER BY DATE DESC;")){
    $comments = $query->fetchAll(PDO::FETCH_ASSOC);
  } else {
    print_r($db->errorInfo());}

    include "statistics-record.php";
    /* Загружаем ищем раздел для хлебных крошек */
    if ($query = $db->query("SELECT 4PU, NAME FROM SECTIONS ORDER BY PRIORITY,NAME")){
      $sections = $query->fetchAll(PDO::FETCH_ASSOC);
    } else {
      print_r($db->errorInfo());}

      foreach ($sections as $section):
        if (strcasecmp($section['4PU'], $url[1]) == 0){
          $SectionName = $section['NAME'];
        }
      endforeach;
      ?>
      <!DOCTYPE html>
      <html lang="RU">
      <head>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Продукт | Каталог | Саженцы почтой </title>

        <!-- Подключаем JS счетчика -->
        <script defer src="/assets/js/amount-controller.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Подключаем CSS слайдера -->
        <link rel="stylesheet" href="/assets/css/simple-adaptive-slider_old.css">

        <!-- Подключаем JS слайдера -->
        <script defer src="/assets/js/simple-adaptive-slider_old.js"></script>
        <link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="/assets/css/style.css">
        <link rel="stylesheet" href="/assets/css/style-slider-product.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Philosopher:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
        <script>
        $(function () {
          $("#add-to-basket").click(function () {
            $.ajax({
              url:"/route-basket.php",
              type: "POST",
              data: {
                action: "update",
                userid: <?php echo $_SESSION['userid'] ?>,
                sku: <?php echo $ProductSKU ?>,
                pcs: $("#pcs").val()
              }
            });
          });
        });
        </script>

        <script>
        document.addEventListener('DOMContentLoaded', function () {
          // инициализация слайдера
          var slider = new SimpleAdaptiveSlider('#slider_product', {
            loop: true,
            autoplay: false,
            swipe: true
          });

          // добавим кнопки для увеличения изображения
          const $slider = document.querySelector('.slider');
          const $newElement = document.createElement('span');
          $newElement.className = 'image-open';
          $slider.append($newElement);

          document.addEventListener('click', function (e) {
            var $target = e.target;
            if (!$target.classList.contains('image-open')) {
              return;
            }
            var sliderWidth = $slider.clientWidth;
            var sliderHeight = $slider.clientHeight;

            var $container = document.querySelector('.slider-overflow__container');
            $container.classList.add('slider-overflow__container_show');

            var width = Math.trunc(($container.clientHeight / sliderHeight) * sliderWidth);
            var $sliderOverflow = document.querySelector('.slider-overflow');
            $sliderOverflow.style.width = width + 'px';
            var $sliderBox = new SimpleAdaptiveSlider('.slider-overflow', {
              loop: true,
              swipe: true
            });
            var $sliderItemActive = document.querySelector('.slider__item_active');
            var index = parseInt($sliderItemActive.dataset.index, 10);
            $sliderBox.moveTo(index, false);
          });

          document.addEventListener('click', function (e) {
            var $target = e.target;
            if (!$target.classList.contains('btn-close')) {
              return;
            }
            var $container = document.querySelector('.slider-overflow__container');
            $container.classList.remove('slider-overflow__container_show');
          });

          var thumbnailsItem = document.querySelectorAll('.slider__thumbnails-item');
          thumbnailsItem.forEach(function ($item, index) {
            $item.dataset.slideTo = index;
          })

          function setActiveThumbnail() {
            var sliderItemActive = document.querySelector('.slider__item_active');
            var index = parseInt(sliderItemActive.dataset.index);
            for (var i = 0, length = thumbnailsItem.length; i < length; i++) {
              if (i !== index) {
                thumbnailsItem[i].classList.remove('active');
              } else {
                thumbnailsItem[index].classList.add('active');
              }
            }
          }
          setActiveThumbnail();
          document.querySelector('.slider').addEventListener('slider.set.active', setActiveThumbnail);
          var sliderThumbnails = document.querySelector('.slider__thumbnails');
          sliderThumbnails.addEventListener('click', function (e) {
            $target = e.target.closest('.slider__thumbnails-item');
            if (!$target) {
              return;
            }
            var index = parseInt($target.dataset.slideTo, 10);
            slider.moveTo(index);
          });
        });
        </script>


      </head>
      <body>
        <?php include 'header.php';?>

        <div class="outer">
          <div class="main">

            <div class="sidebar">
              <?php include 'sidebar_catalog.php'; ?>
              <?php include 'sidebar_mailing-list.php'; ?>
            </div>

            <div class="content">

              <!-- Разметка хлебных крошек -->
              <ul class="breadcrumb unselectable">
                <li><a href="http://rostok">Главная</a></li>
                <li><a href="http://rostok/<?php echo $url[1] ?>"><?php echo $SectionName; ?></a></li>
                <li><?php echo $ProductName; ?></li>
              </ul>

              <div class="product-page-box">
                <div class="page-title">
                  <h2><?php echo $ProductName; ?></h2>
                  <ul class="page-title-info">

                    <li><span class="unselectable">АРТИКУЛ: </span><?php echo $ProductSKU; ?></li>
                  </ul>
                </div>
                <div class="product-page-content">
                  <!-- Разметка слайдера -->
                  <div class="slider__container">
                    <!-- slider -->
                    <div class="slider" id="slider_product">
                      <div class="slider__wrapper">
                        <div class="slider__items">
                          <div class="slider__item">
                            <img src="/assets/images/asia.jpg" alt="..." width="500" height="500"
                            loading="lazy">
                          </div>
                          <div class="slider__item">
                            <img src="/assets/images/salsa.jpg" alt="..." width="700" height="1000"
                            loading="lazy">
                          </div>
                        </div>
                      </div>
                      <a class="slider__control slider__control_prev" href="#" role="button" data-slide="prev"></a>
                      <a class="slider__control slider__control_next" href="#" role="button" data-slide="next"></a>
                    </div>
                    <!-- thumbnails -->
                    <div class="slider__thumbnails">
                      <div class="slider__thumbnails-item" data-slide-to="0">
                        <img src="/assets/images/asia.jpg" alt="..." width="100" height="143" loading="lazy">
                      </div>
                      <div class="slider__thumbnails-item" data-slide-to="1">
                        <img src="/assets/images/salsa.jpg" alt="..." width="150" height="150" loading="lazy">
                      </div>
                    </div>
                  </div>
                  <!-- slider__overflow -->
                  <div class="slider-overflow__container">
                    <button type="button" class="btn-close"></button>
                    <div class="slider-overflow">
                      <div class="slider__wrapper">
                        <div class="slider__items">
                          <div class="slider__item">
                            <img src="/assets/images/asia.jpg" alt="..." loading="lazy">
                          </div>
                          <div class="slider__item">
                            <img src="/assets/images/salsa.jpg" alt="..." loading="lazy">
                          </div>
                        </div>
                      </div>
                      <a class="slider__control slider__control_prev" href="#" role="button" data-slide="prev"></a>
                      <a class="slider__control slider__control_next" href="#" role="button" data-slide="next"></a>
                    </div>
                  </div>

                  <div class="product-page-info">

                    <ul class="product-info-list">
                      <li>
                        <span>Тип товара</span>
                        <div class="border-bottom unselectable"></div>
                        <span>Сажанцы</span>
                      </li>
                      <?php if(is_null($ProductOrigin)){
                      } else { ?>
                        <li>
                          <span>Страна происхождения</span>
                          <div class="border-bottom unselectable"></div>
                          <span><?php echo $ProductOrigin; ?></span>
                        </li>
                      <?php }  ?>
                      <li>
                        <span>Отправка</span>
                        <div class="border-bottom unselectable"></div>
                        <span>по соглосованию (май-октябрь)</span>
                      </li>
                      <li>
                        <span>Фасовка</span>
                        <div class="border-bottom unselectable"></div>
                        <span>1 сажанец</span>
                      </li>
                    </ul>

                    <div class="product-pg-buy-block">
                      <div class="product-pg-buy-block-price">
                        <span class="product-price"><?php echo $ProductPrice; ?> ₽</span>

                        <?php if(is_null($ProductOldprice)){
                        } else { ?>
                          <span class="product-oldprice bold"><?php echo $ProductOldprice; ?></span>
                        <?php }  ?>

                        <span>за саженец</span>
                      </div>
                      <div class="product-pg-buy-block-UI">
                        <div class="number" data-step="1" data-min="4" data-max="100">
                          <input id="pcs" class="number-text" type="text" name="count" value="4">
                          <a href="" class="number-minus">−</a>
                          <a href="" class="number-plus">+</a>
                        </div>
                        <button id="add-to-basket" class="defaultButton product-pg-buy-button">В корзину</button>
                    </div>
                  </div>
                </div>
                <br class="clear" />
              </div>
              <br class="clear" />
              <?php include "comment-form.php"; ?>
            </div>
          </div>
        </div>
      </div>
        <?php include 'footer.php'; ?>
      </body>
      </html>
