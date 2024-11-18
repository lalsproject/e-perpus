<div class="form-group">
	<label>Nama Kategori</label>
	<input type="hidden" value="<?php echo encrypt_url($kat->IdKategori) ?>" name="arg">
	<input type="text" autofocus="" required="" value="<?php echo $kat->NamaKategori ?>" name="kategori" class="form-control">
</div>
<div class="form-group">
	<label>Keterangan</label>
	<textarea name="keterangan" required class="form-control" style="resize: none;"><?php echo $kat->Ket_Kategori ?></textarea>
</div>
