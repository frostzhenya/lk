<?php 
/*-------------------------------------------------------+
| lkfusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: index.php
| Author: lovepsone
| completed: 80%
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	session_start();
	error_reporting(E_ALL);	

	require "config/config.php";
	require "include/functions.php";
	require "locale/language.php";

	if(isset($_SESSION['login']))
		{
			Header('Location: '.$startmodule.'');
		} 

	if(!isset($_POST['login']))
		{
			$jmeno = addslashes(!empty($_POST['jmeno']));
			$heslo = addslashes(!empty($_POST['heslo']));
		}
	else
		{
			$jmeno = addslashes($_POST['jmeno']);
			$heslo = addslashes($_POST['heslo']);
		}

	if ($jmeno == "" || $heslo == "")
		{
			include ('templates/'.$them.'/topmenu.php');
			$reason = $txt[1];
		}
	else
		{
			$jmeno = addslashes($_POST['jmeno']);
			$heslo = addslashes($_POST['heslo']);
			$jmeno = strtoupper($jmeno);
			$heslo = strtoupper($heslo);
			$heslo = sha_password($jmeno,$heslo);
		
			selectDb('realmd');
			$sql="SELECT * FROM account WHERE username='".$jmeno."' AND sha_pass_hash='".$heslo."'";
			$result = mysql_query($sql);
			$vysledek = mysql_fetch_array($result);


			if ($vysledek['username'] == "")

				{
    					include ('templates/'.$them.'/topmenu.php');
    					$reason = "<font color=\"darkred\">$txt[2]</font>";
				}

			elseif ($vysledek['username'] != "")
				{ 
					$user = $vysledek['username'];
					$_SESSION['loged'] = "ano";
					$_SESSION['user'] = $vysledek['username'];
					$_SESSION['id'] = $vysledek['id'];
					Header('Location: '.$startmodule.'?id='.$vysledek[id].'');
				}
		}

	echo"<img src='templates/$them/images/center-top.png'><br>";
	echo"<table align='center' width='689' height='289' border='0' cellspacing='0' cellpadding='0'>";
	echo"<tr><td width='383' height='289' class='center-left'>";
	echo"<form action='$_SERVER[PHP_SELF]' method='POST' id='login'>";
	echo"<p class='center-left-content'>$txt[3]<br><input type='text' class='input-center' name='jmeno'><br><br>$txt[4]<br>";
	echo"<input type='password' class='input-center' name='heslo'><br><br>";
	?><a href='#' onClick="document.getElementById('login').submit()" class="login" name="login" style="padding-left: 82px"></a><?php
	echo"<td width='306' height='289' class='center-right' valign=top>";
	echo"<p class='center-right-content'>$reason</p></td></tr></table>";
	echo"<img src='templates/$them/images/center-buttom.png'><br></th></tr>";
 
	require "templates/$them/bottomline.php";	
?>
