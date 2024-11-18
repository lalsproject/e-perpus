<div class="col-md-8 mb-3">
	<div class="row">
		<div class="col-md-6">
			<div class="card mb-3">
				<div class="card-body">
					<div class="d-flex flex-row">
						<div class="col-3 align-self-center">
							<div class="round">
								<i class="mdi mdi-book"></i>
							</div>
						</div>
						<div class="col-6 text-center align-self-center">
							<div class="m-l-10 ">
								<h5 class="mt-0 round-inner"><?php echo count_fisik() ?></h5>
								<p class="mb-0 text-muted">Buku Fisik</p>
							</div>
						</div>
						                                                     
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="card mb-3">
				<div class="card-body">
					<div class="d-flex flex-row">
						<div class="col-3 align-self-center">
							<div class="round">
								<i class="fa fa-file-pdf-o"></i>
							</div>
						</div>
						<div class="col-6 text-center align-self-center">
							<div class="m-l-10 ">
								<h5 class="mt-0 round-inner"><?php echo count_digital() ?></h5>
								<p class="mb-0 text-muted">Buku Digital</p>
							</div>
						</div>
						                                                     
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="card bg-primary mb-3">
				<div class="card-body">
					<div id="verticalCarousel" class="carousel slide vertical" data-ride="carousel">
						<!-- Carousel items -->
						<div class="carousel-inner">
							<strong style="color: white;"><i class="mdi mdi-book"></i>  REKOMENDASI BUKU</strong><br><br>
							<?php if ($rekom_book != null){ ?>
								<?php foreach ($rekom_book as $key => $rb){ ?>
									<?php if ($key == 0){ ?>
										<div class="carousel-item active">
											<div class="row d-flex justify-content-center text-center">
												
												<h3 style="color: white;">
													<?php if ($rb->tipe_buku == 'BUKU'){ ?>
														<strong><i class="mdi mdi-book"></i> <?php echo $rb->judul_buku ?></strong>
													<?php }else{ ?>
														<strong>
															<a data-fancybox data-type="iframe" style="color: white;" data-src="<?php echo site_url('pdf/'.$rb->ebook_buku) ?>" href="javascript:;" data-options=''><i class="fa fa-file-pdf-o"></i> <?php echo $rb->judul_buku ?></a>
														</strong>
													<?php } ?>
													<br><span style="font-size: 14px;"><?php echo $rb->tipe_buku ?> - <?php echo $rb->NamaKategori ?> - <?php echo date('d/m/y H:i',strtotime($rb->RegDate)) ?></span>
													<?php if ($rb->Flag_New == 'Y'){ ?>
														 <span style="font-size: 12px;" class="badge badge-danger">Baru</span>
													<?php } ?>
												</h3>
											</div>
										</div>
									<?php }else{ ?>
										<div class="carousel-item">
											<div class="row d-flex justify-content-center text-center">
												
												<h3 style="color: white;">
													<?php if ($rb->tipe_buku == 'BUKU'){ ?>
														<strong><i class="mdi mdi-book"></i> <?php echo $rb->judul_buku ?></strong>
													<?php }else{ ?>
														<strong>
															<a data-fancybox data-type="iframe" style="color: white;" data-src="<?php echo site_url('pdf/'.$rb->ebook_buku) ?>" href="javascript:;" data-options=''><i class="fa fa-file-pdf-o"></i> <?php echo $rb->judul_buku ?></a>
														</strong>
													<?php } ?>
													<br><span style="font-size: 14px;"><?php echo $rb->tipe_buku ?> - <?php echo $rb->NamaKategori ?> - <?php echo date('d/m/y H:i',strtotime($rb->RegDate)) ?></span>
													<?php if ($rb->Flag_New == 'Y'){ ?>
														 <span style="font-size: 12px;" class="badge badge-danger">Baru</span>
													<?php } ?>
												</h3>
											</div>
										</div>
									<?php } ?>
								<?php } ?>
							<?php } ?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-md-4 mb-3">
	<div class="card">
		<div class="card-header bg-primary" style="color: white;">
			<strong><i class="mdi mdi-book"></i> Buku Terbaru</strong>
		</div>
		<div class="card-body" style="height: 270px;overflow: auto;">
			<table class="table" width="100%">
				<tbody>
					<?php if ($new_book != null){ ?>
						
						<?php foreach ($new_book as $nb){ ?>
							<tr>
								<td>
									<?php if ($nb->tipe_buku == 'BUKU'){ ?>
										<i class="mdi mdi-book"></i> <?php echo $nb->judul_buku ?>
										<?php if ($nb->status_buku == 'Y'){ ?>
											<span class="badge badge-success">Ready</span>
										<?php }else{ ?>
											<span class="badge badge-danger">Pinjam</span>
										<?php } ?>
									<?php }else{ ?>
										<a data-fancybox data-type="iframe" data-src="<?php echo site_url('pdf/'.$nb->ebook_buku) ?>" href="javascript:;" data-options=''><i class="fa fa-file-pdf-o"></i>  <?php echo $nb->judul_buku ?></a>
									<?php } ?>
									<br>
									<span style="font-size: 11px;"><?php echo $nb->tipe_buku ?> - <?php echo $nb->NamaKategori ?> - <?php echo date('d/m/y H:i',strtotime($nb->RegDate)) ?></span>
								</td>
							</tr>
						<?php } ?>
					<?php }else{ ?>
						<tr>
							<td><center>Tidak Ada Buku Baru</center></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="col-md-12 mb-3">
	<div class="card">
		<div class="card-header bg-primary" style="color: white;">
			<strong><i class="mdi mdi-book"></i> Daftar Buku</strong>
		</div>
		<div class="card-body">
			<table class="table table1 table-hover dt-responsive nowrap" border="0">
				<thead>
					<tr>
						<th width="4%"><center>No</center></th>
						<th><center>TYPE</center></th>
						<th><center>JUDUL</center></th>
						<th><center>KATEGORI</center></th>
						<th><center>PENGARANG</center></th>
						<th width="10%"><center>TAHUN</center></th>
						<th width="10%"><center>STATUS BUKU</center></th>
					</tr>
				</thead>
				<tbody>
					<?php if ($buku != null){ ?>
						<?php $no=1; foreach ($buku as $b){ ?>
							<tr>
								<td><center><?php echo $no++; ?></center></td>
								<td><?php echo $b->tipe_buku ?></td>
								<td>
									<?php echo $b->judul_buku ?>
									<?php if ($b->Flag_New == 'Y'){ ?>
										<span style="font-size: 12px;" class="badge badge-danger">Baru</span>
									<?php } ?>
								</td>
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
								
							</tr>
						<?php } ?>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>	
</div>