<?php 
/*-------------------------------------------------------+
| lkfusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: charrename.php
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
	
	echo"<table width='50%' cellpadding='0' cellspacing='0' rules='none' align='center' style='background : url(templates/$them/images/typ_bg.jpg)'>";
	echo"<tr><td class='typ'>&nbsp;&nbsp;&nbsp;$txt[54]</td></tr>";
	echo"<tr><td align='center'>";
	echo"<table width='100%' class='typ' valign='top' cellpadding='2'>";

   	selectDb('characters');
	$prehled_chary = "SELECT guid, name, race, class, totaltime, money, SUBSTRING(LPAD(HEX(CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(`level`,' ',23),' ',-1) AS UNSIGNED)),8,'0'),4,1) AS gender ,CAST( SUBSTRING_INDEX(SUBSTRING_INDEX(`level`, ' ', 54), ' ', -1) AS UNSIGNED) AS level ,zone FROM `characters` WHERE account = $id" ;
   	$result = mysql_query($prehled_chary);

  	while ($prehled_chary_vypis = mysql_fetch_array($result))
  		{
			$name = $prehled_chary_vypis["name"];
    			echo"<tr><td align=\"left\" width=\"10%\"><img src='images/race/small/".$prehled_chary_vypis['race']."-".$prehled_chary_vypis['gender'].".gif'></td>";
			echo"<td align=\"left\" width=\"10%\"><img src='images/class/small/".$prehled_chary_vypis['class'].".gif'></td>";
			echo"<td align=\"left\" width=\"50%\"><strong>".$name."</strong></td>";
			echo"<th width=\"5%\"><form action=charnamechange.php?guid=".$prehled_chary_vypis["guid"]." method=POST name=\"$name\" id='".$prehled_chary_vypis["guid"]."'><input type=hidden name=\"name\" value=\"$name\"><a href='#' onClick=\"document.getElementById('".$prehled_chary_vypis["guid"]."').submit()\" class=\"arrow\" name=\"change\"></a></form></th></tr>";
			echo"<tr><td colspan=\"4\" align=\"left\"><img src=\"templates/$them/images/cara.png\"  width=\"90%\"></td></tr>";

  		}

		echo"</td></tr></table><br></td></tr></table>";

	require "templates/$them/bottomline.php";
?>