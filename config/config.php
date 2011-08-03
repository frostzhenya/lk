<?php
//=====================================================
// подключения к базам данных
$mangos  = array (
'host'   => '127.0.0.1',	// mysql hostname
'user'   => 'mangos',		// mysql username
'pass'   => 'mangos',		// mysql password
'db'     => 'mangos',		// mysql database (mangos)
);

$realmd  = array (
'host'    => '127.0.0.1',	// mysql hostname
'user'   => 'mangos',		// mysql username
'pass'   => 'mangos',		// mysql password
'db'     => 'realmd',		// mysql database (realmd)
);

$characters  = array (
'host'   => '127.0.0.1',	// mysql hostname
'user'   => 'mangos',		// mysql username
'pass'   => 'mangos',		// mysql password
'db'     => 'characters',	// mysql database (characters)
);

$lk  = array (
'host'   => '127.0.0.1 ',	// mysql hostname
'user'   => 'mangos',		// mysql username
'pass'   => 'mangos',		// mysql password
'db'     => 'lk',		// mysql database (lk)
);

//=====================================================
// настройка самого сайта
$startmodule = "news.php";	// Стартовый модуль admin.php news.php
$them = "cataclysm";		// Тема сайта
$namelk = "Личный Кабинет";	// Название сайта (Личный Кабинет)
$encoding = "cp1251";		// Кодировка данных из mysql
$version = "3.3.5a";		// Версия сервера
$gmlevel="3";			// Уровень гм который сможет зайти в админку
$cena = "5000";			// Кол-во денег на ренейм (10000coppers = 1g)
$lang = "ru";			// язык сайта (пока что поддерживается только русский язык)
$lang_commands = "ru";		// язык команд (пока что поддерживается только русский/англ. язык)
$toplinks = "on"; 		// Вкл.\выкл. верхнего меню в теме
$snow = "off"; 			// Вкл.\выкл. снег
$rev = "lk_revision_nr = [1]"; // Ревизия Лк
$cop = "lkfusion v 0.6.59 from LovePSone 2010-2011";	// копирайт (запрещается менять)

//=====================================================
// найстройка купли доп. возможностей за бонусы
$transfercostage = 300;		// кол-во бонусов на перенос персонажа
$charrename = 10;		// кол-во бонусов на изминение имени персонажа
$money = 1;			// кол-во бонусов за 1 золото игровое
$level = 10;			// формула: (уровень героя)*$level*(кол-во уровней которое хотите добавить)=кол-во бонус за поднятие уровня
$maxlevel = 80;			// максимальный игровой уровень

//=====================================================
// настройка писем
$activation = "off";		// Вкл.\выкл. активацию e-mail - on|off
$linkserver = "/email.php";	// Путь до email.php
$title = "Смена E-mail";	// Заголовок письма
$from = "admin@mail.ru";	// От кого письмо

//=====================================================
// настройка модулей 
$replace = "on";		// Вкл.\выкл. модуль переноса персонажей - on|off
$twofactions = "on";		// разрешить\запретить 2 фракции на 1 аккаунте
$top_money_limit =10;		// Ограничение количества богачей
	
//=====================================================
// курсы обмена бонусов
$wmzb = 500;			// сколько бонусов за 1$
$wmrb = intval($wmzb/30);	// сколько бонусов за 1 рубль. 33 - курс доллара.
$wmeb = intval($wmrb*43);	// сколько бонусов за 1 евро. 43 - курс евро.
$wmub = intval($wmrb*4);	// сколько бонусов за 1 гривну. 4 - курс гривны.

$webmoney = 'https://merchant.webmoney.ru/lmi/payment.asp';	// путь веб-денег

//=====================================================
// кошельки
$zkeeper = '';			// доллар
$rkeeper = '';			// российский рубль
$ekeeper = '';			// евро
$ukeeper = '';			// гривны

//=====================================================
// настройки приёма смс
$prefix = '#wowa';
$prefix2 = '#wowa';
$smsbonuses = 1000;		// сколько бонусов за смс
$smsmodul = 'off';		// Вкл.\выкл. модуль смс - on|off (лутчше отключить если нет приема смс)

//=====================================================
//SOAP (лутчше не трогать, если не разбираетесь)
$username = 'ADMINISTRATOR';	// Логин аккаунта с третим уровнем гм
$password = 'ADMINISTRATOR';	// пороль к аккаунту с третим уровнем гм
$host = "localhost";		// хост имя
$soapport = 7878;		// порт SOAP'а (в php должны быть поддержка SOAP'а, читайте README.TXT)
 
//=====================================================
error_reporting(E_ERROR | E_PARSE | E_WARNING);
//error_reporting(E_ALL);
ini_set('display_errors', 0); //disable on production servers!

?>