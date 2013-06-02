
	<div class="main-container">
		<div class="container-fluid">
			<section>
				<div class="page-header">
					<h1>Category</h1>
				</div>
				
				<?php echo $this->breadcrumb->output(); ?>
					
				<?php echo form_open_multipart("superadmin/lokasi/simpan"); ?>
				
				<label for="lokasi">Lokasi</label>
				<div class="cleaner_h5"></div>
				<input type="search" style="width:90%;" id="lokasi" name="lokasi" placeholder="Lokasi" value="<?php echo $lokasi; ?>" />
				<div class="cleaner_h10"></div>
				
				<input type="hidden" name="id_param" value="<?php echo $id_param; ?>" />
				<input type="hidden" name="tipe" value="<?php echo $tipe; ?>" />
				<div class="cleaner_h10"></div>
				<input type="submit" class="btn btn-info" value="SAVE" />
				<?php echo form_close(); ?>
				<div class="cleaner_h20"></div>
					
			</section>