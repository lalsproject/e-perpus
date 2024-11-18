<div class="col-md-12 mb-3">
	<div class="card">
		<div class="card-header bg-primary" style="color: white;">
			<strong><i class="mdi mdi-book"></i> History Pinjam</strong>
			<div class="float-right">
				<button type="button" class="btn btn-success" onclick="$('#modal_print').modal('show')"><i class="fa fa-print"></i> Print</button>
			</div>
		</div>
		<div class="card-body">
			<table class="table table1 table-hover dt-responsive nowrap" border="0">
				<thead>
					<tr>
						<th width="4%"><center>No</center></th>
						<th><center>PEMINJAM</center></th>
						<th><center>JUDUL</center></th>
						<th><center>TGL PINJAM</center></th>
						<th><center>EST TGL KEMBALI</center></th>
						<th><center>TGL KEMBALI</center></th>
						<th><center>TERLAMBAT</center></th>
						<th><center>DENDA (Rp.)</center></th>
						<th><center>KET</center></th>
						<th><center>STATUS</center></th>
						<th><center>AKSI</center></th>
					</tr>
				</thead>
				<tbody>
					<?php if ($pinjam != null){ ?>
						<?php $no = 1; foreach ($pinjam as $p){ ?>
							<tr>
								<td><center><?php echo $no++; ?></center></td>
								<td><center><?php echo $p->nis_nip.'-'.$p->nama ?></center></td>
								<td><center><?php echo $p->judul_buku ?></center></td>
								<td><center><?php echo date('d/m/Y',strtotime($p->waktupinjam_pin)) ?></center></td>
								<td><center><?php echo date('d/m/Y',strtotime($p->waktukembali_pin)) ?></center></td>
								<td>
									<center>
										<?php if ($p->tgl_kembali == '0000-00-00 00:00:00'){ ?>
											-
										<?php }else{ ?>
											<?php echo date('d/m/Y',strtotime($p->tgl_kembali)) ?>
										<?php } ?>
									</center>
								</td>
								<td>
									<center>
										<?php if ($p->terlambat == null){ ?>
											0 Hari
										<?php }else{ ?>
											<?php echo $p->terlambat ?> Hari
										<?php } ?>
									</center>
								</td>
								<td><center><?php echo rupiah($p->denda_pinjam); ?></center></td>
								<td><center><?php echo $p->keterangan_pin ?></center></td>
								<?php if ($p->status_pin == 'N' AND  $p->status_kembali == 'N'){ ?>
									<td><center><span class="badge badge-pill badge-warning" style="color: white;"><strong>Menunggu</strong></span></center></td>
									<td>
										<center>
											<button type="button" class="btn btn-sm btn-warning" onclick="window.location='<?php echo site_url('Admin/acc_pinjam/'.encrypt_url($p->id_pinjam)) ?>'"><i class="fa fa-check"></i></button>
											<button type="button" class="btn btn-sm btn-danger" onclick="window.location='<?php echo site_url('Admin/batal_pinjam/'.encrypt_url($p->id_pinjam)) ?>'"><i class="fa fa-close"></i></button>
										</center>
									</td>
								<?php }else if($p->status_pin == 'N' AND $p->status_kembali == 'Y'){ ?>
									<td><center><span class="badge badge-pill badge-danger" style="color: white;"><strong>Batal</strong></span></center></td>
									<td>
										<center>
											-
										</center>
									</td>
								<?php }else if($p->status_pin == 'Y' AND $p->status_kembali == 'Y'){ ?>
									<td><center><span class="badge badge-pill badge-success" style="color: white;"><strong>Selesai</strong></span></center></td>
									<td>
										<center>
											-
										</center>
									</td>
								<?php }else{ ?>
									<td><center><span class="badge badge-pill badge-primary">Pinjam</span></center></td>
									<td>
										<center>
											<button type="button" class="btn btn-sm btn-primary" onclick="kembali('<?php echo encrypt_url($p->id_pinjam) ?>')"><i class="mdi mdi-backup-restore"></i></button>
										</center>
									</td>
								<?php } ?>
							</tr>
						<?php } ?>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>		
</div>

<div class="modal fade" id="modal_print">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title"><strong>Print Laporan</strong></h6>
				
			</div>
			<form action="" id="form_print" method="post" accept-charset="utf-8">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 form-group">
							<label>Tanggal Awal</label>
							<input type="date" id="awal" name="awal" class="form-control">
						</div>
						<div class="col-md-6 form-group">
							<label>Tanggal Akhir</label>
							<input type="date" id="akhir" name="akhir" class="form-control">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
	function kembali(arg)
	{
		$.ajax({
			url: '<?php echo site_url('Admin/get_denda') ?>',
			type: 'POST',
			dataType: 'json',
			data: {arg: arg},

			success: function(data, textStatus, xhr)
			{
				// console.table(data);
				swal({
					title: `Buku akan dikembalikan ?`,
					text: `
					Buku 	 : ${data['judul_buku']}
					Peminjam : ${data['nis_nip']}-${data['nama']}
					Terlambat : ${data['terlambat']}
					Denda : ${data['denda_pinjam']}
					`,
					type: 'warning',
					showCancelButton: true,
					confirmButtonText: 'Ya, Setuju',
					cancelButtonText: 'Batal!',
					confirmButtonClass: 'btn btn-success',
					cancelButtonClass: 'btn btn-danger m-l-10',
					buttonsStyling: false
				}).then(function () {
					window.location = '<?php echo site_url('Admin/kembali_buku/') ?>'+arg
				}, function (dismiss) {
					// dismiss can be 'cancel', 'overlay',
					// 'close', and 'timer'
				})
			},
			error: function(xhr, textStatus, errorThrown)
			{
				swal('Warning',errorThrown,'warning');
			}
		});
		
	}

	$( "#form_print" ).submit(function() {
		let awal = $('#awal').val();
		let akhir = $('#akhir').val();
		if (awal == '' || akhir == '')
		{
			swal('Warning','Tanggal Tidak Boleh Kosong','warning');
		}
		else
		{
			window.open(`<?php echo site_url('Admin/print_lap/') ?>${awal}/${akhir}`,'newwindow-<?php echo md5(date('dmyHis')) ?>','width=926,height=972'); return false;
		}
		return false;
	});
</script>