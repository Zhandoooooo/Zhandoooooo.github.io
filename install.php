<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "booking";


$link = mysql_connect($dbhost, $dbuser, $dbpassword);


mysql_select_db($dbname, $link);

// Создаём таблицу customer
// т.е. делаем sql запрос
$query = "create table customer (id int(2) primary key
auto_increment, name varchar(100), tel varchar(20))";
mysql_query($query, $link);

// Закрываем соединение
mysql_close($link)

?>