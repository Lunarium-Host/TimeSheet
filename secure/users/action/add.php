<?php include( '../../../lib/secure.php'); 

	global $user;
	
	$name = $_REQUEST['name'];
	$surname = $_REQUEST['surname'];
	$lastname = $_REQUEST['lastname'];
	$active = $_REQUEST['active'];
	$pass = $_REQUEST['pass'];
	$id = $_REQUEST['id'];
	$loginis = $_REQUEST['loginis'];

	if ( ! empty( $id ) && $id != $user['idCompany'] && $user['admin'] < 2 ){ die('Доступ запрещен'); }
	$idCompany = empty( $id ) ? $user['idCompany'] : $id;

	dbRun("INSERT INTO user 
		SET name=?, surname=?, lastname=?, active=?, pass=PASSWORD(?), idCompany=?, login=?", 'sssisis', 
		$name, $surname, $lastname, $active, $pass, $idCompany, $loginis );

	echo "OK";
// header("Location:../index.php");
include('../../lib/dbstop.php'); 