<script>
var status = "";
function tampil_form()
{
	if(status=="")
	{
		$('#form_balas').slideDown();
		status = "isi";
	}
	else
	{
		$('#form_balas').slideUp();
		status = "";
	}
}
</script>
<div class="container-fluid content-body">
			<div class="row-fluid">
				<div class="span9">
					<?php echo $this->breadcrumb->output(); ?>
					<div class="main_content">
						<h3 class="title"><span class="pull-left"><i class="icon-tasks"></i> DETAIL INBOX</span></h3>
						<div class="container-fluid">
						<span style=" padding-top:3px; cursor:pointer;"><a onclick="tampil_form()"><strong>+ Balas/Kirim Pesan</strong></a></span>
						
							<?php echo $dt_retrieve; ?>
						</div>
					</div>
				</div>