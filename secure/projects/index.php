<?php include('../../tpl/header_secure.php'); 
	global $user;
	$idCompany = empty( $_REQUEST['id'] ) ? $user['idCompany'] : $_REQUEST['id'];
	if ( $idCompany != $user['idCompany'] && $user['admin'] < 2 ){ die('Доступ запрещен'); }
	
	$company = dbRun("SELECT * FROM company WHERE id=?", 'i', $idCompany );
	if( empty( $company ) ) { die("Компании не найдено"); }
	else { $company = $company[0]; }
	
	$projects = dbRun( "SELECT 
			p.*,
			count(t.id) tasks,
			sum(t.spend) spend 
		FROM project p
			LEFT JOIN task t ON t.idProject = p.id AND t.enddate is NULL
		WHERE 
			p.idCompany=?
		GROUP BY p.id 
		ORDER by active desc", 'i', $idCompany );

	$projSum = 0;
	foreach ( $projects as $line ) {
		$projSum += $line['spend'] * $company['price'];
	}
	
	$tasks = dbRun( "SELECT 
			t.*,
			p.name projectName,
			DATE_FORMAT(t.createdate, '%d/%m/%Y') createdate,
			DATE_FORMAT(t.startdate, '%d/%m/%Y') startdate,
			DATE_FORMAT(t.enddatePlan, '%d/%m/%Y') enddatePlan,
			DATE_FORMAT(t.enddate, '%d/%m/%Y') enddate
		FROM task t
			LEFT JOIN project p on t.idProject = p.id
		WHERE 
			t.idProject IN ( SELECT id FROM project WHERE idCompany=? ) AND 
			t.idPeriod IS NULL AND
			t.enddate IS NOT NULL
		ORDER BY t.enddate DESC", 'i', $idCompany );

	$taskSumm = 0;
	foreach ( $tasks as $line ) {
		$taskSumm += $line['spend'] * $company['price'];
	}

	$periods = dbRun( "SELECT 
		p.*,
		DATE_FORMAT( p.datetime, '%d/%m/%Y') datetime,
		SUM( t.spend * c.price ) price
	FROM period p
		LEFT JOIN task t ON t.idPeriod = p.id
		LEFT JOIN company c ON c.id = p.idCompany
	WHERE p.idCompany=?
	GROUP BY p.id", 'i', $idCompany );

	$periodSum = 0;
	$periodPay = 0;
	$periodDebt = 0;
	foreach ( $periods as $line ) {
		$periodSum += $line['price'];
		$periodPay += $line['payed'];
		$periodDebt += $line['price'] - $line['payed'];
	}
?>
<div class="row">
<?php if ( $user['admin'] == 2 ) { ?>
	<div class="col-lg-12 grid-margin">
		<div class="card">
			<div class="card-body row">
				<h4 class="card-title col-12">Компания: <?= $company['name'] ?></h4>
				<div class="card-description col-12"><?= $company['about'] ?></div>
				<dl class="card-description col-6 row">
					<dt class="col-6">Код:</dt>
					<dd class="col-6"><?= $company['code'] ?></dd>
					<dt class="col-6">Цена:</dt>
					<dd class="col-6"><?= $company['price'] ?> руб.</dd>
				</dl>
				<dl class="col-6 row">
					<dt class="col-6">Дата добавления:</dt>
					<dd class="col-6"><?= $company['startdate'] ?></dd>
					<dt class="col-6">Задолженность:</dt>
					<dd class="col-6"><?= $periodDebt ?> руб.</dd>
				</dl>
			</div>
		</div>
	</div>
<?php } ?>
	<div class="col-lg-12 grid-margin">
		<div class="card">
			<div class="card-body row">
				<h4 class="card-title col-6">Проекты</h4>
				<p class="text-right col-6"><a href="javascript:addProject();" class="badge badge-warning">Добавить</a></p>
					
				<DIV class="card-description table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th class="text-center">Активность</th>
								<th>Имя</th>
								<th class="text-center">Открытые задачи</th>
								<th class="text-right">Действия</th>
							</tr>
						</thead>
						<tbody>
<?php foreach( $projects as $line ) { ?>
							<tr>
								<td class="text-center"><?php echo $line['active'] ? 'Да' : '' ?></td>
								<td><?= $line['name'] ?></td>
								<td class="text-center"><?= $line['tasks'] ?></td>
								<td class="text-right">
									<a href="javascript:editProject(<?= $line['id'] ?>)" class="badge badge-secondary">Изменить</a>
									<a href="/secure/tasks/?id=<?= $line['id'] ?>" class="badge badge-info">Задачи</a>
								</td>
							</tr>
<?php } ?>
						</tbody>
						<tfoot>
							<tr>
								<th colspan=2 class="text-right">Итого:</th>
								<th colspan=2><?= $projSum ?> руб.</th>
							</tr>
						</tfoot>
					</table>
				</DIV>
			</div>
		</div>
	</div>

	<div class="col-lg-12 grid-margin">
		<div class="card">
			<div class="card-body row">
				<h4 class="card-title col-12">Выполненные задачи</h4>
	
				<DIV class="card-description table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Проект</th>
								<th>Имя</th>
								<th>Описание</th>
								<th>Часов</th>
								<th>Дата окончания</th>
								<th class="text-right">Действия</th>
							</tr>
						</thead>
						<tbody>
<?php foreach( $tasks as $line ) { ?>
							<tr>
								<td><?= $line['projectName'] ?></td>
								<td><?= $line['name'] ?></td>
								<td><?= $line['about'] ?></td>
								<td><?= $line['spend'] ?></td>
								<td><?= $line['enddate'] ?></td>
								<td class="text-right">
									<a href="javascript:editTask(<?= $line['id'] ?>)" class="badge badge-secondary">Изменить</a>
								</td>
							</tr>
<?php } ?>
						</tbody>
						<tfoot>
							<tr>
								<th colspan=3 class="text-right">Итого:</th>
								<th colspan=3><?= $taskSumm ?> руб.</th>
							</tr>
						</tfoot>
					</table>
				</DIV>

			</div>
		</div>
	</div>

	<div class="col-lg-12 grid-margin">
		<div class="card">
			<div class="card-body row">
				<h4 class="card-title col-6">Периоды</h4>
				<p class="text-right col-6">
					<a href="javascript:addPeriod(<?= $idCompany ?>);" class="badge badge-warning">
						Закрыть период
					</a>
				</p>
				<div class="card-description table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Дата окончания периода</th>
								<th>Итого</th>
								<th>Оплачено</th>
								<th class="text-right">Действия</th>
							</tr>
						</thead>
						<tbody>
<?php foreach( $periods as $line ) { ?>
							<tr>
								<td><?= $line['datetime'] ?></td>
								<td><?= $line['price'] ?> руб.</td>
								<td><?= $line['payed'] ?> руб.</td>
								<td class="text-right">
									<a href="javascript:printPeriod(<?= $line['id'] ?>)" class="badge badge-info" alt="распечатать"><i class="ti-printer"></i></a>
									<a href="javascript:editPeriod(<?= $line['id'] ?>)" class="badge badge-primary">Внести оплату</a>
								</td>
							</tr>
<?php } ?>
						</tbody>
						<tfoot>
							<tr>
								<th class="text-right">Итого:</th>
								<th><?= $periodSum ?> руб.</th>
								<th class="text-right">Оплачено:</th>
								<th colspan=2><?= $periodPay ?> руб.</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function editProject(dbId){
		$.post('modal/',{ id: dbId },
			function( data ) { dialog1.content( data ).modal('show'); } 
	); }

	function addProject() {
		$.post('modal/add.php', { id : <?= $idCompany ?>}, 
			function( data ) { dialog1.content( data ).modal('show'); }
	); }

	function editTask(dbId){
		$.post('modal/task.php',{ id: dbId },
			function( data ) { dialog1.content( data ).modal('show'); } 
	); }

	function addPeriod(dbId){
		$.post('modal/addPeriod.php',{ id: dbId },
			function( data ) { dialog1.content( data ).modal('show'); } 
	); }

	function editPeriod(dbId){
		$.post('modal/editPeriod.php',{ id: dbId },
			function( data ) { dialog1.content( data ).modal('show'); } 
	); }

	function printPeriod(dbId){
		printPage('print/period.php', { id: dbId } );
	}

</script>
<?php include('../../tpl/footer_secure.php') ?>