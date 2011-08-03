<?php	
/*-------------------------------------------------------+
| lkfusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: funccalcul.php
| Author: lovepsone
| completed: 96%
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/ 

	include('config/config.php'); 
	include('include/functions.php');
	open();

	require "include/auth.php";
	require "templates/$them/topmenu.php";
	require "locale/language.php";
	require "include/authpanel.php";
	require "include/zones.php";
	//require "mainform/centermenu.php";
	//require "mainform/rightmenu.php";
	//require "mainform/leftmenu.php";

	echo"<table width='50%' cellpadding='0' cellspacing='0' rules='none' align='center' style='background : url(templates/$them/images/typ_bg.jpg)'>";
	echo"<tr><td class='typ'>&nbsp;&nbsp;&nbsp;$txt[278]</td></tr>";
	echo"<tr><td align='center'><script type='text/javascript' src='include/jquery.js'></script>";
	echo"<table width='100%' class='typ' valign='middle' cellpadding='2'>";

	if (empty($_GET['g']) || empty($_GET['s'])) 
		{
			if (empty($_GET['s'])) 
				{
					echo"<tr><td align='center' width='100%' colspan='2' style='padding: 15px 0;'><strong>$txt[279]</strong></td></tr>";
					echo"<tr><td colspan='2' align='center'><img src='templates/$them/images/cara.png'></td></tr>";
					echo"<tr><td align='right' width='35%'><input type='' value='500' id='sum'></td>";
					echo"<th width='15%'><a href='#' class='arrow' name='change' id='sum_post'></a></th></tr>";

					?><script type="text/javascript">$(document).ready(function () { $('#sum_post').click(function () {if (parseInt($('#sum').val()) > 0) {location.href = 'money.php?s='+parseInt($('#sum').val());}});});</script><?php
				} 
			else 
				{
					$sum = intval($_GET['s']);

					selectDb('characters');
					$prehled_chary = "SELECT guid, name, race, class, totaltime, money, SUBSTRING(LPAD(HEX(CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(`level`,' ',23),' ',-1) AS UNSIGNED)),8,'0'),4,1) AS gender ,CAST( SUBSTRING_INDEX(SUBSTRING_INDEX(`level`, ' ', 54), ' ', -1) AS UNSIGNED) AS level ,zone FROM `characters` WHERE account = $id";
					$result = mysql_query($prehled_chary);

					if (mysql_num_rows($result) > 0) 
						{
							while ($prehled_chary_vypis = mysql_fetch_array($result)) 
								{
									$name = $prehled_chary_vypis["name"];
    									echo"<tr><td align='left' width='10%'><img src='images/race/small/".$prehled_chary_vypis['race']."-".$prehled_chary_vypis['gender'].".gif'></td>";
									echo"<td align='left' width='10%'><img src='images/class/small/".$prehled_chary_vypis['class'].".gif'></td>";
									echo"<td align='left' width='50%'><strong>".$name."</strong></td>";
									echo"<th width='5%'><a href='money.php?g=$prehled_chary_vypis[guid]&s=$sum' class='arrow' name='change'></a></th></tr>";
									echo"<tr><td colspan='4' align='left'><img src='templates/$them/images/cara.png'  width='90%'></td></tr>";
								}
						}
					else 
						{
							echo"<tr><td align='center' width='90%' style='padding: 15px 0;'><strong>$txt[267]</strong></td></tr>";
						}
				}
		} 
	else 
		{
			$sum = intval($_GET['s']);
			$guid = intval($_GET['g']);

			selectDb('realmd');
			$prehled_realmd = "SELECT * FROM account WHERE id=$id LIMIT 1";
			$prehled_realmd_vypis = mysql_fetch_array(mysql_query($prehled_realmd));

			if ($prehled_realmd_vypis["bonuses"] >= $sum && $sum > 0) 
				{
					selectDb('characters');
					$name = @mysql_result(mysql_query("SELECT `name` FROM characters WHERE guid=$guid AND account=$id"),0);

					if ($name) 
						{
							if ($result == 0)
								{
									$sum_realmd= $sum*$money;
									$gold = 10000;
									$sum_characters = $sum*$gold;

									selectDb('realmd');
									mysql_query("UPDATE account SET bonuses=bonuses-".$sum_realmd." WHERE id=$id");
									
									selectDb('lk');
									mysql_query("INSERT INTO `bonuswastes` (`acct`, `guid`, `service_type`, `service_info`, `bonuses`) VALUES ($id, $guid, 2, '".$sum_realmd."', '".$sum_realmd."');");

									selectDb('characters');
									mysql_query("UPDATE characters SET money=money+".$sum_characters." WHERE guid=$guid");

									echo"<tr><td colspan='6' align='center' width='80%' style='padding: 15px 0;'><strong>$txt[280]</strong></td></tr>";
								}
						}
				} 
			else 
				{
					echo"<tr><td align='center' width='100%' style='padding: 15px 0;'>";
					echo"<strong>$txt[281] abs($sum-$prehled_realmd_vypis[bonuses]) $txt[162].<br>(<a href=depositfunds.php class='linkchar'>$txt[24]</a>)</strong></td></tr>";
				}
		}

	echo"</table></td></tr></table><br><br>";

	require "templates/$them/bottomline.php"; 
?>


