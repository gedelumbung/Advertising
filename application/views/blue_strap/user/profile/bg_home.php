<div class="container-fluid content-body">
			<div class="row-fluid">
				<div class="span9">
					<?php echo $this->breadcrumb->output(); ?>
					<div class="main_content">
						
						<h3 class="title"><span class="pull-left"><i class="icon-tasks"></i> EDIT PRFOILE MEMBER</span></h3>
						<div class="container">
						<?php echo $this->session->flashdata("result"); ?>
							<?php echo form_open_multipart("user/profile/set",'class="form-horizontal"'); ?>
							  <div class="control-group">
								<label class="control-label" for="nama">Nama</label>
								<div class="controls">
								  <input type="text" id="nama" name="nama" placeholder="Nama" required value="<?php echo $this->session->userdata("nama"); ?>">
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="email">Email</label>
								<div class="controls">
								  <input type="email" id="email" name="email" placeholder="Email" required value="<?php echo $this->session->userdata("email"); ?>">
								  <input type="hidden" id="email_temp" name="email_temp" value="<?php echo $this->session->userdata("email"); ?>">
								  <input type="hidden" id="gambar" name="gambar" value="<?php echo $this->session->userdata("gambar"); ?>">
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="alamat">Alamat</label>
								<div class="controls">
								  <textarea id="alamat" name="alamat" placeholder="Alamat" required><?php echo $this->session->userdata("alamat"); ?></textarea>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="no_telpon">No Telepon</label>
								<div class="controls">
								  <input type="text" id="no_telpon" name="no_telpon" placeholder="Nomor Telepon" required value="<?php echo $this->session->userdata("no_telpon"); ?>">
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="no_hp">No HP</label>
								<div class="controls">
								  <input type="text" id="no_hp" name="no_hp" placeholder="Nomor HP" required value="<?php echo $this->session->userdata("no_hp"); ?>">
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="jk">Jenis Kelamin</label>
								<div class="controls">
								<?php
								$l=""; $p="";
								if($this->session->userdata("jk")=="L"){$l='selected'; $p='';}
								else if($this->session->userdata("jk")=="P"){$l=''; $p='selected';}
								?>
									<select name="jk" id="jk">
										<option value="L" <?php echo $l; ?>>Laki-Laki</option>
										<option value="P" <?php echo $p; ?>>Perempuan</option>
									</select>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="foto">Foto Member</label>
								<div class="controls">
								<?php
									$gbr = "no-image.png";
									if($this->session->userdata("gambar")!="")
									{
										$gbr = $this->session->userdata("gambar");
									}
								?>
						 		 <img src="<?php echo base_url(); ?>asset/images/member/thumb/<?php echo $gbr; ?>"  class="img" width="150">
								 <div class="cleaner_h0"></div>
								  <input type="file" id="foto" name="userfile">
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