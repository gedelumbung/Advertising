<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<title><?php echo $_SESSION['site_title'].' - '.$_SESSION['site_quotes']; ?></title>
	<meta name="description" content="">
	<meta name="author" content="cuongv">
	<meta name="robots" content="index, follow">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
			
	<!-- CSS styles -->
	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>asset/theme/<?php echo $_SESSION['site_theme']; ?>/css/bootstrap.min.css'>
	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>asset/theme/<?php echo $_SESSION['site_theme']; ?>/css/bootstrap-responsive.min.css'>
	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>asset/theme/<?php echo $_SESSION['site_theme']; ?>/css/main.css'>
	
	<!-- JS Libs -->
	<script src="<?php echo base_url(); ?>asset/theme/<?php echo $_SESSION['site_theme']; ?>/js/jquery.js"></script>
	<script src="<?php echo base_url(); ?>asset/theme/<?php echo $_SESSION['site_theme']; ?>/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/theme/<?php echo $_SESSION['site_theme']; ?>/js/bootstrap-carousel.js"></script>
<script src="<?php echo base_url(); ?>asset/theme/<?php echo $_SESSION['site_theme']; ?>/js/redactor/jquery-1.7.min.js" type="text/javascript"></script>
	<link href="<?php echo base_url(); ?>asset/theme/<?php echo $_SESSION['site_theme']; ?>/js/redactor/redactor.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo base_url(); ?>asset/theme/<?php echo $_SESSION['site_theme']; ?>/js/redactor/redactor.min.js" type="text/javascript"></script>
	<script>
	$(document).ready( function()
	{
		$('#keterangan').redactor({
				fileUpload: '<?php echo site_url('user/iklan/upload_file'); ?>',
			});
		 $('#myCarousel').carousel();
		});
	</script>
	</head>
	<body>
	<div class="container">
		<!-- Main page container -->
		<div class="container-fluid content-body" id="top-bar">
			<div class="row-fluid">
				<div class="span7">
					<a class="brand pull-left" href="<?php echo base_url(); ?>">
						<h1><?php echo $_SESSION['site_title']; ?></h1>
						<h4><?php echo $_SESSION['site_quotes']; ?></h4>
					</a>								
				</div>
				<div class="span5">
				<?php 
					if($this->session->userdata('logged_in')!="")
					{
						?>
						Welcome,
						<h5><?php echo $this->session->userdata("nama"); ?> | <?php echo $this->session->userdata("email"); ?></h5>		
						<div class="cleaner_h5"></div>
						<div class="btn-group">
						  <a class="btn btn-info btn-small" href="<?php echo base_url(); ?>user/iklan/tambah"><i class="icon-comment icon-white"></i> Tambah Iklan</a>
						  <a class="btn btn-info btn-small" href="<?php echo base_url(); ?>user/inbox"><i class="icon-envelope icon-white"></i> Inbox</a>
						  <a class="btn btn-info btn-small" href="<?php echo base_url(); ?>user/password"><i class="icon-refresh icon-white"></i> Password</a>
						  <a class="btn btn-info btn-small" href="<?php echo base_url(); ?>user/profile"><i class="icon-user icon-white"></i> Profile</a>
						</div>	
						<?php
					}
				?>		
				</div>
			</div>
		</div>
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
		<div class="container-fluid content-body" style="padding-top:20px;">
			<?php echo form_open("web/pencarian/set","class='search_top_form'"); ?>					
				<div class="row-fluid">	
					<div class="span3">
						<div class="control-group">
							<div class="input-prepend">
								<span class="add-on">
									<i class="icon-repeat"></i>
								</span>
								<input id="username" class="span9" type="text" name="keyword" placeholder="Masukkan Kata" value="<?php echo $this->session->userdata("keyword"); ?>"  required />
							</div>
						</div>
					</div>
					<div class="span3">
						<div class="control-group">
							<div class="input-prepend">
								<span class="add-on">
									<i class="icon-flag"></i>
								</span>
								<?php echo $combo_lokasi; ?>
							</div>
						</div>
					</div>
					<div class="span3">
						<div class="control-group">
							<div class="input-prepend">
								<span class="add-on">
									<i class="icon-folder-open"></i>
								</span>
								<?php echo $combo_kategori; ?>
							</div>
						</div>
					</div>
					<div class="span3">
						<button class="btn btn-info"><i class="icon-search icon-white"></i> <strong>CARI DIREKTORI IKLAN</strong></button>
					</div>
				</div>
			<?php echo form_close(); ?>
		</div>