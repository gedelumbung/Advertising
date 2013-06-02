
	<div class="main-container">
		<div class="container-fluid">
			<section>
				<div class="page-header">
					<h1>Product</h1>
				</div>
				
				<div class="input-append">
				<?php echo form_open("superadmin/product/set"); ?>
				<?php echo $combo_kategori; ?>
				<input type="search" class="span2" id="appendedInputButton" name="by_nama" value="<?php echo $this->session->userdata("search_nama_produk"); ?>" placeholder="Search by name" /><input type="submit" class="btn btn-primary" type="button" value="Filter">
				<?php echo form_close(); ?>
				</div>
				
				<?php echo $this->breadcrumb->output(); ?>
				<p class="pull-right"><a href='<?php echo base_url(); ?>superadmin/product/tambah' class='btn'><i class='icon-plus'></i> Add New Product</a></p>
				<div class="cleaner_h5"></div>
				<div class="row-fluid">
					<div class="well">
							<?php echo $data_retrieve; ?>
					</div>
				</div>
			</section>