<?php
session_start();
	/*
		Если пользователь не авторизован (проверяем по сессии) -
		тогда проверим его куки, если в куках есть логин и ключ,
		то пробьем их по базе данных.
		Если пара логин-ключ подходит - пишем авторизуем пользователя.

		Если пользователь авторизован - ничего не делаем.
		Поэтому этот код должен вызываться всегда при заходе пользователя на сайт -
		нагрузку на сервер он не создает.

		Если пустая переменная auth из сессии ИЛИ она равна false (для авторизованного она true).
	*/
	if (empty($_SESSION['auth']) or $_SESSION['auth'] == false) {
		//Проверяем, не пустые ли нужные нам куки...
		if ( !empty($_COOKIE['userid']) and !empty($_COOKIE['key']) ) {
			//Пишем логин и ключ из КУК в переменные (для удобства работы):
			$login = $_COOKIE['userid'];
			$key = $_COOKIE['key']; //ключ из кук (аналог пароля, в базе поле cookie
			//Ответ базы запишем в переменную $result:
			$result = $db->query("SELECT * FROM users WHERE USERID = '$login' AND COOKIE = '$key'")->fetch(PDO::FETCH_ASSOC);
			//Если база данных вернула не пустой ответ - значит пара логин-ключ_к_кукам подошла...
			if (!empty($result)) {
				//Стартуем сессию:
				//Пишем в сессию информацию о том, что мы авторизовались:
				$_SESSION['auth'] = true;
				/*
					Пишем в сессию логин и id пользователя
					(их мы берем из переменной $user!):
				*/
				$_SESSION['userid'] = $result['USERID'];
        $_SESSION['name'] = $result['NAME'];
				$_SESSION['login'] = $result['EMAIL'];
				//Тут можно добавить перезапись куки, см. ниже объяснение.
			}
		}
	}
?>