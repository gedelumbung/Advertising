		<div class="navbar">
			<div class="navbar-inner main-menu">
				<div class="container-fluid">
					<div class="row-fluid">			
						<div class="nav-collapse collapse">									 		                 
							<?php echo $left_top_menu; ?>							 		                 
							<?php 
								if($this->session->userdata('logged_in')=="")
								{
									echo $right_top_menu;
								}
								else
								{
									?>
									<ul class="nav pull-right">
										<li><a href="<?php echo base_url(); ?>user/dashboard"><i class="icon-warning-sign"></i> DASHBOARD</a></li>
										<li><a href="<?php echo base_url(); ?>web/sign_in/logout"><i class="icon-remove-sign"></i> SIGN OUT</a></li>
									<?php
								} 
							?>	
						</div>
					</div>
				</div>
			</div>		
		</div>	
		<div class="container-fluid footer">	
		<div class="container">		
			<div class="row-fluid">	
				<div class="span4">
					<h4><i class="icon-bookmark icon-white"></i> Bergabung Dengan Kami di :</h4>
					<a href="#"><img src="<?php echo base_url(); ?>asset/theme/<?php echo $_SESSION['site_theme']; ?>/images/social-facebook.png" alt="Facebook" /></a>
					<a href="#"><img src="<?php echo base_url(); ?>asset/theme/<?php echo $_SESSION['site_theme']; ?>/images/social-twitter.png" alt="Twitter" /></a>
					<a href="#"><img src="<?php echo base_url(); ?>asset/theme/<?php echo $_SESSION['site_theme']; ?>/images/social-rss.png" alt="RSS" /></a>
					<a href="#"><img src="<?php echo base_url(); ?>asset/theme/<?php echo $_SESSION['site_theme']; ?>/images/social-flickr.png" alt="Flickr" /></a>
				</div>				
				 <div class="span4">   
					<h4 class=""><i class="icon-file icon-white"></i> Informasi Situs</h4>
						<?php echo $center_bottom_menu; ?>
				</div>
				<div class="span4">
					<div class="company_info">
						<h4><i class="icon-bullhorn icon-white"></i> Hubungi Kami</h4>
						<p>
							<?php echo $_SESSION['site_address']; ?>
						</p>
					</div>
				</div>					
			</div>	
			<div class="cleaner_h20"></div>
			<?php echo $_SESSION['site_footer']; ?>
		</div>
		</div>
		</div>
		<!-- /Main page container -->		
	</body>	
</html>