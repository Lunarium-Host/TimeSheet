<?php 
	include('tpl/header.php');
?>

		<div class="container-fluid page-body-wrapper full-page-wrapper">
			<div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
				<div class="row flex-grow">
					<div class="col-lg-6 d-flex align-items-center justify-content-center">
						<div class="auth-form-transparent text-left p-3">
							<div class="brand-logo">
								<img src="/images/logo.svg" alt="logo">
							</div>
							<div class="my-3">
								<a href='secure/' class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Войти</a>
							</div>
						</div>
					</div>
					<div class="col-lg-6 login-half-bg d-flex flex-row">
						<p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2018 AutoCar.</p>
					</div>
				</div>
			</div>
			<!-- content-wrapper ends -->
		</div>
		<!-- page-body-wrapper ends -->
<?php
include('tpl/footer.php');
?>