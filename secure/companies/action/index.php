<?php include( '../../../lib/secure.php'); 

	global $user;
	$id = $_REQUEST['id'];
	$code = $_REQUEST['code'];
	$name = $_REQUEST['name'];
	$about = $_REQUEST['about'];
	$price = $_REQUEST['price'];

	$company = dbRun("SELECT * FROM company WHERE id=?", 'i', $id );
	if ( empty( $company ) ) { die("Компании не существует"); }
	$company = $company[0];

	dbRun("UPDATE company SET code=?, name=?, about=?, price=? WHERE id=?", 'ssssi', 
		$code, $name, $about, $price, $id );

	echo "OK";
// header("Location:../index.php");
include('../../../lib/dbstop.php'); 