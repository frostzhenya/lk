<?php
	echo"<table width='100%' align='center' cellpadding='0' cellspacing='0'>";
	echo"<tr><td align='right' class='welcome'>$txt[64]<strong>".ucfirst(strtolower($uzivatel))."</strong>! || <a href=$startmodule?id=$id class='generallink'>$txt[65]</a> || <a href=logout.php class='generallink'>$txt[66]</a>";

	selectDb('realmd');
	$admin = mysql_fetch_array(mysql_query("SELECT `gmlevel` FROM `account` WHERE id=$id LIMIT 1"));

	if($admin['gmlevel'] == $gmlevel) {echo" || <a href=admin.php class='generallink'>$txt[34]</a>";}

	echo"</td></tr></table><br>";
?>