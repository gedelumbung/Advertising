
	<div class="main-container">
		<div class="container-fluid">
			<section>
				<div class="page-header">
					<h1>Category</h1>
				</div>
				
				<?php echo $this->breadcrumb->output(); ?>
					
				<?php echo form_open_multipart("superadmin/artikel/simpan"); ?>
				
				<label for="judul">Judul</label>
				<div class="cleaner_h5"></div>
				<input type="search" style="width:90%;" id="judul" name="judul" placeholder="Judul" value="<?php echo $judul; ?>" />
				<div class="cleaner_h10"></div>
				
				<label for="isi">Content</label>
				<div class="cleaner_h5"></div>
				<textarea name="isi" id="keterangan"><?php echo $isi; ?></textarea>
				<div class="cleaner_h10"></div>
				
				<label>Gambar</label>
				<div class="cleaner_h5"></div>
				<input type="file" name="userfile" />
				<div class="cleaner_h10"></div>
				
				<input type="hidden" name="id_param" value="<?php echo $id_param; ?>" />
				<input type="hidden" name="tipe" value="<?php echo $tipe; ?>" />
				<input type="hidden" name="gambar" value="<?php echo $gambar; ?>" />
				<div class="cleaner_h10"></div>
				<input type="submit" class="btn btn-info" value="SAVE" />
				<?php echo form_close(); ?>
				<div class="cleaner_h20"></div>
					
			</section>