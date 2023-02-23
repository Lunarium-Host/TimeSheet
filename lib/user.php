<?php
global $sesId;
if( !empty( $_POST ) && !empty( $_POST['login'] ) ) {
	$existLogin = dbRun('select id from user where login=? and pass=password(?);', 'ss', $_POST['login'], $_POST['passwd'] ) ; //
	if ( empty( $existLogin ) ) { header('Location: /login.php?auth=bad'); die(); }
	$existLogin = $existLogin[0];
	dbRun( "update session set idUser=? where id=?", 'ss' , $existLogin['id'], $sesId );
	header('Location: /secure/');
	die(); 
}
$user = dbRun("
	select
		u.*, 
		c.`name` companyName,
		c.*,
		u.id id
	from 
		user u,
		session s, 
		company c
	where 
		u.id=s.idUser
		and c.id=u.idCompany
		and s.id=?
		and u.active=1", 's', $sesId );
if ( empty( $user ) ) { header('Location: /login.php'); die(); }

if( ! empty( $_GET ) && ! empty( $_GET["logout"] ) ){
	dbRun("update session set idUser=NULL where id=?", 's', $sesId );
	header( "Location: /logout.php");
	die();
}
$user = $user[0];
dbRun("UPDATE user SET lastdate=NOW() WHERE id=?", 'i', $user['id'] );