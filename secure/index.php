<?php 
	include('../tpl/header_secure.php'); 
	global $user; 
	$tasks = dbRun("SELECT t.*,
			DATE_FORMAT( t.createdate, '%d/%m/%Y') createdate,
			DATE_FORMAT( t.startdate, '%d/%m/%Y') startdate,
			DATE_FORMAT( t.enddatePlan, '%d/%m/%Y') enddatePlan,
			DATE_FORMAT( t.enddate, '%d/%m/%Y') enddate,
			p.name projectName,
			c.name companyName
		FROM task t
			LEFT JOIN project p ON p.id = t.idProject 
			LEFT JOIN company c ON c.id = p.idCompany
		WHERE 
			t.enddate IS NULL AND
			t.idPeriod IS NULL
	")
?>
<div class="row">
	<div class="col-12 card">
		<div class="card-body table-responsive">
			<div class="card-title">Задачи</div>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Компания</th>
						<th>Проект</th>
						<th>Наименование</th>
						<th>Дата добавления</th>
						<th>Часы</th>
						<th>Действия</th>
					</tr>
				</thead>
				<tbody>
<?php if ( empty($tasks) ) { ?>
					<tr><td colspan="6" class="text-center">Нет задач</td></tr>
<?php } ?>
<?php foreach( $tasks as $line ) { ?>
					<tr>
						<td><?= $line['companyName'] ?></td>
						<td><?= $line['projectName'] ?></td>
						<td><?= $line['name'] ?></td>
						<td><?= $line['createdate'] ?></td>
						<td><?= $line['spend'] ?></td>
						<td>
							<a href="javascript:editTask(<?= $line['id'] ?>);" class="badge badge-info">Изменить</a>
						</td>
					</tr>
<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script type='text/javascript'>

function editTask( dbId ) { 
	$.post( '/secure/tasks/modal/', { id : dbId }, 
		function( data ) { dialog1.content( data ).modal('show'); }
	);
}
</script>
						
<?php include('../tpl/footer_secure.php') ?>
