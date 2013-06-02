
	<div class="main-container">
		<div class="container-fluid">
			<section>
				<div class="page-header">
					<h1>Category</h1>
				</div>
				
				<?php echo $this->breadcrumb->output(); ?>
					
				<?php echo form_open_multipart("superadmin/kategori/simpan"); ?>
				
				<label for="kategori">Kategori</label>
				<div class="cleaner_h5"></div>
				<input type="search" style="width:90%;" id="kategori" name="kategori" placeholder="Kategori" value="<?php echo $kategori; ?>" />
				<div class="cleaner_h10"></div>
				
				<label for="icon">Icon</label>
				<div class="cleaner_h5"></div>
				<input type="search" style="width:90%;" id="icon" name="icon" placeholder="Icon" value="<?php echo $icon; ?>" />
				<div class="cleaner_h10"></div>
				
				<label for="custom_fields">Custom Fields</label>
				<div class="cleaner_h5"></div>
				<input type="search" style="width:90%;" id="custom_fields" name="custom_fields" placeholder="Custom Fields" value="<?php echo $custom_fields; ?>" />
				<div class="cleaner_h10"></div>
				
				<input type="hidden" name="id_param" value="<?php echo $id_param; ?>" />
				<input type="hidden" name="tipe" value="<?php echo $tipe; ?>" />
				<div class="cleaner_h10"></div>
				<input type="submit" class="btn btn-info" value="SAVE" />
				<?php echo form_close(); ?>
				<div class="cleaner_h20"></div>
					
			</section>