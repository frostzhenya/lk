<?php
/*-------------------------------------------------------+
| lkfusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: depositfunds.php
| Author: lovepsone
| completed: 73%
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/ 

	require "config/config.php";
	require "include/functions.php";
	require "locale/language.php";
	require "include/auth.php";
	require "include/zones.php";
	require "templates/$them/topmenu.php";
	require "locale/language.php";
	require "include/authpanel.php";
	require_once "mainform/centermenu.php";
	require_once "mainform/rightmenu.php";
	require_once "mainform/leftmenu.php";

	if(isset($_GET['deposit']))
		{
			echo"<table width='50%' cellpadding='0' cellspacing='0' border='0' rules='none' align='center' style='background: url(templates/$them/images/typ_bg.jpg)'>";
			echo"<tr><td class='typ'>&nbsp;&nbsp;&nbsp;$txt[80]</td></tr>";
			echo"<tr><td align='center'>";

			echo"<table width='100%' class='typ' valign='middle' cellpadding='2'>";

			echo"<tr><td colspan='2' align='center'><img src='templates/$them/images/cara.png'></td></tr>";

			echo"<tr><td align='center' width='100%'><strong>$txt[81]</strong></td>";
			echo"<th width='100%'><a href='depositfunds.php?webmoney' class='arrow' name='webmoney'></a></th></tr>";

			echo"<tr><td colspan='2' align='center'><img src='templates/$them/images/cara.png'></td></tr>";

			echo"<tr><td align='center' width='100%'><strong>$txt[82]</strong></td>";
			echo"<th width='100%'><a href='depositfunds.php?sms' class='arrow' name='sms'></a></th></tr>";

			echo"<tr><td colspan='2' align='center'><img src='templates/$them/images/cara.png'></td></tr></td></tr>";
        		echo"</table><br></td></tr></table><br><br>";
		}

	//веб-донейт
	elseif(isset($_GET['webmoney']))
		{
			echo"<table width='50%' cellpadding='0' cellspacing='0' border='0' rules='none' align='center' style='background: url(templates/$them/images/typ_bg.jpg)'>";
			echo"<tr><td class='typ'>&nbsp;&nbsp;&nbsp;$txt[335]</td></tr>";
			echo"<tr><td align='center'><script type='text/javascript' src='include/jquery.js'></script>";

			echo"<table width='70%' cellpadding='0' cellspacing='0' style='padding: 15px 0;'>";
			echo"<tr><td align='center'>$txt[336]</td>";

			echo"<td width='12.5%' align='center'><input type='radio' class='wm_type' id='wmz' onClick=\"$(this).changetype('wmz');\" checked> WMZ</td>";
			echo"<td width='12.5%' align='center'><input type='radio' class='wm_type' id='wmr' onClick=\"$(this).changetype('wmr');\"> WMR</td>";
			echo"<td width='12.5%' align='center'><input type='radio' class='wm_type' id='wme' onClick=\"$(this).changetype('wme');\"> WME</td>";
			echo"<td width='12.5%' align='center'><input type='radio' class='wm_type' id='wmu' onClick=\"$(this).changetype('wmu');\"> WMU</td></tr>";

			echo"<tr><td height='10'></td></tr>";
			echo"<tr><td width='50%' align='center'>$txt[337]</td>";
			echo"<td colspan='4' width='50%' align='left'><input name='amount' type='text' size='15' style='width: 155px;' id='amount' onClick='$(this).bonusforwm(true);' onchange='$(this).bonusforwm(true);' value='0'><span id='wm'> WMZ</span></td></tr>";

			echo"<tr><td width='50%' align='center'></td>";
			echo"<td colspan='4' width='50%' align='left'><input name='bonus' type='text' size='15' style='width: 155px;' id='bonus' onClick='$(this).bonusforwm();' onchange='$(this).bonusforwm();' value='0'>$txt[162]</td></tr>";

			echo"<tr><td height='10'></td></tr>";
			echo"<tr><td><input type='hidden' id='wm_type' name='wm_type' value='Z'><input type='hidden' id='wm_rate' name='wm_rate' value='$wmzb'></td>";
			echo"<td colspan='4'><input type='button' id='submit' value='$txt[338]' alt='$txt[338]' style='width: 225px;'></td></tr></table>";

			echo"<form method='POST' action='$webmoney' id='payment'>";
				echo"<input type='hidden' name='LMI_PAYMENT_AMOUNT' id='LMI_PAYMENT_AMOUNT' value='0'>";
				echo"<input type='hidden' name='LMI_PAYMENT_DESC' value='#$id'>";
				echo"<input type='hidden' name='LMI_PAYMENT_NO' value='$id'>";
				echo"<input type='hidden' id='keeper' name='LMI_PAYEE_PURSE' value='$zkeeper'></td></form>";

				echo"<script type='text/javascript'>";

			?>
			function flr (value){ return Math.round(value); }

			$(document).ready(function () {
				$.fn.changetype = function(type) {
					$('.wm_type').attr('checked',false);
					$('#'+type).attr('checked','true');

    					if (type == 'wme') {
    						$('#wm_type').val('E');
    						$('#wm_rate').val(<?php echo $wmeb; ?>);
    						$('#wm').text('WME');
    						$('#keeper').val('<?php echo $ekeeper; ?>');
    					}

					else if (type == 'wmr') {
    						$('#wm_type').val('R');
    						$('#wm_rate').val(<?php echo $wmrb; ?>);
    						$('#wm').text('WMR');
    						$('#keeper').val('<?php echo $rkeeper; ?>');
    					}

					else if (type == 'wmu') {
    						$('#wm_type').val('U');
    						$('#wm_rate').val(<?php echo $wmub; ?>);
    						$('#wm').text('WMU');
    						$('#keeper').val('<?php echo $ukeeper; ?>');
    					}
					else {
    						$('#wm_type').val('Z');
    						$('#wm_rate').val(<?php echo $wmzb; ?>);
    						$('#wm').text('WMZ');
    						$('#keeper').val('<?php echo $zkeeper; ?>');
					}
    				$(this).bonusforwm(true);
    			};

    			$('#submit').click(function () {
    				if (parseInt($('#amount').val()) > 0) {
    					$('#LMI_PAYMENT_AMOUNT').val(parseInt($('#amount').val()));
    					$('#payment').submit();
    				}
    			});

    			$.fn.bonusforwm = function(fix) {
    				var rate = $('#wm_rate').val();
    				var amount = $('#amount').val();
    				var bonus = $('#bonus').val();

    				if (fix){
    					amount = flr(amount);
    					if (amount > 1000)
    						amount = 1000;
    						bonus = flr(amount*rate);
    					} else {
    						bonus = flr(bonus);
    						if (bonus/rate > 1000)
    							bonus = 1000*rate;
    							amount 	= flr(bonus/rate);
    					}
    					$('#amount').val(amount);
    					$('#bonus').val(bonus);
    				};
			});
			<?php

			echo"</script></td></tr></table>";
		}

	//смс-донейт
	elseif(isset($_GET['sms']))
		{
			if($smsmodul == 'on')
				{
					echo"<table width='50%' cellpadding='0' cellspacing='0' border='0' rules='none' align='center' style='background: url(templates/$them/images/typ_bg.jpg)'>";
					echo"<tr><td class='typ'>&nbsp;&nbsp;&nbsp;$txt[82]</td></tr>";
					echo"<tr><td align='center'><script type='text/javascript' src='include/jquery.js'></script>";

					echo"<table class='typ' valign='middle' cellpadding='2'>";

					if ($_POST['c'])
						{
							if ($_POST['op'])
								{
									selectDb('lk');
									$query = mysql_query("SELECT * FROM `tarrifs` WHERE `country`='".mysql_escape_string($_POST['c'])."' AND `operator`='".mysql_escape_string($_POST['op'])."' LIMIT 1;");
									$tarrif = mysql_fetch_array($query);

									if (mysql_escape_string($_POST['c']) == '”краина') {$prefix = $prefix2;}

									$txtsms = "<strong>$txt[345]$smsbonuses$txt[346]<font color=yellow>$prefix $id</font>$txt[347]$tarrif[num]$txt[348]$tarrif[costage] (Ђ$tarrif[country]-$tarrif[operator]ї).</strong>";
									echo"<tr><td align='justify' width='100%' style='padding: 15px 5px;'>$txtsms</td></tr>";
								}
							else
								{
									echo"<form method='post' action='depositfunds.php?sms' id='operator_form'>";
									echo"<tr><td align='center' width='100%' colspan='2' style='padding: 15px 0;'>$txt[349]<input type='hidden' value='$_POST[c]' name='c'></td></tr>";
									echo"<tr><td colspan='2' align='center'><img src='templates/$them/images/cara.png'></td></tr>";
									echo"<tr><td align='right' width='193'><select name='op' style='width: 150px;'>";

									selectDb('lk');
									$query = mysql_query("SELECT * FROM `tarrifs` WHERE `country`='".mysql_escape_string($_POST[c])."';");

									while ($row = mysql_fetch_array($query))
										{
											echo"<option value='$row[operator]'>$row[operator]</option>";
										}

									echo"</select></td><th width='150'><a href='#' class='arrow' name='change' id='operator_post'></a></th></tr></form>";

									echo"<script type='text/javascript'>";

									?>$(document).ready(function () { $('#operator_post').click(function () { $('#operator_form').submit(); });});<?php

									echo"</script>";
								}
						}
					else
						{
							echo"<form method='post' action='depositfunds.php?sms' id='country_form'>";
							echo"<tr><td align='center' width='100%' colspan='2' style='padding: 15px 0;'>$txt[340]</td></tr>";
							echo"<tr><td colspan='2' align='center'><img src='templates/$them/images/cara.png'></td></tr>";
							echo"<tr><td align='right' width='193'>";
							echo"<select name='c'>";

							selectDb('lk');
							$query = mysql_query("SELECT * FROM `tarrifs` GROUP by `country`;");

							while ($row = mysql_fetch_array($query))
								{
									echo"<option value='$row[country]'>$row[country]</option>";
								}

							echo"</select></td>";
							echo"<th width='150'><a href='#' class='arrow' name='change' id='country_post'></a></th></tr></form>";

							echo"<script type='text/javascript'>";
							?>$(document).ready(function () { $('#country_post').click(function () { $('#country_form').submit(); });});<?php
							echo"</script>";

						}
					echo"</table><br></td></tr></table>";
				}
			else
				{
					echo"<table width='50%' cellpadding='0' cellspacing='0' border='0' rules='none' align='center' style='background: url(templates/$them/images/typ_bg.jpg)'>";
					echo"<tr><td class='typ'>&nbsp;&nbsp;&nbsp;$txt[335]</td></tr>";
					echo"<tr><td align='center'>";

					echo"<table width='70%' cellpadding='0' cellspacing='0' style='padding: 15px 0;'>";
					echo"<tr><td align='center'><b>$txt[339]</td></tr></table>";
				}
		}

	require"templates/$them/bottomline.php";  
?>