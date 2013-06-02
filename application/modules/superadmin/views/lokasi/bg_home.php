
	<div class="main-container">
		<div class="container-fluid">
			<section>
				<div class="page-header">
					<h1>Lokasi</h1>
				</div>
				
				<?php echo $this->breadcrumb->output(); ?>
				<?php echo "<a href='".base_url()."superadmin/lokasi/tambah' class='btn btn'><i class='icon-plus'></i> Add New</a>"; ?>
				<?php echo $data_retrieve; ?>
			</section>