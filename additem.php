<?php
/*-------------------------------------------------------+
| lkfusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: additem.php
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
	require "mainform/leftmenu.php";

	echo"<script src='http://www.wowhead.com/widgets/power.js'></script>";

	if(isset($_GET['item']))
		{
			include ('mainform/rightmenu.php');
			echo"<table width='50%' cellpadding='0' cellspacing='0' rules='none' align='center' style='background: url(templates/$them/images/typ_bg.jpg)'>";
			echo"<tr><td class='typ'>&nbsp;&nbsp;&nbsp;$txt[54]</td></tr>";
			echo"<tr><td align='center'>";

			echo"<table width='100%' class='typ' valign='top' cellpadding='2'>";
			echo"<tr><td colspan='4' align='left'><img src='templates/$them/images/cara.png' width='90%'></td></tr><br>";
 			
   			selectDb('characters');
			$prehled_chary = "SELECT guid, name, race, class, totaltime, money, SUBSTRING(LPAD(HEX(CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(`level`,' ',23),' ',-1) AS UNSIGNED)),8,'0'),4,1) AS gender ,CAST( SUBSTRING_INDEX(SUBSTRING_INDEX(`level`, ' ', 54), ' ', -1) AS UNSIGNED) AS level ,zone FROM `characters` WHERE account = $id" ;
   			$result = mysql_query($prehled_chary);

  			while ($prehled_chary_vypis = mysql_fetch_array($result))
  				{
					$name = $prehled_chary_vypis["name"];
					$guid = $prehled_chary_vypis["guid"];
					$race = $prehled_chary_vypis["race"];
					$gender = $prehled_chary_vypis["gender"];
					$class = $prehled_chary_vypis["class"];

    					echo"<tr><td align='left' width='10%'><img src='images/race/small/$race-$gender.gif'></td>";
					echo"<td align='left' width='10%'><img src='images/class/small/$class.gif'></td>";
					echo"<td align='left' width='50%'><strong>$name</strong></td>";
					echo"<th width='5%'><form action='additem.php?guid=$guid' method='POST' name='$name' id='$guid'><input type='hidden' name='name' value='$name'><a href='#' onClick='document.getElementById(".$prehled_chary_vypis["guid"].").submit()' class='arrow' name='change'></a></form></th></tr>";
					echo"<tr><td colspan='4' align='left'><img src='templates/$them/images/cara.png' width='90%'></td></tr>";
  				}
			echo"</table><br></td></tr></table>";
		}

	if(isset($_POST['name']))
		{
			echo"<form action='additem.php?guid=$guid' method=POST>";

			echo"<table width='74%' cellpadding='0' cellspacing='0' border='0' rules='none' align='center' style='background: url(templates/$them/images/typ_bg.jpg)'>";
			echo"<tr><td class='typ'>&nbsp;&nbsp;&nbsp;$txt[290]</td></tr>";
			echo"<tr><td align='right'>";//<script type='text/javascript' src='include/jquery.js'></script>

			echo"<table width='100%' class='typ' valign='top' cellpadding='2'>";

			echo"<tr><td width='10%' align='left' class='item'>$txt[323]</td>";
			echo"<td width='10%' align='left' class='item'></td>";
			echo"<td width='50%' align='left' class='item'>$txt[324]</td>";
			echo"<td width='10%' align='left' class='item'>$txt[325]</td>";
			echo"<td width='30%' align='left'class='item'>$txt[326]$_POST[name]</td></tr>";
			echo"<tr><td colspan='5' align='left'><img src='templates/$them/images/cara.png' width='90%'></td></tr><br>";

			selectDb('lk');
			$prehled_lk = "SELECT additem.id, additem.name_item_loc1, additem.name_item_loc8, additem.lvl_item, additem.val, itemicon.name FROM additem, itemicon where additem.id = itemicon.entry";
   			$prehled_lk_vypis = mysql_query($prehled_lk);
	
			while ($row = mysql_fetch_array($prehled_lk_vypis))
				{
					if($lang == 'ru'){ $nameitem = $row['name_item_loc8'];}else{$nameitem = $row['name_item_loc1'];}

					$valitem = $row["val"];
					$iditem = $row["id"];
					$itemicon = $row["name"];
					$lvlitem = $row["lvl_item"];

					echo"<tr><td width='10%' align='left' class='item'>$lvlitem</td>";
					echo"<td width='10%' align='left' class='item'><a href='http://ru.wowhead.com/?item=$iditem' class='linkchar' target='_blank'><img src='images/icons/".$itemicon.".jpg'></a></td>";
					echo"<td width='35%' align='left' class='item'><a href='http://ru.wowhead.com/?item=$iditem' class='linkchar' target='_blank'>$nameitem</a></td>";
					echo"<td width='10%' align='left' class='item'><font color='yellow'>$valitem $txt[162]</font></td>";
					echo"<td width='30%' align='left' class='item'><form action='additem.php?iditem=$iditem' method='POST' name='$guid' id='$iditem'><input type='hidden' name='guid' value='$guid'><a href='#' onClick='document.getElementById(".$iditem.").submit()' class='arrow' name='change'></a></form></td></tr>";
					echo"<tr><td colspan='5' align='left'><img src='templates/$them/images/cara.png' width='90%'></td></tr>";
				}

			echo"</table></td></tr></table></form>";
		}
	elseif(isset($_POST['guid']))
		{
			include ('mainform/rightmenu.php');
			$iditem = addslashes($_GET["iditem"]);
			$guid = addslashes($_POST["guid"]);

			echo"<form action='additem.php?iditem=$iditem' method=POST>";
			echo"<table width='50%' cellpadding='0' cellspacing='0' rules='none' align='center' style='background : url(templates/$them/images/typ_bg.jpg)'>";
			echo"<tr><td class='typ'>&nbsp;&nbsp;&nbsp;$txt[54]</td></tr>";
			echo"<tr><td align='center'>";
			echo"<table width='100%' class='typ' valign='top' cellpadding='2'>";

			selectDb('lk');
			$prehled_lk = mysql_query("SELECT * FROM `additem` WHERE `id` = $iditem");

			while ($row = mysql_fetch_array($prehled_lk))
				{
					if($lang == 'ru'){ $nameitem = $row['name_item_loc8'];}else{$nameitem = $row['name_item_loc1'];}
					$valitem = $row['val'];
				}


			selectDb('characters');
			$prehled_char = mysql_query("SELECT `account`, `name` FROM `characters` WHERE `guid` = $guid");

			while ($row = mysql_fetch_array($prehled_char))
				{
					$name = $row['name'];
					$account = $row['account'];
				}

			selectDb('realmd');
			$bonuses = mysql_fetch_array(mysql_query("SELECT * FROM `account` WHERE `id`=$id LIMIT 1"));

			if($bonuses["bonuses"] >= $valitem)
				{
					$client = new SoapClient(NULL,array( "location" => "http://$host:$soapport/", "uri" => "urn:MaNGOS", "style" => SOAP_RPC, 'login' => $username, 'password' => $password ));
					try 	{
							$command = 'send items '.$name.' "Purchase of the subject" "You have successfully purchased at auction item. Thank you for your purchase!" '.$iditem;

							selectDb('realmd');
							mysql_query("UPDATE account SET bonuses=bonuses-".$valitem." WHERE id=$account");

    							$result = $client->executeCommand(new SoapParam($command, "command"));
							echo"<tr><td align='left' width='100%'><b>$txt[328]<a href='http://ru.wowhead.com/?item=$iditem' class='linkchar' target='_blank'>$nameitem</a>$txt[329]$name</b></td></tr>";
						}

					catch (Exception $e)
						{
    							echo "<tr><td align='left' width='100%'>Произошла ошибка!!!</td></tr>";
    							echo $e->getMessage();
						}
				}
			else
				{
					echo"<tr><td align='center' width='100%'>$txt[334]</td></tr>";
				}

			echo"</table></td></tr></table></form>";		
		}

	require "templates/$them/bottomline.php";  
?>