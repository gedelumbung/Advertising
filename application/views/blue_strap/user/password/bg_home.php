<div class="container-fluid content-body">
			<div class="row-fluid">
				<div class="span9">
					<?php echo $this->breadcrumb->output(); ?>
					<div class="main_content">
						
						<h3 class="title"><span class="pull-left"><i class="icon-tasks"></i> EDIT PRFOILE MEMBER</span></h3>
						<div class="container">
						<?php echo $this->session->flashdata("result"); ?>
							<?php echo form_open("user/password/set",'class="form-horizontal"'); ?>
							  <div class="control-group">
								<label class="control-label" for="pass_lama">Password Lama</label>
								<div class="controls">
								  <input type="password" id="pass_lama" name="pass_lama" placeholder="Password Lama" required>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="pass_baru">Password Baru</label>
								<div class="controls">
								  <input type="password" id="pass_baru" name="pass_baru" placeholder="Password Baru" required>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="ulangi_pass">Ulangi Password</label>
								<div class="controls">
								  <input type="password" id="ulangi_pass" name="ulangi_pass" placeholder="Ulangi Password" required>
								</div>
							  </div>
							  
							  <div class="control-group">
								<div class="controls">
								  <button type="submit" class="btn btn-primary">Simpan Data</button>
								</div>
							  </div>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>