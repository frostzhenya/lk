<?PHP	/*завершенность: 90%*/ 

	include('config/config.php');
	include('include/functions.php');
	include('include/auth.php');
	include('templates/'.$them.'/topmenu.php');
	include('locale/language.php');
	include('include/log_info.php');
	open();

	echo "<img src='templates/$them/images/logo.png' vspace='15'>
	<table width='343' cellpadding='0' cellspacing='0' border='0' rules='none' align='center' style='background : url(templates/$them/images/typ_bg.jpg)'>
	<tr><td class='typ'>&nbsp;&nbsp;&nbsp;$txt[160]</td></tr>
	<tr><td align='center'><table class='typ' valign='top' align='center'>";

	if($replace=="on")
		{
			if(!isset($_POST['action']))
				{
					echo '<form method="POST">
					<table><tr style="text-align:center;">
					<td colspan="2" style="padding:15px 0px;"><strong>'.$txt[161].$transfercostage.$txt[162].'</strong></td></tr>
					<tr><td>'.$txt[131].'</td><td><input type="text" name="p_acc"></td></tr>
					<tr><td>'.$txt[132].'</td><td><input type="password" name="p_pass"></td></tr>
					<tr><td>'.$txt[133].'</td><td><input type="text" name="p_char_name"></td></tr>
					<tr><td>'.$txt[163].'</td><td><input type="text" name="p_new_owner"></td></tr></table>
					<input type="hidden" name="action" value="save"><br>
					<input type="submit" value="'.$txt[164].'"></form><br><br>';
				}

			if (isset($_POST['action']) == "save")
				{
					$account=$_POST['p_acc'];
					$password=$_POST['p_pass'];
					$charname=$_POST['p_char_name'];
					$newaccount=$_POST['p_new_owner'];
					$hash = SHA1(strtoupper($account.":".$password));

					if($charname == '' or $newaccount == '')
						{
							echo "<br><center>$txt[165]<br><br><a href='transfercharacter.php'>
							$txt[122]</a></table><br></td></tr></table></center>";
							include ('templates/'.$them.'/patka.php');
							die;
						}

					selectDb('realmd');
					$query = "SELECT sha_pass_hash,id FROM account WHERE username='".$account."'";
					$tmp = mysql_query($query);
					$remhash = mysql_fetch_array($tmp);

					if($hash!=$remhash['sha_pass_hash']) 
						{
							echo "<br><center>$txt[166]<br><br><a href='transfercharacter.php'>
							$txt[122]</a></table><br></td></tr></table></center>";
							include ('templates/'.$them.'/patka.php');
							die;
						}

					selectDb('realmd');
					$sql = "SELECT id FROM account_banned WHERE id='".$remhash['id']."'";
					$temp = mysql_query($sql);
					$result = mysql_fetch_array($temp);

					if(empty($result['id']))
						{

							$query = "SELECT id FROM account WHERE username='".$newaccount."'";
							$tmp = mysql_query($query);
							$newacc = mysql_fetch_array($tmp);

							if(empty($newacc['id']))
								{
									echo "<br><center>$txt[131] $newaccount $txt[167]<br><br><a href='transfercharacter.php'>
									$txt[122]</a></table><br></td></tr></table></center>";
									include ('templates/'.$them.'/patka.php');
									die;

								}
							else
								{

									selectDb('characters');
									$query = "SELECT race FROM characters WHERE account='".$newacc['id']."' LIMIT 1";
									$tmp = mysql_query($query);
									$newchar = mysql_fetch_array($tmp);

									if($newchar['race']=='2' OR $newchar['race']=='5' OR $newchar['race']=='6' OR $newchar['race']=='8' OR $newchar['race']=='10') $orc=1;
									if($newchar['race']=='1' OR $newchar['race']=='3' OR $newchar['race']=='4' OR $newchar['race']=='7' OR $newchar['race']=='11') $all=1;

									if(empty($newchar['race']))
										{
											$orc=1;
											$all=1;
										}
								}


							selectDb('characters');
							$query = "SELECT race FROM characters WHERE name='".$charname."' AND account='".$remhash['id']."' ";
							$tmp = mysql_query($query);
							$remacc = mysql_fetch_array($tmp);

							if(empty($remacc['race']))
								{
									echo "<center>$txt[168] $charname $txt[167]<br><br><a href='transfercharacter.php'>
									$txt[122]</a></table><br></td></tr></table></center>";
									include ('templates/'.$them.'/patka.php');
									die;

								}
							else
								{
									if($remacc['race']=='2' OR $remacc['race']=='5' OR $remacc['race']=='6' OR $remacc['race']=='8' OR $remacc['race']=='10') $orc2=1;
									if($remacc['race']=='1' OR $remacc['race']=='3' OR $remacc['race']=='4' OR $remacc['race']=='7' OR $remacc['race']=='11') $all2=1;

									if ($twofactions == 'off')
										{

											if(@$orc!=@$orc2 AND @$all!=@$all2) 
												{
													echo "<br><center>$txt[169]<br><br><a href='transfercharacter.php'>
													$txt[122]</a></table><br></td></tr></table></center>";
													include ('templates/'.$them.'/patka.php');
													die;

												}
											else
												{	
													selectDb('realmd');
													$bonuses = @mysql_result(mysql_query("SELECT `bonuses` FROM account WHERE id=$id LIMIT 1"),0);
													if ($bonuses = $renamecostage) 
														{
															$sql = mysql_query("UPDATE account SET bonuses=bonuses-".$transfercostage." WHERE id=$id");
															if ($sql) 
																{
																	selectDb('characters');
																	$query = "UPDATE characters SET account='".$newacc['id']."' WHERE name='".$charname."'";
																	$tmp = mysql_query($query);

																	selectDb('lk');
																	mysql_query("INSERT INTO logs (date,name,text,type) VALUES ('$date','$uzivatel','С аккаунта <b>$uzivatel</b> был перенесен персонаж <b>$charname</b> на аккаунт <b>$newaccount</b>!','transfer')");

																	echo "<br><center>$txt[170] <font color='green'>$txt[171]</font></center><br>";
																} 
															else 
																{
																	echo "<br><center>$txt[172]</center><br>";
																}
														} 
													else 
														{
															echo "<br><center>$txt[173]</center><br>";
														}
												}

										}
									else
										{
											selectDb('realmd');
											$bonuses = @mysql_result(mysql_query("SELECT `bonuses` FROM account WHERE id=$id LIMIT 1"),0);
											if ($bonuses >= $renamecostage) 
												{
													$sql = mysql_query("UPDATE account SET bonuses=bonuses-".$transfercostage." WHERE id=$id");

													if ($sql) 
														{			
															selectDb('characters');
															$query = "UPDATE characters SET account='".$newacc['id']."' WHERE name='".$charname."'";
															$tmp = mysql_query($query);

															selectDb('lk');
															mysql_query("INSERT INTO logs (date,name,text,type) VALUES ('$date','$uzivatel','С аккаунта <b>$uzivatel</b> был перенесен персонаж <b>$charname</b> на аккаунт <b>$newaccount</b>!','transfer')");

															echo "<br><center>$txt[170] <font color='green'>$txt[171]</font></center><br>";
														} 
													else 
														{
															echo "<br><center>$txt[172]</center><br>";
														}
													} 
											else 
												{
													echo "<br><center>$txt[173]</center><br>";
												}
										}
								}
						}
					else
						{
							echo "<br><center>$txt[131] <b>$account</b> <font color='red'>$txt[174]</font></center><br>";
						}
					mysql_close();
				}
		}
	else
		{
			echo "<br><center>".$txt[115]."<br><br><a href=manage.php>$txt[175]</a></center>";}
?>
</table><br>
</td></tr>
</table>

<?php include ('templates/'.$them.'/patka.php'); ?>