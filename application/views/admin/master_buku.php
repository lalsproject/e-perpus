<div class="col-md-12 mb-3">
	<div class="card">
		<div class="card-header bg-primary" style="color: white;">
			<strong><i class="fa fa-table"></i> Daftar Buku</strong>
			<button type="button" class="btn btn-success btn-sm float-right" onclick="$('#modal-add').modal('show')">Tambah Buku</button>
		</div>
		<div class="card-body table-responsive">
			<table class="table table-hover dt-responsive nowrap" border="0">
				<thead>
					<tr>
						<th width="4%"><center>No</center></th>
						<th><center>TYPE</center></th>
						<th><center>JUDUL</center></th>
						<th><center>KATEGORI</center></th>
						<th><center>PENGARANG</center></th>
						<th width="10%"><center>TAHUN</center></th>
						<th width="10%"><center>STATUS BUKU</center></th>
						<th width="10%"><center>SISA BUKU</center></th>
						<th width="15%"><center>Aksi</center></th>
					</tr>
				</thead>
				<tbody>
					<?php if ($buku != null){ ?>
						<?php $no=1; foreach ($buku as $b){ ?>
							<tr>
								<td><center><?php echo $no++; ?></center></td>
								<td><?php echo $b->tipe_buku ?></td>
								<td><?php echo $b->judul_buku ?></td>
								<td><?php echo $b->NamaKategori ?></td>
								<td><?php echo $b->pengarang_buku ?></td>
								<td><center><?php echo $b->tahun_buku ?></center></td>
								<td>
									<center>
										<?php if ($b->status_buku == "Y"){ ?>
											<span class="badge badge-success">Ready</span>
										<?php }else if($b->status_buku == "N"){ ?>
											<span class="badge badge-danger">Pinjam</span>
										<?php } ?>
									</center>
								</td>
								<td>
									<center>
										<?php echo $b->jmlh_buku ?>
									</center>
								</td>	
								<td>
									<center>
										<?php if ($b->tipe_buku == "BUKU"){ ?>
											<a href="javascript: void(0);" class="btn btn-sm btn-warning" onclick="get_edit('<?php echo encrypt_url($b->IdBuku) ?>')"><i class="fa fa-edit"></i></a>
										<?php }else if($b->tipe_buku == "E-BOOK"){?>
											<a class="btn btn-sm btn-success" data-fancybox data-type="iframe" data-src="<?php echo site_url('pdf/'.$b->ebook_buku) ?>" href="javascript:;" data-options=''><i class="fa fa-eye"></i></a>
										<?php }?>
										<a href="javascript: void(0);" class="btn btn-sm btn-danger" onclick="window.location='<?php echo site_url('Admin/hapus_buku/'.encrypt_url($b->IdBuku)) ?>'"><i class="fa fa-trash"></i></a>
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
<div class="modal fade" id="modal-add">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary" style="color: white;">
				<p class="modal-title" style="font-size: 15px;"><strong>Tambah Buku Baru</strong></p>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
			<form id="form_add" action="<?php echo site_url('Admin/tambah_buku') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 form-group">
							<label>Judul Buku</label>
							<input type="text" class="form-control" required autofocus name="judul">
						</div>
						<div class="col-md-3 form-group">
							<label>Pengarang</label>
							<input type="text" class="form-control" required name="pengarang">
						</div>
						<div class="col-md-3 form-group">
							<label>Tahun Buku</label>
							<input type="number" class="form-control" required name="tahun">
						</div>
						<div class="col-md-3 form-group">
							<label>Total buku</label>
							<input type="number" class="form-control" required name="jmlh">
						</div>
						<div class="col-md-3 form-group">
							<label>Harga Denda</label>
							<input type="number" class="form-control" required name="denda">
						</div>
						
						<div class="col-md-3 form-group">
							<label>Kategori</label>
							<select name="kategori" class="form-control sl2" required>
								<option value="">--Pilih</option>
								<?php foreach ($kategori as $k){ ?>
									<option value="<?php echo encrypt_url($k->IdKategori) ?>"><?php echo $k->NamaKategori ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-3 form-group">
							<label>Type Buku</label>
							<select name="tipe" required class="form-control" onchange="booktype(`${$(this).val()}`)">
								<option value="">--Pilih</option>
								<option value="E-BOOK">Buku Digital</option>
								<option value="BUKU">Buku Fisik</option>
							</select>
						</div>
						<div class="col-md-12 form-group">
							<label>Daftar Isi</label>
							<textarea name="daftar-isi" class="form-control" id="editor" required></textarea>
						</div>
						<div class="col-md-12 form-group" id="upload" style="display: none;">
							<label>File Ebook</label><br>
							<input type="file" name="ebook" id="files" required>
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
				<p class="modal-title" style="font-size: 15px;"><strong>Tambah Buku Baru</strong></p>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
			<form id="form_edit" action="<?php echo site_url('Admin/edit_buku') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
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

	function booktype(arg)
	{
		if(arg == "" || arg == null || arg == 'BUKU')
		{
			$('#upload').hide();
			$('#files').removeAttr('required');
		}
		else
		{
			$('#upload').show();
			$('#files').attr('required','');
		}
	}
	
	function get_edit(arg)
	{
		$.ajax({
			url: '<?php echo site_url('Admin/get_edit_buku') ?>',
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
	CKEDITOR.replace('editor');
	$("#form_add").submit( function(e) {
        var messageLength = CKEDITOR.instances['editor'].getData().replace(/<[^>]*>/gi, '').length;
        if( !messageLength ) {
            swal('Warning','Silakan Masukan Daftar Isi','warning');
            e.preventDefault();
        }
    });
</script>