<?php


$dbhost = "localhost"; // Хост
$dbuser = "root"; // Имя пользователя
$dbpassword = ""; // Пароль
$dbname = "booking"; // Имя базы данных

// Подключаемся к mysql серверу
$link = mysql_connect($dbhost, $dbuser, $dbpassword);

// Выбираем нашу базу данных
mysql_select_db($dbname, $link);

// Добавляем запись в нашу таблицу customer
// т.е. делаем sql запрос
$query = "insert into customer values(0,'Иванов Иван Иванович',
'(095) 555-55-55')";

mysql_query($query, $link);

// Закрываем соединение
mysql_close($link);

?>