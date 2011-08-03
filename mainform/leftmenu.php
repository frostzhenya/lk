<?php
/*-------------------------------------------------------+
| lkfusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: leftrmenu.php
| Author: lovepsone
| completed: 90%
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	selectDb('realmd');
	$prehled_realmd = "SELECT * FROM account WHERE id=$id LIMIT 1";
	$prehled_realmd_vypis = mysql_fetch_array(mysql_query($prehled_realmd));
	$sql = "SELECT * FROM account_banned WHERE unbandate=(SELECT MAX(unbandate) FROM account_banned WHERE active=1 and id=$id)";
	$row = mysql_fetch_array(mysql_query($sql));

	$email = $prehled_realmd_vypis["email"];
	$vytvoreno = $prehled_realmd_vypis["joindate"];
	$last_login = $prehled_realmd_vypis["last_login"];
	$last_ip = $prehled_realmd_vypis["last_ip"];
	$locked = $prehled_realmd_vypis["locked"];
	$online = $prehled_realmd_vypis["online"];
	@$locale = getLocale($prehled_realmd_vypis["locale"]);
	$bonuses = $prehled_realmd_vypis["bonuses"];
	$expansion = getExpansion($prehled_realmd_vypis['expansion']);
	$bandate = $row["bandate"];
	$unbandate = $row["unbandate"];
	$bannedby = $row["bannedby"];
	$banreason = $row["banreason"];

	if ($row!='')
		{
			$ban = "<font color='red'>$txt[5]</font>";
		} 
	else 
		{
			$ban = "<font color='green'>$txt[6]</font>";
		}

	//Основная информация об аккаунте
	echo"<table width='25%' cellpadding='0' cellspacing='0' border='0' align='left' style='background: url(templates/$them/images/bg.png);'>";
	echo"<tr><td style='background: url(templates/$them/images/manage.jpg);' class='mltbl'>&nbsp;&nbsp;&nbsp;$txt[9]</td></tr>";
	echo"<tr><td align='center' class='brtbl'>";

	echo"<table border='0' width='100%'>";

	echo"<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[56]</th><td class=greyText><strong>".ucfirst(strtolower($uzivatel))."</strong></td></tr>";
	echo"<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[10]</th><td class=greyText>$id</td></tr>";
	echo"<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[55]</th><td class=greyText>$expansion</td></tr>";
	echo"<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[11]</th><td class=greyText>$email</td></tr>";

	echo"<tr valign='top' align='left' class='browntext' height='20'><td colspan='2' height='12' valign='center'><img src='templates/$them/images/content-separator2.png'></td></tr>";

	echo"<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[12]</th><td class=greyText>$vytvoreno</td></tr>";
	echo"<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[13]</th><td class=greyText>$last_login</td></tr>";
	echo"<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[14]</th><td class=greyText>$last_ip</td></tr>";

	echo"<tr valign='top' align='left' class='browntext' height='20'><td colspan='2' height='12' valign='center'><img src='templates/$them/images/content-separator2.png'></td></tr>";

	echo"<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[15]</th><td class=greyText>$locked</td></tr>";
	echo"<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[16]</th><td class=greyText>$ban</td></tr>";

	if ($row!='')
		{
			echo "<tr valign='top' align='left' height='20'><th colspan=2 class=ban><b>$txt[17]</b> date('d-m-Y G:i', $bandate) | <b>$txt[18]</b> date('d-m-Y G:i', $unbandate) <br> <b>$txt[19]</b> $bannedby<br> <b>$txt[20];</b> $banreason</th></tr>";
 		} 

	if ($online==0)
		{
			echo"<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[21]</th><td class=greyText>$txt[8]</td></tr>";
		}
	else
		{
			echo"<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[21]</th><td class=greyText>$txt[7]</td></tr>";
		}

	echo"<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[22]</th><td class=greyText>$locale</td></tr>";
	echo"<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[23]</th><td class=greyText>$bonuses (<a href=payment.php class='linkchar'>$txt[24]</a>)</td></tr>";

	if ($locked==0)
		{
			echo"<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[57]</th><td class=greyText>$txt[6]</td></tr>";
		}
	else
		{
			echo"<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[57]</th><td class=greyText>$txt[5]</td></tr>";
		}
	echo"<tr valign='top' align='left' class='browntext' height='40'>&nbsp;</tr></table></td></tr>";

	selectDb('realmd');
	$sql_realm = mysql_query("SELECT * FROM `realmlist`");
	$realm_data = mysql_fetch_array($sql_realm);
	$realm_name = $realm_data['name'];
	$server_ip = $realm_data['address'];

	selectDb('characters');
	$sql_characters = "SELECT * FROM `characters` WHERE online=1";
	$online_characters = mysql_query($sql_characters);
	$counter=0;

	while($row = mysql_fetch_array($online_characters)){$counter++;}

	selectDb('characters');
	$online_aliance = "SELECT * FROM `characters` WHERE online=1 and `race` IN (1, 3, 4, 7, 11);";
	$online_characters_aliance = mysql_query($online_aliance);
	$counter_aliance=0;
	while($row = mysql_fetch_array($online_characters_aliance)){$counter_aliance++;}	
   
	selectDb('characters');
	$online_horde = "SELECT * FROM `characters` WHERE online=1 and `race` IN (2, 5, 6, 8, 10);";
	$online_characters_horde = mysql_query($online_horde);
	$counter_horde=0;
	while($row = mysql_fetch_array($online_characters_horde)){$counter_horde++;}

	// Аптайм сервера
	selectDb('realmd');
	$query=mysql_query("SELECT Max(`starttime`) from uptime");
	$upt = time() - @mysql_result($query,0);
	$sec = $upt % 60;
	$upt = intval($upt / 60);
	$min = $upt % 60;
	$upt = intval($upt / 60);
	$hours = $upt % 24;
	$upt = intval($upt / 24);
	$days = $upt;

	//Статистика по серверу
	echo"<tr><td style='background: url(templates/$them/images/manage.jpg);' class='mltbl'>&nbsp;&nbsp;&nbsp;$txt[83]</td></tr>";
	echo"<tr><td align='center' class='brtbl'>";
	echo"<table border='0' width='100%'>";

	if (!$open = @fsockopen($server_ip, $port, $errno, $errstr,(float)0.1))

	   echo"<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[84]</th><td class=greyText>$realm_name</td></tr>
		<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[85]</th><td class=greyText>$version</td></tr>
		<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[86]</th><td class=greyText>$realm_type</td></tr>
		<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[87]</th><td class=greyText>$server_ip:$port</td></tr>
		<tr valign='top' align='left' class='browntext' height='20'><td colspan='2' height='12' valign='center'><img src='templates/$them/images/content-separator2.png'></td></tr>
		<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[91]</th><td class=greyText>$txt[92]</td></tr>";

      else
		{
			echo"<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[84]</th><td class=greyText>$realm_name</td></tr>
			<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[85]</th><td class=greyText>$version</td></tr>
			<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[86]</th><td class=greyText>$realm_type</td></tr>
			<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[87]</th><td class=greyText>$server_ip:$port</td></tr>
			<tr valign='top' align='left' class='browntext' height='20'><td colspan='2' height='12' valign='center'><img src='templates/$them/images/content-separator2.png'></td></tr>
			<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[88]</th><td class=greyText>$counter</td></tr>
			<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[89]</th><td class=greyText>$counter_aliance</td></tr>
			<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[90]</th><td class=greyText>$counter_horde</td></tr>
			<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[91]</th><td class=greyText>{$days} $txt[93]&nbsp;$hours $txt[94] $min $txt[95] $sec $txt[96]</td></tr>";

			fclose($open);
		}

	echo"</table></td></tr>";

	echo"<tr><td style='background: url(templates/$them/images/manage.jpg);' class='mltbl'>&nbsp;&nbsp;&nbsp;$txt[97]</td></tr>";
	echo"<tr><td align='center' class='brtbl'>";
	echo"<table border='0' width='100%'>";

	// Подсчет Аккаунтов
	selectDb('realmd');
	$counter_accounts = "SELECT * FROM `account`";
	$result_counter = mysql_query($counter_accounts);
	$acc_conter=0;
    	while ($rowAcc = mysql_fetch_array($result_counter)){$acc_conter++;}

	// Подсчет Гильдий
	selectDb('characters');
	$sql_guild = "SELECT `guildid` FROM `guild`";
	$result_guild = mysql_query($sql_guild);
	$counter_guild=0;
	while ($line_gild_num = mysql_fetch_array($result_guild, MYSQL_ASSOC)) {$counter_guild++;}
    	mysql_free_result($result_guild);

	// Подсчет Альянса\Орды и тотал
 	selectDb('characters');
 	$query = mysql_query("SELECT count(*) FROM `characters`");
 	$total_chars = mysql_result($query,0);

 	selectDb('characters');
 	$query = mysql_query("SELECT count(guid) FROM `characters` WHERE race IN(2,5,6,8,10)");
 	$horde_chars = mysql_result($query,0);
 	$horde_pros = round(($horde_chars*100)/$total_chars ,1);
 	$allies_chars = $total_chars - $horde_chars;
 	$allies_pros = 100 - $horde_pros;

	echo"<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[98]</th><td class=greyText>$acc_conter</td></tr>";
	echo"<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[99]</th><td class=greyText>$total_chars</td></tr>";
	echo"<tr valign='top' align='left' class='browntext' height='20'><th>&nbsp;&nbsp;$txt[100]</th><td class=greyText>$counter_guild</td></tr>";

	echo"<tr><td width='100%' colspan=2>";
	echo"<table border='0' cellpadding='0' cellspacing='0' width=100%>";

 	echo"<tr><td width=$allies_pros% align=center><img src='images/alliance.png'>$txt[89]</td><td width=$horde_pros% align=center><img src='images/horde.png'>$txt[90]</td></tr>";
 	echo"<tr><td width=$allies_pros% background='images/aliance_bg.gif' align=center><font title='$txt[101] $allies_chars $txt[102]'>$allies_chars($allies_pros%)</font></td><td width=$horde_pros% background='images/horde_bg.gif' align=center><font title='$txt[103] $horde_chars $txt[102]'>$horde_chars($horde_pros%)</font></td></tr>";
	echo"</table></td></tr>";
	echo"</table></td></tr></table>";
?>