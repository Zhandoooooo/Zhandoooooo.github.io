<?php

// Данные для mysql сервера
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
$query = "select * from booking";

// Запрашиваем
$result = mysql_query($query, $link);

while($rows = mysql_fetch_array($result, mysql_assoc))
{
printf("id:%d, name:%s, tel:%s", $rows['id'],$rows['name'],$rows['tel']);
}

// Закрываем соединение
mysql_close($link);

?>