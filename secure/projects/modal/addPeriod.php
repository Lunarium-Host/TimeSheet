<?php include( '../../../lib/secure.php');  
$idCompany = $_REQUEST['id'];
global $user; 
?>
<FORM method="POST" id="addPeriod">
	<input type="hidden" name="id" value="<?= $idCompany ?>">
	<div class="modal-header">
		<h5 class="modal-title">Закрытие периода</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
	<div class="modal-content">Вы действительно хотите закрыть период?</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
		<button type="submit" class="btn btn-primary">Закрыть</button>
	</div>
</FORM>
<script type="text/javascript">
	var form = $('#addPeriod');
	form.submit( function(){
		$.post('action/addPeriod.php', form.serialize(), function(data){ window.location.reload(); } );
		return false;
	} );
</script>