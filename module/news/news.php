<?php
/*-------------------------------------------------------+
| lkfusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: news.php
| Author: lovepsone
| completed: 0%
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/


	//новости
	echo"<table width='50%' cellpadding='0' cellspacing='0' border='0' align='center' style='background: url(templates/$them/images/bg.png);'>";
	echo"<tr><td style='background: url(templates/$them/images/manage.jpg);' class='mltbl'>&nbsp;&nbsp;&nbsp;$txt[30]</td></tr>";
	echo"<tr><td align='center' width='50%' class='brtbl'>";

	selectDb('lk');
	$news=mysql_query("SELECT * FROM `news` ORDER BY id DESC");

	if($news) 
		{
			if(mysql_num_rows($news)!=0) 
				{
					$row = mysql_fetch_array($news);
					$i=1;
					do
						{
							printf ("<table width=600 align=left border=0><tr><td  width=600 ><font class=news>$i)%s</td></tr><tr><td align=right><font style='font-size: 10px' color='green'>$txt[31]</font></td></tr></table></font><br><center><img src=templates/$them/images/oddel.jpg></center><br>",$row["news"],$row["date"]);
							$i++;
						}
					while ($row = mysql_fetch_array($news));
				} 
			else 
				{
					echo "$txt[32]";
				}
		} 
	else 
		{
			echo "$txt[33]";
		}

	echo"</td></tr></table><br><br>";
?>	