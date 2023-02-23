<?php include('../../tpl/header_secure.php'); 
	global $user;
	$idCompany = empty( $_REQUEST['id'] ) ? $user['idCompany'] : $_REQUEST['id'];
	if ( $idCompany != $user['idCompany'] && $user['admin'] < 2 ){ die('Доступ запрещен'); }
	$users = dbRun("SELECT * FROM user WHERE idCompany=?", 'i', $idCompany );
?>
<div class="row">
	<div class="col-lg-12 grid-margin">
		<div class="card">
			<div class="card-body row">
				<h4 class="card-title col-6">
					Пользователи
				</h4><p class="text-right col-6"><a href="javascript:addUser();" class="badge badge-warning">Добавить</a></p>
					
				<DIV class="card-description table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Активность</th>
								<th>Логин</th>
								<th>Имя</th>
								<th>Последняя активность</th>
								<th>Действия</th>
							</tr>
						</thead>
						<tbody>
<?php foreach( $users as $line ) { ?>
							<tr>
								<td><?php echo $line['active'] ? 'Да' : '' ?></td>
								<td><?= $line['login'] ?></td>
								<td><?= $line['name'] ?> <?= $line['surname'] ?> <?= $line['lastname'] ?></td>
								<td><?= $line['lastdate'] ?></td>
								<td>
									<a href="javascript:editUser(<?= $line['id'] ?>)" class="badge badge-primary">Изменить</a>
								</td>
							</tr>
<?php } ?>
						</tbody>
					</table>
				</DIV>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function editUser(dbId){
		$.post('modal/',{ id: dbId },
			function( data ) { dialog1.content( data ).modal('show'); } 
	); }

	function addUser() {
		$.post('modal/add.php', { id : <?= $idCompany ?>}, 
			function( data ) { dialog1.content( data ).modal('show'); }
	); }
</script>
<?php include('../../tpl/footer_secure.php') ?>