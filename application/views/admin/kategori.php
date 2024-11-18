<div class="col-md-4 mb-3">
	<div class="card">
		<div class="card-header bg-primary" style="color: white;">
			<strong><i class="fa fa-plus"></i>  Tambah Kategori</strong>
		</div>
		<div class="card-body">
			<form action="<?php echo site_url('Admin/tambah_kategori') ?>" method="post" accept-charset="utf-8">
				<div class="form-group">
					<label>Nama Kategori</label>
					<input type="text" autofocus="" required="" name="kategori" class="form-control">
				</div>
				<div class="form-group">
					<label>Keterangan</label>
					<textarea name="keterangan" required class="form-control" style="resize: none;"></textarea>
				</div>
				<div class="form-group float-right">
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="col-md-8 mb-3">
	<div class="card">
		<div class="card-header bg-primary"style="color: white;">
			<strong><i class="fa fa-table"></i> Daftar Kategori</strong>
		</div>
		<div class="card-body table-responsive">
			<table class="table table-hover dt-responsive nowrap" border="0">
				<thead>
					<tr>
						<th width="4%"><center>No</center></th>
						<th><center>Kategori</center></th>
						<th><center>Keterangan</center></th>
						<th width="15%"><center>Aksi</center></th>
					</tr>
				</thead>
				<tbody>
					<?php if ($kategori != null){ ?>
						<?php $no=1; foreach ($kategori as $k){ ?>
							<tr>
								<td><center><?php echo $no++; ?></center></td>
								<td><?php echo $k->NamaKategori ?></td>
								<td><?php echo limitText($k->Ket_Kategori) ?></td>
								<td>
									<center>
										<a href="javascript: void(0);" class="btn btn-sm btn-success" onclick="get_edit('<?php echo encrypt_url($k->IdKategori) ?>')"><i class="fa fa-edit"></i></a>
										<a href="javascript: void(0);" class="btn btn-sm btn-danger" onclick="window.location='<?php echo site_url('Admin/hapus_kategori/'.encrypt_url($k->IdKategori)) ?>'"><i class="fa fa-trash"></i></a>
									</center>
								</td>
							</tr>
						<?php } ?>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-edit">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary" style="color: white;">
				<p class="modal-title" style="font-size: 15px;"><strong>Edit Kategori</strong></p>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
			<form action="<?php echo site_url('Admin/simpan_edit_kategori') ?>" method="post" accept-charset="utf-8">
				<div class="modal-body" id="body_edit">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
	function get_edit(arg)
	{
		$.ajax({
			url: '<?php echo site_url('Admin/get_edit_kategori') ?>',
			type: 'POST',
			dataType: 'html',
			data: {arg: arg},
			success: function(data, textStatus, xhr) {
				$('#modal-edit').modal('show');
				$('#body_edit').html(data)
			},
			error: function(xhr, textStatus, errorThrown)
			{
				swal('Server ERROR',`${errorThrown}`,'error');
			}
		});
	}
</script>