<?PHP

session_start();
$sesId = session_id();

$session = dbRun( "select id from session where id=?", 's', $sesId );
if( empty( $session ) ) {
	dbRun( "insert into session set id=?, startdate=NOW()", 's', $sesId );
}
dbRun( "update session set lastdate=NOW() where id=?", 's', $sesId );
$session = dbRun( "select * from session where id=?", 's', $sesId );
$session = $session[0];
// var_dump($sessionDB);