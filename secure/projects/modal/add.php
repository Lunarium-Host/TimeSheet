<?php include( '../../../lib/secure.php');  
$idCompany = $_REQUEST['id'];
global $user; 
?>
<FORM method="POST" id="addProject">
	<input type="hidden" name="id" value="<?= $idCompany ?>">
	<div class="modal-header">
		<h5 class="modal-title">Редактор Проекта</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
	<div class="form-group">
		<input id="active" name="active" type="checkbox" class="form-check-input" checked>
		<label class="form-check-label" for="active">Активен</label>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label for="code">Код:</label>
			<input id="code" name="code" placeholder="Код" type="text" class="form-control">
		</div>
		<div class="form-group">
			<label for="name">Имя:</label>
			<input id="name" name="name" placeholder="Имя" type="text" class="form-control">
		</div>
		<div class="form-group">
			<label for="about">Описание:</label>
			<textarea id="about" name="about" placeholder="Описание" class="form-control"></textarea>
		</div>
		
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
		<button type="submit" class="btn btn-primary">Добавить</button>
	</div>
</FORM>
<script type="text/javascript">
	var form = $('#addProject');
	form.submit( function(){
		$.post('action/add.php', form.serialize(), function(data){ window.location.reload(); } );
		return false;
	} );
</script>