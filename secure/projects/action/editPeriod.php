<?php include( '../../../lib/secure.php'); 

	global $user;
	$idPeriod = $_REQUEST['id'];
	$payed = $_REQUEST['payed'];
	dbRun( "UPDATE period SET payed=? WHERE id=?", 'si', $payed, $idPeriod );
	echo "OK";
// header("Location:../index.php");
include('../../../lib/dbstop.php'); 