
	<div class="main-container">
		<div class="container-fluid">
			<section>
				<div class="page-header">
					<h1>Product</h1>
				</div>
				
				<div class="input-append">
				<?php echo form_open("superadmin/user/set"); ?>
				<input type="search" class="span2" id="appendedInputButton" name="by_nama" placeholder="Cari berdasarkan nama" /><input 
				type="submit" class="btn btn-primary" type="button" value="Filter">
				<?php echo form_close(); ?>
				</div>
				
				<?php echo $this->breadcrumb->output(); ?>
					
				<?php echo form_open("superadmin/product/simpan"); ?>
				
				<label for="id_menu">Category</label>
				<div class="cleaner_h5"></div>
				<select name="id_menu" id="id_menu">
					<?php
					if($id_menu==0)
					{
						?>
						<option value="0" selected="selected">None</option>
						<?php
					}
					else
					{
						?>
						<option value="0">None</option>
						<?php
					}
					?>
					<?php
						foreach ($menu_list->result_array() as $ml) {
							if($id_menu==$ml['id_menu'])
							{
						?>
							<option value="<?php echo $ml['id_menu']; ?>" selected="selected"><?php echo $ml['menu']; ?></option>
						<?php
							}
							else
							{
						?>
							<option value="<?php echo $ml['id_menu']; ?>"><?php echo $ml['menu']; ?></option>
						<?php
							}
						}
					?>
				</select>
				<div class="cleaner_h10"></div>
				
				<label for="nama_produk">Product Name</label>
				<div class="cleaner_h5"></div>
				<input type="search" id="nama_produk" style="width:90%;" name="nama_produk" placeholder="Product Name" 
				value="<?php echo $nama_produk; ?>" />
				<div class="cleaner_h10"></div>
				
				<label for="keterangan">Description</label>
				<div class="cleaner_h5"></div>
				<textarea name="keterangan" class="ckeditor" cols="50" rows="6"><?php echo $keterangan; ?></textarea>
				<div class="cleaner_h10"></div>
				
				<input type="hidden" name="id_param" value="<?php echo $id_param; ?>" />
				<input type="hidden" name="tipe" value="<?php echo $tipe; ?>" />
				<div class="cleaner_h10"></div>
				<input type="submit" class="btn btn-info" value="SAVE" />
				<?php echo form_close(); ?>
				<div class="cleaner_h10"></div>
				<?php echo $this->session->flashdata("result"); ?>
				<?php if($tipe=="edit")
				{
					echo '<div class="page-header"><h1>Add Image</h1></div>';
					echo $list_gambar;
					echo '<div class="cleaner_h10"></div>';
					echo form_open_multipart("superadmin/product/tambah_gambar");
					?>
					<input type="file" class="span3" name="userfile" />
					<input type="hidden" class="span3" name="id_produk" value="<?php echo $id_param; ?>" />
					<input type="submit" class="btn btn-primary" type="button" value="UPLOAD">
					<?php
					echo form_close();
				}
				?>
				<div class="cleaner_h20"></div>
					
			</section>