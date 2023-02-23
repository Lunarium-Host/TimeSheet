<?php 
	$absPath = realpath(dirname(__FILE__) . '/..');
	include_once( $absPath . '/lib/secure.php'); 
?>

	<?php include('header.php'); ?>
		<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
			<?php include('logo.php'); ?>
			<div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
				<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
					<span class="ti-view-list"></span>
				</button>
				<?php include('searchinput.php');  ?>
				<ul class="navbar-nav navbar-nav-right">
				  <?php include('messages.php'); ?>
					<?php include('warnings.php'); ?>
					<?php include('menu_profile.php'); ?>
				</ul>
				<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
					<span class="ti-view-list"></span>
				</button>
			</div>
		</nav>
	<!-- partial -->
		<div class="container-fluid page-body-wrapper">
		<!-- partial:partials/_sidebar.html -->
			<nav class="sidebar sidebar-offcanvas" id="sidebar">
				<?php include('menu_secure.php') ?>
			</nav>
		<!-- partial -->
			<div class="main-panel">
				<div class="content-wrapper">