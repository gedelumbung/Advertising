<div class="container-fluid content-body">
			<div class="row-fluid">
				<div class="span9">
					<?php echo $this->breadcrumb->output(); ?>
					<div class="main_content">
						
						<h3 class="title"><span class="pull-left"><i class="icon-tasks"></i> SIGN UP MEMBER</span></h3>
						<div class="container">
						<?php echo $this->session->flashdata("result"); ?>
							<?php echo form_open("web/sign_up/set",'class="form-horizontal"'); ?>
							  <div class="control-group">
								<label class="control-label" for="nama">Nama</label>
								<div class="controls">
								  <input type="text" id="nama" name="nama" placeholder="Nama" required>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="email">Email</label>
								<div class="controls">
								  <input type="email" id="email" name="email" placeholder="Email" required>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="alamat">Alamat</label>
								<div class="controls">
								  <textarea id="alamat" name="alamat" placeholder="Alamat" required></textarea>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="no_telpon">No Telepon</label>
								<div class="controls">
								  <input type="text" id="no_telpon" name="no_telpon" placeholder="Nomor Telepon" required>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="no_hp">No HP</label>
								<div class="controls">
								  <input type="text" id="no_hp" name="no_hp" placeholder="Nomor HP" required>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="password">Password</label>
								<div class="controls">
								  <input type="password" id="controls" name="password" placeholder="Password" required>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="password">Re-Type Password</label>
								<div class="controls">
								  <input type="password" id="controls" name="password2" placeholder="Re-Type Password" required>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="jk">Jenis Kelamin</label>
								<div class="controls">
									<select name="jk" id="jk">
										<option value="L">Laki-Laki</option>
										<option value="P">Perempuan</option>
									</select>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="captcha">Captcha</label>
								<div class="controls">
								<p><?php echo $captcha; ?></p>
								  <input type="text" id="captcha" name="captcha" placeholder="Captcha" required>
								</div>
							  </div>
							  
							  <div class="control-group">
								<div class="controls">
								  <button type="submit" class="btn btn-primary">Sign Up</button>
								</div>
							  </div>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>