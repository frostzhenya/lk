<?php 
/*-------------------------------------------------------+
| lkfusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: changepassword.php
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

	if(!isset($_POST['change']))
		{
			$oldpw = addslashes(!empty($_POST["oldpw"]));
			$newpw1 = addslashes(!empty($_POST["newpw1"]));
			$newpw2 = addslashes(!empty($_POST["newpw2"]));
		}
	else
		{
			$oldpw = addslashes($_POST["oldpw"]);
			$newpw1 = addslashes($_POST["newpw1"]);
			$newpw2 = addslashes($_POST["newpw2"]);
		}

 	if ($oldpw == "" || $newpw1 == "" || $newpw2 == "")
		{
  			$reason = "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\" id='change'><table width=\"100%\">
  				   <tr><td>".$txt[120].":</td><td><input type=\"password\" name=\"oldpw\"></td></tr>
  				   <tr><td>".$txt[121].":</td><td><input type=\"password\" name=\"newpw1\"></td></tr>
  				   <tr><td>".$txt[122].":</td><td><input type=\"password\" name=\"newpw2\"></td></tr>
  				   <tr><td align=\"center\" colspan=\"2\"><br><input type=\"hidden\" name=\"change\"><a href='#' onClick=\"document.getElementById('change').submit()\" class=\"changepass\" name=\"change\"></a></table>";
  		}
	else
		{

     			$jmeno = strtoupper($uzivatel);
     			$heslo = strtoupper($oldpw);
     			$heslo = sha_password($jmeno,$heslo);
     
  			selectDb('realmd'); 
  			$sql="SELECT * FROM account WHERE username='".$uzivatel."' AND sha_pass_hash='".$heslo."'";
  			$result = mysql_query($sql);
  			$vysledek = mysql_num_rows($result);

    			if ($vysledek != 1)
				{
      					$reason = "<img src='images/no.png'>&nbsp;&nbsp;".$txt[123]."<br><br><a href=pass.php>".$txt[122]."</a>";
    
    				}
			else
				{
     					if ($newpw1 == $newpw2)
						{
     							$heslo = strtoupper($newpw1);
     							$heslo = sha_password($jmeno,$heslo);
     
  							$sql = "UPDATE account SET sha_pass_hash='$heslo' WHERE id=$id";
  							mysql_query($sql) or die ('querry ...');
  
  							selectDb('lk');
  							$sql = mysql_query("INSERT INTO logs (date,name,text,type) VALUES ('$date','$uzivatel','На аккаунте <b>$uzivatel</b> был изменен пароль!','password')");

  							$reason = "<img src='images/yes.png'>&nbsp;&nbsp;".$txt[124];
  						}
					else
						{
  							$reason = "<img src='images/no.png'>&nbsp;&nbsp;".$txt[125]."<br><br><a href=changepassword.php>".$txt[122]."</a>";
						}
				}
		}

	echo"<table width='50%' cellpadding='0' cellspacing='0' border='0' rules='none' align='center' style='background : url(templates/$them/images/typ_bg.jpg)'>
	<tr><td class='typ'>&nbsp;&nbsp;&nbsp;$txt[126]</td></tr>
	<tr><td align='center'><table class='typ' valign='top' align='center'>
	<tr><td align='center'><br>$reason</td></tr></table><br></td></tr></table><br><br>";

	require "templates/$them/bottomline.php"; 
?>
