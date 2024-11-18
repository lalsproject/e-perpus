<div class="row">
	<div class="col-md-12 form-group">
		<label>Buku Yang Disukai</label>
		<select name="kategori[]" class="form-control sl2-edit" multiple required>
			<?php if ($rekom != null){ ?>
				<?php foreach ($rekom as $r){ ?>
					<option value="<?php echo encrypt_url($r->IdKategori) ?>" selected=""><?php echo $r->NamaKategori ?></option>
				<?php } ?>
			<?php } ?>
			<?php foreach ($kategori as $k){ ?>
				<option value="<?php echo encrypt_url($k->IdKategori) ?>"><?php echo $k->NamaKategori ?></option>
			<?php } ?>
		</select>
	</div>
</div>
<script>
	$(".sl2-edit").select2({
       width: '100%'
   });
</script>