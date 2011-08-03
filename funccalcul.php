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

	require "config/config.php";
	require "include/functions.php";
	require "locale/language.php";
	require "include/auth.php";
	require "include/zones.php";
	require "mainform/centermenu.php";
	require "mainform/rightmenu.php";
	require "mainform/leftmenu.php";

	echo"<table width='50%' cellpadding='0' cellspacing='0' border='0' rules='none' align='center' style='background : url(templates/$them/images/typ_bg.jpg)'>";
	echo"<tr><td class='typ'>&nbsp;&nbsp;&nbsp;$txt[286]</td></tr>";
	echo"<tr><td align='center'><script type='text/javascript' src='include/jquery.js'></script>";
	echo"<table class='typ' valign='middle' cellpadding='2'>";

	if (empty($_GET['g']) || empty($_GET['s'])) 
		{
			if (empty($_GET['s'])) 
				{
					echo"<tr><td align='center' width='100%' colspan='2' style='padding: 15px 0;'><strong>$txt[287]</strong></td></tr>";
					echo"<tr><td colspan='2' align='center'><img src='templates/$them/images/cara.png'></td></tr>";
					echo"<th width='150'>";
					echo"<tr><td align='center' width='193'><input type='' id='sum'></td>";
					echo"<tr><td align='center' width='193'><a href='#' class='arrow' name='change' id='sum_post'></a></td></th></tr>";
					echo"<script type='text/javascript'>$(document).ready(function () { $('#sum_post').click(function () {if (parseInt($('#sum').val()) > 0) {location.href = 'funccalcul.php?s='+parseInt($('#sum').val());}});});</script>";
				} 
			else 
				{
					$sum = intval($_GET['s']);

					selectDb('characters');
					$prehled_chary = "SELECT guid, name, race, class, totaltime, money, SUBSTRING(LPAD(HEX(CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(`level`,' ',23),' ',-1) AS UNSIGNED)),8,'0'),4,1) AS gender ,CAST( SUBSTRING_INDEX(SUBSTRING_INDEX(`level`, ' ', 54), ' ', -1) AS UNSIGNED) AS level ,zone FROM `characters` WHERE account = $id";
					$result = mysql_query($prehled_chary);

					while ($prehled_chary_vypis = mysql_fetch_array($result)) 
						{
							$name = $prehled_chary_vypis["name"];
    							echo"<tr><td align='left' width='10%'><img src='images/race/small/".$prehled_chary_vypis['race']."-".$prehled_chary_vypis['gender'].".gif'></td>";
							echo"<td align='left' width='10%'><img src='images/class/small/".$prehled_chary_vypis['class'].".gif'></td>";
							echo"<td align='left' width='50%'><strong>".$name."</strong></td>";
							echo"<th width='5%'><a href='funccalcul.php?g=$prehled_chary_vypis[guid]&s=$sum' class='arrow' name='change'></a></th></tr>";
							echo"<tr><td colspan='4' align='left'><img src='templates/$them/images/cara.png'  width='90%'></td></tr>";

						}
				}
		} 
	else 
		{
			$sum = intval($_GET['s']);
			$guid = intval($_GET['g']);

			selectDb('characters');
			$prehled_chary = "SELECT name, SUBSTRING(LPAD(HEX(CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(`level`,' ',23),' ',-1) AS UNSIGNED)),8,'0'),4,1) AS gender ,CAST( SUBSTRING_INDEX(SUBSTRING_INDEX(`level`, ' ', 54), ' ', -1) AS UNSIGNED) AS level FROM `characters` WHERE guid=$guid AND account=$id";
			$result = mysql_query($prehled_chary);

			while ($prehled_chary_vypis = mysql_fetch_array($result))
				{
					$lvl = $prehled_chary_vypis["level"];
					$sumlvl = $sum*$level*$lvl;
					echo"<tr><td align='center' width='100%' style='padding: 15px 0;'><strong>$txt[288]$sumlvl$txt[162]</strong></td></tr>";	
					echo"<tr><td align='center' width='100%' style='padding: 15px 0;'><strong><a href='leadslevel.php' name='change'>$txt[289]</a></strong></td></tr>";
				}		
			//echo("<script>location.href='leadslevel.php'</script>");
		}
	echo"</table></td></tr></table><br><br>";

	require "templates/$them/bottomline.php";  
?>
