<?php
/*-------------------------------------------------------+
| lkfusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: online.php
| Author: lovepsone
| completed: 91%
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "config/config.php";
	require_once "include/functions.php";
	require_once "locale/language.php";
	require_once "include/auth.php";
	require_once "include/zones.php";
	//загрузка форм
	require_once "templates/$them/topmenu.php";
	require_once "include/authpanel.php";
	//require_once "mainform/centermenu.php";
	require_once "mainform/rightmenu.php";
	require_once "mainform/leftmenu.php";

	// игроки онлайн
	if(isset($_GET['online']))
		{
			echo"<table width='50%' cellpadding='0' cellspacing='0' border='0' rules='none' align='center' style='background: url(templates/$them/images/typ_bg.jpg)'>";

			echo"<tr><td class='typ'>&nbsp;&nbsp;&nbsp;$txt[58]</td></tr>";
			echo"<tr><td align='center'>";

    			echo"<table border='0' width='100%' align='center'>";
			echo"<tr valign='top' align='left' class='browntexts' height='20'><td valign='center'>$txt[26]</td>";

			echo"<td valign='center' align='center'>$txt[27]</td>";
			echo"<td valign='center' align='center'>$txt[28]</td>";
			echo"<td valign='center' align='center'>$txt[29]</td>";
			echo"<td valign='center' align='center'>$txt[311]</td>";
			echo"<td valign='center' align='center'>$txt[282]</td></tr>";

			mysql_selectdb ('characters');
			$prehled_online = "SELECT * FROM `characters`";
			$result = mysql_query($prehled_online);

			if($result['online'] == '1')
				{
						while ($prehled_online_vypis = mysql_fetch_array($result))
							{
								echo "<tr><td valign='center'><a href=/cswowd/index.php?player=".$prehled_online_vypis["guid"]." class='linkchar'>".$prehled_online_vypis["name"]."</a></td>";
								echo "<td valign='center' align='center'>".$prehled_chary_vypis["level"]."</td>";
								echo "<td valign='center' align='center'><img src='images/race/small/".$prehled_online_vypis['race']."-".$prehled_online_vypis['gender'].".gif'></td>";
								echo "<td valign='center' align='center'><img src='images/class/small/".$prehled_online_vypis['class'].".gif'></td>";
								echo "<td valign='center' align='center'>".$zones[$prehled_online_vypis["zone"]]."</td></tr>";
							}
				}
			else
				{
					echo"<tr><td valign='center' align='center' colspan='5'>$txt[59]</td></tr>";
				}
	
			echo"</table></td></tr>";
			echo"<tr><td colspan='3' background='templates/$them/images/box_bg_btm.jpg' width='100%' height='20' ></td></tr></table><br>";
		}

	// Toп богатейших игроков
	elseif(@$_GET['top']=='money')
		{
			echo"<table width='50%' cellpadding='0' cellspacing='0' border='0' align='center' style='background: url(templates/$them/images/bg.png);'>";
			echo"<tr><td style='background: url(templates/$them/images/manage.jpg);' class='mltbl'>&nbsp;&nbsp;&nbsp;$txt[25]</td></tr>";
			echo"<tr><td align='center' class='brtbl'>";

    			echo"<table border='0' width='100%' align='center'>";
			echo"<tr valign='top' align='left' class='browntexts' height='20'><td valign='center'>$txt[26]</td>";
			echo"<td valign='center' align='center'>$txt[27]</td>";
			echo"<td valign='center' align='center'>$txt[28]</td>";
			echo"<td valign='center' align='center'>$txt[29]</td>";
			echo"<td valign='center' align='center'>$txt[311]</td>";
			echo"<td valign='center' align='center'>$txt[282]</td></tr>";

			selectDb('characters');
			$prehled_chary = "SELECT * FROM `characters` ORDER BY `money` DESC LIMIT $top_money_limit" ;
			$result = mysql_query($prehled_chary);

			while ($prehled_chary_vypis = mysql_fetch_array($result))
				{
					echo "<tr><td valign='center'><a href=/cswowd/index.php?player=".$prehled_chary_vypis["guid"]." class='linkchar'>".$prehled_chary_vypis["name"]."</a></td>";
					//echo "<tr><td valign='center'><a href=character.php?guid=".$prehled_chary_vypis["guid"]." class='linkchar'>".$prehled_chary_vypis["name"]."</a></td>";
					echo "<td valign='center' align='center'>".$prehled_chary_vypis["level"]."</td>";
					echo "<td valign='center' align='center'><img src='images/race/small/".$prehled_chary_vypis['race']."-".$prehled_chary_vypis['gender'].".gif'></td>";
					echo "<td valign='center' align='center'><img src='images/class/small/".$prehled_chary_vypis['class'].".gif'></td>";
					echo "<td valign='center' align='center'>".$zones[$prehled_chary_vypis["zone"]]."</td>";
					echo "<td valign='center' align='center'>".char_money($prehled_chary_vypis["money"])."</td></tr>";
				}

			echo"</table></td></tr>";
			echo"<tr><td colspan='3' background='templates/$them/images/box_bg_btm.jpg' width='100%' height='20'></td></tr></table><br>";
		}

	// Toп чести
	elseif(isset($_GET['top_honor']))
		{
		}
?>