<?php
include 'dbsettings.php';

function generateSalt()
{
	$salt = '';
	$saltLength = 8; //длина соли
	for($i=0; $i<$saltLength; $i++) {
		$salt .= chr(mt_rand(33,126)); //символ из ASCII-table
	}
	return $salt;
}

//Если форма авторизации отправлена...
if ( !empty($_REQUEST['password']) and !empty($_REQUEST['email']) ) {
	//Пишем логин и пароль из формы в переменные (для удобства работы):
	$login = $_REQUEST['email'];
	$password = $_REQUEST['password'];

	//Преобразуем ответ из БД в нормальный массив PHP:
	$user = $db->query("SELECT USERID, NAME, PASSWORD, SALT, COOKIE FROM users WHERE EMAIL = '$login'")->fetch(PDO::FETCH_ASSOC);

	//Если база данных вернула не пустой ответ - значит такой логин есть...
	if (!empty($user)) {
		//Получим соль:
		$salt = $user['SALT'];

		//Посолим пароль из формы:
		$saltedPassword = md5($password.$salt);

		//Если соленый пароль из базы совпадает с соленым паролем из формы...
		if ($user['PASSWORD'] == $saltedPassword) {
			//Стартуем сессию:

			session_start();

			//Пишем в сессию информацию о том, что мы авторизовались:
			$_SESSION['auth'] = true;

			/*
			Пишем в сессию логин и id пользователя
			(их мы берем из переменной $user!):
			*/
			$_SESSION['userid'] = $user['USERID'];
			$_SESSION['name'] = $user['NAME'];
			$_SESSION['login'] = $user['EMAIL'];

			//Проверяем, что была нажата галочка 'Запомнить меня':
			if ( !empty($_REQUEST['remember']) and $_REQUEST['remember'] == 1 ) {
				//Сформируем случайную строку для куки (используем функцию generateSalt):
				$key = generateSalt(); //назовем ее $key

				//Пишем куки (имя куки, значение, время жизни - сейчас+месяц)
				setcookie('userid', $user['USERID'], time()+60*60*24*30); //логин
				setcookie('key', $key, time()+60*60*24*30); //случайная строка

				/*
				Пишем эту же куку в базу данных для данного юзера.

				Формируем и отсылаем SQL запрос:
				ОБНОВИТЬ  таблицу_users УСТАНОВИТЬ cookie = $key ГДЕ login=$login.
				*/
				$db->exec("UPDATE users SET COOKIE = '$key' WHERE EMAIL = '$login'");

			}
			header('Refresh: 0; url=/');
		}
		//Если соленый пароль из базы НЕ совпадает с соленым паролем из формы...
		else {
			$error = 'Неправильный логин или пароль';
		}
	} else {
		$error = 'Неправильный логин';
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
          <div style="width:600px ;"class="page-title center">
            <h2 class="center">Личный кабинет</h2>
          </div>
					<div  style="padding: 0 0 0 0;" class="error-reg content-text center">
            <p style="padding: 0 0 0 0;text-align:center;"class="content-text center">
              <?php echo $error; ?>
            </p>
          </div>





					<!-- Это форма авторизации: -->
            <form class="center" style="margin-top: 20px;width: 300px;" action='login' method='POST' autocomplete="on">


                <p style="padding: 0 0 0 0;"class="content-text">Email: </p>
                <input style="margin-top: 0; margin-bottom: 8px; width:100%; height:50px;"class="input_box" type="email" name="email">

                <p style="padding: 0 0 0 0;"class="content-text">Пароль: </p>
                <input style="margin-top: 0; margin-bottom: 8px; width:100%; font-family: 'Philosopher', sans-serif; height:50px"class="input_box" name='password' type='password'>


								<label class="custom-checkbox_box">
									<input class="custom-checkbox" name='remember' type='checkbox' value='1' >
									<div style="padding: 5px 0 0 15px;"class="content-text">Сохранить пароль</div>
								</label>



                <input style="height: 50px; font-size: 22px; margin-bottom: 20px; margin-top: 20px; width:100%;" class="defaultButton" type='submit' value='Войти'>
            </form>
					<!-- Конец формы авторизации. -->

      </div>
    </div>
  </div>

  <?php include 'footer.php'; ?>
</body>
</html>
