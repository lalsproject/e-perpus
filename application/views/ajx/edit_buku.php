<div class="row">
	<input type="hidden" value="<?php echo encrypt_url($buku->IdBuku) ?>" name="arg">
	<div class="col-md-12 form-group">
		Status Buku : 
		<?php if ($buku->status_buku == "Y"){ ?>
			<span class="badge badge-success">Ready</span>
		<?php }else if($buku->status_buku == "N"){ ?>
			<span class="badge badge-danger">Pinjam</span>
		<?php } ?>
	</div>
	<div class="col-md-6 form-group">
		<label>Judul Buku</label>
		<input type="text" class="form-control" value="<?php echo $buku->judul_buku ?>" required autofocus name="judul">
	</div>
	<div class="col-md-3 form-group">
		<label>Pengarang</label>
		<input type="text" class="form-control"  value="<?php echo $buku->pengarang_buku ?>" required name="pengarang">
	</div>
	<div class="col-md-3 form-group">
		<label>Tahun Buku</label>
		<input type="number" class="form-control"  value="<?php echo $buku->tahun_buku ?>" required name="tahun">
	</div>
	<div class="col-md-3 form-group">
		<label>Total buku</label>
		<input type="number" class="form-control" value="<?php echo $buku->jmlh_buku ?>" required name="jmlh">
	</div>
	<div class="col-md-3 form-group">
		<label>Harga Denda</label>
		<input type="number" class="form-control"  value="<?php echo $buku->harga_denda ?>" required name="denda">
	</div>
	
	<div class="col-md-6 form-group">
		<label>Kategori</label>
		<select name="kategori" class="form-control sl2-edit" required>
			<option value="<?php echo encrypt_url($buku->IdKategori) ?>"><?php echo $buku->NamaKategori ?></option>
			<?php foreach ($kategori as $k){ ?>
				<option value="<?php echo encrypt_url($k->IdKategori) ?>"><?php echo $k->NamaKategori ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-md-12 form-group">
		<label>Daftar Isi</label>
		<textarea name="daftar-isi" class="form-control" id="editor-edit" required><?php echo $buku->daftarisi_buku ?></textarea>
	</div>
</div>
<script>
	$('.sl2-edit').select2({
		width: '100%'
	});
	CKEDITOR.replace('editor-edit');
	$("#form_edit").submit( function(e) {
        var messageLength = CKEDITOR.instances['editor-edit'].getData().replace(/<[^>]*>/gi, '').length;
        if( !messageLength ) {
            swal('Warning','Silakan Masukan Daftar Isi','warning');
            e.preventDefault();
        }
    });
</script>