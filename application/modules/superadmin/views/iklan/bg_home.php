
	<div class="main-container">
		<div class="container-fluid">
			<section>
				<div class="page-header">
					<h1>Iklan</h1>
				</div>
				
				<div class="well">
					<?php echo $this->breadcrumb->output(); ?>
					<?php echo form_open("superadmin/iklan/filter"); ?>
					<select name="filter">
					<?php $a=''; $u=''; $s='';
					if($this->session->userdata("filter_iklan")=="1"){$a='selected'; $u=''; $s='';}
					else if($this->session->userdata("filter_iklan")=="0"){$a=''; $u='selected'; $s='';}
					else if($this->session->userdata("filter_iklan")=="2"){$a=''; $u=''; $s='selected';}
					?>
						<option value="2" <?php echo $s; ?> >Semua</option>
						<option value="1" <?php echo $a; ?> >Approve</option>
						<option value="0" <?php echo $u; ?> >Unapprove</option>
					</select>
					<br />
					<input type="submit" value="Filter Data" class="btn btn-info" />
					<?php echo $data_retrieve; ?>
				</div>
			</section>