<?php include( '../../../lib/secure.php'); 

	global $user;
	$idCompany = $_REQUEST['id'];
	$code = $_REQUEST['code'];
	$name = $_REQUEST['name'];
	$about = $_REQUEST['about'];
	$active = $_REQUEST['active'] ? 1 : 0;

	dbRun("INSERT INTo project SET code=?, name=?, about=?, active=?, idCompany=?", 'ssssi', 
		$code, $name, $about, $active, $idCompany );

	echo "OK";
// header("Location:../index.php");
include('../../../lib/dbstop.php'); 