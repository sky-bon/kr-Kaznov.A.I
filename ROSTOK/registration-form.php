<?php
include 'dbsettings.php';

$default = false;
$callback = false;
$number = $_POST["number"];
$email = $_POST["email"];
$pass = $_POST["pass"];
$pass_rep = $_POST["pass_rep"];

function generateSalt()
	{
		$salt = '';
		$saltLength = 8; //длина соли
		for($i=0; $i<$saltLength; $i++) {
			$salt .= chr(mt_rand(33,126)); //символ из ASCII-table
		}
		return $salt;
	}

$db->exec("DELETE FROM `users` WHERE CURRENT_TIMESTAMP() > (`DATE` + INTERVAL 1 DAY) AND `CONFIRMAITION` = 0");     // Проверка и удаление пользователей, не подтвердивших аккаунт в течении 1 дня


    // Все последующие проверки, проверяют форму и выводят ошибку
    $uniq_email = $db->query("SELECT EXISTS (SELECT 1 FROM users WHERE EMAIL = '$email')")->fetch();
    if($uniq_email[0]==1){                        // Проверка на совпадение паролей
      $error = 'Этот email уже используется';
    }
    if($_POST["pass"]!==$_POST["pass_rep"]){      // Проверка на совпадение паролей
      $error = 'Пароли не совпадают';
    }
    if(!$_POST["pass_rep"]){                      // Проверка есть ли вообще повторный пароль
      $error = 'Повторите пароль';
    }
    if(!$_POST["pass"]){                          // Проверка есть ли пароль
      $error = 'Введите пароль';
    }
    if(!$_POST["email"]){                         // Проверка есть ли email
      $error = 'Введите email';
    }
    if(!$_POST["number"]){                        // Проверка есть ли номер телефона
      $error = 'Введите номер телефона';
    }
    if(!$_POST["name"]){                          // Проверка есть ли имя
      $error = 'Введите имя';
    }
    if(!$_POST["name"] and !$_POST["number"] and !$_POST["email"] and !$_POST["pass"] and !$_POST["pass_rep"]){      // Проверка на совпадение паролей
      $default = true;
    }

    // Если ошибок нет, то происходит регистрация
    if (!$error) {
        do {
          $id = rand(10000, 99999);
          $chek_id = $db->query("SELECT EXISTS (SELECT 1 FROM users WHERE USERID = '$id')")->fetch();
        } while ($chek_id[0]==1);                             // Проверка на повторение ID
        $name=$_REQUEST['name'];
        $email = $_REQUEST['email'];
        $salt = generateSalt();                               //генерируем соль
				$saltedPassword = md5($_REQUEST['pass'].$salt);       // Пароль хешируется (с помошью соли)
        $hash = md5($email . time());                         // хешируем хеш, который состоит из логина и времени

        // Переменная $headers нужна для Email заголовка
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "To: <$email>\r\n";
        $headers .= "From: <mail@example.com>\r\n";
        // Сообщение для Email
        $message = '
                <html>
                <head>
                <title>Подтвердите Email</title>
                </head>
                <body>
                <p>Что бы подтвердить Email, перейдите по <a href="http://rostok/confirmed.php?hash=' . $hash . '">ссылка</a></p>
                </body>
                </html>
                ';

        // Добавление пользователя в БД
        $sth = $db->exec("INSERT INTO `users` (`USERID`, `ADMIN`, `PASSWORD`, `SALT`, `COOKIE`,`HASH`, `NAME`, `NUMBER`, `EMAIL`, `DATE`, `CONFIRMAITION`) VALUES ('$id', 0, '$saltedPassword', '$salt', NULL, '$hash', '$name', '$number', '$email', CURRENT_TIMESTAMP(), 0)");
        // Добавляем комментарий в таблицу

        if((int)$sth!==1) {
           $error = 'Что-то пошло не так';// запрос по каким-то причинам не выполнен
        }
        // проверяет отправилась ли почта
        if (mail($email, "Подтвердите Email на сайте", $message, $headers) and (int)$sth==1) {
            // Если да, то выводит сообщение
            $callback = true;
        }
    }
?>




<!DOCTYPE html>
<html lang="RU">
<head>
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>Регистрация | Каталог | Саженцы почтой </title>
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
    <div class="main">

      <div style="width:800px"class="content_box-center center" >

        <?php if ($callback==TRUE) { ?>

          <div style="width:600px; margin-bottom:20px;"class="page-title center">
            <h2 class="center">Подтвердите аккаунт на почте</h2>
          </div>

        <?php }else { ?>
          <div style="width:600px ;"class="page-title center">
            <h2 class="center">Регистрация</h2>
          </div>

          <?php  if($default==false){  ?>
          <div  style="padding: 0 0 0 0;" class="error-reg content-text center">
            <p style="padding: 0 0 0 0;text-align:center;"class="content-text center">
              <?php echo $error; ?>
            </p>
            </div>
          <?php } ?>

            <form style="margin-top: 20px;width: 300px;" action="registration" method="post" class="center" >
              <p style="padding: 0 0 0 0;"class="content-text">Фамилия и имя: </p>
              <input style="margin-top: 0; margin-bottom: 8px; width:100%; height:50px;"class="input_box" type="text" name="name">
                <p style="padding: 0 0 0 0;"class="content-text">Номер телефона: </p>
                <input style="margin-top: 0; margin-bottom: 8px; width:100%; height:50px;"class="input_box" type="text" name="number">
                <p style="padding: 0 0 0 0;"class="content-text">Email: </p>
                <input style="margin-top: 0; margin-bottom: 8px; width:100%; height:50px;"class="input_box" type="email" name="email" autocomplete="on">
                <p style="padding: 0 0 0 0;"class="content-text">Пароль: </p>
                <input style="margin-top: 0; margin-bottom: 8px; width:100%; font-family: 'Philosopher', sans-serif; height:50px"class="input_box" type="password" name="pass"autocomplete="on">
                <p style="padding: 0 0 0 0;"class="content-text">Повторите пароль: </p>
                <input style="margin-top: 0; margin-bottom: 8px; width:100%; font-family: 'Philosopher', sans-serif; height:50px"class="input_box" type="password" name="pass_rep">
                <input style="height: 50px; font-size: 22px; margin-bottom: 20px; margin-top: 20px; width:100%;" class="defaultButton" type="submit" value="Зарегистрироваться" name="doGo">
            </form>



        <?php } ?>


      </div>
    </div>
  </div>

  <?php include 'footer.php'; ?>
</body>
