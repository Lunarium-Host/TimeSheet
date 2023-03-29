<?php include( '../../../lib/secure.php'); 

$idTask = $_REQUEST['id'];

$task = dbRun("DELETE FROM task WHERE id=?", 'i', $idTask );

echo "OK";

include('../../../lib/dbstop.php'); 