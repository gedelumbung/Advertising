
<doctype html>
<html>
<head>
	<title><?php echo $_SESSION['site_title']; ?></title>
	<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/admin/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/admin/css/bootstrap-responsive.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/admin/css/style.css" />
	<script src="<?php echo base_url(); ?>asset/theme/<?php echo $_SESSION['site_theme']; ?>/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/main.js"></script>
	<script src="<?php echo base_url(); ?>asset/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/theme/<?php echo $_SESSION['site_theme']; ?>/js/redactor/jquery-1.7.min.js" type="text/javascript"></script>
	<link href="<?php echo base_url(); ?>asset/theme/<?php echo $_SESSION['site_theme']; ?>/js/redactor/redactor.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo base_url(); ?>asset/theme/<?php echo $_SESSION['site_theme']; ?>/js/redactor/redactor.min.js" type="text/javascript"></script>
	<script>
	$(document).ready( function()
	{
		$('#keterangan').redactor();
		});
	</script>
</head>
<body>
	<div class="navbar navbar-fixed-top m-header">
		<div class="navbar-inner m-inner">
		
			<div class="container-fluid">
				<a target="_blank" class="brand m-brand" href="<?php echo base_url(); ?>"><?php echo $_SESSION['site_title']; ?><h4><?php echo $_SESSION['site_quotes']; ?></h4></a>
		        
				<div class="nav-collapse collapse">
	
					<div class="btn-group pull-right">
				        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
			          		<i class="icon-user"></i> <?php echo $this->session->userdata("nama"); ?>
			          		<span class="caret"></span>
				        </a>
				        <ul class="dropdown-menu">
			          		<li><a href="<?php echo base_url(); ?>superadmin/profil"><i class="icon-map-marker"></i> User Profil</a></li>
			          		<li><a href="<?php echo base_url(); ?>superadmin/password"><i class="icon-folder-open"></i> User Password</a></li>
	 		 				<li class="divider"></li>
			          		<li><a href="<?php echo base_url(); ?>superadmin/superadmin/logout"><i class="icon-off"></i> Log Out</a></li>
				        </ul>
			      	</div>
	
					<div class="btn-group pull-right">
				        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
			          		<i class="icon-cog"></i> Configuration
			          		<span class="caret"></span>
				        </a>
				        <ul class="dropdown-menu">
			          		<li><a href="<?php echo base_url(); ?>superadmin/user"><i class="icon-leaf"></i> User Management</a></li>
							
	 		 				<li class="divider"></li>
			          		<li><a href="<?php echo base_url(); ?>superadmin/routing_pages"><i class="icon-refresh"></i> Routing Pages</a></li>
			          		<li><a href="<?php echo base_url(); ?>superadmin/sistem"><i class="icon-fire"></i> Sistem</a></li>
				        </ul>
			      	</div>
				
					<div class="btn-group pull-right">
							<a class="btn" href="<?php echo base_url(); ?>superadmin">
								<i class="icon-home"></i> Dashboard
							</a>
					</div>
	          	</div>
			</div>
		</div>
	</div>
	<div class="m-top"></div>
	<aside class="sidebar">
		<ul class="nav nav-tabs nav-stacked">

			<li>
				<a href="<?php echo base_url(); ?>superadmin/artikel">
					<div>
						<div class="ico">
							<img src="<?php echo base_url(); ?>asset/admin/images/ico-artikel.png">
						</div>
						<div class="title">
							ARTIKEL
						</div>
					</div>
					<div class="arrow">
						<div class="bubble-arrow-border"></div>
						<div class="bubble-arrow"></div>
					</div>
				</a>
			</li>

			<li>
				<a href="<?php echo base_url(); ?>superadmin/iklan">
					<div>
						<div class="ico">
							<img src="<?php echo base_url(); ?>asset/admin/images/ico-berita.png">
						</div>
						<div class="title">
							 IKLAN
						</div>
					</div>
					<div class="arrow">
						<div class="bubble-arrow-border"></div>
						<div class="bubble-arrow"></div>
					</div>
				</a>
			</li>

			<li>
				<a href="<?php echo base_url(); ?>superadmin/kategori">
					<div>
						<div class="ico">
							<img src="<?php echo base_url(); ?>asset/admin/images/ico-bidang.png">
						</div>
						<div class="title">
							KATEGORI
						</div>
					</div>
					<div class="arrow">
						<div class="bubble-arrow-border"></div>
						<div class="bubble-arrow"></div>
					</div>
				</a>
			</li>

			<li>
				<a href="<?php echo base_url(); ?>superadmin/lokasi">
					<div>
						<div class="ico">
							<img src="<?php echo base_url(); ?>asset/admin/images/ico-category.png">
						</div>
						<div class="title">
							LOKASI
						</div>
					</div>
					<div class="arrow">
						<div class="bubble-arrow-border"></div>
						<div class="bubble-arrow"></div>
					</div>
				</a>
			</li>

			<li>
				<a href="<?php echo base_url(); ?>superadmin/member">
					<div>
						<div class="ico">
							<img src="<?php echo base_url(); ?>asset/admin/images/ico-profil.png">
						</div>
						<div class="title">
							MEMBER
						</div>
					</div>
					<div class="arrow">
						<div class="bubble-arrow-border"></div>
						<div class="bubble-arrow"></div>
					</div>
				</a>
			</li>

			<li>
				<a href="<?php echo base_url(); ?>superadmin/pesan">
					<div>
						<div class="ico">
							<img src="<?php echo base_url(); ?>asset/admin/images/ico-product.png">
						</div>
						<div class="title">
							PESAN
						</div>
					</div>
					<div class="arrow">
						<div class="bubble-arrow-border"></div>
						<div class="bubble-arrow"></div>
					</div>
				</a>
			</li>
	    </ul>
	</aside>
	<div class="m-sidebar-collapsed">
		<ul class="nav nav-pills">
			
		</ul>

		<div class="arrow-border">
			<div class="arrow-inner"></div>
		</div>
	</div>