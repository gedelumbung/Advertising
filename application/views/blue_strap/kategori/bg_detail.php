<div class="container-fluid content-body">
			<div class="row-fluid">
				<div class="span9">
					<?php echo $this->breadcrumb->output(); ?>
					<div class="main_content">
					<h3 class="title"><span class="pull-left"><i class="icon-tasks"></i> KATEGORI <?php echo $kategori_title; ?></span>
					<span class="pull-right"><a href="<?php echo base_url(); ?>web/kategori">Lihat Semua Kategori</a>  <span class="label label-warning">INDEXS</span></span></h3>
						<div class="container-fluid">
							<div class="row-fluid product_listing">
								<?php echo $dt_retrieve; ?>
							</div>
						</div>
					</div>
				</div>