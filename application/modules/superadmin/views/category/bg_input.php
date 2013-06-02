
	<div class="main-container">
		<div class="container-fluid">
			<section>
				<div class="page-header">
					<h1>Category</h1>
				</div>
				
				<?php echo $this->breadcrumb->output(); ?>
					
				<?php echo form_open_multipart("superadmin/category/simpan"); ?>
				
				<label for="menu">Title of Menu</label>
				<div class="cleaner_h5"></div>
				<input type="search" style="width:90%;" id="menu" name="menu" placeholder="Judul Menu" value="<?php echo $menu; ?>" />
				<div class="cleaner_h10"></div>
				
				<label for="id_parent">Parent Menu</label>
				<div class="cleaner_h5"></div>
				<select name="id_parent" id="id_parent">
					<?php
					if($id_parent==0)
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
							if($id_parent==$ml['id_menu'])
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
				
				<label for="url_route">URL Route </label>
				<div class="cleaner_h5"></div>
				<input type="search" style="width:90%;" id="url_route" name="url_route" placeholder="URL Route" value="<?php echo $url_route; ?>" />
				<div class="cleaner_h10"></div>
				
				<label for="content">Content</label>
				<div class="cleaner_h5"></div>
				<textarea name="content" class="ckeditor" cols="50" rows="6"><?php echo $content; ?></textarea>
				<div class="cleaner_h10"></div>
				
				<input type="hidden" name="id_param" value="<?php echo $id_param; ?>" />
				<input type="hidden" name="tipe" value="<?php echo $tipe; ?>" />
				<input type="hidden" name="jenis" value="<?php echo $jenis; ?>" />
				<div class="cleaner_h10"></div>
				<input type="submit" class="btn btn-info" value="SAVE" />
				<?php echo form_close(); ?>
				<div class="cleaner_h20"></div>
					
			</section>