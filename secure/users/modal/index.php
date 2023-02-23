<?php include( '../../../lib/secure.php'); 
	global $user;
	$id = $_REQUEST['id'];
	$data = dbRun("SELECT * FROM user WHERE id=?", 'i', $id );
	if ( empty( $data ) ) { die("Пользователя не существует"); }
	$data = $data[0];
	if ( $data['idCompany'] != $user['idCompany'] && $user['admin'] < 2 ){ die('Доступ запрещен'); }

	$data['name'] = htmlentities( $data['name'], ENT_QUOTES, 'UTF-8');
	$data['surname'] = htmlentities( $data['surname'], ENT_QUOTES, 'UTF-8');
	$data['lastname'] = htmlentities( $data['lastname'], ENT_QUOTES, 'UTF-8');

?>
<FORM method="POST" id="editUser">
	<input type="hidden" name="id" value="<?= $id ?>">
	<div class="modal-header">
		<h5 class="modal-title">Редактор пользователя</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<div class="form-check">	
				<input name="active" type="checkbox" class="form-check-input" <?= $data['active'] ? 'checked' : ''?>>
				<label class="form-check-label">Активность</label>
			</div>
		</div>
		<div class="form-group">
			<label for="lastdate">Дата посещения:</label>
			<input id="lastdate" name="lastdate" placeholder="Дата посещения" value="<?= $data['lastdate'] ?>" type="text" class="form-control" disabled>
		</div>
		<div class="form-group">
			<label for="login">Логин:</label>
			<input id="login" name="login" placeholder="Логин" value="<?= $data['login'] ?>" type="text" class="form-control" disabled>
		</div>
		<div class="form-group">
			<label for="name">Имя:</label>
			<input id="name" name="name" placeholder="Имя" value="<?= $data['name'] ?>" type="text" class="form-control">
		</div>
		<div class="form-group">
			<label for="surname">Отчество:</label>
			<input id="surname" name="surname" placeholder="Отчество" value="<?= $data['surname'] ?>" type="text" class="form-control">
		</div>
		<div class="form-group">
			<label for="lastname">Фамилия:</label>
			<input id="lastname" name="lastname" placeholder="Фамилия" value="<?= $data['lastname'] ?>" type="text" class="form-control">
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
		<button type="submit" class="btn btn-primary">Изменить</button>
		<button type="delete" onClick="deleteUser();" class="btn btn-danger">Удалить</button>
	</div>
</FORM>
<script type="text/javascript">
	var form = $('#editUser');
	form.submit( function(){
		$.post('action/', form.serialize(), function(data){ window.location.reload(); } );
		return false;
	} );

	function deleteUser() {
		$.post('action/delete.php', { id: <?= $id ?> } , function(data){ window.location.reload(); } );
	}
</script>