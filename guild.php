<?php
/*-------------------------------------------------------+
| lkfusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: guild.php
| Author: lovepsone
| completed: 50%
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/ 

	require_once "config/config.php"; 
	require_once "include/functions.php";
	require_once "include/auth.php";
	require_once "include/zones.php";
	require_once "templates/$them/topmenu.php";
	require_once "locale/language.php";
	require_once "include/authpanel.php";
	require_once "mainform/centermenu.php";
	require_once "mainform/rightmenu.php";
	require_once "mainform/leftmenu.php";

	if(!isset($_GET['guid']))
		{
			echo"<table width='50%' cellpadding='0' cellspacing='0' border='0' align='center' style='background: url(templates/$them/images/bg.png);'>";
			echo"<tr><td class='typ'>&nbsp;&nbsp;&nbsp;$txt[301]</td></tr>";
			echo"<tr><td class='guild' align='center'>";

			echo"<table class='typ' valign='top' border='0' align='center' width='100%'>";
			echo "<tr><td align='center'>&nbsp;$txt[302]</td>";
			echo "<td align='center'>$txt[303]</td>";
			echo "<td align='center'>$txt[304]</td>";
			echo "<td align='center'>$txt[305]</td>";
			echo "<td align='center'>$txt[306]</td>";
			echo "<td align='center'>$txt[307]</td></tr>";

			selectDb('characters');
			$guild = mysql_query("SELECT * FROM `guild` ORDER by `name`");

			while ($row = mysql_fetch_array($guild))
				{
					$guild_num = mysql_query("SELECT COUNT(*) FROM `guild_member` WHERE `guildid`='$row[guildid]'");
					$gleader = "SELECT `name`, `race` FROM `characters` WHERE `guid`='$row[leaderguid]'";
					$myrow = mysql_fetch_array(mysql_query($gleader));

					if($myrow['race']=="1" or $myrow['race']=="3" or $myrow['race']=="4" or $myrow['race']=="7" or  $myrow['race']=="11") { $faction = "alliance";} else {$faction = "horde";}

					$num = mysql_fetch_row($guild_num);

					echo"<tr><td align='center'><a href='?guid=".$row['guildid']."' class='toplink'><<".$row['name'].">></a></td>";
					echo"<td align='center'>".$num['0']."</td>";
					echo"<td align='center'>".date('d-m-y', $row['createdate'])."</td>";
					echo"<td align='center'><a href=/cswowd/index.php?player=".$row['leaderguid']." class='toplink'>".$myrow['name']."</a></td>";
					echo"<td align='center'><img src=images/".$faction.".png title=".$faction."></td>";
					echo"<td align='center'>".char_money($row['BankMoney'])."</td></tr>";
				}
			echo "</table></td></tr></table>";
		}

	if (@$_GET['guid'])
		{

		}

	require "templates/$them/bottomline.php";
?>