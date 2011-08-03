<?php 
/*-------------------------------------------------------+
| lkfusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: character.php
| Author: lovepsone
| completed: 20%
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "config/config.php";
	require_once "include/functions.php";
	require_once "locale/language.php";
	require_once "include/auth.php";
	require_once "include/zones.php";
	require_once "templates/$them/topmenu.php";
	require_once "include/authpanel.php";

	// поиск игрока
  	if(@$_GET['search']=='player')
		{
			//загрузка менюшек
			include ('mainform/rightmenu.php');
			include ('mainform/leftmenu.php');

			echo"<table width='50%' cellpadding='0' cellspacing='0' border='0' rules='none' align='center' style='background: url(templates/$them/images/typ_bg.jpg)'>";
			echo"<tr><td class='typ'>&nbsp;&nbsp;&nbsp;$txt[354]</td></tr>";
			echo"<tr><td align='center'>";

			echo"<table class='typ' valign='top' align='center'>";
			echo"<tr><td align='center'><form method='POST'>$txt[133]</td></tr>";
			echo"<tr><td align='center'><input type='text' name='name'></td></tr>";
			echo"<tr><td align='center' colspan='2'><input type='submit' name='search' value='$txt[355]'></form></td></tr></table></td></tr></table>";

			if(isset($_POST['search']))
				{
					selectDb('characters');
					$sql = mysql_query("SELECT `guid` FROM `characters` where `name`= '".$_POST['name']."' LIMIT 1");
					$row = mysql_fetch_array($sql);
					echo $row['guid'];

					echo <<<HERE
					<script type="text/javascript"> <!--
					function exec_refresh(){window.status = "Переадресация..." + myvar;myvar = myvar + " .";var timerID = setTimeout("exec_refresh();", 100);if (timeout > 0){timeout -= 1;}else{clearTimeout(timerID);window.status = "";window.location = "/cswowd/index.php?player=$row[guid]";}}var myvar = "";var timeout = 0;exec_refresh();
					//--> </script>
HERE;

				}

		}

	require "templates/$them/bottomline.php";

?>