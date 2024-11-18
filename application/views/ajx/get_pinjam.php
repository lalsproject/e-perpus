<div class="row">
	<input type="hidden" name="arg"  value="<?php echo encrypt_url($buku->IdBuku) ?>">
	<div class="col-md-12 form-group" style="overflow: auto;">
		<table class="" style="width: 100%;">
			<tbody>
				<tr>
					<th colspan="3">Detail Buku</th>
				</tr>
				<tr>
					<td width="20%">Judul Buku</td>
					<td width="5%"><center>:</center></td>
					<td width="75%"><?php echo $buku->judul_buku ?></td>
				</tr>
				<tr>
					<td width="20%">Kategori</td>
					<td width="5%"><center>:</center></td>
					<td width="75%"><?php echo $buku->NamaKategori ?></td>
				</tr>
				<tr>
					<td width="20%">Tahun</td>
					<td width="5%"><center>:</center></td>
					<td width="75%"><?php echo $buku->tahun_buku ?></td>
				</tr>
				<tr>
					<td width="20%">Pengarang</td>
					<td width="5%"><center>:</center></td>
					<td width="75%"><?php echo $buku->pengarang_buku ?></td>
				</tr>
				<tr>
					<td colspan="3"><hr></td>
				</tr>
				<tr>
					<th colspan="3">Daftar Isi</th>
				</tr>
				<tr >
					<td  colspan="3">
						<span style="font-size: 12px;">
							<?php echo $buku->daftarisi_buku ?>
						</span>
					</td>
				</tr>
				<tr>
					<td colspan="3"><hr></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-md-6 form-group">
		<label>Tanggal Pinjams</label>
		<input type="date" required name="start_date" class="form-control">
	</div>
	<div class="col-md-6 form-group">
		<label>Tanggal Kembali</label>
		<input type="date" required name="end_date" class="form-control">
	</div>
	<div class="col-md-12 form-group">
		<label>Keterangan</label>
		<textarea name="ket_pinajm" required class="form-control"></textarea>
	</div>
</div>