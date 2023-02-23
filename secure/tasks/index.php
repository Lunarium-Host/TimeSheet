<?php include('../../tpl/header_secure.php'); 
	global $user;
	$idProject = empty( $_REQUEST['id'] ) ? $user['idProject'] : $_REQUEST['id'];
	$project = dbRun("SELECT * FROM project WHERE id=?", 'i', $idProject );
	if ( empty( $project ) ) { die("Проект не найден"); }
	$project = $project[0];
	$tasks = dbRun("SELECT 
			t.*,
			DATE_FORMAT(t.startdate, '%d/%m/%Y') startdate,
			DATE_FORMAT(t.enddate, '%d/%m/%Y') enddate,
			DATE_FORMAT(t.createdate, '%d/%m/%Y') createdate,
			s.name as status
		FROM task t
			LEFT JOIN status s ON t.idStatus = s.id 
		WHERE 
			t.idProject=? AND 
			t.idPeriod IS NULL
		ORDER BY t.enddate, t.startdate, t.createdate", 'i', $idProject );
?>
<div class="row">
	<div class="col-lg-12 grid-margin">
		<div class="card">
			<div class="card-body row">
				<h4 class="card-title col-6">Проект: <?= $project['name'] ?></h4>
			</div>
			<div class="card-description col-12">
				<?= $project['about'] ?>
			</div>
		</div>
	</div>

	<div class="col-lg-12 grid-margin">
		<div class="card">
			<div class="card-body row">
				<h4 class="card-title col-6">Задачи</h4>
				<p class="text-right col-6"><a href="javascript:addTask();" class="badge badge-warning">Добавить</a></p>
					
				<DIV class="card-description table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Статус</th>
								<th>Наименование</th>
								<th>Описание</th>
								<th>Часы</th>
								<th>Дата добавления</th>
								<th>Дата окончания</th>
								<th>Действия</th>
							</tr>
						</thead>
						<tbody>
<?php foreach( $tasks as $line ) { ?>
							<tr>
								<td><?= $line['status'] ?></td>
								<td><?= $line['name'] ?></td>
								<td><?= $line['about'] ?></td>
								<td><?= $line['spend'] ?></td>
								<td><?= $line['createdate'] ?></td>
								<td><?= $line['enddate'] ?></td>
								<td>
									<a href="javascript:editTask(<?= $line['id'] ?>)" class="badge badge-secondary">Изменить</a>
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
	function editTask(dbId){
		$.post('modal/',{ id: dbId },
			function( data ) { dialog1.content( data ).modal('show'); } 
	); }

	function addTask() {
		$.post('modal/add.php', { id : <?= $idProject ?>},
			function( data ) { dialog1.content( data ).modal('show'); }
	); }
</script>
<?php include('../../tpl/footer_secure.php') ?>