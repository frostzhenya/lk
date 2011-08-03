<?php
/*-------------------------------------------------------+
| lkfusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: charnamechange.php
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

	$guid = addslashes($_GET["guid"]);
	$name = addslashes($_POST["name"]);
	
	// Проверка Guid'a на посторонние символы
 	if (!preg_match("|^[\d]+$| ", $guid)) 
		{
			exit ("<p>$txt[268]");
		}

	//запросы на базу
	selectDb('realmd');
	$p_realmd = "SELECT * FROM account WHERE id=$id LIMIT 1";
	$p_realmd_vypis = mysql_fetch_array(mysql_query($p_realmd));
	$bonuses = $p_realmd_vypis["bonuses"];
	$odecet = $bonuses-$charrename;

	if(!isset($_POST['rename']))
		{
  			$reason = "<form action=\"charnamechange.php?guid=$guid\" method=\"POST\" id='form'>
			<table width=\"100%\" border='0'>
			<tr><td valign='top' width='34%'>$txt[269]</td>
			<td width=20%><img width=100% id='image' src='include/securimage/securimage_show.php?sid=".md5(uniqid(time()))."'></td>
			<td valign=top><a href=\"#\" onclick=\"document.getElementById('image').src = 'include/securimage/securimage_show.php?sid=' + Math.random(); return false\" title='Refresh'><img src=include/securimage/images/refresh.png border='0'></a></td></tr>
			<tr><td valign=bottom colspan=4 align=center><input type='text' name='code' style='width:150' maxlength='4'><br /></td></td></tr>
  			<tr><td align=\"center\" colspan=\"4\"><br><input type=\"hidden\" name=\"name\" value=\"".$_POST["name"]."\"><input type='hidden' name='rename'><a href='#' onClick=\"document.getElementById('form').submit()\" class=\"changename\" name=\"rename\"></a></table></form>";
  		}
	else
		{
  
			include("include/securimage/securimage.php");
			$img = new Securimage();
			$valid = $img->check($_POST['code']);

			if($valid == true) 
				{

					selectDb('characters');
  					$hrac_dotaz_sql = "SELECT guid, account, online, name FROM characters WHERE guid=$guid";
        				$hrac_dotaz_sql_vysledek = mysql_query($hrac_dotaz_sql);
					$online = mysql_fetch_array($hrac_dotaz_sql_vysledek);
	      
					if ($bonuses < $charrename)
						{  
							$reason = "<img src='images/no.png'>&nbsp;&nbsp;".$txt[270].'<br><br><a href=charrename.php>'.$txt[175].'</a>';
						}
					else
						{
							if ($online["online"]=="0")
								{

									selectDb('realmd');	
									$sql = "UPDATE `account` SET `bonuses`=$odecet WHERE id=$id"; 
									mysql_query($sql);

									selectDb('characters');
									$at_login = "UPDATE characters SET at_login='1' WHERE guid=$guid AND account=$id";
									mysql_query($at_login);

									$reason = "<img src='images/yes.png'>&nbsp;&nbsp;$txt[273]";
								}
							else
								{
									$reason = "<img src='images/no.png'>&nbsp;&nbsp;".$txt[271]."<br><br><a href='charrename.php'>".$txt[122]."</a>";
								}
						}
				}
			else
				{
					$reason = "<img src='images/no.png'>&nbsp;&nbsp;".$txt[272]."<br><br><a href='charrename.php'>".$txt[122]."</a>";
				}
		}


	echo"<table width='50%' cellpadding='0' cellspacing='0' border='0' rules='none' align='center' style='background : url(templates/$them/images/typ_bg.jpg)'>";
	echo"<tr><td class='typ'>&nbsp;&nbsp;&nbsp;$txt[54]</td></tr>";
	echo"<tr><td align='center'>";
	echo"<table width='100%' border='0' class='typ' valign='top' align='center'>";
	echo"<tr><td align='center'><br>";

	echo"<table border='0' width='100%'>";
	echo"<tr><td width='100%' colspan='2' align=center><font color=red><b>$txt[274]<br><img src=\'templates/$them/images/cara.png\' width='100%' vspace='7' height=1></td>";
	echo"<tr><td width='50%'>$txt[275]</td>";
	echo"<td align=right>$charrename $txt[23]</td>";
	echo"<tr><td width='50%'>$txt[276]</td>";
	echo"<td align=right>$bonuses $txt[23]<tr>";
	echo"<td width='50%'>$txt[277]</td>";
	echo"<td align=right><strong>$name</strong></td></tr></table>$reason</td></tr></table><br></td></tr></table><br><br>";

	require "templates/$them/bottomline.php";  
?>


