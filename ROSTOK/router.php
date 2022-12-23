<?php
include 'dbsettings.php';
$route = trim($_GET['route']);    // Получам юрл
$url = explode("/", $route);      // Разбиваем его

if($url) {
} else {
  include 'index.php';
}

switch (count($url)) {
    case 0:
        break;
    case 1:
        $result = $db->query("SELECT EXISTS(SELECT 1 FROM SECTIONS WHERE 4PU = '$url[0]')");
        $exists = $result->fetch();
            if($exists[0] == 1){
              include 'catalog.php';
              break;
            }
            if($url[0]=='about'){
              include 'add-to-basket.php';
              break;
            }
            if($url[0]=='how-to-buy'){

            }
            if($url[0]=='contacts'){

            }
            if($url[0]=='registration'){
              include 'registration-form.php';
              break;
            }
            if($url[0]=='login'){
              include 'authentication-form.php';
              break;
            }
            if($url[0]=='logout'){
              include 'logout.php';
              break;
            }
            if($url[0]=='account'){
              include 'account.php';
              break;
            }

            if($url[0]=='basket'){
              include 'basket.php';
              break;
            }
            if($url[0]=='orders'){
              include 'orders.php';
              break;
            }
            if($url[0]=='account'){
              include 'account.php';
              break;
            }
            if($_GET['hash']){
              include 'registration-confirmation.php';
              break;
            }
    case 2:
        $result = $db->query("SELECT EXISTS(SELECT 1 FROM SECTIONS WHERE 4PU = '$url[0]')");
        $exists = $result->fetch();
          if($exists[0] == 1){
              $result = $db->query("SELECT EXISTS(SELECT * FROM PRODUCTS WHERE 4PU = '$url[1]')");
              $exists = $result->fetch();
                if($exists[0] == 1){
                  include 'product.php';
                  break;
         }
         if($url[1]=='add_comment.php'){
           include 'add_comment.php';
         }
       }
    default:
       include 'error404.php';
}
?>
