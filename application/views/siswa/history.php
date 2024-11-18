<div class="col-md-12 mb-3">
	<div class="card">
		<div class="card-header bg-primary" style="color: white;">
			<strong><i class="mdi mdi-book"></i> History Pinjam</strong>
		</div>
		<div class="card-body">
			<table class="table table1 table-hover dt-responsive nowrap" border="0">
				<thead>
					<tr>
						<th width="4%"><center>No</center></th>
						<th><center>JUDUL</center></th>
						<th><center>TGL PINJAM</center></th>
						<th><center>TGL KEMBALI</center></th>
						<th><center>TERLAMBAT</center></th>
						<th><center>DENDA (Rp.)</center></th>
						<th><center>KET</center></th>
						<th><center>STATUS</center></th>
					</tr>
				</thead>
				<tbody>
					<?php if ($pinjam != null){ ?>
						<?php $no = 1; foreach ($pinjam as $p){ ?>
							<tr>
								<td><center><?php echo $no++; ?></center></td>
								<td><center><?php echo $p->judul_buku ?></center></td>
								<td><center><?php echo date('d/m/Y',strtotime($p->waktupinjam_pin)) ?></center></td>
								<td><center><?php echo date('d/m/Y',strtotime($p->waktukembali_pin)) ?></center></td>
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
									
								<?php }else if($p->status_pin == 'N' AND $p->status_kembali == 'Y'){ ?>
									<td><center><span class="badge badge-pill badge-danger" style="color: white;"><strong>Batal</strong></span></center></td>
									
								<?php }else if($p->status_pin == 'Y' AND $p->status_kembali == 'Y'){ ?>
									<td><center><span class="badge badge-pill badge-success" style="color: white;"><strong>Selesai</strong></span></center></td>
									
								<?php }else{ ?>
									<td><center><span class="badge badge-pill badge-primary">Pinjam</span></center></td>
									
								<?php } ?>
							</tr>
						<?php } ?>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>		
</div>	