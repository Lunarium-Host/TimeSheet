		</div>
	</div>
	<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1Label" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content"></div>
		</div>
	</div>
	<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modal2label" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content"></div>
		</div>
	</div>

	<div id="printArea"></div>

	<script src="/vendors/base/vendor.bundle.base.js"></script>
	<script src="/vendors/chart.js/Chart.min.js"></script>
	<script src="/js/off-canvas.js"></script>
	<script src="/js/hoverable-collapse.js"></script>
	<script src="/js/template.js"></script>
	<script src="/js/todolist.js"></script>
	<script src="/js/gijgo.min.js"></script>

	<script type="text/javascript">
		window.dialog1 = $('#modal1');
		window.dialog1.content = function( ctnt ) {
			window.dialog1.find('.modal-content').empty().append( ctnt );
			return window.dialog1;
		}
		window.dialog2 = $('#modal2');
		window.dialog2.content = function( ctnt ) {
			window.dialog2.find('.modal-content').empty().append( ctnt );
			return window.dialog2;
		}

		function printPage( url, params ) {
			var main = $('#main');
			var printArea = $('#printArea');
			$.post( url, params, function(data) {	
				main.hide();
				printArea.html(data);
				setTimeout(function(){
					window.print();
					setTimeout(function(){
						printArea.empty();
						main.show();	
					},500);
				},100);
			} );
		}

		function addTask(){
			$.post('/secure/modal/addTask.php', {}, function(data){
				dialog1.content( data ).modal('show'); 
			} );
		}

		function __attachValidationHandler(input) {
			var rule = input.data("rule");
			if (typeof rule !== 'undefined' && rule.length > 0) {
				input.blur(
					function () {
						var current = $(this).val();
						var code = rule.replace("{val}", "'" + current + "'");
						var result = __eval(code);
						if (result) $(this).removeClass("is-invalid");
						else $(this).addClass("is-invalid");
					} 
				);
			}
		}

		function __eval(code) { 
			return Function('"use strict";return (' + code + ')')(); }

		$(document).ready(function() {
			$('input,select,textarea').each( function() { 
				__attachValidationHandler( $(this) ); } );

			$('form').each( function() {
				var form = $(this);
				form.submit( function() {
					if( form.find('.is-invalid').length > 0 ) { return false; }
					return true;
				} );
			} );
		} );
	</script>
</body>
</html>
