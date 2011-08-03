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

	function char_racegender($race, $gender)
		{ 
          		$char_race = array( 
              		1 => 'Human', 
             		2 => 'orc', 
              		3 => 'dwarf', 
              		4 => 'nightelf', 
              		5 => 'scourge', 
              		6 => 'tauren', 
              		7 => 'gnome', 
              		8 => 'troll', 
			9 => 'goblin',
              		10 => 'bloodelf', 
              		11 => 'draenei',
			22 => 'worgen'); 
                    
         		$char_gender = array( 
             		0 => 'мужчина', 
             		1 => 'женщина'); 

       			echo $char_race[$race].$char_gender[$gender]; 
	   	}

	function char_class($class)
		{ 
	    		$char_class = array( 
       			1=>'Воин',
	  		2=>'Паладин',
	   		3=>'Охотник',
	   		4=>'Разбойник',
	   		5=>'Жрец',
	   		6=>'Рыцарь смерти',
	   		7=>'Шаман',
	   		8=>'Маг',
	   		9=>'Чернокнижник',
	   		11=>'Друид'); 
	   
			echo $char_class[$class];
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

$type_game = array(
    0 => 'Normal',
    1 => 'PVP',
    4 => 'Normal',
    6 => 'RP',
    8 => 'RPPVP'
);

$temp=get_realmd();
$type=$temp['icon'];
$port=$temp['port'];
$realm_type = $type_game[$type];
$gen = "<meta name=\"Generator\" content=\"Personal Cabinet 1.5 Lite\">";


	function getExpansion($typ)
		{
			switch ($typ):
    			case 0:
    			$typ = "World of Warcraft";
   			break;

    			case 1:
    			$typ = "The Burning Crusade";
   			break;

  			case 2:
 			$typ = "Wrath of the Lich King";
   			break;

  			endswitch;
			return $typ;
		}

$rank_alliance = array(
    0 => 'Нет звания',
    1 => 'Private',
    2 => 'Corporal',
    3 => 'Sergeant',
    4 => 'Master Sergeant',
	5 => 'Sergeant Major',
	6 => 'Knight',
	7 => 'Knight-Lieutenant',
	8 => 'Knight-Captain',
	9 => 'Knight-Champion',
	10 => 'Lieutenant Commander',
	11 => 'Commander',
	12 => 'Marshal',
	13 => 'Field Marshal',
	14 => 'Grand Marshal',
	15 => 'City Protector'
  );
  
$rank_horde = array(
    	0 => 'Нет звания',
	1 => 'Scout',
	2 => 'Grunt',
	3 => 'Sergeant',
	4 => 'Senior Sergeant',
	5 => 'First Sergeant',
	6 => 'Stone Guard',
	7 => 'Blood Guard',
	8 => 'Legionnaire',
	9 => 'Centurion',
	10 => 'Champion',
	11 => 'Lieutenant General',
	12 => 'General',
	13 => 'Warlord',
	14 => 'High Warlord',
	15 => 'City Protector'
  );
  

  
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

	function char_money($money)
		{  
			$g = floor( $money / (100*100) );
			$money = $money - $g*100*100;
			$s = floor( $money / 100 );
			$money = $money - $s*100;
			$c = floor( $money );
			return sprintf("<b>%d<img src='images/gold.png'>&nbsp;%02d<img src='images/silver.png'>&nbsp;%02d<img src='images/copper.png'></b>", $g, $s, $c);
		}

	function char_totaltime($totaltime)
		{
			$d = floor($totaltime/(3600*24));
			$totaltime = ($totaltime - $d*3600*24);
			$h = floor($totaltime/3600);
			$totaltime = ($totaltime - $h*3600);
			$m = floor($totaltime/60);
			$totaltime = ($totaltime - $m*60);
			$sec = floor($totaltime);
			return sprintf("{$d} д. {$h} ч. {$m} м. {$sec} c.");
		}
	
?>