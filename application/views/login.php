<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<title>Login</title>
		<meta content="Login Dashboard Perpustakaan" name="description" />
		<meta content="Perpustakaan SMA Negeri 1 Tompaso" name="author" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<link rel="shortcut icon" href="<?php echo base_url() ?>mods/assets/images/logo-sma.png">

		<!-- Sweet Alert -->
        <link href="<?php echo base_url() ?>mods/assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url() ?>mods/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url() ?>mods/assets/css/icons.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url() ?>mods/assets/css/style.css" rel="stylesheet" type="text/css">
		<!-- jQuery  -->
		<script src="<?php echo base_url() ?>mods/assets/js/jquery.min.js"></script>
		<script src="<?php echo base_url() ?>mods/assets/js/popper.min.js"></script>
		<script src="<?php echo base_url() ?>mods/assets/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url() ?>mods/assets/js/modernizr.min.js"></script>
		<script src="<?php echo base_url() ?>mods/assets/js/detect.js"></script>
		<script src="<?php echo base_url() ?>mods/assets/js/fastclick.js"></script>
		<script src="<?php echo base_url() ?>mods/assets/js/jquery.slimscroll.js"></script>
		<script src="<?php echo base_url() ?>mods/assets/js/jquery.blockUI.js"></script>
		<script src="<?php echo base_url() ?>mods/assets/js/waves.js"></script>
		<script src="<?php echo base_url() ?>mods/assets/js/jquery.nicescroll.js"></script>
		<script src="<?php echo base_url() ?>mods/assets/js/jquery.scrollTo.min.js"></script>
		<!-- Sweet-Alert  -->
        <script src="<?php echo base_url() ?>mods/assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
	</head>
	<body class="fixed-left">
		<!-- Begin page -->
		<div class="accountbg"></div>
		<div class="wrapper-page">
			<div class="card">
				<div class="card-body">
					<h3 class="text-center mt-0 m-b-15">
						<a href="" class="logo"><img src="<?php echo base_url() ?>mods/assets/images/logo-sma.png" height="50" alt="logo"></a>
						<a href="" class="logo">E-Perpus</a>
					</h3>
					<div class="p-3">
						<form class="form-horizontal m-t-20" action="<?php echo site_url('Login/login_proses') ?>" method="post">
							<div class="form-group row">
								<div class="col-12">
									<input class="form-control" type="email" required="" name="username" placeholder="Username" autofocus="">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-12">
									<input class="form-control" type="password" name="password" required="" placeholder="Password">
								</div>
							</div>
							<div class="form-group text-center row m-t-20">
								<div class="col-12">
									<button class="btn btn-danger btn-block waves-effect waves-light" type="submit">Log In</button>
								</div>
								<div class="col-12 m-t-10">
									<button type="button" class="btn btn-primary btn-block" onclick="window.location='<?php echo site_url('register') ?>'"><i class="mdi mdi-account-circle"></i> Daftar Akun Baru</button>
									<!-- <a href="pages-register.html" class="btn btn-primary btn-block"><i class="mdi mdi-account-circle"></i> <small>Create an account ?</small></a> -->
								</div>
							</div>
							<div class="form-group m-t-10 mb-0 row">
								<div class="col-12">
									<?php echo $this->session->flashdata('notif'); ?>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- App js -->
		<script src="<?php echo base_url() ?>mods/assets/js/app.js"></script>
	</body>
</html>