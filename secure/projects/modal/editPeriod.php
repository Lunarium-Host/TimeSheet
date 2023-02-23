<?php include( '../../../lib/secure.php');  
global $user;
$idPeriod = $_REQUEST['id'];
$period = dbRun("SELECT * FROM period WHERE id=?", 'i', $idPeriod);
if ( empty( $period ) ) { die("Период не найден");}
$period = $period[0];
?>
<FORM method="POST" id="editPeriod">
	<input type="hidden" name="id" value="<?= $idPeriod ?>">
	<div class="modal-header">
		<h5 class="modal-title">Внесение оплаты</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
	<div class="form-group">
		<label for="payed">Получено:</label>
		<input id="payed" name="payed" placeholder="рублей" value="<?= $period['payed'] ?>" type="text" class="form-control">
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
		<button type="submit" class="btn btn-primary">Внести оплату</button>
	</div>
</FORM>
<script type="text/javascript">
	var form = $('#editPeriod');
	form.submit( function(){
		$.post('action/editPeriod.php', form.serialize(), function(data){ window.location.reload(); } );
		return false;
	} );
</script>