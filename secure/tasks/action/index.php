<?php include( '../../../lib/secure.php'); 

	global $user;
	$idTask = $_REQUEST['id'];
	$name = $_REQUEST['name'];
	$about = $_REQUEST['about'];
	$idStatus = $_REQUEST['idStatus'];
	$spend = $_REQUEST['spend'];
	$startdate = $_REQUEST['startdate'];
	$enddatePlan = $_REQUEST['enddatePlan'];
	$enddate = $_REQUEST['enddate'];

	$task = dbRun("SELECT * FROM task WHERE id=?", 'i', $idTask );
	// $project = dbRun("SELECT * FROM project WHERE id=?", 'i', $idProject );
	if ( empty( $task ) ) { die("Задача не найдена"); }
	$task = $task[0];
	dbRun("UPDATE task SET name=?, about=?, idStatus=?, spend=? WHERE id=?",'ssisi', 
		$name, $about, $idStatus, $spend, $idTask );

	if ( $startdate ) { dbRun("UPDATE task SET startdate=? WHERE id=?", 'si', $startdate, $idTask); }
	else { dbRun("UPDATE task SET startdate=NULL WHERE id=?", 'i', $idTask ); }
	if ( $enddatePlan ) { dbRun("UPDATE task SET enddatePlan=? WHERE id=?", 'si', $enddatePlan, $idTask); }
	else { dbRun("UPDATE task SET enddatePlan=NULL WHERE id=?", 'i', $idTask ); }
	if ( $enddate ) { dbRun("UPDATE task SET enddate=? WHERE id=?", 'si', $enddate, $idTask); }
	else { dbRun("UPDATE task SET enddate=NULL WHERE id=?", 'i', $idTask ); }
	echo "OK";

// header("Location:../index.php");
include('../../../lib/dbstop.php'); 