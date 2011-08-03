<?php
/*
	завершенность: 90%
	completed: 90%

	lkfusion from LovePSone 2010-2011 

*/
	include('config/config.php');
	include('include/functions.php');
	include('include/auth.php');
	include('templates/'.$them.'/topmenu.php');
	include('locale/language.php');
	include('include/log_info.php');
	open();
?>

	<img src="templates/<?php echo $them; ?>/images/logo.png"  vspace="15">
	<table width="600" cellpadding="0" cellspacing="0" border="0" rules="none" align="center" style="background : url(templates/<?php echo $them; ?>/images/typ_bg.jpg)">
	<tr><td class="typ">&nbsp;&nbsp;&nbsp;<? echo $txt[283]; ?></td></tr>
	<tr><td align="center"><script type="text/javascript" src="include/jquery.js"></script>
	<table class="typ" valign="middle" cellpadding="2">
<?php



	if (empty($_GET['g']) || empty($_GET['s'])) 
		{
			if (empty($_GET['s'])) 
				{

?>
					<tr><td align="center" width="100%" colspan="2" style="padding: 15px 0;"><strong><? echo $txt[284]; ?></strong></td></tr>
					<tr><td colspan="2" align="center"><img src="templates/<? echo $them; ?>/images/cara.png"></td></tr>
					<tr><td align="right" width="600"><input type="" value="10" id="sum"></td><th width="600"><a href='#' class="arrow" name="change" id="sum_post"></a></th></tr>

					<script type="text/javascript">$(document).ready(function () { $('#sum_post').click(function () {if (parseInt($('#sum').val()) > 0) {location.href = 'leadslevel.php?s='+parseInt($('#sum').val());}});});</script>
<?php
				} 
			else 
				{
					$sum = intval($_GET['s']);
?>
					<tr><td colspan="2" align="center"><img src="templates/<? echo $them; ?>/images/cara.png"></td></tr>
<?php
					selectDb('characters');
					$prehled_chary = "SELECT `name`, `guid`, `level` FROM `characters` WHERE account=$id";
					$result = mysql_query($prehled_chary);

					if (mysql_num_rows($result) > 0) 
						{
							while ($prehled_chary_vypis = mysql_fetch_array($result)) 
								{

									$name = $prehled_chary_vypis["name"];
?>
									<tr><td align="right" width="600"><strong><? echo $name; ?></strong></td><th width="600">
									<a href='leadslevel.php?g=<? echo $prehled_chary_vypis["guid"]; ?>&s=<?php echo $sum; ?>' class="arrow" name="change"></a></th></tr>
									<tr><td colspan="2" align="center"><img src="templates/<? echo $them; ?>/images/cara.png"></td></tr>
<?php
								}
						} 
					else 
						{
?>
							<tr><td align="center" width="100%" style="padding: 15px 0;">
							<strong><? echo $txt[267]; ?></strong></td></tr>
<?php
						}
				}
		} 
	else 
		{
			$sum = intval($_GET['s']);
			$guid = intval($_GET['g']);

			selectDb('characters');
			$prehled_chary_lvl = "SELECT `level` FROM `characters` WHERE guid=$guid AND account=$id";
			$result_lvl = mysql_query($prehled_chary_lvl);
									
			$lvl = $prehled_chary_lvl['level'];
			$sumlvl_realmd= $sum*$level*$lvl;
			$sumlvl_characters = $sum;

			selectDb('realmd');
			$prehled_realmd = "SELECT * FROM account WHERE id=$id LIMIT 1";
			$prehled_realmd_vypis = mysql_fetch_array(mysql_query($prehled_realmd));

			if ($prehled_realmd_vypis["bonuses"] >= $sum && $sum > 0) 
				{
					selectDb('characters');
					$name = @mysql_result(mysql_query("SELECT `name` FROM characters WHERE guid=$guid AND account=$id"),0);

					if ($name) 
						{
							if ($result == 0) 
								{

									selectDb('realmd');
									mysql_query("UPDATE account SET bonuses=bonuses-".$sumlvl_realmd." WHERE id=$id");
									
									selectDb('lk');
									mysql_query("INSERT INTO `bonuswastes` (`acct`, `guid`, `service_type`, `service_info`, `bonuses`) VALUES ($id, $guid, 4, '".$sumlvl_realmd."', '".$sumlvl_realmd."');");

									selectDb('characters');
									mysql_query("UPDATE characters SET level=level+".$sumlvl_characters." WHERE guid=$guid");

									echo "<tr><td align='center' width='100%' style='padding: 15px 0;'><strong>$txt[285]</strong></td></tr>";

								}
						}
				} 
			else 
				{
?>
					<tr><td align="center" width="100%" style="padding: 15px 0;">
					<strong><? echo $txt[281].' '.abs($sum-$prehled_realmd_vypis["bonuses"]).' '.$txt[162]; ?>.<br>(<a href=depositfunds.php class='linkchar'><? echo $txt[24]; ?></a>)</strong></td></tr>
<?php
				}
		}
?>
	</table></td></tr></table><br><br>

<? include ('templates/'.$them.'/patka.php'); ?>


