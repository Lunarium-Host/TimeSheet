<?php include( '../../../lib/secure.php'); 
	global $user;
	$id = $_REQUEST['id'];
	if ( ! empty( $id ) && $id != $user['idCompany'] && $user['admin'] < 2 ){ die('Доступ запрещен'); }
?>
<FORM method="POST" id="addUser">
	<input type="hidden" name="id" value="<?= $id ?>">
	<div class="modal-header">
		<h5 class="modal-title">Добавить пользователя</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<div class="form-check">	
				<input name="active" type="checkbox" class="form-check-input" checked>
				<label class="form-check-label">Активность</label>
			</div>
		</div>
		<div class="form-group">
			<label for="loginis">Логин:</label>
			<input id="loginis" name="loginis" placeholder="Логин" value="" type="text" class="form-control" >
		</div>
		<div class="form-group">
			<label for="name">Имя:</label>
			<input id="name" name="name" placeholder="Имя" value="" type="text" class="form-control">
		</div>
		<div class="form-group">
			<label for="surname">Отчество:</label>
			<input id="surname" name="surname" placeholder="Отчество" value="" type="text" class="form-control">
		</div>
		<div class="form-group">
			<label for="lastname">Фамилия:</label>
			<input id="lastname" name="lastname" placeholder="Фамилия" value="" type="text" class="form-control">
		</div>
		<div class="form-group">
			<label for="pass">Пароль:</label>
			<input id="pass" name="pass" placeholder="Пароль" value="" type="password" class="form-control">
		</div>
		<div class="form-group">
			<label for="pass2">Пароль еще раз:</label>
			<input id="pass2" name="pass2" placeholder="Пароль" value="" type="password" class="form-control">
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
		<button type="submit" class="btn btn-primary">Добавить</button>
	</div>
</FORM>
<script type="text/javascript">
	var form = $('#addUser');
	form.submit( function(){
		$.post('action/add.php', form.serialize(), function(data){ window.location.reload(); } );
		return false;
	} );
</script>