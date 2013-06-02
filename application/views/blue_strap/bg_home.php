<div class="container-fluid content-body">
			<div class="row-fluid">
				<div class="span9">
					<div class="main_content">
						<h3 class="title"><span class="pull-left"><i class="icon-briefcase"></i> IKLAN TERBARU</span><span class="pull-right"><a href="<?php echo base_url(); ?>web/iklan">Lihat Semua Iklan Terbaru</a> <span class="label label-success">NEW</span></span></h3>
						<div class="container-fluid">
						<ul class="thumbnails">
							<div class="row-fluid product_listing">
								<?php echo $front_iklan_new; ?>
							</div>
						</div>
						
						<h3 class="title"><span class="pull-left"><i class="icon-tasks"></i> KATEGORI IKLAN</span><span class="pull-right"><a href="<?php echo base_url(); ?>web/kategori">Lihat Semua Kategori</a>  <span class="label label-warning">INDEXS</span></span></h3>
						<div class="container-fluid">
							<div class="row-fluid product_listing">
								<?php echo $front_kategori; ?>
							</div>
						</div>
						
						<h3 class="title"><span class="pull-left"><i class="icon-th"></i> IKLAN TERPOPULER</span><span class="pull-right"><a href="<?php echo base_url(); ?>web/iklan/hot">Lihat Semua Iklan Terpopuler</a> <span class="label label-important">HOT</span></span></h3>				
						<div class="row-fluid">
							<div class="row-fluid product_listing">
								<?php echo $front_iklan_hot; ?>
							</div>
						</div>
						<h3 class="title"><span class="pull-left"><i class="icon-file"></i> ARTIKEL TERBARU</span><span class="pull-right"><a href="<?php echo base_url(); ?>web/artikel">Lihat Semua Artikel</a>  <span class="label label-success">NEW</span></span></h3>
						<div class="row-fluid">
							<div class="span7">
								<?php echo $front_artikel_newest; ?>
							</div>
							<div class="span5">
								<div class="other_info">
									<?php echo $front_artikel_newest_list; ?>
								</div>
							</div>
						</div>
					</div>
				</div>