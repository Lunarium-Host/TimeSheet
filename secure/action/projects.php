<?php include( '../../lib/secure.php'); 
global $user;
$idCompany = $_REQUEST['id'];
$projects = dbRun("SELECT * FROM project WHERE idCompany=? ORDER BY name", 'i', $idCompany );
?>
<?php foreach ( $projects as $line ) { ?>
<option value="<?= $line['id'] ?>"><?= $line['name'] ?></option>
<?php } ?>
include('../../lib/dbstop.php'); 