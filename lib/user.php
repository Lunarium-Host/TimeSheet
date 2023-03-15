<?php
global $sesId;
if( !empty( $_POST ) && !empty( $_POST['login'] ) ) {
	$existLogin = dbRun('SELECT id FROM user WHERE login=? AND pass=MD5(?);', 
		'ss', $_POST['login'], $_POST['passwd'] ) ; //
	if ( empty( $existLogin ) ) { header('Location: /login.php?auth=bad'); die(); }
	$existLogin = $existLogin[0];
	dbRun( "UPDATE session SET idUser=? WHERE id=?", 'ss' , $existLogin['id'], $sesId );
	header('Location: /secure/');
	die(); 
}
$user = dbRun("
	SELECT
		u.*, 
		c.`name` companyName,
		c.*,
		u.id id
	FROM 
		user u,
		session s, 
		company c
	WHERE 
		u.id=s.idUser AND 
		c.id=u.idCompany AND 
		s.id=? AND 
		u.active=1", 's', $sesId );
if ( empty( $user ) ) { header('Location: /login.php'); die(); }

if( ! empty( $_GET ) && ! empty( $_GET["logout"] ) ){
	dbRun("UPDATE session SET idUser=NULL WHERE id=?", 's', $sesId );
	header( "Location: /logout.php");
	die();
}
$user = $user[0];
dbRun("UPDATE user SET lastdate=NOW() WHERE id=?", 'i', $user['id'] );