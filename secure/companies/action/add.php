<?php include( '../../../lib/secure.php'); 

	global $user;
	$code = $_REQUEST['code'];
	$name = $_REQUEST['name'];
	$about = $_REQUEST['about'];
	$price = $_REQUEST['price'];

	dbRun("INSERT INTO company SET code=?, name=?, about=?, price=?, startdate=NOW()", 'ssss', 
		$code, $name, $about, $price );

	echo "OK";
// header("Location:../index.php");
include('../../../lib/dbstop.php'); 