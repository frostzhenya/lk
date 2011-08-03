<?php 
/*-------------------------------------------------------+
| lkfusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: commands.php
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
	require "templates/$them/topmenu.php";
	require "locale/language_game_commands.php";
	require "locale/language.php";
	require "include/authpanel.php";
	require "mainform/centermenu.php";
	require "mainform/rightmenu.php";
	//require "mainform/leftmenu.php";

	$number=1;

	echo "<table width='75%' cellpadding='0' cellspacing='0' border='0' style='background : url(templates/$them/images/manage_bg.jpg)'>";
	echo "<tr><td class='commands'>";
	echo "<table border='0' width='100%'>";
	echo "<tr><td width='2%' align='center' class='title'>$txt[156]</td>";
	echo "<td width='22%' align='center' class='title'>$txt[157]</td>";
	echo "<td width='36%' align='center' class='title'>$txt[158]</td>";
	echo "<td width='40%' align='center' class='title'>$txt[159]</td></tr></table></td></tr>";
	echo "<tr><td align='left'><table class='commands' valign='top' align='center'>";

	while($row = mysql_fetch_array($prehled_realmd_vypis))
		{
			$name_commands = $row['name_commands'];
			$syntax = $row['syntax'];

			if(empty($lang_commands['ru']))
				{
					$commands_text= $row['commands_text_loc1']; 
				}
			else
				{
					$commands_text = $row['commands_text_loc8'];
				}
			print "<table align=\"center\" cellSpacing=\"0\" cellPadding=\"10\" width=\"100%\" border=\"0\" class=\"bgcolor4\"><tr>
			<td width=\"2%\" align=\"center\"  border=\"0\" ><b>$number</b></td>
			<td width=\"22%\" align=\"center\"  border=\"0\" ><font color=\"green\"><b>$name_commands</b></font></td>
			<td width=\"36%\" align=\"center\"  border=\"0\" ><font color=\"green\"><b>$syntax</b></font></td>
			<td width=\"40%\" align=\"left\"  border=\"0\" ><font color=\"green\">$commands_text</font></td><tr></table>";
			$number++;
		}

	echo"</td></table><br></td></tr></table>";

	require "templates/$them/bottomline.php"; 
?>