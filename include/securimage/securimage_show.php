<?php
/*-------------------------------------------------------+
| lkfusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename:securimage_show.php
| Author: lovepsone
| completed: 100%
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/ 

	include 'securimage.php';

	$img = new securimage();
	$img->show(); // alternate use:  $img->show('/path/to/background.jpg');
?>