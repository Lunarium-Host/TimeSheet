<?php include( '../../../lib/secure.php'); 

	global $user;
	$id = $_REQUEST['id'];

	$data = dbRun("SELECT * FROM user WHERE id=?", 'i', $id );
	if ( empty( $data ) ) { die("Пользователя не существует"); }
	$data = $data[0];

	dbRun("DELETE FROM user WHERE id=?", 'i', $id );

	echo "OK";
// header("Location:../index.php");
include('../../lib/dbstop.php'); 