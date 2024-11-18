<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<title>Register</title>
		<meta content="Login Dashboard Perpustakaan" name="description" />
		<meta content="Perpustakaan SMA Negeri 1 Tompaso" name="author" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<link rel="shortcut icon" href="<?php echo base_url() ?>mods/assets/images/logo-sma.png">

		<!-- Sweet Alert -->
        <link href="<?php echo base_url() ?>mods/assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url() ?>mods/assets/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
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
        <script src="<?php echo base_url() ?>mods/assets/plugins/select2/select2.min.js" type="text/javascript"></script>
		
	</head>
	<body class="fixed-left">
		<!-- Begin page -->
		<div class="accountbg"></div>
		<div class="col-md-12">
			<div class="row">
				<div class="wrapper-page col-md-12">
					<div class="card">
						<div class="card-body">
							<h3 class="text-center mt-0 m-b-15">
								<a href="" class="logo"><img src="<?php echo base_url() ?>mods/assets/images/logo-sma.png" height="50" alt="logo"></a>
								<a href="" class="logo">E-Perpus</a><br>
								Daftar Akun Baru
							</h3>
							<div class="p-3">
								<form class="form-horizontal m-t-20" action="<?php echo site_url('Login/daftar') ?>" method="post" enctype="multipart/form-data">
									<div class="form-group row">
										<div class="col-12">
											<input class="form-control" type="number" min="1" required="" name="nis" placeholder="NIS" autofocus="">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-12">
											<input class="form-control" type="text" required="" name="nama" placeholder="Nama" autofocus="">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-12">
											<input type="number" class="form-control" min="1" placeholder="Tahun masuk" required name="tahun">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-12">
											<input type="text" class="form-control" placeholder="Nomor HP" required name="nohp">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-12">
											<input type="email" class="form-control" required name="email" placeholder="Email">
										</div>
									</div>
									
									<div class="form-group row">
										<div class="col-12">
											<input type="password" class="form-control" required name="password" placeholder="Password">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-12">
											<textarea name="alamat" class="form-control" required placeholder="Alamat"></textarea>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-12">
											<label>Buku Yang Disukai</label> 
											<select name="kategori[]" class="form-control sl2" multiple required>
												<?php foreach ($kategori as $k){ ?>
													<option value="<?php echo encrypt_url($k->IdKategori) ?>"><?php echo $k->NamaKategori ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-12">
											<input type="number" class="form-control" required name="id_telegram" placeholder="ID Telegram">
											<span><div class="alert alert-warning" role="alert" style="color: black;">
												<strong><a href="https://t.me/perpus_notif_bot" title="" target="_blank">Klik Disini</a></strong> Untuk Mendapatkan ID Telegram Anda
											</div></span>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-12">
											<label>Foto</label><br>
											<input type="file" name="foto" accept="image/*" >
										</div>
									</div>
									<div class="form-group text-center row m-t-20">
										<div class="col-12 m-b-10">
											<button type="submit" class="btn btn-primary btn-block"><i class="mdi mdi-account"></i> Daftar</button>
										</div>
										<div class="col-12">
											<button class="btn btn-danger btn-block waves-effect waves-light" type="button" onclick="window.location='<?php echo site_url('Login') ?>'">Log In</button>
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
			</div>
		</div>			
		<!-- App js -->
		<script src="<?php echo base_url() ?>mods/assets/js/app.js"></script>
		<script>
			$(".sl2").select2({
	           width: '100%'
	       });
		</script>
	</body>
</html>