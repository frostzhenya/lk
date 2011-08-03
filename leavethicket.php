<?php
/*-------------------------------------------------------+
| lkfusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: leavethicket.php
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

	echo"<table width='50%' cellpadding='0' cellspacing='0' border='0' style='background : url(templates/$them/images/manage_bg.jpg)'>";
	echo"<tr><td class='commands'><table border='0' width='100%'>";
	echo"<tr><td width='100%' class='title'>&nbsp;&nbsp;&nbsp;$txt[148]</td></tr></table></td></tr>";
	echo"<tr><td align='center'><br>";

	if(isset($_POST['send']))
		{
			if($_POST['ticket_text'] == '')
				{
					echo "<img src='images/no.png'>&nbsp;&nbsp;$txt[149]<br><br>";
				}
			else
				{
					include("include/securimage/securimage.php");
				  	$img = new Securimage();
				  	$valid = $img->check($_POST['code']);
				
				  	if($valid == true) 
						{
							$ticket_text = $_POST['ticket_text'];
							$guid = $_POST['guid'];

							selectDb('characters');
							$row = mysql_query("INSERT INTO character_ticket (guid,ticket_text) VALUES ('$guid', '$ticket_text')");
		
				  			if ($row == 'true')
								{
									echo "<img src='images/yes.png'>&nbsp;&nbsp;$txt[150]<br><br>";
								}
							else
								{
									echo "<img src='images/no.png'>&nbsp;&nbsp;$txt[151]<br><br>";
								}											
				  		}
					else 
						{
				        		echo "<img src='images/no.png'>&nbsp;&nbsp;$txt[152]<br><br>";
				        	}
				}
		}
			
	echo"<form action='leavethicket.php' method='post' id='send'>";
	echo"<table border='0' width='485'>";
	echo"<tr><td valign='top'>$txt[153]</td>";
	echo"<td colspan=4><textarea name='ticket_text' style='width:300; height: 100'></textarea></td></tr>";
	echo"<tr><td valign='top'>$txt[154]</td>";
	echo"<td align='center' colspan=4><select name=guid>";

	selectDb('characters');   
	$prehled_chary = "SELECT `name`,`guid`,CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(`level`, ' ', 35), ' ', -1) AS UNSIGNED) AS `level` FROM `characters` WHERE account=$id";
	$result = mysql_query($prehled_chary);

	while ($prehled_chary_vypis = mysql_fetch_array($result))
		{
  			echo "<option value='";
  			echo $prehled_chary_vypis['guid']; 
  			echo "'>"; 
  			echo $prehled_chary_vypis['name']; 
  			echo "</option>";
		}

	echo"</select></td></tr>";

	echo"<tr><td valign='top'>$txt[155]</td>";
	echo"<td valign='top'>";
	echo"<td width='175'><img id='image' src='include/securimage/securimage_show.php?sid=md5(uniqid(time()))'></td>";

	?><td valign=top><a href="#" onclick="document.getElementById('image').src = 'include/securimage/securimage_show.php?sid=' + Math.random(); return false" title='Refresh'><img src=include/securimage/images/refresh.png></a></td><?php

	echo"<td valign=bottom><input type='text' name='code' style='width:50' maxlength='4'><br/></td></td></tr>";
	echo"<tr><td colspan='5'><br><center><input type='hidden' name='send'>";

	?><a href='#' onClick="document.getElementById('send').submit()" class="send" name="send"></a><?php

	echo"</center></td><td></table><br></form></tr></td></table>";

 	require "templates/$them/bottomline.php";
?>