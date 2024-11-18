<div class="row">
	<div class="col-md-6 form-group">
		<?php if ($siswa->flag_admin == 'Y'){ ?>
			
		<label>NIP</label>
		<?php }else{ ?>
		<label>NIS</label>
		<?php } ?>
		<input type="hidden" name="arg" value="<?php echo encrypt_url($siswa->IdUser) ?>">
		<input type="number" value="<?php echo $siswa->nis_nip ?>" class="form-control" required autofocus name="nis">
	</div>
	<div class="col-md-6 form-group">
		<label>Nama</label>
		<input type="text" class="form-control" required name="nama" value="<?= $siswa->nama ?>">
	</div>
	<div class="col-md-3 form-group">
		<label>Tahun Masuk</label>
		<input type="number" class="form-control" min="1" required name="tahun" value="<?= $siswa->tahunmasuk ?>">
	</div>
	<div class="col-md-3 form-group">
		<label>No HP</label>
		<input type="text" class="form-control" required name="nohp" value="<?= $siswa->nohp ?>">
	</div>
	<div class="col-md-3 form-group">
		<label>Email</label>
		<input type="email" class="form-control" required name="email" value="<?= $siswa->email ?>">
	</div>
	<div class="col-md-3 form-group">
		<label>ID Telegram</label>
		<input type="number" class="form-control" required name="id_telegram" value="<?php echo $siswa->id_telegram ?>">
	</div>
	<div class="col-md-12 form-group">
		<label>Alamat</label>
		<textarea class="form-control" required name="alamat" required style="resize: none;"><?php echo $siswa->alamat ?></textarea>
	</div>
	
</div>