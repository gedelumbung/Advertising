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
						<h3 class="title"><span class="pull-left"><i class="icon-tasks"></i> KIRIM PESAN BARU</span></h3>
						<div class="container-fluid">
						<div id="form_balas">
							<?php echo form_open("user/inbox/kirim_new") ?>
							<table  width="700" bgcolor="#ECF5CF" cellspacing="0" border="0" cellpadding="10">
							<tr>
							<td>
							<textarea id="keterangan" cols="10" name="isi"></textarea>
							</td>
							</tr>
							<tr>
								<td>
								<input type="submit" value="KIRIM PESAN" class="btn btn-primary" />
								<input type="hidden" name="id_penerima" value="<?php echo $id_penerima; ?>" />
								</td>
							</tr>
							</table>
							<?php echo form_close() ?>
							</div>
						</div>
					</div>
				</div>