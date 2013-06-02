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
	<div class="main-container">
		<div class="container-fluid">
			<section>
				<div class="page-header">
					<h1>Pesan</h1>
				</div>
				
				<?php echo $this->breadcrumb->output(); ?>
				<span style=" padding-top:3px; cursor:pointer;"><a onclick="tampil_form()"><strong>+ Balas/Kirim Pesan</strong></a></span>
				<div id="form_balas" style="display:none;">
					<?php echo form_open("superadmin/pesan/kirim") ?>
					<table  width="700" bgcolor="#ECF5CF" cellspacing="0" border="0" cellpadding="10">
					<tr>
					<td>
					<textarea id="keterangan" cols="10" name="isi"></textarea>
					</td>
					</tr>
					<tr>
						<td>
						<input type="submit" value="KIRIM PESAN" class="btn btn-primary" />
						<input type="hidden" name="id_pengirim" value="<?php echo $id_penerima; ?>" />
						</td>
					</tr>
					</table>
					<?php echo form_close() ?>
				</div>
				<?php echo $data_retrieve; ?>
			</section>