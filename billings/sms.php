<?php

include('../../config/config.php');

$smsid = '0';
$num = '0';
$operator = '0';
$user_id = '0';
$cost = '0';
$msg = '0';

$smsid = $_GET['smsid'];
$num = $_GET['num'];
$operator = $_GET['operator'];
$user_id = substr($_GET['user_id'],0,-2).'XX';
$cost = $_GET['cost'];
$msg = strtolower($_GET['msg']);

if ($smsid) {
mysql_connect($lk['host'],$lk['user'],$lk['pass']) OR die();

$allsmsuser = str_replace(" ","",str_replace($prefix2, "", str_replace($prefix, "", strtolower($msg))));
$date = date('YmdHis', time());
$accid = intval($allsmsuser);
$bonus = $smsbonuses;
$check = mysql_query("SELECT * FROM `".$lk['db']."`.`tarrifs` WHERE `num`=".$num);
if (mysql_num_rows($check) > 0) {
	@mysql_query("INSERT INTO `".$lk['db']."`.`proceeds` (`type`,`acct`,`info`,`bonuses`) VALUES ('2','$accid','$user_id','$bonus')");
	@mysql_connect($realmd['host'],$realmd['user'],$realmd['pass']);
	mysql_query("UPDATE `".$realmd['db']."`.`account` SET `bonuses`=`bonuses`+".$bonus." WHERE id='".$accid."';");
	echo "smsid:".$smsid."\n";
	echo "status:reply\n";
	echo "content-type:text/plan\n";
	echo "\n";
	echo "Бонус был зачислен. Благодарим за помощь серверу.\n";
} else {
	echo "smsid:".$smsid."\n";
	echo "status:reply\n";
	echo "content-type:text/plan\n";
	echo "\n";
	echo "Бонус не был зачислен. Пожалуйста, обратитесь к администрации.\n";
}
}

?>