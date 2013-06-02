
	<div class="main-container">
		<div class="container-fluid">
			<section>
				<div class="page-header">
					<h1>System</h1>
				</div>
				
				<?php echo $this->breadcrumb->output(); ?>
					
				<?php echo form_open_multipart("superadmin/sistem/simpan"); ?>
				
				<label for="title">Setting System</label>
				<div class="cleaner_h5"></div>
				<input type="search" style="width:90%;" id="title" name="title" placeholder="Nama Pengaturan" value="<?php echo $title; ?>" />
				<div class="cleaner_h10"></div>
				
				<label for="tipe">Type</label>
				<div class="cleaner_h5"></div>
				<input type="search" style="width:90%;" id="tipe" name="tipe" placeholder="Tipe" value="<?php echo $tipe; ?>" readonly="true" />
				<div class="cleaner_h10"></div>
				
				<label for="content_setting">Content of Setting</label>
				<div class="cleaner_h5"></div>
				<textarea name="content_setting" id="keterangan"><?php echo $content_setting; ?></textarea>
				<div class="cleaner_h10"></div>
				
				<input type="hidden" name="id_param" value="<?php echo $id_param; ?>" />
				<input type="hidden" name="tipe" value="<?php echo $tipe; ?>" />
				<div class="cleaner_h10"></div>
				<input type="submit" class="btn btn-info" value="SIMPAN" />
				<?php echo form_close(); ?>
				<div class="cleaner_h20"></div>
					
			</section>