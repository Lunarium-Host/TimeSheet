<?php include('../../tpl/header_secure.php'); 
	global $user;
	if( $user['admin'] < 2 ){ die('Доступ запрещен'); }
	$companies = dbRun("SELECT * FROM company ORDER BY name");
?>
<div class="row">
	<div class="col-lg-12 grid-margin">
		<div class="card">
			<div class="card-body">
				<p class="float-right"><a href="javascript:addCompany();" class="badge badge-warning">Добавить</a></p>
				<h4 class="card-title">Компании</h4>
				<div class="card-description row">
<?php foreach ( $companies as $line ) { ?>
					<div class="card col-3 mb-2 mr-2 p-2">
						<h3 class="card-title">
							<i class="ti-folder"></i>
							<a href="/secure/projects/?id=<?= $line['id'] ?>"><?= $line['name'] ?></a>
						</h3>
						<p class="card-description text-right"><a href="javascript:editCompany(<?= $line['id'] ?>);"><i class="ti-pencil-alt"></i></a></p>
					</div>
<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function editCompany(dbId){
		$.post('modal/',{ id: dbId },
			function( data ) { dialog1.content( data ).modal('show'); } 
	); }

	function addCompany() {
		$.post('modal/add.php', {}, 
			function( data ) { dialog1.content( data ).modal('show'); }
	); }
</script>
<?php include('../../tpl/footer_secure.php') ?>