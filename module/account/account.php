<?php 
/*-------------------------------------------------------+
| lkfusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: index.php
| Author: lovepsone
| completed: 0%
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	//session_start();
	//error_reporting(E_ALL);


	if(isset($_SESSION['login']))
		{
			Header('Location: '.$modules['start'].'');
		} 

	if(!isset($_POST['login']))
		{
			$auth_name = addslashes(!empty($_POST['auth_name']));
			$auth_pass = addslashes(!empty($_POST['auth_pass']));
		}
	else
		{
			$auth_name = addslashes($_POST['auth_name']);
			$auth_pass = addslashes($_POST['auth_pass']);
		}

	if ($auth_name == "" || $auth_pass == "")
		{
			$reason = $txt[1];
		}
	else
		{
			$auth_name = addslashes($_POST['auth_name']);
			$auth_pass = addslashes($_POST['auth_pass']);
			$auth_name = strtoupper($auth_name);
			$auth_pass = strtoupper($auth_pass);
			$auth_pass = sha_password($auth_name,$auth_pass);
		
			selectDb('realmd');
			$sql="SELECT * FROM account WHERE username='".$auth_name."' AND sha_pass_hash='".$auth_pass."'";
			$result = mysql_query($sql);
			$vysledek = mysql_fetch_array($result);


			if ($vysledek['username'] == "")

				{
    					$reason = "<font color=\"darkred\">$txt[2]</font>";
				}

			elseif ($vysledek['username'] != "")
				{ 
					$user = $vysledek['username'];
					$_SESSION['loged'] = "ano";
					$_SESSION['user'] = $vysledek['username'];
					$_SESSION['id'] = $vysledek['id'];
					Header('Location: '.$modules['start'].'');
				}
		}

	echo"<img src='templates/$them/images/center-top.png'><br>";
	echo"<table align='center' width='689' height='289' border='0' cellspacing='0' cellpadding='0'>";
	echo"<tr><td width='383' height='289' class='center-left'>";
	echo"<form action='$_SERVER[PHP_SELF]' method='POST' id='login'>";
	echo"<p class='center-left-content'>$txt[3]<br><input type='text' class='input-center' name='auth_name'><br><br>$txt[4]<br>";
	echo"<input type='password' class='input-center' name='auth_pass'><br><br>";
	?><a href='#' onClick="document.getElementById('login').submit()" class="login" name="login" style="padding-left: 82px"></a><?php
	echo"<td width='306' height='289' class='center-right' valign=top>";
	echo"<p class='center-right-content'>$reason</p></td></tr></table>";
	echo"<img src='templates/$them/images/center-buttom.png'><br></th></tr>";
 	
?>
