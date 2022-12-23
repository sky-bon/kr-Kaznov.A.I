<?php
include 'dbsettings.php';
    $type=0;
    $infoProduct=[];
    if ($query = $db->query("SELECT * FROM SECTIONS ORDER BY PRIORITY,NAME")){
        $infoProduct = $query->fetchAll(PDO::FETCH_ASSOC);
    } else {
        print_r($db->errorInfo());}

?>

<!DOCTYPE html>
<html lang="RU">
    <head>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
		    <title>Агрокомпания | Каталог | Саженцы почтой </title>


        <!-- Подключаем CSS слайдера -->
        <link rel="stylesheet" href="/assets/css/simple-adaptive-slider_old.css">
        <!-- Подключаем JS слайдера -->
        <script defer src="/assets/js/simple-adaptive-slider_old.js"></script>
        <link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="/assets/css/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Philosopher:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
          // инициализация слайдера
          var slider_ad = new SimpleAdaptiveSlider('#slider_ad', {
            loop: true,
            autoplay: true,
            interval: 4000,
            swipe: true
          });
        });
  </script>


    </head>
    <body>
      <?php
      include 'header.php';
      ?>

      <div class="outer">
				<div id="main">
            <div class="content_box-center center">
              <div class="error_404 center">
                <h2>
  								Ошибка 404
  							</h2>
                <p class="content-text" style="color:gray;">Ошибка 404 означает, что страница, которую Вы запрашиваете, не существует.</p>
                <p class="content-text" style="color:gray;">Возможно, она была удалена, возможно, Вы набрали неправильный адрес.</p>
                <p class="content-text"><a href="/">Главная страница сайта</a></p>
              </div>
						</div>
						<br class="clear unselectable" />
					<br class="clear unselectable" />
				</div>
			</div>

      <?php include 'footer.php'; ?>
    </body>
</html>
