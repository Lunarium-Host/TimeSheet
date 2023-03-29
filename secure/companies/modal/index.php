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
			<input id="code" 
				name="code" 
				placeholder="Код" 
				value="<?= $company['code'] ?>" 
				type="text" 
				data-rule="{val}.length > 0"
				class="form-control">
			<div class="invalid-feedback">
				Код используется для обозначения, придумайте код.
			</div>
		</div>
		<div class="form-group">
			<label for="name">Имя:</label>
			<input id="name" 
				name="name" 
				placeholder="Имя" 
				value="<?= $company['name'] ?>" 
				type="text" 
				data-rule="{val}.length > 0"
				class="form-control">
			<div class="invalid-feedback">
				Должно быть введено наименование компании.
			</div>
		</div>
		<div class="form-group">
			<label for="about">Описание:</label>
			<textarea id="about" 
				name="about" 
				placeholder="Описание" 
				class="form-control"
			><?= $company['about'] ?></textarea>
		</div>
		<div class="form-group">
			<label for="price">Цена:</label>
			<input id="price" 
				name="price" 
				placeholder="Цена" 
				value="<?= $company['price'] ?>" 
				type="text" 
				data-rule="! isNaN({val})"
				class="form-control">
			<div class="invalid-feedback">
				Должно быть число, либо 0.
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
		<button type="submit" class="btn btn-primary">Изменить</button>
	</div>
</FORM>
<script type="text/javascript">
	var form = $('#editCompany');

	form.find('input,select,textarea').each( function() { 
		__attachValidationHandler( $(this) ); } );

	form.submit( function(){
		if ( form.find('.is-invalid').length > 0 ) { return false; }
		$.post('action/', form.serialize(), function(data){ window.location.reload(); } );
		return false;
	} );
</script>