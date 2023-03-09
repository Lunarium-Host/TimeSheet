<?php include('tpl/header.php'); ?>
		<div class="container-fluid page-body-wrapper full-page-wrapper">
			<div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
				<div class="row flex-grow">
					<div class="col-lg-6 d-flex align-items-center justify-content-center">
						<div class="auth-form-transparent text-left p-3">
							<div class="brand-logo">
								<img src="/images/logo.svg" alt="logo">
							</div>
							<h4>Авторизация</h4>
							<h6 class="font-weight-light">Введите учетные данные для продолжения</h6>
							<form class="pt-3" method="POST" action="secure/">
								<div class="form-group">
									<label for="exampleInputEmail">Логин</label>
									<div class="input-group">
										<div class="input-group-prepend bg-transparent">
											<span class="input-group-text bg-transparent border-right-0">
												<i class="ti-user text-primary"></i>
											</span>
										</div>
										<input type="text" name='login' class="form-control form-control-lg border-left-0" id="userLogin" placeholder="Логин">
									</div>
<?PHP if( ! empty( $_GET ) && $_GET['auth'] == 'bad') { ?>
										<span class='text-danger'>Неверный логин</span>
<?PHP } ?>
									
								</div>
								<div class="form-group">
									<label for="exampleInputPassword">Пароль</label>
									<div class="input-group">
										<div class="input-group-prepend bg-transparent">
											<span class="input-group-text bg-transparent border-right-0">
												<i class="ti-lock text-primary"></i>
											</span>
										</div>
										<input type="password" name='passwd' class="form-control form-control-lg border-left-0" id="userPass" placeholder="Пароль">                        
									</div>
								</div>
								<div class="my-2 d-flex justify-content-between align-items-center">
									<div class="form-check">
										<label class="form-check-label text-muted">
											<input type="checkbox" class="form-check-input">
											Запомнить
										</label>
									</div>
									<a href="#" class="auth-link text-black">Забыли пароль?</a>
								</div>
								<div class="my-3">
									<input type='submit' class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value='Войти'>
								</div>
								<div class="text-center mt-4 font-weight-light">
								</div>
							</form>
						</div>
					</div>
					<div class="col-lg-6 login-half-bg d-flex flex-row">
						<p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2023 <a href="http://www.lundera.ru" target="_blank">Lundera</a>.</p>
					</div>
				</div>
			</div>
		</div>
<?php include('tpl/footer_web.php'); ?>
