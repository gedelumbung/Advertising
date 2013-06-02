
	<div class="main-container">
		<div class="container-fluid">
			<section>
				<div class="page-header">
					<h1>Slide Banner</h1>
				</div>
				
				<?php echo $this->breadcrumb->output(); ?>
					
				<?php echo form_open_multipart("superadmin/slide_banner/simpan"); ?>
				
				<label for="judul">Title</label>
				<div class="cleaner_h5"></div>
				<input type="search" style="width:90%;" id="judul" name="judul" placeholder="Title" value="<?php echo $judul; ?>" />
				<div class="cleaner_h10"></div>
				
				<label for="deskripsi">Description</label>
				<div class="cleaner_h5"></div>
				<textarea name="deskripsi" class="ckeditor" cols="50" rows="6"><?php echo $deskripsi; ?></textarea>
				<div class="cleaner_h10"></div>
				
				<label for="stts">Status</label>
				<div class="cleaner_h5"></div>
				<select name="stts" id="stts">
					<?php
						$a=""; $b="";
						if($stts=="1"){$a="selected"; $b="";}
						else if($stts=="0"){$b="selected"; $a="";}
					?>
					<option value="0" <?php echo $b; ?>>Not Active</option>
					<option value="1" <?php echo $a; ?>>Active</option>
				</select>
				<div class="cleaner_h10"></div>
				
				<label for="gambar">Image</label>
				<div class="cleaner_h5"></div>
				<input type="file" id="gambar" name="userfile" class="span3" />
				<div class="cleaner_h10"></div>
				
				<input type="hidden" name="id_param" value="<?php echo $id_param; ?>" />
				<input type="hidden" name="tipe" value="<?php echo $tipe; ?>" />
				<input type="hidden" name="gambar" value="<?php echo $gambar; ?>" />
				<div class="cleaner_h10"></div>
				<input type="submit" class="btn btn-info" value="SAVE" />
				<?php echo form_close(); ?>
				<div class="cleaner_h20"></div>
					
			</section>