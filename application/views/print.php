<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<title>PRINT</title>
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
<!-- <body style="padding: 10px;"> -->
<body style="padding: 20px;" onload="window.print();window.onafterprint = window.close;">
	<center>
		<table border="0" style="width: 75%;">
			<tbody>
				<tr>
					<td>
						<center>
							<img src="<?php echo base_url() ?>mods/assets/images/logo-sma.png" style="width: 75px;">
						</center>
					</td>
					<td>
						<center>
							<h5 style="margin-bottom: 5px;">Laporan Peminjaman Buku</h5>
							<h4>SMA NEGERI 1 TOMPASO</h4>
						</center>
					</td>
					<td>
						<center>
							<img src="https://www.freepnglogos.com/uploads/tut-wuri-handayani-png-logo/vector-wuri-handayani-warna-0.png" style="width: 60px;">
						</center>
					</td>
				</tr>
			</tbody>
		</table>
		<hr style="border: solid 0.25px;">
	</center>
	<br>
	Data Peminjaman Buku <br>
	Tanggal : <?php echo tgl_indo($awal) ?> (s/d) <?php echo tgl_indo($akhir) ?><br>
	Tanggal Cetak : <?php echo tgl_indo(date('Y-m-d')) ?>
	<br>
	<br>
	<table class="" border="1" width="100%" >
		<thead>
			<tr>
				<th style="font-size: 14px;" width="4%"><center>No</center></th>
				<th style="font-size: 14px;"><center>PEMINJAM</center></th>
				<th style="font-size: 14px;"><center>JUDUL</center></th>
				<th style="font-size: 14px;"><center>TGL PINJAM</center></th>
				<th style="font-size: 14px;"><center>EST TGL KEMBALI</center></th>
				<th style="font-size: 14px;"><center>TGL KEMBALI</center></th>
				<th style="font-size: 14px;"><center>TERLAMBAT</center></th>
				<th style="font-size: 14px;"><center>DENDA (Rp.)</center></th>
				<th style="font-size: 14px;"><center>KET</center></th>
				<th style="font-size: 14px;"><center>STATUS</center></th>
			</tr>
		</thead>
		<tbody>
			<?php if ($history != null){ ?>
				<?php $no = 1; foreach ($history as $p){ ?>
					<tr>
						<td style="font-size: 14px;"><center><?php echo $no++; ?></center></td>
						<td style="font-size: 14px;"><center><?php echo $p->nis_nip.'-'.$p->nama ?></center></td>
						<td style="font-size: 14px;"><center><?php echo $p->judul_buku ?></center></td>
						<td style="font-size: 14px;"><center><?php echo date('d/m/Y',strtotime($p->waktupinjam_pin)) ?></center></td>
						<td style="font-size: 14px;"><center><?php echo date('d/m/Y',strtotime($p->waktukembali_pin)) ?></center></td>
						<td style="font-size: 14px;">
							<center>
								<?php if ($p->tgl_kembali == '0000-00-00 00:00:00'){ ?>
									-
								<?php }else{ ?>
									<?php echo date('d/m/Y',strtotime($p->tgl_kembali)) ?>
								<?php } ?>
							</center>
						</td>
						<td style="font-size: 14px;">
							<center>
								<?php if ($p->terlambat == null){ ?>
									0 Hari
								<?php }else{ ?>
									<?php echo $p->terlambat ?> Hari
								<?php } ?>
							</center>
						</td>
						<td style="font-size: 14px;"><center><?php echo rupiah($p->denda_pinjam); ?></center></td>
						<td style="font-size: 14px;"><center><?php echo $p->keterangan_pin ?></center></td>
						<?php if ($p->status_pin == 'N' AND  $p->status_kembali == 'N'){ ?>
							<td style="font-size: 14px;"><center>Menunggu</center></td>
							
						<?php }else if($p->status_pin == 'N' AND $p->status_kembali == 'Y'){ ?>
							<td style="font-size: 14px;"><center>Batal</center></td>
							
						<?php }else if($p->status_pin == 'Y' AND $p->status_kembali == 'Y'){ ?>
							<td style="font-size: 14px;"><center>Selesai</center></td>
							
						<?php }else{ ?>
							<td style="font-size: 14px;"><center>Pinjam</center></td>
							
						<?php } ?>
					</tr>
				<?php } ?>
			<?php }else{ ?>
				<tr>
					<td colspan="10">
						<center>
							Tidak ada data
						</center>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<br>
	<br>
	<br>
	<div class="float-right" style="margin-right: 15%;">
		<table style="width: 100%;" border="0">
			<tbody>
				<tr>
					<td>
						<center>
							<strong>Admin Perpustakaan</strong>
							<br><br><br><br>
							<u><?php echo $this->session->userdata('nama'); ?></u>
							<p>NIP : <?php echo $this->session->userdata('nis_nip'); ?></p>
						</center>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<!-- App js -->
	<script src="<?php echo base_url() ?>mods/assets/js/app.js"></script>
</body>
</html>