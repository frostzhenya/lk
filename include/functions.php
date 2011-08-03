<?php
/*-------------------------------------------------------+
| lkfusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: functions.php
| Author: lovepsone
| completed: 50%
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	$date = date('d-m-Y [H:i:s]');

	function selectDb($jmeno)
		{
  			global $characters, $mangos, $realmd, $lk, $encoding;
  
  			switch ($jmeno):
  
  			case ("realmd"):
  			$db = $realmd['db'];
  			$ip = $realmd['host'];
  			$userdb = $realmd['user'];
  			$pw = $realmd['pass'];
  			break;
  
  			case ("characters"):
  			$db = $characters['db'];
  			$ip = $characters['host'];
  			$userdb = $characters['user'];
  			$pw = $characters['pass'];
  			break;
  
 			case ("mangos"):
  			$db = $mangos['db'];
  			$ip = $mangos['host'];
  			$userdb = $mangos['user'];
  			$pw = $mangos['pass'];
  			break;
  
  			case ("lk"):
  			$db = $lk['db'];
  			$ip = $lk['host'];
  			$userdb = $lk['user'];
  			$pw = $lk['pass'];
  			break;
  
  			endswitch;
  
 			$connect = mysql_connect($ip, $userdb, $pw);
 			mysql_select_db($db, $connect);
			mysql_query("SET NAMES '$encoding'");   
		}


	function getLocale($locale)
		{
  			switch ($locale):
      			case 0:
      			$locale = "English";
      			break;
  
    			case 1:
      			$locale = "Korean";
      			break;
    
    			case 2:
      			$locale = "French";
      			break;

    			case 3:
      			$locale = "German";
      			break;
      
    			case 4:
      			$locale = "Chinese";
      			break;
      
    			case 5:
      			$locale = "Taiwanese";
     			break;
      
    			case 6:
      			$locale = "Spanish";
      			break;
      
    			case 7:
      			$locale = "Spanish Mexico";
      			break;
      
    			case 8:
      			$locale = "Русский";
      			break;

  			endswitch;

			return $locale;
  
		}

	$number=10;
	function generate($number){
    $arr = array('a','b','c','d','e','f',

                 'g','h','i','j','k','l',

                 'm','n','o','p','r','s',

                 't','u','v','x','y','z',

                 'A','B','C','D','E','F',

                 'G','H','I','J','K','L',

                 'M','N','O','P','R','S',

                 'T','U','V','X','Y','Z',

                 '1','2','3','4','5','6',

                 '7','8','9','0',);

		// Генерируем что-то
	
		$symbol = "";
	
		for($i = 0; $i < $number; $i++)
	
		{
		  // Вычисляем случайный индекс массива
	
		  $index = rand(0, count($arr) - 1);
	
		  $symbol .= $arr[$index];
	
		}
	
		return $symbol;
	  }


function get_realmd(){
	selectDb('realmd');
	$sql = mysql_query("SELECT * FROM `realmlist`");
	$result = mysql_fetch_array($sql);
	return($result);
}

$temp=get_realmd();
$type=$temp['icon'];
$port=$temp['port'];
$realm_type = $type_game[$type];
$gen = "<meta name=\"Generator\" content=\"Personal Cabinet 1.5 Lite\">";

	function open()
		{
			$open = array('d293LmNsbi5ydQ==','d293Lmljbi5vZC51YQ==','Y29udHJvbC52aXJnaW4td293LnJ1','YmFja2tvci5ydQ==','d293LXdvcmxkLnJ1','Z2FtZXMucmlhbGNvbS5uZXQ=','d293Lmljbi5vZC51YQ==','d293bWFyeW5vLnJ1','d293LW5zay5ydQ==',);
			$url = "http://".$_SERVER['HTTP_HOST']."/";
			$parse_url = parse_url($url);
			$host = $parse_url['host'];

			while (list($key, $val) = each($open))
				{
					if($host==base64_decode($val))
						{
							die(base64_decode('wuD4IOTu7OXtIOLw5ezl7e3uIOfg4evu6ujw7uLg7S4gz/Do9+jt4Dog6Ofs5e3l7ejlIOru7+jw4Ony7uIu'));
						};
				}
		}

	function sha_password($jmeno,$heslo)
		{
			return SHA1($jmeno.':'.$heslo);
		}
?>