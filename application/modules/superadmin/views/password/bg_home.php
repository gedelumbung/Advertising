
	<div class="main-container">
		<div class="container-fluid">
			<section>
				<div class="page-header">
					<h1>User Password</h1>
				</div>
				
				<?php echo $this->breadcrumb->output(); ?>
				
				<div class="cleaner_h10"></div>
				<?php echo $this->session->flashdata("simpan_akun"); ?>
				<?php echo validation_errors(); ?>
				<div class="cleaner_h10"></div>
					
				<?php echo form_open("superadmin/password/simpan"); ?>
				
				<label for="username">Username Super Admin</label>
				<div class="cleaner_h5"></div>
				<input type="search" id="username" name="username" placeholder="Username Super Admin" 
				value="<?php echo $username; ?>" readonly="true" />
				<div class="cleaner_h10"></div>
				
				<label for="password_lama">PASSWORD LAMA : </label>
				<input type="password" name="password_lama" id="password_lama" placeholder="Masukkan password lama...." />
				<div class="cleaner_h10"></div>
				
				<label for="password_baru">PASSWORD BARU : </label>
				<input type="password" name="password_baru" id="password_baru" placeholder="Masukkan password baru...." />
				<div class="cleaner_h10"></div>
				
				<label for="ulangi_password">ULANGI PASSWORD BARU : </label>
				<input type="password" name="ulangi_password" id="ulangi_password" placeholder="Masukkan ulang password baru...." />
				<input type="hidden" name="id_param" value="<?php echo $id_param; ?>" />
				<div class="cleaner_h10"></div>	
				
				<input type="hidden" name="id_param" value="<?php echo $id_param; ?>" />
				<input type="hidden" name="username_temp" value="<?php echo $username; ?>" />
				<div class="cleaner_h10"></div>
				<input type="submit" class="btn btn-info" value="SIMPAN" />
				<?php echo form_close(); ?>
				<div class="cleaner_h20"></div>
					
			</section>