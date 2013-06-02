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
						
						<h3 class="title"><span class="pull-left"><i class="icon-tasks"></i> INDEXS INBOX</span></h3>
						<span style=" padding-top:3px; cursor:pointer;"><a onclick="tampil_form()"><strong>+ Balas/Kirim Pesan</strong></a></span>
						<div class="container-fluid">
						<div id="form_balas" style="display:none;">
							<?php echo form_open("user/pesan_admin/kirim") ?>
							<table  width="700" bgcolor="#ECF5CF" cellspacing="0" border="0" cellpadding="10">
							<tr>
							<td>
							<textarea id="keterangan" cols="10" name="isi"></textarea>
							</td>
							</tr>
							<tr>
								<td>
								<input type="submit" value="KIRIM PESAN" class="btn btn-primary" />
								<input type="hidden" name="id_pengirim" value="<?php echo $this->session->userdata("id_member"); ?>" />
								</td>
							</tr>
							</table>
							<?php echo form_close() ?>
							</div>
							<?php echo $dt_retrieve; ?>
						</div>
					</div>
				</div>