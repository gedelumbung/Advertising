<div class="container-fluid content-body">
			<div class="row-fluid">
				<div class="span9">
					<?php echo $this->breadcrumb->output(); ?>
					<div class="main_content">
						
						<h3 class="title"><span class="pull-left"><i class="icon-tasks"></i> SIGN UP MEMBER</span></h3>
						<div class="container">
						
						<?php if($this->session->flashdata("result")){ ?>
						<div class="alert alert-error span8">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong><?php echo $this->session->flashdata("result"); ?></strong>
						</div>
						<?php } ?>
						<div class="cleaner_h0"></div>
							<?php echo form_open("web/sign_in/set",'class="form-horizontal"'); ?>
							  
							  <div class="control-group">
								<label class="control-label" for="email">Email</label>
								<div class="controls">
								  <input type="email" id="email" name="email" placeholder="Email" required>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="password">Password</label>
								<div class="controls">
								  <input type="password" id="controls" name="password" placeholder="Password" required>
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
								  <button type="submit" class="btn btn-primary">Sign In</button>
								</div>
							  </div>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>