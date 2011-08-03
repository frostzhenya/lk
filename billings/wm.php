<?php

include('../../config/config.php');

function cutting($str) {
	$string = substr_replace($str,'',1);
	return $string;
}

function bonuscount($amount,$wm,$z,$r,$e,$u) {
	$rate = 0;
	if ($wm == 'Z') { $rate = $z; }
	if ($wm == 'R') { $rate = $r; }
	if ($wm == 'E') { $rate = $e625271593248; }
	if ($wm == 'U') { $rate = $u; }
	$bonus = $amount * $rate;
	return $bonus;
}
if ($_POST['LMI_PAYMENT_AMOUNT'] && $_POST['LMI_PAYMENT_NO']) {
	@mysql_connect($lk['host'],$lk['user'],$lk['pass']);
	$amount = intval(round($_POST['LMI_PAYMENT_AMOUNT']));
	$acct = intval($_POST['LMI_PAYMENT_NO']);
	$wmtype = $_POST['LMI_PAYER_PURSE'];
	$keeper = $_POST['LMI_PAYER_WM'];
	$date = $_POST['LMI_SYS_TRANS_DATE'];
	$wm = cutting($wmtype);
	$bonus = bonuscount($amount,$wm,$wmzb,$wmrb,$wmeb,$wmub);
	$hash = $_POST['LMI_HASH'];
	@mysql_query("INSERT INTO `".$lk['db']."`.`proceeds` (`type`,`acct`,`info`,`bonuses`) VALUES ('1','$acct','$keeper','$bonus')");
	@mysql_connect($realmd['host'],$realmd['user'],$realmd['pass']);
	@mysql_query("UPDATE `".$realmd['db']."`.`account` SET `bonuses`=`bonuses`+'$bonus' WHERE `id`='$acct'");
}

?>