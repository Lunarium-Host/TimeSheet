<?php include( '../../../lib/secure.php'); 

	global $user;
	$idCompany = $_REQUEST['id'];
	
	dbRun( "INSERT INTO period SET idCompany=?, `datetime`=NOW()", 'i', $idCompany );
	$idPeriod = lastid();
	dbRun( "UPDATE task SET idPeriod=? WHERE enddate <= NOW() AND idPeriod IS NULL AND idProject in (SELECT id FROM project WHERE idCompany=?)", 'ii', $idPeriod, $idCompany );
	echo "OK";
// header("Location:../index.php");
include('../../../lib/dbstop.php'); 