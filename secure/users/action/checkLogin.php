<?php include( '../../../lib/secure.php'); 

	$login = $_REQUEST['loginis'];
	if ( empty( $login ) ) { echo( "Поле не должно быть пустым" ); die; }

	$exists = dbRun( "SELECT id FROM user WHERE login=?", 's', $login );
	
	if ( empty( $exists ) ) { echo("OK"); die; }

	echo( "Логин существует, Введите другой логин" );
	die;