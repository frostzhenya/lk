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

	echo"<img src='templates/$them/images/center-top.png'><br>";

	echo"<table align='center' width='689' height='289' border='0' cellspacing='0' cellpadding='0'>";
	echo"<tr><td width='383' height='289' class='center-left'>";

	echo"<form method='POST'>";
	echo"<p class='center-left-content'>$txt[3]<br>

	<input type='text' class='input-center' name='auth_name'><br><br>$txt[4]<br>";
	echo"<input type='password' class='input-center' name='auth_pass'><br><br>";

	echo"<input type='submit' value='войти'>";

	echo"<td width='306' height='289' class='center-right' valign=top>";

	echo"<p class='center-right-content'>$txt[1]</p></td></tr></table>";

	echo"<img src='templates/$them/images/center-buttom.png'><br></th></tr>";
 	
?>
