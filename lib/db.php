<?php
	global $absPath;
	include( $absPath."/conf/db.php" );
	global $DB;

	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$mysqli = new mysqli( $DB["host"], $DB["login"], $DB["pass"], $DB["db"] );
	if ( $mysqli->error ) { die( $mysqli->error ); }

	function dbRun( $sql,...$bindParams) {
		global $mysqli;
		$stmt = $mysqli->prepare($sql);
		if ( $mysqli->error ) { die( $mysqli->error ); }
		if ( ! empty( $bindParams ) ){ $stmt->bind_param( ...$bindParams ); }
		$stmt->execute();
		if ( $mysqli->error ) { die( $mysqli->error ); }
		$result = $stmt->get_result();
		if ( empty($result ) ){ return []; }
		if ( $result->num_rows == 0 ) { return []; }
		// if( $result->num_rows == 1 ){ return $result->fetch_assoc(); }
		return $result->fetch_all(MYSQLI_ASSOC);
	}

function lastid(){
	$lastId = dbRun("SELECT LAST_INSERT_ID() as id");
	return $lastId[0]["id"];
}

dbRun("SET NAMES 'utf8'");
?>
