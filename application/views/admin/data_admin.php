<div class="col-md-12 mb-3">
	<div class="card">
		<div class="card-header bg-primary" style="color: white;">
			<strong><i class="fa fa-table"></i> Data Admin</strong>
			<button type="button" class="btn btn-success btn-sm float-right" onclick="$('#modal-add').modal('show')">Tambah Admin</button>
		</div>
		<div class="card-body table-responsive">
			<table class="table table-hover dt-responsive nowrap" border="0">
				<thead>
					<tr>
						<th width="4%"><center>NO</center></th>
						<th width="4%"><center>FOTO</center></th>
						<th><center>NIP</center></th>
						<th><center>NAMA</center></th>
						<th><center>TAHUN MASUK</center></th>
						<th><center>ALAMAT</center></th>
						<th><center>EMAIL</center></th>
						<th><center>NO HP</center></th>
						<th><center>AKSI</center></th>
					</tr>
				</thead>
				<tbody>
					<?php if ($admin != null){ ?>
						<?php $no = 1; foreach ($admin as $s){ ?>
							<tr>
								<td><center><?php echo $no ?></center></td>
								<td id="gallery"><center><a href="<?php echo base_url() ?>mods/assets/pic/<?php echo $s->foto ?>"><img class="img-thumbnail" src="<?php echo base_url() ?>mods/assets/pic/<?php echo $s->foto ?>" alt=""></a></center></td>
								<td><?php echo $s->nis_nip ?></td>
								<td><?php echo $s->nama ?></td>
								<td width="10%"><center><?php echo $s->tahunmasuk ?></center></td>
								<td><?php echo $s->alamat ?></td>
								<td><?php echo $s->email ?></td>
								<td><?php echo $s->nohp ?></td>
								<td>
									<center>
										<a href="javascript: void(0);" class="btn btn-sm btn-success" onclick="get_edit('<?php echo encrypt_url($s->IdUser) ?>')"><i class="fa fa-edit"></i></a>
										<a href="javascript: void(0);" class="btn btn-sm btn-danger" onclick="window.location='<?php echo site_url('Admin/hapus_siswa/'.encrypt_url($s->IdUser)) ?>'"><i class="fa fa-trash"></i></a>
										<?php if ($s->flag_acc == 'N'){ ?>
											<a href="javascript: void(0);" class="btn btn-sm btn-primary" alt="Accept User" onclick="window.location='<?php echo site_url('Admin/access_admin/'.encrypt_url($s->IdUser).'/'.encrypt_url('Y')) ?>'"><i class="fa fa-check"></i></a>
										<?php }else{ ?>
											<a href="javascript: void(0);" class="btn btn-sm btn-warning" onclick="window.location='<?php echo site_url('Admin/access_admin/'.encrypt_url($s->IdUser).'/'.encrypt_url('N')) ?>'"><i class="mdi mdi-account-off"></i></a>
										<?php } ?>
									</center>
								</td>
							</tr>
						<?php $no++;} ?>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-add">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary" style="color: white;">
				<p class="modal-title" style="font-size: 15px;"><strong>Tambah Admin Baru</strong></p>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
			<form id="form_add" action="<?php echo site_url('Admin/tambah_admin') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 form-group">
							<label>NIP</label>
							<input type="number" class="form-control" required autofocus name="nis">
						</div>
						<div class="col-md-6 form-group">
							<label>Nama</label>
							<input type="text" class="form-control" required name="nama">
						</div>
						<div class="col-md-3 form-group">
							<label>Tahun Masuk</label>
							<input type="number" class="form-control" min="1" required name="tahun">
						</div>
						<div class="col-md-3 form-group">
							<label>No HP</label>
							<input type="text" class="form-control" required name="nohp">
						</div>
						<div class="col-md-3 form-group">
							<label>Email</label>
							<input type="email" class="form-control" required name="email">
						</div>
						<div class="col-md-3 form-group">
							<label>ID Telegram</label>
							<input type="number" class="form-control" required name="id_telegram">
						</div>
						<div class="col-md-12 form-group">
							<label>Alamat</label>
							<textarea class="form-control" required name="alamat" required style="resize: none;"></textarea>
						</div>
						<div class="col-md-12 form-group">
							<label>Foto</label><br>
							<input type="file" name="foto">
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
<div class="modal fade" id="modal-edit">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary" style="color: white;">
				<p class="modal-title" style="font-size: 15px;"><strong>Edit Admin</strong></p>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
			<form id="form_edit" action="<?php echo site_url('Admin/edit_admin') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
				<div class="modal-body" id="body-edit">
					
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
		$('#body-edit').html('');
		$.ajax({
			url: '<?php echo site_url('Admin/get_edit_siswa') ?>',
			type: 'POST',
			dataType: 'html',
			data: {arg: arg},
			success: function(data, textStatus, xhr) {
				$('#modal-edit').modal('show');
				$('#body-edit').html(data);
			},
			error: function(xhr, textStatus, errorThrown) {
				swal('error',`ERROR = ${errorThrown}`,'error');
			}
		});
	}

	Fancybox.bind("#gallery a", {
      groupAll : true, // Group all items
      on : {
        ready : (fancybox) => {
          console.log(`fancybox #${fancybox.id} is ready!`);
        }
      }
    });
</script>