<?php
/*-------------------------------------------------------+
| lkfusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: centermenu.php
| Author: lovepsone
| completed: 92%
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	echo"<table width='100%' cellpadding='0' cellspacing='0' border='0' align='center' style='background: url(templates/$them/images/bg.png);'>";
	echo"<tr><td style='background: url(templates/$them/images/manage.jpg);' class='mltbl'>&nbsp;&nbsp;&nbsp;$txt[25]</td></tr>";
	echo"<tr><td align='center' class='brtbl'>";

    	echo"<table border='0' width='100%' align='center'>";
	echo"<tr valign='top' align='left' class='browntexts' height='20'><td valign='center'>$txt[26]</td>";
	echo"<td valign='center' align='center'>$txt[27]</td>";
	echo"<td valign='center' align='center'>$txt[28]</td>";
	echo"<td valign='center' align='center'>$txt[29]</td>";
	echo"<td valign='center' align='center'>$txt[311]</td>";
	echo"<td valign='center' align='center'>$txt[282]</td>";
	echo"<td valign='center' align='center'>$txt[293]</td></tr>";

	selectDb('characters');
	$prehled_chary = "SELECT * FROM `characters` WHERE `account` = $id" ;

	$result = mysql_query($prehled_chary);

	while ($prehled_chary_vypis = mysql_fetch_array($result))
		{
			echo "<tr><td valign='center'><a href=/cswowd/index.php?player=".$prehled_chary_vypis["guid"]." class='linkchar'>".$prehled_chary_vypis["name"]."</a></td>";
			//echo "<tr><td valign='center'><a href=character.php?guid=".$prehled_chary_vypis["guid"]." class='linkchar'>".$prehled_chary_vypis["name"]."</a></td>";
			echo "<td valign='center' align='center'>".$prehled_chary_vypis["level"]."</td>";
			echo "<td valign='center' align='center'><img src='images/race/small/".$prehled_chary_vypis['race']."-".$prehled_chary_vypis['gender'].".gif'></td>";
			echo "<td valign='center' align='center'><img src='images/class/small/".$prehled_chary_vypis['class'].".gif'></td>";
			echo "<td valign='center' align='center'>".$zones[$prehled_chary_vypis["zone"]]."</td>";
			echo "<td valign='center' align='center'>".char_money($prehled_chary_vypis["money"])."</td>";
			echo "<td valign='center' align='center'>".char_totaltime($prehled_chary_vypis["totaltime"])."</td></tr>";
		}

	echo"</table></td></tr>";
	echo"<tr><td colspan='3' background='templates/$them/images/box_bg_btm.jpg' width='100%' height='20' ></td></tr></table><br>";
?>