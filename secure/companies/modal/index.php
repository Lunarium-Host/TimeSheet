<?php include( '../../../lib/secure.php'); 
	global $user;
	$id = $_REQUEST['id'];
	$company = dbRun("SELECT * FROM company WHERE id=?", 'i', $id );
	if ( empty( $company ) ) { die("Компании не существует"); }
	$company = $company[0];
	$company['name'] = htmlentities( $company['name'], ENT_QUOTES, 'UTF-8')
?>
<FORM method="POST" id="editCompany">
	<input type="hidden" name="id" value="<?= $id ?>">
	<div class="modal-header">
		<h5 class="modal-title">Редактор компании</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label for="code">Код:</label>
			<input id="code" name="code" placeholder="Код" value="<?= $company['code'] ?>" type="text" class="form-control">
		</div>
		<div class="form-group">
			<label for="name">Имя:</label>
			<input id="name" name="name" placeholder="Имя" value="<?= $company['name'] ?>" type="text" class="form-control">
		</div>
		<div class="form-group">
			<label for="about">Описание:</label>
			<textarea id="about" name="about" placeholder="Описание" class="form-control"><?= $company['about'] ?></textarea>
		</div>
		<div class="form-group">
			<label for="price">Цена:</label>
			<input id="price" name="price" placeholder="Цена" value="<?= $company['price'] ?>" type="text" class="form-control">
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
		<button type="submit" class="btn btn-primary">Изменить</button>
	</div>
</FORM>
<script type="text/javascript">
	var form = $('#editCompany');
	form.submit( function(){
		$.post('action/', form.serialize(), function(data){ window.location.reload(); } );
		return false;
	} );
</script>