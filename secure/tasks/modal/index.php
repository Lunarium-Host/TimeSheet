<?php include( '../../../lib/secure.php'); 
	global $user;
	$id = $_REQUEST['id'];
	$task = dbRun("SELECT * FROM task WHERE id=?", 'i', $id );
	if ( empty( $task ) ) { die("Задачи не существует"); }
	$task = $task[0];
	$project['name'] = htmlentities( $project['name'], ENT_QUOTES, 'UTF-8');
	$statuses = dbRun("SELECT * FROM status");
?>
<FORM method="POST" id="editTask">
	<input type="hidden" name="id" value="<?= $id ?>">
	<div class="modal-header">
		<h5 class="modal-title">Редактор задачи</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label for="idStatus">Статус:</label>
			<select id="idStatus" name="idStatus" class="form-control">
<?php foreach ($statuses as $line) { ?>
	<option value="<?= $line['id'] ?>"<?= $line['id'] == $task['idStatus'] ? 'selected' : '' ?>><?= $line['name'] ?></option>
<?php } ?>
			</select>
		</div>
		<div class="form-group">
			<label for="name">Имя:</label>
			<input id="name" 
				name="name" 
				placeholder="Имя" 
				value="<?= $task['name'] ?>" 
				type="text" 
				data-rule="{val}.length > 0"
				class="form-control">
			<div class="invalid-feedback">
				Поле не может быть пустым.
			</div>
		</div>
		<div class="form-group">
			<label for="about">Описание:</label>
			<textarea id="about" 
				name="about" 
				placeholder="Описание" 
				class="form-control"><?= $task['about'] ?></textarea>
		</div>
		<div class="form-group">
			<label for="spend">Кол-во часов:</label>
			<input id="spend" 
				name="spend" 
				placeholder="Кол-во часов" 
				type="text" 
				value="<?= $task['spend'] ?>"
				data-rule="! isNaN({val})" 
				class="form-control">
			<div class="invalid-feedback">
				Должно быть число
			</div>
		</div>
		<div class="form-group">
			<label for="startdate">Дата старта:</label>
			<input id="startdate" 
				name="startdate" 
				placeholder="Дата старта" 
				value="<?= $task['startdate'] ?>" 
				type="text" 
				class="form-control">
		</div>
		<div class="form-group">
			<label for="enddatePlan">Плановая дата завершения:</label>
			<input id="enddatePlan" 
				name="enddatePlan" 
				placeholder="Плановая дата завершения" 
				value="<?= $task['enddatePlan'] ?>" 
				type="text" 
				class="form-control">
		</div>
		<div class="form-group">
			<label for="enddate">Дата завершения:</label>
			<input id="enddate" 
				name="enddate" 
				placeholder="Дата завершения" 
				type="text" 
				value="<?= $task['enddate'] ?>" 
				class="form-control">
		</div>
	</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
		<button type="submit" class="btn btn-primary">Изменить</button>
		<button type="submit" class="btn btn-danger" onClick="removeTask()">Удалить</button>
	</div>
</FORM>
<script type="text/javascript">
	var form = $('#editTask');

	form.find('#startdate').datetimepicker({
      uiLibrary: 'bootstrap4',
      modal: true,
      footer: true,
      format: 'yyyy-mm-dd HH:MM:00',
      // minDate: today
      // locale: 'ru-ru'
  });
  form.find('#enddatePlan').datetimepicker({
      uiLibrary: 'bootstrap4',
      modal: true,
      footer: true,
      format: 'yyyy-mm-dd HH:MM:00',
      // minDate: today
      // locale: 'ru-ru'
  });
  form.find('#enddate').datetimepicker({
      uiLibrary: 'bootstrap4',
      modal: true,
      footer: true,
      format: 'yyyy-mm-dd HH:MM:00',
      // minDate: today
      // locale: 'ru-ru'
  });
	
	form.find('input,select,textarea').each( function() { 
		__attachValidationHandler( $(this) ); } );

	form.submit( function(){
		if ( form.find('.is-invalid').length > 0 ) { return false; }
		$.post('/secure/tasks/action/', form.serialize(), function(data) { window.location.reload(); } );
		return false;
	} );

	function removeTask() {
		if ( ! confirm("Хотите удалить задачу?") ) { return false; }
		$.post('/secure/tasks/action/remove.php', { id : <?= $id ?>  }, function(data) { window.location.reload(); } );
	}
</script>