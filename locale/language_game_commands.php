<?php
/*-------------------------------------------------------+
| lkfusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: language_game_commands.php
| Author: lovepsone
| completed: 100%
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "config/config.php";

	selectDb('realmd');
   	$prehled_realmd = "SELECT * FROM `account` WHERE id=$id LIMIT 1";
   	$prehled_realmd_vypis = mysql_fetch_array(mysql_query($prehled_realmd));

	if($prehled_realmd_vypis['gmlevel']=='0'){$cm='0';}
	elseif($prehled_realmd_vypis['gmlevel']=='1') {$cm='1';}
	elseif($prehled_realmd_vypis['gmlevel']=='2') {$cm='2';}
	elseif($prehled_realmd_vypis['gmlevel']=='3') {$cm='3';}
	elseif($prehled_realmd_vypis['gmlevel']=='4') {$cm='4';}

	selectDb('lk');
	$prehled_realmd = "SELECT * FROM `commands_text` WHERE `security`=$cm;";
	$prehled_realmd_vypis = mysql_query($prehled_realmd);
?>