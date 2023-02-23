<?php include( '../../../lib/secure.php'); 
	global $user;
	$id = $_REQUEST['id'];
	$project = dbRun("SELECT * FROM project WHERE id=?", 'i', $id );
	if ( empty( $project ) ) { die("Проекта не существует"); }
	$project = $project[0];
	$project['name'] = htmlentities( $project['name'], ENT_QUOTES, 'UTF-8');
?>
<FORM method="POST" id="editProject">
	<input type="hidden" name="id" value="<?= $id ?>">
	<div class="modal-header">
		<h5 class="modal-title">Редактор Проекта</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
	<div class="form-group">
		<input id="active" name="active" type="checkbox" <?= $project['active'] ? 'checked' : '' ?> class="form-check-input">
		<label class="form-check-label" for="active">Активен</label>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label for="code">Код:</label>
			<input id="code" name="code" placeholder="Код" value="<?= $project['code'] ?>" type="text" class="form-control">
		</div>
		<div class="form-group">
			<label for="name">Имя:</label>
			<input id="name" name="name" placeholder="Имя" value="<?= $project['name'] ?>" type="text" class="form-control">
		</div>
		<div class="form-group">
			<label for="about">Описание:</label>
			<textarea id="about" name="about" placeholder="Описание" class="form-control"><?= $project['about'] ?></textarea>
		</div>
		
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
		<button type="submit" class="btn btn-primary">Изменить</button>
	</div>
</FORM>
<script type="text/javascript">
	var form = $('#editProject');
	form.submit( function(){
		$.post('action/', form.serialize(), function(data){ window.location.reload(); } );
		return false;
	} );
</script>