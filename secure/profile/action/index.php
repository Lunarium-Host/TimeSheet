<?php include( '../../../lib/secure.php'); 

	global $user;
	$id = $user['id'];
	$name = $_REQUEST['name'];
	$surname = $_REQUEST['surname'];
	$lastname = $_REQUEST['lastname'];
	$pass = $_REQUEST['pass'];

	dbRun("UPDATE user SET name=?, surname=?, lastname=? WHERE id=?", 'sssi', $name, $surname, $lastname, $id );

	if( ! empty( $pass ) ) {
		dbRun("UPDATE user set pass=MD5(?) WHERE id=?", 'si', $pass, $id );
	}

	header("Location:../../profile/");

include('../../../lib/dbstop.php'); 