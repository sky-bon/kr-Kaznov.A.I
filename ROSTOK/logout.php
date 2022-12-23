<?php
session_start();
	//Если переменная auth из сессии не пуста и равна true, то...
	if (!empty($_SESSION['auth']) and $_SESSION['auth']) {
    session_unset();
    session_destroy(); //разрушаем сессию для пользователя
		//Удаляем куки авторизации путем установления времени их жизни на текущий момент:
		setcookie('userid', '', time()); //удаляем логин
		setcookie('key', '', time()); //удаляем ключ
	}
  header('Refresh: 0; url=/');
?>
