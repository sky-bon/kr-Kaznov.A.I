<?php
// Подключаем коннект к БД
include 'dbsettings.php';

// Проверка есть ли хеш
if ($_GET['hash']) {
    $hash = $_GET['hash'];
    // Получаем id и подтверждено ли Email

    if ($query = $db->query(" SELECT `USERID`, `CONFIRMAITION` FROM `users` WHERE `HASH`='" . $hash . "'")){
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $result):
          $ID=$result['USERID'];
          $CONF=$result['CONFIRMAITION'];
        endforeach;

        if ($CONF == 0) {
            // Если всё верно, то делаем подтверждение
            $sth = $db->exec("UPDATE `users` SET `CONFIRMAITION`= 1 WHERE `USERID`=". $ID . "");// Добавляем комментарий в таблицу
            echo "Email подтверждён";
        } else {
            echo "Что то пошло не так";
        }
        // Проверяет получаем ли id и Email подтверждён ли
    } else {
      echo "ссыка недействительна";
    }
  }
?>
