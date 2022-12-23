<?php
include 'dbsettings.php';
    /* Загружаем разделы */
    if ($query = $db->query("SELECT 4PU, NAME, NUMBER FROM SECTIONS ORDER BY PRIORITY,NAME")){
        $sections = $query->fetchAll(PDO::FETCH_ASSOC);
    } else {
        print_r($db->errorInfo());}

        $url = $_SERVER['REQUEST_URI'];
        $url = explode('/', $url);
        $Page4PU = $url[1];

        foreach ($sections as $section):
          if (strcasecmp($section['4PU'], $Page4PU) == 0){
            $PageTitle = $section['NAME'];
            $SectionNum = $section['NUMBER'];
          }
        endforeach;
        /* Загружаем товары */
        if ($query = $db->query(" SELECT SKU,SECTION,NAME,OLDPRICE,PRICE,STOCK,4PU,PRIORITY FROM PRODUCTS WHERE SECTION = ".$SectionNum." AND STOCK = 1 ORDER BY PRIORITY,NAME ")){
            $products = $query->fetchAll(PDO::FETCH_ASSOC);
        } else {
            print_r($db->errorInfo());}
        /* Загружаем теги */
        if ($query = $db->query(" SELECT * FROM TAGS")){
            $tags = $query->fetchAll(PDO::FETCH_ASSOC);
        } else {
            print_r($db->errorInfo());}

            /* Загружаем фото */
        if ($query = $db->query("SELECT SKU,PHOTO FROM photos WHERE MAIN = TRUE AND (SELECT SECTION FROM products WHERE photos.SKU = products.SKU) = ".$SectionNum." ")){
            $MainPhotos = $query->fetchAll(PDO::FETCH_ASSOC);
        } else {
            print_r($db->errorInfo());}
?>






<!DOCTYPE html>
<html lang="RU">
    <head>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
		    <title><?php echo $PageTitle ?> | Каталог | Саженцы почтой </title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="/assets/css/style.css">
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
                sku: $(this).getAttribute('data-widget-name'),
                pcs: $("#pcs").val()
              }
            });
          });
        });
        </script>



    </head>
    <body>
      <?php include 'header.php'; ?>


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
              <li><?php echo $PageTitle ?></li>
            </ul>

            <div class="content_box">
              <h2><?php echo $PageTitle ?></h2>
              <ul class="products clearfix">
                <?php foreach ($products as $product): ?>

                  <li class="product-wrapper">
                    <a href="/<?php echo $Page4PU ?>/<?php echo $product['4PU'] ?>" class="product">
                      <div class="product-photo no-drag unselectable">
                        <?php foreach ($MainPhotos as $MainPhoto):
                          if($product['SKU'] == $MainPhoto['SKU']){ ?>
                            <img src="<?php echo $MainPhoto['PHOTO']; ?>" alt="">
                          <?php }
                          else { ?>
                            <img src="/assets/images/no-image.jpg" alt="">
                          <?php   }
                        endforeach;
                        if (empty($MainPhotos)) { ?>
                          <img src="/assets/images/no-image.jpg" alt="">
                        <?php   } ?>
                        <div class="product-tags no-drag unselectable">
                          <?php foreach ($tags as $tag):
                            if( $product['SKU'] == $tag['SKU']){
                              ?>
                              <div class="top-tag"><?php echo $tag['TAG']; ?></div>
                            <?php }
                          endforeach; ?>
                        </div>
                      </div>
                      <div class="product-info">
                        <div class="product-price-info unselectable">
                          <?php if(is_null($product['OLDPRICE'])){
                          } else { ?>
                            <span class="product-oldprice"><?php echo $product['OLDPRICE'] ?> руб.</span>
                            <?php }  ?>



                          <span class="product-price"><?php echo $product['PRICE'] ?> руб.</span>
                        </div>
                        <button id="add-to-basket" class="product-cart-btn-buy" data-sku="<?php echo $product['SKU'] ?>"><span>В кoрзину</span></button>
                        <h4 class="product-name"><?php echo $product['NAME'] ?></h4>
                        <strong><center>Цена за 1 сажанец</center></strong>
                      </div>
                    </a>
                  </li>
                <?php endforeach; ?>

						</div>

            <!-- Разметка слайдера -->
              <?php include 'slider.php'; ?>
						<br class="clear unselectable" />
					</div>
					<br class="clear unselectable" />
				</div>
			</div>

      <?php include 'footer.php'; ?>
    </body>

</html>
