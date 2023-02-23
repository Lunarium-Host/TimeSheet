<?php include( '../../../lib/secure.php'); 

$idPeriod = $_REQUEST['id'];
$period = dbRun("SELECT
		p.*,
		DATE_FORMAT(p.datetime, '%d/%m/%Y') datetime
	FROM period p WHERE p.id=?", 'i', $idPeriod );
if ( empty( $period ) ) { die("Период не найден"); }
$period = $period[0];
 
$company = dbRun("SELECT * FROM company WHERE id=?", 'i', $period['idCompany'] );
$company = $company[0];

$tasks = dbRun("SELECT 
		*, 
		DATE_FORMAT(enddate, '%d/%m/%Y') enddate 
	FROM task 
	WHERE idPeriod=?", 'i', $idPeriod );
$fullPrice = 0;
for ( $i=0; $i< count( $tasks ); $i++ ) {
		$tasks[$i]['price'] = $tasks[$i]['spend'] * $company['price'];
		$fullPrice += $tasks[$i]['price'];
}
?>
<h2 class="text-center">Акт приемки работ № <?= $period['id'] ?></h2>
<h4 class="text-center">от: <strong><?= $period['datetime'] ?></strong></h4>
<dl class="row">
	<dt class="col-3">Клиент:</dt><dd class="col-3"><?= $company['name']?></dd>
</dl>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Задача</th>
			<th>Описание</th>
			<th>Часы</th>
			<th>Цена</th>
			<th>Итог</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ( $tasks as $line ) { ?>
		<tr>
			<td><?= $line['name'] ?></td>
			<td><?= $line['about'] ?></td>
			<td><?= $line['spend'] ?></td>
			<td><?= $company['price'] ?> р.</td>
			<td><?= $line['price'] ?> р.</td>
		</tr>
<?php } ?>
	</tbody>
	<tfoot>
		<tr><td colspan="5" class="text-right">Итого: <strong><?= $fullPrice ?> р.</strong></td></tr>
	</tfoot>
</table>
<?php include('../../../lib/dbstop.php'); ?>