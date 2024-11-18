<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<title><?= $title ?></title>
		<meta content="Admin Dashboard Perpustakaan" name="description" />
		<meta content="Perpustakaan SMA Negeri 1 Tompaso" name="author" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />

		<link rel="shortcut icon" href="<?php echo base_url() ?>mods/assets/images/logo-sma.png">

		<link href="<?php echo base_url() ?>mods/assets/plugins/morris/morris.css" rel="stylesheet">
		<!-- Sweet Alert -->
        <link href="<?php echo base_url() ?>mods/assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url() ?>mods/assets/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />

        <!-- DataTables -->
        <link href="<?php echo base_url() ?>mods/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>mods/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="<?php echo base_url() ?>mods/assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

		<link href="<?php echo base_url() ?>mods/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url() ?>mods/assets/css/icons.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url() ?>mods/assets/css/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"/>
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
        <!-- Required datatable js -->
         <script src="<?php echo base_url() ?>mods/assets/plugins/datatables/jquery.dataTables.min.js"></script>
         <script src="<?php echo base_url() ?>mods/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
         <!-- Buttons examples -->
         <script src="<?php echo base_url() ?>mods/assets/plugins/datatables/dataTables.buttons.min.js"></script>
         <script src="<?php echo base_url() ?>mods/assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
         <script src="<?php echo base_url() ?>mods/assets/plugins/datatables/jszip.min.js"></script>
         <script src="<?php echo base_url() ?>mods/assets/plugins/datatables/pdfmake.min.js"></script>
         <script src="<?php echo base_url() ?>mods/assets/plugins/datatables/vfs_fonts.js"></script>
         <script src="<?php echo base_url() ?>mods/assets/plugins/datatables/buttons.html5.min.js"></script>
         <script src="<?php echo base_url() ?>mods/assets/plugins/datatables/buttons.print.min.js"></script>
         <script src="<?php echo base_url() ?>mods/assets/plugins/datatables/buttons.colVis.min.js"></script>
         <!-- Responsive examples -->
         <script src="<?php echo base_url() ?>mods/assets/plugins/datatables/dataTables.responsive.min.js"></script>
         <script src="<?php echo base_url() ?>mods/assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
 
		<script src="<?php echo base_url() ?>mods/assets/plugins/skycons/skycons.min.js"></script>
		<script src="<?php echo base_url() ?>mods/assets/plugins/raphael/raphael-min.js"></script>
		<script src="<?php echo base_url() ?>mods/assets/plugins/morris/morris.min.js"></script>
		<!-- Sweet-Alert  -->
        <script src="<?php echo base_url() ?>mods/assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
        <script src="<?php echo base_url() ?>mods/assets/plugins/select2/select2.min.js" type="text/javascript"></script>
        <!--Wysiwig js-->
        <script src="<?php echo base_url() ?>mods/assets/ck/ckeditor.js?<?php echo md5(date('h:i:s')) ?>" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
		<style type="text/css" media="screen">
			.card-body{
				padding: 15px;
			}
			textarea{
				resize: none;
			}
			body{
				font-size: 14px !important;
			}
			label{
				font-weight: bold;
			}
			th{
				font-weight: bold;
			}
			.fancybox__content{
				padding: 0px;
				height: 100% !important;
			}
		</style>
	</head>
	<body class="fixed-left">
		<!-- Loader -->
		<div id="preloader"><div id="status"><div class="spinner"></div></div></div>
		<!-- Begin page -->
		<div id="wrapper">
			<!-- ========== Left Sidebar Start ========== -->
			<div class="left side-menu">
				<button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
					<i class="ion-close"></i>
				</button>
				<!-- LOGO -->
				<div class="topbar-left">
					<div class="text-center">
						<a href="" class="logo"><img src="<?php echo base_url() ?>mods/assets/images/logo-sma.png" height="50" alt="logo"></a>
						<a href="" class="logo">E-Perpus</a>
					</div>
				</div>
				<div class="sidebar-inner slimscrollleft">
					<div id="sidebar-menu">
						<ul>
							<li class="menu-title">Main</li>

							<li>
								<a href="<?php echo site_url('Siswa') ?>" class="waves-effect">
									<i class="mdi mdi-airplay"></i>
									<span> Dashboard</span>
								</a>
							</li>
							<li class="has_sub">
								<a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-layers"></i> <span> Data Buku </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
								<ul class="list-unstyled">
									<li><a href="<?php echo site_url('Siswa/pinjam_buku') ?>">Peminjaman</a></li>
									<li><a href="<?php echo site_url('Siswa/history_pinjam') ?>">History</a></li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="clearfix"></div>
				</div> <!-- end sidebarinner -->
			</div>
			<!-- Left Sidebar End -->
			<!-- Start right Content here -->
			<div class="content-page">
				<!-- Start content -->
				<div class="content">
					<!-- Top Bar Start -->
					<div class="topbar">
						<nav class="navbar-custom">
							<ul class="list-inline float-right mb-0">
								<li class="list-inline-item dropdown notification-list">
									<a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
									   aria-haspopup="false" aria-expanded="false">
										<img src="<?php echo base_url() ?>mods/assets/pic/<?php echo $this->session->userdata('foto'); ?>" alt="user" class="rounded-circle">
									</a>
									<div class="dropdown-menu dropdown-menu-right profile-dropdown col-md-12" style="width: 100%;">
										<a class="dropdown-item" href="javascript:void(0)" style="padding-left: 10px;" onclick="$('#modal-password').modal('show');"><i class="mdi mdi-fingerprint m-r-3 text-muted"></i>Ubah Password</a>
										<a class="dropdown-item" href="javascript:void(0)" style="padding-left: 10px;" onclick="get_rekom()"><i class="mdi mdi-book m-r-3 text-muted"></i>Rekomendasi</a>
										<a class="dropdown-item" href="<?php echo site_url('Login/logout') ?>" style="padding-left: 10px;"><i class="mdi mdi-logout m-r-3 text-muted"></i>Logout</a>
									</div>

								</li>
							</ul>
							<ul class="list-inline menu-left mb-0">
								<li class="float-left">
									<button class="button-menu-mobile open-left waves-light waves-effect">
										<i class="mdi mdi-menu"></i>
									</button>
								</li>
							</ul>
							<div class="clearfix"></div>
						</nav>
					</div>
					<!-- Top Bar End -->
					<div class="page-content-wrapper ">
						<div class="container-fluid">

							<div class="row">
								<div class="col-sm-12">
									<div class="page-title-box">
										<div class="btn-group float-right">
											<ol class="breadcrumb hide-phone p-0 m-0">
												<li class="breadcrumb-item"><a href="#">Application</a></li>
												<li class="breadcrumb-item active"><strong><?= $title ?></strong></li>
											</ol>
										</div>
										<h4 class="page-title"><?= $title ?></h4>
									</div>
								</div>
							</div>
							<!-- end page title end breadcrumb -->

									
							<div class="row">
								<?php echo $this->session->flashdata('notif'); ?>
								<?php $this->load->view($content); ?>
							</div>
							                                                 
						</div><!-- container -->


					</div> <!-- Page content Wrapper -->

				</div> <!-- content -->

				<footer class="footer">
					© <?php echo date('Y') ?> Create by 💙.
				</footer>

			</div>
			<!-- End Right content here -->

		</div>
		<!-- END wrapper -->
		<div class="modal fade" id="modal-rekom">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Setting Rekomendasi Buku</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							<span class="sr-only">Close</span>
						</button>
					</div>
					<form id="frm-rekom" action="<?php echo site_url('Siswa/simpan_rekomendasi') ?>" method="post" accept-charset="utf-8">
						<div class="modal-body" id="body-rekom">
							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save changes</button>
						</div>
					</form>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<div class="modal fade" id="modal-password">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Ubah Password</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							<span class="sr-only">Close</span>
						</button>
					</div>
					<form action="<?php echo site_url('Siswa/update_password') ?>" method="post" accept-charset="utf-8">
						<div class="modal-body">
							<div class="row">
								<div class="col-md-6 form-group">
									<label>Password Lama</label>
									<input type="password" name="old_pass" required class="form-control">
								</div>
								<div class="col-md-6 form-group">
									<label>Password Baru</label>
									<input type="password" name="new_pass" required class="form-control">
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save changes</button>
						</div>
					</form>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- App js -->
		<script src="<?php echo base_url() ?>mods/assets/js/app.js"></script>
		<script>
			 /* BEGIN SVG WEATHER ICON */
			 if (typeof Skycons !== 'undefined'){
			var icons = new Skycons(
				{"color": "#fff"},
				{"resizeClear": true}
				),
					list  = [
						"clear-day", "clear-night", "partly-cloudy-day",
						"partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
						"fog"
					],
					i;

				for(i = list.length; i--; )
				icons.set(list[i], list[i]);
				icons.play();
			};

		// scroll

		$(document).ready(function() {
		$('.table1').DataTable({
			responsive: true,
				"language": {
	             "url": "<?php echo base_url() ?>mods/assets/plugins/datatables/id.json"
	         },
		});
		$("#boxscroll").niceScroll({cursorborder:"",cursorcolor:"#cecece",boxzoom:true});
		$("#boxscroll2").niceScroll({cursorborder:"",cursorcolor:"#cecece",boxzoom:true}); 
		
		});
			$(".sl2").select2({
	           width: '100%'
	       });
		
		function get_rekom()
		{
			$.ajax({
				url: '<?php echo site_url('Siswa/get_rekom') ?>',
				type: 'POST',
				dataType: 'html',
				success: function(data, textStatus, xhr) {
					//called when successful
					$("#modal-rekom").modal('show');
					$("#body-rekom").html(data);
				},
				error: function(xhr, textStatus, errorThrown) {
					//called when there is an error
					swal('error',errorThrown,'error');
				}
			});
			
		}
		</script>
		</script>
		<script>
			
		</script>	
	</body>
</html>