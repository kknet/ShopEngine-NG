<?php
defined('shopengine') or die('something wrong');
$db_host     = 'localhost';
$db_user     = 'alexanpm_shop';
$db_pass     = 'darthdara';
$db_database = 'alexanpm_shop';

$link = mysql_connect($db_host, $db_user, $db_pass);

mysql_select_db($db_database,$link) or die("Ошибка соединения с Базой Данных ".mysql_error());
mysql_query("SET names UTF8");


?>