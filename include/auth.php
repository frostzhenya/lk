<?php
	session_start();
	if (isset($_SESSION["loged"])!="ano"):
  	Header('Location: index.php');
	break;
	else:
	$uzivatel = $_SESSION["user"];
	$id = $_SESSION["id"];
endif;
?>
