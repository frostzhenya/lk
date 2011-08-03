<?php 
/*-------------------------------------------------------+
| lkfusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: logout.php
| Author: lovepsone
| completed: 100%
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	session_start();
	unset($_SESSION['loged']);
	unset($_SESSION['user']);
	unset($_SESSION['id']);
	session_destroy();
   
	require "config/config.php";
	require "include/functions.php";
	require "locale/language.php";
	require "templates/$them/topmenu.php";

	echo"<script type='text/javascript'> <!-- function exec_refresh(){ window.status = '$txt[300]' + myvar; myvar = myvar + ' .'; var timerID = setTimeout('exec_refresh();', 100); if (timeout > 0){ timeout -= 1; }else{ clearTimeout(timerID); window.status = ''; window.location = 'index.php'; } } var myvar = ''; var timeout = 20; exec_refresh();//--> </script>";

	echo"<img src='templates/$them/images/center-top.png'><br>";
	echo"<table align='center' width='689' height='289' border='0' cellspacing='0' cellpadding='0'>";
	echo"<tr><td width='383' height='289' class='center-left'><p class='center-left-content'>$txt[310]<font color='black'><a href='/../index.php'>$txt[309]</a></td>";
	echo"<td width='306' height='289' class='center-right' valign=top><p class='center-right-content'></p></td></tr></table><img src='templates/$them/images/center-buttom.png'><br></th></tr></div>";

	require "templates/$them/bottomline.php";  
?>