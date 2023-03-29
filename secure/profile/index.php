<?php include('../../tpl/header_secure.php'); global $user; ?>
<div class="row">
	<div class="col-lg-12 grid-margin">
		<div class="card">
			<div class="card-body row">
				<h4 class="card-title col-12">Ваш профиль</h4>
				<DIV class="card-description col-12">
					<FORM id="userProfile" action="action/" method="POST">
						<div class="form-group">
							<label for="name">Имя:</label>
							<input id="name" 
								name="name" 
								placeholder="Имя" 
								value="<?= $user['name'] ?>" 
								type="text" 
								data-rule="{val}.length > 0"
								class="form-control">
							<div class="invalid-feedback">
								Поле не может быть пустым.
							</div>
						</div>
						<div class="form-group">
							<label for="surname">Отчество:</label>
							<input id="surname" 
								name="surname" 
								placeholder="Отчество" 
								value="<?= $user['surname'] ?>" 
								type="text" 
								class="form-control">
						</div>
						<div class="form-group">
							<label for="lastname">Фамилия:</label>
							<input id="lastname" 
								name="lastname" 
								placeholder="Фамилия" 
								value="<?= $user['lastname'] ?>" 
								type="text" 
								class="form-control">
						</div>
						<div class="form-group">
							<label for="pass">Пароль:</label>
							<input id="pass" 
								name="pass" 
								placeholder="Пароль" 
								value="" 
								type="password" 
								class="form-control">
						</div>
						<div class="form-group">
							<label for="pass2">Пароль еще раз:</label>
							<input id="pass2" 
								name="pass2" 
								placeholder="Пароль" 
								value="" 
								type="password" 
								data-rule="$('#pass').val() == {val}"
								class="form-control">
							<div class="invalid-feedback">
								Пароли не совпадают.
							</div>
						</div>
						<button type="submit" class="btn btn-primary mr-2">Сохранить</button>
					</FORM>
				</DIV>
			</div>
		</div>
	</div>
</div>
<?php include('../../tpl/footer_secure.php') ?>