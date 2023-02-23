<?php include( '../../../lib/secure.php'); 

	global $user;
	$idProject = $_REQUEST['id'];
	$name = $_REQUEST['name'];
	$about = $_REQUEST['about'];
	$idStatus = $_REQUEST['idStatus'];
	$spend = $_REQUEST['spend'];
	$startdate = $_REQUEST['startdate'];
	$enddatePlan = $_REQUEST['enddatePlan'];
	$enddate = $_REQUEST['enddate'];

	$project = dbRun("SELECT * FROM project WHERE id=?", 'i', $idProject );
	if ( empty( $project ) ) { die("Проект не найден"); }

	dbRun("INSERT INTO task SET idProject=?, name=?, about=?, idStatus=?, spend=?",'issis', 
		$idProject, $name, $about, $idStatus, $spend );
	$idTask = lastid();
	if ( $startdate ) { dbRun("UPDATE task SET startdate=? WHERE id=?", 'si', $startdate, $idTask); }
	if ( $enddatePlan ) { dbRun("UPDATE task SET enddatePlan=? WHERE id=?", 'si', $enddatePlan, $idTask); }
	if ( $enddate ) { dbRun("UPDATE task SET enddate=? WHERE id=?", 'si', $enddate, $idTask); }
	echo "OK";

// header("Location:../index.php");
include('../../../lib/dbstop.php'); 