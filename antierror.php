<?php 
/*-------------------------------------------------------+
| lkfusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: antierror.php
| Author: lovepsone
| completed: 91%
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/  


	require "config/config.php";
	require "include/functions.php";
	require "locale/language.php";
	require "include/auth.php";
	require "include/zones.php";
	//загрузка форм
	require "templates/$them/topmenu.php";
	require "include/authpanel.php";
	require "mainform/centermenu.php";
	require "mainform/rightmenu.php";
	require "mainform/leftmenu.php";
	
	error_reporting(E_ERROR);
	$config['db_name']= $characters['db'] ;  //Настройка вывода.
	$config['debug'] = "false" ;		 //Настройка файла
	$config['file']="AntiError.php";

	$link = mysql_connect($characters['host'], $characters['user'], $characters['pass']); //Подключаемся к базе.
	if (!$link) $config['dhtml'].= ".$txt[127].".mysql_error()."<br>\n";

	//Выбираем Базу данных.
	if (!mysql_select_db($config['db_name']) or !mysql_select_db($realmd['db'])) $config['dhtml'].= ".$txt[128].".mysql_error()."<br>\n";

	//Функция показа формы для ввода имя персоонажа.
	function show_form(){ global $config, $txt, $them;

	$config['html'].= "<table width='50%' cellpadding='0' cellspacing='0' border='0' rules='none' align='center' style='background : url(templates/".$them."/images/typ_bg.jpg)'>
				<tr><td class='typ'>&nbsp;&nbsp;&nbsp;$txt[129]</td></tr>
				<tr><td align='center'>
				<table class='typ' valign='top' align='center'>
				<tr><td align='center'><br>$txt[130]</a><br><br>";

	$config['html'].= "<form action = '".$config['file']."' method='POST' id='anti'>\n";
	$config['html'].= "</h4><center><table><tr><td>$txt[131]</td><td><input type='text' name='p_acc' value=''></td></tr>\n";
	$config['html'].= "<tr><td>$txt[132]</td><td><input type='password' name='p_pass' value=''></td></tr>\n";
	$config['html'].= "<tr><td>$txt[133]</td><td><input type='text' name='p_char_name' value=''></td></tr></table><center>\n";
	$config['html'].= "<input type='hidden' name='action' value='save'><br>\n";
	$config['html'].= "<a href='#' onClick=\"document.getElementById('anti').submit()\" class=\"pull\"></a></center>\n";
	$config['html'].= "</form>\n";
	$config['html'].= "</td></tr></table><br></td></tr></table>\n";}

	//Функция удаления ячейки
	function save_char($acc,$pass,$char_name){
	global $config, $txt;
	global $link, $them;

	//Проверка аккаунта
	mysql_select_db($realmd['db']);
	$query = "SELECT * FROM `account` WHERE `username`='".$acc."';" ;
	$result = mysql_query($query,$link);

	if (!$result) $config['dhtml'].= ".$txt[133].".mysql_error(). "<br>\n";
	else
		{
			$res=mysql_fetch_array($result);
			$pass1=$res['sha_pass_hash'];
			$acc_guid=$res['id'];
			$hash = SHA1(strtoupper($acc.":".$pass));

			if ($hash==$pass1) ;
			else
				{
					$config['html'].= "<table width='50%' cellpadding='0' cellspacing='0' border='0' rules='none' align='center' style='background : url(templates/$them/images/typ_bg.jpg)'>
								<tr><td class='typ'>&nbsp;&nbsp;&nbsp;$txt[129]</td></tr>
								<tr><td align='center'>
								<table class='typ' valign='top' align='center'>
								<tr><td align='center'><br><center><img src=images/no.png>$txt[135]</center><br><a href=".$config['file'].">$txt[122]</a>\n";

					$config['html'].= "</td></tr></table><br></td></tr></table>\n";
					return;
				}
		}

	mysql_select_db($config['db_name']);
	$query = "SELECT * FROM `characters` WHERE `name`='".$char_name."';" ;
	$result = mysql_query($query,$link);

	if (!$result) $config['dhtml'].= ".$txt[134].".mysql_error(). "<br>\n";
	else
		{
			$res=mysql_fetch_array($result);
			$pac1=$res['account'];

			if ($acc_guid==$pac1) ;
			else
				{
					$config['html'].= "<table width='50%' cellpadding='0' cellspacing='0' border='0' rules='none' align='center' style='background : url(templates/$them/images/typ_bg.jpg)'>
								<tr><td class='typ'>&nbsp;&nbsp;&nbsp;$txt[129]</td></tr>
								<tr><td align='center'>
								<table class='typ' valign='top' align='center'>
								<tr><td align='center'><br>";

					$config['html'].= "<center><img src=images/no.png>$txt[136]</center><br><br><a href=".$config['file'].">$txt[122]</a></td></tr></table><br></td></tr></table>\n";
					return;
				}
		}
	//Делаем выборку персонажа
	mysql_select_db($config['db_name']);
	$query = "SELECT `guid` FROM `characters` WHERE `name`='".$char_name."';" ;
	$result = mysql_query($query,$link);

	if (!$result) $config['dhtml'].= ".$txt[134].".mysql_error(). "<br>\n";
	else
		{
			$res=mysql_fetch_array($result);
			$tmp_guid=$res['guid'];
		}

	$query = "SELECT `online` FROM `characters` WHERE `guid`='".$tmp_guid."';";
	$result0 = mysql_query($query,$link);
	$tmp_online = mysql_fetch_array($result0);
	$online = $tmp_online['online'];

	if ($online=="0")
    		{
			//Убираем ненужность всякую
			print "<table width='343' cellpadding='0' cellspacing='0' border='0' rules='none' align='center' style='background : url(templates/$them/images/typ_bg.jpg)'>
				<tr><td class='typ'>&nbsp;&nbsp;&nbsp;$txt[129]</td></tr>
				<tr><td align='center'>
				<table class='typ' valign='top' align='center'><tr>
				<td align='center'><br><center>$txt[137]</center>";

			$query = "DELETE FROM `character_aura` WHERE `guid`='".$tmp_guid."';";
			$result1 = mysql_query($query,$link);
			if ($result1) echo "<center><font color=green>$txt[138]</font></center>";print "<br>\n";

			print "<center>$txt[139]</center>";
			$query = "DELETE FROM `groups` WHERE `leaderGuid`='".$tmp_guid."';";
			$result2 = mysql_query($query,$link);
			if ($result2) echo "<center><font color=green>$txt[138]</font></center>";

			print "<br>\n";
			print "<center>$txt[140]</center>";
			$query = "DELETE FROM `groups` WHERE `leaderGuid`='".$tmp_guid."';";
			$result3 = mysql_query($query,$link);
			if ($result3) echo "<center><font color=green>$txt[138]</font></center>";

			print "<br>\n";
			print "<center>$txt[141]<center>";
			$query = "DELETE FROM `group_member` WHERE `memberGuid`='".$tmp_guid."';";
			$result4 = mysql_query($query,$link);
			if ($result4) echo "<center><font color=green>$txt[138]</font></center>";

			print "<br>\n";
			print "<center>$txt[142]<center>";
			$query = "UPDATE `characters` SET `trans_x`=0, `trans_y`=0, `trans_z`=0, `trans_o`=0, `transguid`=0, `taxi_path`='' WHERE `characters`.`guid`=".$tmp_guid.";";
			$result7 = mysql_query($query,$link);
			if ($result7) echo "<center><font color=green>$txt[143]</font></center>";

			print "<br>\n";
			print "<center>$txt[144]<center>";
			$query = "UPDATE `characters`, `character_homebind` SET `characters`.`position_x`=`character_homebind`.`position_x`, `characters`.`position_y`=`character_homebind`.`position_y`, `characters`.`position_z`=`character_homebind`.`position_z`, `characters`.`map`=`character_homebind`.`map` WHERE `characters`.`guid`=".$tmp_guid." AND `characters`.`guid`=`character_homebind`.`guid`;";
			$result5 = mysql_query($query,$link);
			if ($result5) echo "<center><font color=green>$txt[143]</font></center> <br>\n";

			print "<br>\n";
			print "$txt[145]";
			//ПОДЧЕНИТЬ НАДО!
			$query = "REPLACE INTO character_aura VALUES (".$tmp_guid.",".$tmp_guid.",15007,0,1,-75,600000,600000,-1),(".$tmp_guid.",".$tmp_guid.",15007,1,1,-75,600000,600000,-1),(".$tmp_guid.",".$tmp_guid.",15007,2,1,0,600000,600000,-1);";
			$result6 = mysql_query($query,$link);
			if ($result6) echo "<center><font color=green>$txt[143]</font></center><br>";

			if (!$result) $config['dhtml'].= ".$txt[134].".mysql_error(). "<br>\n";
			else
				{
					$config['html'].= "<center><img src=images/yes.png> <font color=green size=3>$txt[146]</font></center><br></td></tr></table><br></td></tr></table>\n";
				}
    		}

    	else print "<table width='50%' cellpadding='0' cellspacing='0' border='0' rules='none' align='center' style='background : url(templates/$them/images/typ_bg.jpg)'><tr>
			<td class='typ'>&nbsp;&nbsp;&nbsp;$txt[129]</td></tr>
			<tr><td align='center'>
			<table class='typ' valign='top' align='center'>
			<tr><td align='center'><br><center><img src=images/no.png>$txt[147]<br><br><a href=".$config['file'].">$txt[122]</a></center></td></tr></table><br></td></tr></table>\n";
    
		}

	//Отлавливаем действия.
	if ($HTTP_POST_VARS['action'] == "save")
		{
			save_char($HTTP_POST_VARS['p_acc'],$HTTP_POST_VARS['p_pass'],$HTTP_POST_VARS['p_char_name']);
		}
	else show_form();

	echo $config['dhtml'];
	echo $config['html'] ;

	require "templates/$them/bottomline.php";
?>
