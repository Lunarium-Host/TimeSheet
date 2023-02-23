<?php include( '../../../lib/secure.php'); 

	global $user;
	$id = $_REQUEST['id'];
	$code = $_REQUEST['code'];
	$name = $_REQUEST['name'];
	$about = $_REQUEST['about'];
	$active = $_REQUEST['active'] ? 1 : 0;

	$company = dbRun("SELECT * FROM project WHERE id=?", 'i', $id );
	if ( empty( $company ) ) { die("Проекта не существует"); }
	$company = $company[0];

	dbRun("UPDATE project SET code=?, name=?, about=?, active=? WHERE id=?", 'ssssi', 
		$code, $name, $about, $active, $id );

	echo "OK";
// header("Location:../index.php");
include('../../../lib/dbstop.php'); 