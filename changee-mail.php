<?php 
/*-------------------------------------------------------+
| lkfusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: changee-mail.php
| Author: lovepsone
| completed: 91%
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/


	require_once "config/config.php";
	require_once "include/functions.php";
	require_once "locale/language.php";
	require_once "include/auth.php";
	require_once "include/zones.php";
	//загрузка форм
	require_once "templates/$them/topmenu.php";
	require_once "include/authpanel.php";
	require_once "mainform/centermenu.php";
	require_once "mainform/rightmenu.php";
	require_once "mainform/leftmenu.php";

	if($activation == 'on')
		{
			if(@$_GET['active']=='1')
				{
	  				if ($_GET['name']==$uzivatel)
						{

							selectDb('lk');
							$sql = mysql_query("SELECT * FROM `change_mail` WHERE name='".$_GET['name']."'");
							$data = mysql_fetch_array($sql);
	
							if($_GET['code']==$data['code'])
								{
									selectDb('realmd');
									$sql = "UPDATE account SET email='".$data['new_mail']."' WHERE id=$id";
									mysql_query($sql) or die ('querry ...');
			  
									selectDb('lk');
									$sql = mysql_query("DELETE FROM change_mail WHERE name='".$_GET['name']."'");
									$sql = mysql_query("INSERT INTO logs (date,name,text,type) VALUES ('$date','$uzivatel','На аккаунте <b>$uzivatel</b> был изменен E-mail!','email')");
		
									$reason =  "<tr><td align=\"center\"><br><img src='images/yes.png'>&nbsp;&nbsp;".$txt[110]."<br><br>".$txt[111]." <b>".$data['new_mail']."</b></td></tr>";

									echo"<table width='50%' cellpadding='0' cellspacing='0' border='0' rules='none' align='center' style='background: url(templates/$them/images/typ_bg.jpg)'>";
									echo"<tr><td class='typ'>&nbsp;&nbsp;&nbsp;".$txt[112]."</td></tr>";
									echo"<tr><td align='center'><table class='typ' valign='top' align='center'>$reason</table><br></td></tr></table><br><br>";
									die;
								}
						}
				}
			selectDb('lk');
			$sql = mysql_query("SELECT * FROM `change_mail` WHERE name='".$uzivatel."'");
			$data = mysql_fetch_array($sql);

			if($sql) 
				{
					if(mysql_num_rows($sql)!=0) 
						{
							$reason = "<br><center>$txt[113]<br></center>";
						} 
					else 
						{
							if(!isset($_POST['change']))
								{
									$email = addslashes(!empty($_POST["email"]));
								}
							else
								{
									$email = addslashes($_POST["email"]);
								}

 							if ($email == "")
								{
 									$reason =  "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\" id='form'>
										    <tr><td align=\"center\"><br><br>$txt[114] <input type=\"text\" name=\"email\"></td></tr>
										    <tr><td align=\"center\"><br><input type=\"hidden\" name=\"change\"><a href='#' onClick=\"document.getElementById('form').submit()\" class=\"changeemail\" name=\"change\"></a></td></tr>";
  								}
							else
								{

  							if (!eregi("^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]+\.[a-zA-Z]{2,4}$",$email))
								{
									$reason = "<tr><td align=\"center\"><br><br><img src='images/no.png'>&nbsp;&nbsp;".$txt[115]."<br><br><a href=changee-mail.php>$txt[116]</a></td></tr>";
    								}
							else
								{

									selectDb('realmd');
 									$sql = mysql_query("SELECT email FROM account WHERE id=$id");
  									$data = mysql_fetch_array($sql);

        								$title = substr(htmlspecialchars(trim($title)), 0, 1000);  
        								$to = $data['email'];
        								$code = generate($number);
        								$linkemail = "".$linkserver."?active=1&name=".$uzivatel."&code=".$code."";
        								$linkemail = str_replace(" ", "%20", $linkemail);
       									$mess = "".$txt[117]."".$uzivatel.". ".$txt[118]." ".$linkemail."";
        
        								// функция, которая отправляет наше письмо. 
        								mail($to, $title, $mess, 'From:'.$from.' MIME-Version: 1.0 Content-type: text/plain; charset=windows-1251');

        								$reason = "<tr><td align=\"center\"><br><img src='images/yes.png'>".$txt[119]." <b>".$to."</b><br></td></tr>"; 
 
									selectDb('lk');
									$sql = "INSERT INTO `change_mail`(name,code,new_mail) VALUES ('$uzivatel', '$code', '$email')";
									mysql_query($sql) or die ('querry ...');
								}
						}
				}	
		}
				
		}
	else
		{
			if(!isset($_POST['change']))
				{
					$email = addslashes(!empty($_POST["email"]));
				}
			else
				{
					$email = addslashes($_POST["email"]);
				}

			if ($email == "")
				{
  					$reason =  "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\" id='form'><tr><td align=\"center\"><br><br>".$txt[111]." <input type=\"text\" name=\"email\"></td></tr>
						    <tr><td align=\"center\"><br><input type=\"hidden\" name=\"change\"><a href='#' onClick=\"document.getElementById('form').submit()\" class=\"changeemail\" name=\"change\"></a></td></tr>";

  				}
			else
				{  
  					if (!eregi("^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]+\.[a-zA-Z]{2,4}$",$email))
						{
    							$reason = "<tr><td align=\"center\"><br><br><img src='images/no.png'>&nbsp;&nbsp;".$txt[115]."<br><br><a href=changee-mail.php>$txt[116]</a></td></tr>";   
    						}
					else
						{
    
  							selectDb('realmd');
  							$sql = "UPDATE account SET email='$email' WHERE id=$id";
  							mysql_query($sql) or die ('querry ...');
  
 							selectDb('lk');
  							$sql = mysql_query("INSERT INTO logs (date,name,text,type) VALUES ('$date','$uzivatel','На аккаунте <b>$uzivatel</b> был изменен E-mail!','email')");
  							$reason = "<tr><td align=\"center\"><br><br><img src='images/yes.png'>&nbsp;&nbsp;".$txt[110]."<br><br>".$txt[111]." <b>".$email."</b></td></tr>";
						}
    				}
		}

	echo"<table width='50%' cellpadding='0' cellspacing='0' border='0' rules='none' align='center' style='background: url(templates/$them/images/typ_bg.jpg)'>";
	echo"<tr><td class='typ'>&nbsp;&nbsp;&nbsp;$txt[112]</td></tr>";
	echo"<tr><td align='center'><table class='typ' valign='top' align='center'>";

	echo $reason;

	echo"</table><br></td></tr></table><br><br>";

	require "templates/$them/bottomline.php";
?>
