<?php include( '../../../lib/secure.php'); 
	global $user;
	$idProject = $_REQUEST['id'];
	$project = dbRun("SELECT * FROM project WHERE id=?", 'i', $idProject);
	if ( empty( $project ) ) { die('Проекта не существует'); }
	$project = $project[0];
	$statuses = dbRun("SELECT * FROM status");
?>
<FORM method="POST" id="addTask">
	<input type="hidden" name="id" value="<?= $idProject ?>">
	<div class="modal-header">
		<h5 class="modal-title">Редактор задачи</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label for="idStatus">Статус:</label>
			<select id="idStatus" name="idStatus" class="form-control">
<?php foreach ($statuses as $line) { ?>
	<option value="<?= $line['id'] ?>"><?= $line['name'] ?></option>
<?php } ?>
			</select>
		</div>
		<div class="form-group">
			<label for="name">Имя:</label>
			<input id="name" name="name" placeholder="Имя" type="text" class="form-control">
		</div>
		<div class="form-group">
			<label for="about">Описание:</label>
			<textarea id="about" name="about" placeholder="Описание" class="form-control"></textarea>
		</div>
		<div class="form-group">
			<label for="spend">Кол-во часов:</label>
			<input id="spend" name="spend" placeholder="Кол-во часов" type="text" value="0" class="form-control">
		</div>
		<div class="form-group">
			<label for="startdate">Дата старта:</label>
			<input id="startdate" name="startdate" placeholder="Дата старта" type="text" class="form-control">
		</div>
		<div class="form-group">
			<label for="enddatePlan">Плановая дата завершения:</label>
			<input id="enddatePlan" name="enddatePlan" placeholder="Плановая дата завершения" type="text" class="form-control">
		</div>
		<div class="form-group">
			<label for="enddate">Дата завершения:</label>
			<input id="enddate" name="enddate" placeholder="Дата завершения" type="text" class="form-control">
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
		<button type="submit" class="btn btn-primary">Добавить</button>
	</div>
</FORM>
<script type="text/javascript">
	$('#startdate').datetimepicker({
      uiLibrary: 'bootstrap4',
      modal: true,
      footer: true,
      format: 'yyyy-mm-dd HH:MM:00',
      // minDate: today
      // locale: 'ru-ru'
  });
  $('#enddatePlan').datetimepicker({
      uiLibrary: 'bootstrap4',
      modal: true,
      footer: true,
      format: 'yyyy-mm-dd HH:MM:00',
      // minDate: today
      // locale: 'ru-ru'
  });
  $('#enddate').datetimepicker({
      uiLibrary: 'bootstrap4',
      modal: true,
      footer: true,
      format: 'yyyy-mm-dd HH:MM:00',
      // minDate: today
      // locale: 'ru-ru'
  });
	var form = $('#addTask');
	form.submit( function(){
		$.post('action/add.php', form.serialize(), function(data){ window.location.reload(); } );
		return false;
	} );
</script>