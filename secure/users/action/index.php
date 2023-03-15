<?php include( '../../../lib/secure.php'); 

	global $user;
	$id = $_REQUEST['id'];
	$name = $_REQUEST['name'];
	$surname = $_REQUEST['surname'];
	$lastname = $_REQUEST['lastname'];
	$active = $_REQUEST['active'] ? 1 : 0;
	$pass = $_REQUEST['pass'];

	$data = dbRun("SELECT * FROM user WHERE id=?", 'i', $id );
	if ( empty( $data ) ) { die("Пользователя не существует"); }
	$data = $data[0];

	dbRun("UPDATE user SET name=?, surname=?, lastname=?, active=? WHERE id=?", 'sssii', 
		$name, $surname, $lastname, $active, $id );

	if( ! empty( $pass ) ) {
		dbRun("UPDATE user set pass=MD5(?) WHERE id=?", 'si', $pass, $id );
	}

	echo "OK";
// header("Location:../index.php");
include('../../../lib/dbstop.php'); 