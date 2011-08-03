<?php
/*-------------------------------------------------------+
| lkfusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: rightmenu.php
| Author: lovepsone
| completed: 90%
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	echo"<table width='24%' cellpadding='0' cellspacing='0' border='0' align='right' style='background: url(templates/$them/images/bg.png);'>";

	/*-------------------------------------------- Платные услуги --------------------------------------------*/
	echo"<tr><td style='background: url(templates/$them/images/manage.jpg);' class='mltbl'>&nbsp;&nbsp;&nbsp;$txt[35]</td></tr>";
	echo"<tr><td align='center' class='brtbl'>";
	echo"<table class='table' valign='top' border='0' align='right' width='24%' >";

	echo"<tr><th><img src='images/menu/01_deposfun.png'></th><td width='75%'><h1 class='nadpis'><a href='depositfunds.php?deposit'>$txt[38]</a></h1>$txt[39]</td></tr>";
	echo"<tr><th colspan='2'><img src='templates/$them/images/content-separator2.png' width='100%' vspace='10'></th></tr>";

	echo"<tr><th><img src='images/menu/02_charrename.png'></th><td width='75%'><h1 class='nadpis'><a href='charrename.php'>$txt[54]</a></h1>$txt[69]</td></tr>";
	echo"<tr><th colspan='2'><img src='templates/$them/images/content-separator2.png' width='100%' vspace='10'></th></tr>";

	echo"<tr><th><img src='images/menu/03_money.png'></th><td width='75%'><h1 class='nadpis'><a href='money.php'>$txt[70]</a></h1>$txt[71]</td></tr>";
	echo"<tr><th colspan='2'><img src='templates/$them/images/content-separator2.png' width='100%' vspace='10'></th></tr>";

	echo"<tr><th><img src='images/menu/04_item.png'></th><td width='75%'><h1 class='nadpis'><a href='additem.php?item'>$txt[72]</a></h1>$txt[73]</td></tr>";
	echo"<tr><th colspan='2'><img src='templates/$them/images/content-separator2.png' width='100%' vspace='10'></th></tr>";

	echo"<tr><th><img src='images/menu/05_level.png'></th><td width='75%'><h1 class='nadpis'><a href='leadslevel.php'>$txt[74]</a></h1>$txt[75]</td></tr>";
	echo"<tr><th colspan='2'><img src='templates/$them/images/content-separator2.png' width='100%' vspace='10'></th></tr>";

	echo"<tr><th><img src='images/menu/06_transfercharacter.png'></th><td width='75%'><h1 class='nadpis'><a href='transfercharacter.php'>$txt[52]</a></h1>$txt[53]</td></tr>";
	echo"<tr><th colspan='2'><img src='templates/$them/images/content-separator2.png' width='100%' vspace='10'></th></tr></table></td></tr>";

	/*-------------------------------------------- Бесплатные услуги --------------------------------------------*/
	echo"<tr><td style='background: url(templates/$them/images/manage.jpg);' class='mltbl'>&nbsp;&nbsp;&nbsp;$txt[36]</td></tr>";
	echo"<tr><td align='center' class='brtbl'>";
	echo"<table class='table' valign='top' border='0' align='right' width='24%' >";

	echo"<tr><th><img src='images/menu/11_cha-mail.png'></th><td width='75%'><h1 class='nadpis'><a href='changeE-mail.php'>$txt[42]</a></h1>$txt[43]</td></tr>";
	echo"<tr><th colspan='2'><img src='templates/$them/images/content-separator2.png' width='100%' vspace='10'></th></tr>";

	echo"<tr><th><img src='images/menu/12_changepw.png'></th><td width='75%'><h1 class='nadpis'><a href='changepassword.php'>$txt[44]</a></h1>$txt[45]</td></tr>";
	echo"<tr><th colspan='2'><img src='templates/$them/images/content-separator2.png' width='100%' vspace='10'></th></tr>";

	echo"<tr><th><img src='images/menu/13_antierror.png'></th><td width='75%'><h1 class='nadpis'><a href='antierror.php'>$txt[46]</a></h1>$txt[47]</td></tr>";
	echo"<tr><th colspan='2'><img src='templates/$them/images/content-separator2.png' width='100%' vspace='10'></th></tr></table></td></tr>";

	/*-------------------------------------------- Разное --------------------------------------------*/
	echo"<tr><td style='background: url(templates/$them/images/manage.jpg);' class='mltbl'>&nbsp;&nbsp;&nbsp;$txt[37]</td></tr>";
	echo"<tr><td align='center' class='brtbl'>";
	echo"<table class='table' valign='top' border='0' align='right' width='24%' >";

	echo"<tr><th><img src='images/menu/14_leavthic.png'></th><td width='75%'><h1 class='nadpis'><a href='leavethicket.php'>$txt[48]</a></h1>$txt[49]</td></tr>";
	echo"<tr><th colspan='2'><img src='templates/$them/images/content-separator2.png' width='100%' vspace='10'></th></tr>";

	echo"<tr><th><img src='images/menu/15_commands.png'></th><td width='75%'><h1 class='nadpis'><a href='commands.php'>$txt[50]</a></h1>$txt[51]</td></tr>";
	echo"<tr><th colspan='2'><img src='templates/$them/images/content-separator2.png' width='100%' vspace='5'></th></tr></table></td></tr>";

	echo "<tr><td colspan='3' background='templates/$them/images/box_bg_btm.jpg' width='24%' height='20' ></td></tr></table>";
?>