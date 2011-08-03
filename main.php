<?php
/*-------------------------------------------------------+
| lkfusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: main.php
| Author: lovepsone
| completed: 0%
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	include_once("conf.php");

	$module = isset($modules[$mode]) ? $modules[$mode] : (isset($modules["default"]) ? $modules["default"] : NULL);
	// Подключаем модуль если найден
	if ($module!=NULL)
    	include($module);
?>