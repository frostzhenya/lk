<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1251">
  <meta name="robots" content="index, follow">
  <meta name="author" content="lovepsoe">
  <meta name="Copyright" content="">
  <?php echo $gen."\n"; ?>
  <meta http-equiv="Content-Style-Type" content="text/css">
  <link href="images/favicon.ico" rel="icon" type="image/ico">

  <link rel="stylesheet" type="text/css" href="templates/cataclysm/style.css">
  <link rel="stylesheet" type="text/css" href="lkstyle.css">
  <?php /*<link rel="stylesheet" type="text/css" href="armory_main.css">*/ ?>
  <link rel="stylesheet" type="text/css" href="armory_power.css"> 
  <link rel="stylesheet" type="text/css" href="armory_ie6.css" media="all" />
  <link rel="stylesheet" type="text/css" href="armory_tooltips.css" media="all" />
 
  <script src="include/js/jquery.js" type="text/javascript"></script> 
  <script src="include/js/jquery.tablesorter.js" type="text/javascript"></script> 
  <script src="include/js/jquery_ui.js" type="text/javascript"></script> 
  <script src="include/js/jquery.tablesorter.pager.js" type="text/javascript"></script> 
  <script src="include/js/tooltips.js" type="text/javascript"></script> 
  <script src="include/js/swfobject.js" type="text/javascript"></script> 

  <title><?php echo $namelk; ?></title>
  <style type="text/css">
  img { behavior: url(include/iepngfix/iepngfix.htc); }
  </style>

  <?php if(@$snow=='on'){?>
  <script src="include/snowstorm.js?ver=1" type="text/javascript"></script>
  <?php }?>
  <![endif]-->
  </head>

  	<body>
<?php 
	if($toplinks=='on')
		{
			echo"<table width='100%' cellpadding='0' cellspacing='0' align='center'>";
			echo"<tr><td style='background : url(templates/$them/images/top_bg.png); width: 100%; height: 26px' class=topnav>";

			echo"<img src='templates/$them/images/topnav_div.gif'><a href='/'>На сайт</a>";
			echo"<img src='templates/$them/images/topnav_div.gif'><a href='character.php?search=player'>Поиск игрока</a>";
			echo"<img src='templates/$them/images/topnav_div.gif'><a href='guild.php'>Гильдии</a>";
			echo"<img src='templates/$them/images/topnav_div.gif'><a href='playerservinfo.php?online' name='online'>Игроки Online</a>";
			echo"<img src='templates/$them/images/topnav_div.gif'><a href='playerservinfo.php?top=money' name='top_money'>Toп богатейших игроков</a>";
			echo"<img src='templates/$them/images/topnav_div.gif'><a href=''>Toп чести</a>";
			echo"<img src='templates/$them/images/topnav_div.gif'><a href=''>Toп арена 2x2</a>";
			echo"<img src='templates/$them/images/topnav_div.gif'><a href=''>Toп арена 3x3</a>";
			echo"<img src='templates/$them/images/topnav_div.gif'><a href=''>Toп арена 5x5</a></td></tr></table>";

		}

	echo"<table width='100%' cellpadding='0' cellspacing='0' border='0' align='center'>";
	echo"<tr><td colspan='3' style='height: 89px' valign=top><div class='logo'></div></td></tr>";
	echo"<tr><td width='100%' height='86'></td></tr>";
	echo"<tr><td colspan='3' align='center'>";
?>