<?php include( '../../lib/secure.php'); global $user; ?>
<FORM action="actions/tmpl.php" method="POST" id="formModal">
	<div class="modal-header">
		<h5 class="modal-title">Template</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
	<div class="modal-body">
		Template
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
		<button type="submit" class="btn btn-primary">Добавить</button>
	</div>
</FORM>
<script type="text/javascript">
	var form = $('#formModal');
	form.submit( function(){
		$.post('action/tmpl.php', form.serialize(), function(data){ window.location.reload(); } );
		return false;
	} );
</script>