
	<div class="main-container">
		<div class="container-fluid">
			<section>
				<div class="page-header">
					<h1>User Profile</h1>
				</div>
				
				<?php echo $this->breadcrumb->output(); ?>
				
				<div class="cleaner_h10"></div>
				<?php echo $this->session->flashdata("simpan_akun"); ?>
				<div class="cleaner_h10"></div>
					
				<?php echo form_open("superadmin/profil/simpan"); ?>
				
				<label for="nama_user">Superadmin Name</label>
				<div class="cleaner_h5"></div>
				<input type="search" id="nama_user" name="nama_user" placeholder="Superadmin Name" 
				value="<?php echo $nama_user; ?>" />
				<div class="cleaner_h10"></div>
				
				<label for="username">Username of Superadmin</label>
				<div class="cleaner_h5"></div>
				<input type="search" id="username" name="username" placeholder="Username of Superadmin" 
				value="<?php echo $username; ?>" />
				<div class="cleaner_h10"></div>
				
				<input type="hidden" name="id_param" value="<?php echo $id_param; ?>" />
				<input type="hidden" name="username_temp" value="<?php echo $username; ?>" />
				<div class="cleaner_h10"></div>
				<input type="submit" class="btn btn-info" value="SAVE" />
				<?php echo form_close(); ?>
				<div class="cleaner_h20"></div>
					
			</section>