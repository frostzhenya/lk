<?php 
/*-------------------------------------------------------+
| lkfusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: admin.php
| Author: lovepsone
| completed: 50%
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/
  
	require_once "config/config.php";
	require "include/functions.php";
	require "locale/language.php";
	require "include/auth.php";
	require "templates/$them/topmenu.php";
	require "include/authpanel.php";

	echo"<script type='text/javascript' src='include/adminmenu.js'></script>";
	echo"<table width='100%' cellpadding='0' cellspacing='0' border='0' align='center' style='background: url(templates/$them/images/manage_bg.jpg)'>";
	echo"<tr><td class='kategorie'>&nbsp;&nbsp;&nbsp;$txt[176]</td></tr>";
	echo"<tr><td>";

	if($admin['gmlevel'] == $gmlevel)
		{
			$menu = '<table align=center><td align=center><center><br><center><div class="horizontalcssmenu">
				<ul id="cssmenu1">
					<li style="border-left: 1px solid #202020;"><a>'.$txt[177].'</a> 
						<ul>
    						<li><a href="admin.php?add">'.$txt[178].'</a></li>
    						<li><a href="admin.php?edit">'.$txt[179].'</a></li>
    						<li><a href="admin.php?delete">'.$txt[180].'</a></li>
    						</ul></li>

					<li style="border-left: 1px solid #202020;"><a>'.$txt[181].'</a> 
						<ul>
    						<li><a href="admin.php?password">'.$txt[182].'</a></li>
    						<li><a href="admin.php?email">'.$txt[183].'</a></li>
    						<li><a href="admin.php?transfer">'.$txt[184].'</a></li>
    						</ul></li>

					<li style="border-left: 1px solid #202020;"><a>'.$txt[185].'</a> 
						<ul>
    						<li><a href="admin.php?ban">'.$txt[186].'</a></li>
    						<li><a href="admin.php?unbanip">'.$txt[187].'</a></li>
    						<li><a href="admin.php?unbanacc">'.$txt[188].'</a></li>
    						</ul></li>

					<li style="border-left: 1px solid #202020;"><a>'.$txt[189].'</a> 
						<ul>
    						<li><a href="admin.php?bonuswastes">'.$txt[190].'</a></li>
    						<li><a href="admin.php?addbonuses">'.$txt[191].'</a></li>
    						</ul></li>

					<li style="border-left: 1px solid #202020;"><a>'.$txt[192].'</a> 
						<ul>
    						<li><a href="admin.php?ticket">'.$txt[192].'</a></li>
    						</ul></li>

					<li style="border-left: 1px solid #202020;"><a>'.$txt[291].'</a> 
						<ul>
    						<li><a href="admin.php?item">'.$txt[292].'</a></li>
    						</ul></li>
				</ul><br style="clear: left;" /></div></center></td></table><br><br>';

			echo $menu;
		}

	echo"<font class='news' align='center'>";

	selectDb('lk');
	@$news=$_POST['news'];
	@$create=$_POST['create'];
	@$news_edit=$_POST['news_edit'];

	//Функция добавления бана
	if(isset($_POST['addban']))
		{

			if($_POST['hourban'] == '' or $_POST['reasonban'] == '' or $_POST['idban'] == '')
				{
					echo '<center>'.$txt[193].'</center><br>';
				}
			elseif($_POST['type'] == 'cancel')
				{
					echo '<center>'.$txt[194].'</center><br>';
				}
			else
				{
					if($_POST['type'] == 'account')
						{
							selectDb('realmd');
							$bantime = time() + (3600 * $_POST['hourban']);
							$result = mysql_query ("INSERT INTO `account_banned` (id, bandate, unbandate, bannedby, banreason, active) VALUES ( '$_POST[idban]' , ".time().", '$bantime ', '$uzivatel', '$_POST[reasonban]', '1')");

							if ($result == 'true')
								{
									echo "<center>$txt[195]</center><br>";
								}
							else
								{
									echo "<center>$txt[196]</center><br>";
								}
						}
					elseif($_POST['type'] == 'ip')
						{
							selectDb('realmd');
							$bantime = time() + (3600 * $_POST['hourban']);
							$result = mysql_query ("INSERT INTO ip_banned (ip, bandate, unbandate, bannedby, banreason) VALUES ('$_POST[idban]',".time().",$bantime,'$uzivatel','$_POST[reasonban]')");

							if ($result == 'true')
								{
									echo "<center>$txt[197]</center><br>";
								}
							else
								{
									echo "<center>$txt[198]</font></center><br>";
								}
						}

				}
		}

	//Функция удаления бана с ip
	if(isset($_POST['delbanip']))
		{

			if(empty($_POST['id']))
				{
					echo "<center>$txt[214]</center><br><br>";
				}
			else
				{
					selectDb('realmd');
					$result = mysql_query ("DELETE FROM `ip_banned` WHERE `ip`='$_POST[id]'");


					if ($result == 'true')
						{
							echo "<center>$txt[199]</center><br>";	
						}
					else
						{
							echo "<center>$txt[200]</center><br>";
						}
				}
		}

	//Функция удаления бана с аккаунта
	if(isset($_POST['delbanacc']))
		{

			if(empty($_POST['id']))
				{
					echo "<center>$txt[194]</center><br><br>";
				}
			else
				{
					selectDb('realmd');
					$result = mysql_query ("UPDATE `account_banned` SET active=0 WHERE `id`='$_POST[id]'");

					if ($result == 'true')
						{
							echo "<center>$txt[199]</center><br>";
						}
					else
						{
							echo "<center>$txt[200]</center><br>";
						}
				}
		}

	//Функция создания новости
	if(isset($create))
		{

			if(empty($news))
				{
					echo'<center>'.$txt[201].'</center><br>';
				}
			else
				{
					$news = str_replace("\n", "<br>", $news);
					$result = mysql_query ("INSERT INTO news (date,news) VALUES ('$date','$news')");

					if ($result == 'true')
						{
							echo"<center>$txt[202]</center><br>";
						}
					else
						{
							echo"<center>$txt[203]</center><br>";
						}
				}
		}

	//Функция удаления логов password
	if(isset($clearpass))
		{

			$result = mysql_query ("DELETE FROM `logs` WHERE `type`='password'");
			if ($result == 'true')
				{
					echo "<center>$txt[204]</center><br>";
				}
			else
				{
					echo "<center>$txt[205]</center><br>";
				}
		}

	//Функция удаления логов email
	if(isset($clearemail))
		{

			$result = mysql_query ("DELETE FROM `logs` WHERE `type`='email'");
			if ($result == 'true')
				{
					echo "<center>$txt[204]</center><br>";
				}
			else
				{
					echo "<center>$txt[205]</center><br>";
				}
		}

	//Функция удаления логов трансфера
	if(isset($cleartransfer))
		{

			$result = mysql_query ("DELETE FROM `logs` WHERE `type`='transfer'");
			if ($result == 'true')
				{
					echo "<center>$txt[204]</center><br>";
				}
			else
				{
					echo "<center>$txt[205]</center><br>";
				}
		}


	//Функция редактирования ticket'a
	if(isset($_POST['edit_ok']))
		{

			if(empty($_POST['ticket_text']))
				{
					echo'<center>$txt[201]</center><br>';
				}
			else
				{
					selectDb('characters');
					$result = mysql_query ("UPDATE `character_ticket` SET `ticket_text`='$_POST[ticket_text]' WHERE ticket_id='$_POST[id]'");

					if ($result == 'true')
						{
							echo "<center>$txt[206]</center><br>";
						}
					else
						{
							echo "<center>$txt[207]</center><br>";
						}
				}
		}

	//Функция удаления ticket'a
	if(isset($_POST['ticket_delete']))
		{

			if(empty($_POST['id']))
				{
					echo "<center>'.$txt[208].'</center><br><br>";
				}
			else
				{
					selectDb('characters');
					$result = mysql_query ("DELETE FROM `character_ticket` WHERE `ticket_id`='$_POST[id]'");

					if ($result == 'true')
						{
							echo "<center>$txt[209]</center><br>";
						}
					else
						{
							echo "<center>$txt[210]</center><br>";
						}
				}
		}

	//Функция редактирования новости
	if(isset($_POST['edit_news']))
		{

			if(empty($news_edit))
				{
					echo'<center>$txt[193]</center><br>';
				}
			else
				{
					$result = mysql_query ("UPDATE `news` SET `news`='$news_edit' WHERE id='$_POST[id]'");

					if ($result == 'true')
						{
							echo "<center>$txt[211]</center><br>";
						}
					else
						{
							echo "<center>$txt[212]</center><br>";
						}
				}
		}


	//Функция удаления новости
	if(isset($_POST['del']))
		{
			if(empty($_POST['id']))
				{
					echo "<center>$txt[213]</center><br><br>";
				}
			else
				{
					$result = mysql_query ("DELETE FROM `news` WHERE `id`='$_POST[id]'");

					if ($result == 'true')
						{
							echo "<center>$txt[214]</center><br>";
						}
					else
						{
							echo "<center>$txt[215]</center><br>";
						}
				}
		}

	//Функция добавления предмета на аукцион
	if(isset($_POST['additem']))
		{
			if($_POST['nameitem'] == '' or $_POST['iditem'] == '' or $_POST['valitem'] == '' or $_POST['lvlitem'] == '')
				{
					echo '<center>'.$txt[193].'</center><br>';
				}
			else
				{
					if($_POST['valitem'] && $_POST['nameitem'] && $_POST['iditem'])
						{
							if($lang == 'ru'){$name_item_loc='name_item_loc8';}else{$name_item_loc='name_item_loc1';}

							selectDb('lk');
							$result = mysql_query ("INSERT INTO `additem` (id, $name_item_loc, lvl_item,  val) VALUES ( '$_POST[iditem]', '".mysql_escape_string($_POST['nameitem'])."','$_POST[lvlitem]', '$_POST[valitem]')");

							if ($result == 'true')
								{
									echo "<center>$txt[322]</center><br>";
								}
							else
								{
									echo "<center>$txt[323]</center><br>";
								}
						}

				}
		}

	//=========================================ФОРМЫ=========================================//

	//Если add,то выводим форму:
	if(isset($_GET['add']))
		{
			$reason='<center><form action="admin.php?add" method="POST">'.$txt[216].'<br><textarea style="width:450px;height:150px;" name="news"></textarea><br><br><input type=submit value='.$txt[178].' name="create"></form></center><br>';
		}

	//Если items,то выводим форму:
	elseif(isset($_GET['item']))
		{
			echo"<form action='admin.php?item' method='POST'>";
			echo"<table width='777' align='center' border='0'>";
			echo"<tr><td>$txt[318]</td>";
			echo"<td><input type='text' name='nameitem' value=''></td></tr>";
			echo"<tr><td>$txt[319]</td>";
			echo"<td><input type='text' name='iditem' value='0'></td></tr>";
			echo"<tr><td>$txt[320]</td>";
			echo"<td><input type='text' name='valitem' value='0'></td></tr>";
			echo"<tr><td>$txt[330]</td>";
			echo"<td><input type='text' name='lvlitem' value='0'></td></tr>";
			echo"<tr><td colspan='2'><input type='submit' value='$txt[321]' name='additem'></td></tr></table></form>";
		}

	//Если edit,то выводим форму:
	elseif(isset($_GET['edit']))
		{

			if(!isset($_POST['edit']) and !isset($_POST['edit_news']))
				{
					$edit=@mysql_query("SELECT * FROM `news` ORDER BY id DESC");

					if($edit) 
						{
							if(mysql_num_rows($edit)!=0) 
								{
									$row = mysql_fetch_array($edit);
									echo "<form action=admin.php?edit method=POST>";
									do
										{
											printf ("<table width=700 align=center border=0><tr><td width=16><input name=id type=radio value='%s'></td><td><b>$txt[217]</b>: %s <b>$txt[218]</b>: %s</td></tr></table>",$row["id"],$row["date"],$row["news"]);
										}
									while ($row = mysql_fetch_array($edit));

									echo"<center><input type=submit name=edit value=$txt[179]></center><br><br></fotm>";
								} 
					else 
						{
							$reason = "<center>'.$txt[219].'</center><br>";
						}
				} 
			else 
				{
					$reason = "<center>'.$txt[220].'</center><br>";
				}
		}



	if(isset($_POST['edit']))
		{
			if($_POST['id']=='')
				{
					echo "<center>$txt[221]</center><br><br>";
				}
			else
				{
					$result = mysql_query("SELECT news,id FROM news WHERE id='$_POST[id]'");
					$myrow = mysql_fetch_array($result);
					$myrow['news'] = str_replace("<br>", "\n", $myrow['news']);
					$reason = '<form action="admin.php?edit" method="POST">'.$txt[216].'<br><textarea style="width:450px; height:150px;" name="news_edit">'.$myrow['news'].'</textarea><br><br><input type=submit value='.$txt[179].' name="edit_news"><input value='.$_POST['id'].' type=hidden name=id></form><br>';
				}
		}
		}


	//Если delete,то выводим форму:
	elseif(isset($_GET['delete']))
		{

			if(!isset($_POST['del']))
				{
					$delete=@mysql_query("SELECT * FROM `news` ORDER BY id DESC");

					if($delete) 
						{

							if(mysql_num_rows($delete)!=0) 
								{
									$row = mysql_fetch_array($delete);
									echo "<form action=admin.php?delete method=POST>";
									do
										{
											printf ("<table width=700 align=center border=0><tr><td width=16><input name=id type=radio value='%s'></td><td><b>$txt[217]</b>: %s <b>$txt[218]</b>:%s </td></tr></table>",$row["id"],$row["date"],$row["news"]);
										}
									while ($row = mysql_fetch_array($delete));
									echo"<center><input type=submit name=del value=$txt[180]></center><br><br></fotm>";

								} 
							else 
								{
									$reason = "<center>'.$txt[219].'</center><br>";
								}
						} 
					else 
						{
							$reason = "<center>'.$txt[220].'</center><br>";
						}
				}



		}


	//Если ban,то выводим форму:
	elseif(isset($_GET['ban']))
		{
			echo '<center><form action=admin.php?ban method=POST><select name="type">
			<option disabled selected value="cancel">'.$txt[222].'</option>
			<option value="ip">'.$txt[223].'</option>
			<option value="account">'.$txt[224].'</option></select><br><br>'.$txt[225].'<br><input type=text name=idban><br><br>'.$txt[226].'<br><input type=text name=hourban><br><br>'.$txt[227].'<br><input type=text name=reasonban><br><br>';

			echo "<br><center><input type='submit' value='$txt[222]' name='$txt[228]'></center></form><br><br>";

		}


	//Если unbanip,то выводим форму:
	elseif(isset($_GET['unbanip']))
		{

			if(!isset($_POST['delbanip']))
				{
					selectDb('realmd');
					$delete=@mysql_query("SELECT * FROM `ip_banned`");

					if($delete) 
						{

							if(mysql_num_rows($delete)!=0) 
								{
									$row = mysql_fetch_array($delete);
									echo "<form action=admin.php?unbanip method=POST>";
									do
										{
											printf ("<table width=700 align=center border=0><tr><td width=16><input name=id type=radio value='%s'></td><td><b>'.$txt[223].'</b>: %s <b>'.$txt[229].'</b>:%s <b>'.$txt[230].'</b>: %s</td></tr></table>",$row["ip"],$row["ip"],$row["bannedby"],$row["banreason"]);
										}
									while ($row = mysql_fetch_array($delete));
									echo"<center><input type=submit name=$txt[231] value=$txt[232]></center><br><br></fotm>";

								} 
							else 
								{
									$reason = "<center>'.$txt[233].'</center><br>";
								}
						} 
					else 
						{
							$reason = "<center>'.$txt[199].'</center><br>";
						}
				}


		}


	//Если unbanacc,то выводим форму:
	elseif(isset($_GET['unbanacc']))
		{

			if(!isset($_POST['delbanacc']))
				{
					selectDb('realmd');
					$delete=@mysql_query("SELECT * FROM `account_banned` WHERE active=1");

					if($delete) 
						{

							if(mysql_num_rows($delete)!=0) 
								{
									$row = mysql_fetch_array($delete);
									echo "<form action=admin.php?unbanacc method=POST>";
									do
										{
											printf ("<table width=700 align=center border=0><tr><td width=16><input name=id type=radio value='%s'></td><td><b>$txt[234]</b> %s <b>$txt[229]</b> %s <b>$txt[230]</b> %s</td></tr></table>",$row["id"],$row["id"],$row["bannedby"],$row["banreason"]);
										}

									while ($row = mysql_fetch_array($delete));
									echo"<center><input type=submit name=delbanacc value=$txt[232]></center><br><br></fotm>";

								} 
							else 
								{
									$reason = "<center>'.$txt[233].'</center><br>";
								}
						} 
					else 
						{
							$reason = "<center>'.$txt[220].'</center><br>";
						}
				}

		}

	//Если ticket,то выводим форму:
	elseif(isset($_GET['ticket']))
		{

			if(!isset($_POST['ticket_edit']) and !isset($_POST['edit_ok']) and !isset($_POST['ticket_delete']))
				{
					selectDb('characters');
					$sql = mysql_query("SELECT * FROM `character_ticket`");

					if($sql) 
						{
							if(mysql_num_rows($sql)!=0) 
								{
									$row = mysql_fetch_array($sql);
									echo "<form action=admin.php?ticket method=POST>";
									do
										{
											selectDb('characters');
											$select_name = mysql_query("SELECT * FROM `characters` WHERE guid='$row[guid]'");
											$myrow = mysql_fetch_array($select_name);
											printf ("<table width=700 align=center border=0><tr><td width=16><input name=id type=radio value='%s'></td><td><b>$txt[235]</b> %s <b>$txt[236]</b> %s</td></tr></table>",$row["ticket_id"],$myrow["name"],$row["ticket_text"]);
										}
									while ($row = mysql_fetch_array($sql));
									echo"<center><input type=submit name=ticket_edit value=$txt[237]><input type=submit name=ticket_delete value=$txt[232]></center><br><br></fotm>";
								} 
							else 
								{
									$reason = "<center>$txt[238]</center><br>";
								}
						} 
					else 
						{
							$reason = "<center>'.$txt[220].'</center><br>";
						}
				}


			if(isset($_POST['ticket_edit']))
				{

					if(empty($_POST['id']))
						{
							echo "<center>$txt[239]</center><br><br>";
						}
					else
						{
							selectDb('characters');
							$result = mysql_query("SELECT * FROM character_ticket WHERE ticket_id='$_POST[id]'");
							$myrow = mysql_fetch_array($result);
							$reason = '<form action="admin.php?ticket" method="POST">'.$txt[240].'<br><textarea style="width:450px; height:150px;" name="ticket_text">'.$myrow['ticket_text'].'</textarea><br><br><input type=submit value=$txt[241] name="edit_ok"><input value='.$_POST['id'].' type=hidden name=id></form><br>';
						}
				}
		}


	//Если password,то выводим форму:
	elseif(isset($_GET['password']))
		{

			$sql = mysql_query("SELECT * FROM `logs` WHERE type='password' LIMIT 1500");

			if($sql) 
				{
					$i=1;
					if(mysql_num_rows($sql)!=0) 
						{
							$row = mysql_fetch_array($sql);
							echo "<form action=admin.php?password method=POST>";
							do
								{
									printf ("<table width='700' align='center' border='0'><tr><td><b>$i</b></td><td> %s </td><td align='right'><b>%s</b></td></tr></table>",$row["text"],$row["date"]);
					 				$i++;
								}
							while ($row = mysql_fetch_array($sql));
							echo "<br><center><input type='submit' value=$txt[242] name='clearpass'></center></form><br><br>";
						} 
					else 
						{
							$reason = "<center>$txt[243]</center><br>";
						}
				} 
			else 
				{
					$reason = "<center>'.$txt[220].'</center><br>";
				}
		}

	//Если transfer,то выводим форму:
	elseif(isset($_GET['transfer']))
		{

			$sql = mysql_query("SELECT * FROM `logs` WHERE type='transfer' LIMIT 1500");

			if($sql) 
				{
					$i=1;
					if(mysql_num_rows($sql)!=0) 
						{
							$row = mysql_fetch_array($sql);
							echo "<form action=admin.php?transfer method=POST>";
							do
								{
									printf ("<table width='700' align='center' border='0'><tr><td><b>$i</b></td><td> %s </td><td align='right'><b>%s</b></td></tr></table>",$row["text"],$row["date"]);
									$i++;
								}
							while ($row = mysql_fetch_array($sql));
							echo "<br><center><input type='submit' value=$txt[242] name='cleartransfer'></center></form><br><br>";
						} 
					else 
						{
							$reason = "<center>$txt[243]</center><br>";
						}
				} 
			else 
				{
					$reason = "<center>'.$txt[220].'</center><br>";
				}
		}


	elseif(isset($_GET['addbonuses']))
		{
			if ($_POST['add'] && $_POST['login']) 
				{
					selectDb('realmd');
					$bonuses = intval($_POST['add']);
					$check = mysql_query("SELECT * FROM account WHERE username='".mysql_escape_string($_POST['login'])."';");
					
					$sql = mysql_query("UPDATE account SET bonuses = bonuses + ".$bonuses." WHERE username='".mysql_escape_string($_POST['login'])."';");
					if (mysql_num_rows($check) > 0) 
						{
							if ($sql) 
								{
									echo "<center>$txt[244]</center><br>";
					  			} 
							else 
								{
									echo '<center>$txt[245]</center><br>';
				     				}
						} 
					else 
						{
							echo '<center>'.$txt[246].'</center><br>';
			     			}
				} 

			elseif ($_POST['add'] && $_POST['charname']) 
				{
					selectDb('characters');
					$check1 = mysql_query("SELECT `account` FROM characters WHERE name='".mysql_escape_string($_POST['charname'])."' LIMIT 1");
	
					selectDb('realmd');
					$bonuses = intval($_POST['add']);
					if (mysql_num_rows($check1) > 0) 
						{
							$account = mysql_result($check1,0);
							$check2 = mysql_query("SELECT * FROM account WHERE id='".intval($account)."';");
							$sql = mysql_query("UPDATE account SET bonuses = bonuses + ".$bonuses." WHERE id='".intval($account)."';");

							if (mysql_num_rows($check2) > 0) 
								{
					
									if ($sql) 
										{
											if ($bonuses > 0) 
												{
													echo '<center>'.$txt[247].'</center><br>';
												} 
											else 
												{
							
													echo '<center>'.$txt[248].'</center><br>';
												}
										} 
									else 
										{
											echo '<center>'.$txt[249].'</center><br>';
										}
								} 
							else 
								{
									echo '<center>'.$txt[250].'</center><br>';
								}
						} 
					else 
						{
							echo '<center>'.$txt[251].'</center><br>';
						}
				} 
			else 
				{
?>
					<form action=admin.php?addbonuses method=POST>
					<table width='700' align='center' border='0'><tr><td><?php echo $txt[252]; ?></td>
					<td><input type="text" name="login" value=""></td></tr>
					<tr><td><?php echo $txt[253]; ?></td>
					<td><input type="text" name="charname" value=""></td></tr>
					<tr><td><?php echo $txt[254]; ?></td>
					<td><input type="text" name="add" value="0"></td></tr>
					<tr><td colspan="2"><input type="submit" value='<?php echo $txt[255]; ?>'></td></tr></table></form>
<?php
				}
		}

	//Если email,то выводим форму:
	elseif(isset($_GET['email']))
		{

			$sql = mysql_query("SELECT * FROM `logs` WHERE type='email' LIMIT 1500");

			if($sql) 
				{
					$i=1;
					if(mysql_num_rows($sql)!=0) 
						{
							$row = mysql_fetch_array($sql);
							echo "<form action=admin.php?email method=POST>";
							do
								{
									printf ("<table width='700' align='center' border='0'><tr><td><b>$i</b></td><td> %s </td><td align='right'><b>%s</b></td></tr></table>",$row["text"],$row["date"]);
					 				$i++;
								}
							while ($row = mysql_fetch_array($sql));
							echo "<br><center><input type='submit' value=$txt[242] name='clearemail'></center></form><br><br>";
						} 
					else 
						{
							$reason = "<center>$txt[243]</center><br>";
						}
				} 
			else 
				{
					$reason = "<center>$txt[220]</center><br>";
				}

		} 

	elseif(isset($_GET['bonuswastes']))
		{
			$result = mysql_query ("SELECT * FROM `bonuswastes` LIMIT 50");

			if (mysql_num_rows($result) > 0) 
				{
?>
					<script src="http://www.wowhead.com/widgets/power.js"></script>
					<table width="100%" align="center" cellpadding="0" cellspacing="0">
					<tr width="100%" height="24" style="background: #fff;">
					<td align="center" width="20%"><b><?php echo $txt[256]; ?></b></td>
					<td align="center" width="20%"><b><?php echo $txt[257]; ?></b></td>
					<td align="center" width="20%"><b><?php echo $txt[258]; ?></b></td>
					<td align="center" width="20%"><b><?php echo $txt[259]; ?></b></td>
					<td align="center" width="20%"><b><?php echo $txt[260]; ?></b></td></tr>
<?php
					while ($waste = mysql_fetch_array($result)) 
						{
							if ($waste['service_type'] == 1) 
								{
									$info = $txt[261];
								} 

							elseif ($waste['service_type'] == 2) 
								{
									$info = $waste['service_info'].$txt[262];
								} 	

							elseif ($waste['service_type'] == 4) 
								{
									$info = ''.$txt[263].' ('.$waste['service_info'].')';
								} 
							else 
								{
									$info = '<a href="http://wowhead.com/?item='.$waste['service_info'].'" class="linkchar" target="_blank">'.$txt[264].'</a>';
								}
?>
							<tr onmouseover="this.style.background='#f25f5f';" onmouseout="this.style.background=''">
							<td align="center"><?php echo $info ?></td>
							<td align="center"><?php echo $waste['acct'] ?></td>
							<td align="center"><?php echo $waste['guid'] ?></td>
							<td align="center"><?php echo $waste['bonuses'] ?></td>
							<td align="center"><?php echo $waste['date'] ?></td></tr>
<?php
						}
					echo"</table>";
				} 
			else 
				{
					echo "<center>$txt[265]</center><br>";
				}
		} 
	else 
		{
			$reason='<center><form action="admin.php?add" method="POST">'.$txt[216].'<br><textarea style="width:450px; height:150px;" name="news"></textarea><br><br><input type=submit value='.$txt[178].' name="create"></form></center><br>'; 
		}

	if($admin['gmlevel'] == $gmlevel)
		{
			echo @$reason;
		}
	else
		{
			echo "<br><center>$txt[266]</center><br><br>";
		}

	echo"</font></td></tr></table>";

	require "templates/$them/bottomline.php";
?>



