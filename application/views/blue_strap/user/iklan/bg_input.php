<div class="container-fluid content-body">
			<div class="row-fluid">
				<div class="span9">
					<?php echo $this->breadcrumb->output(); ?>
					<div class="main_content">
						
						<h3 class="title"><span class="pull-left"><i class="icon-tasks"></i> INPUT IKLAN</span></h3>
						<div class="container">
						<?php echo $this->session->flashdata("result"); ?>
							<?php echo form_open("user/iklan/set",'class="form-horizontal"'); ?>
							  <div class="control-group">
								<label class="control-label" for="judul">Judul</label>
								<div class="controls">
								  <input type="text" id="judul" name="judul" placeholder="Judul" required value="<?php echo $judul_iklan; ?>">
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="judul">Lokasi</label>
								<div class="controls">
								  <?php echo $combo_lokasi_iklan; ?>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="judul">Kategori</label>
								<div class="controls">
								  <?php echo $combo_kategori_iklan; ?>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="keterangan">Keterangan</label>
								<div class="controls" style="width:630px;">
								  <textarea id="keterangan" name="keterangan" placeholder="Keterangan" required><?php echo $keterangan; ?></textarea>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="harga">Harga</label>
								<div class="controls">
								  <input type="text" id="harga" name="harga" placeholder="Harga" required value="<?php echo $harga; ?>">
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="kondisi">Kondisi</label>
								<div class="controls">
								<?php $a=''; $b='';
								if($kondisi=="Bekas"){ $a='selected="selected"'; $b=''; }
								if($kondisi=="Baru"){ $b='selected="selected"'; $a=''; }
								?>
									<select name="kondisi" id="kondisi">
										<option value="Bekas" <?php echo $a; ?>>Bekas</option>
										<option value="Baru" <?php echo $b; ?>>Baru</option>
									</select>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="tipe">Tipe</label>
								<div class="controls">
								<?php $c=''; $d='';
								if($tipe=="Sewa"){ $c='selected="selected"'; $d='';}
								else if($tipe=="Cari"){ $d='selected="selected"'; $c=''; }
								?>
									<select name="tipe" id="tipe">
										<option value="Sewa" <?php echo $c; ?>>Sewa</option>
										<option value="Cari" <?php echo $d; ?>>Cari</option>
									</select>
								</div>
							  </div>
							  
							  <div class="control-group">
								<div class="controls">
								  <button type="submit" class="btn btn-primary">Simpan Data</button>
								  <input type="hidden" name="id_member" value="<?php echo $id_member; ?>" />
								  <input type="hidden" name="id_iklan" value="<?php echo $id_iklan; ?>" />
								  <input type="hidden" name="st" value="<?php echo $st; ?>" />
								</div>
							  </div>
							<?php echo form_close(); ?>
							<?php
								if($st=="edit")
								{
									echo form_open_multipart("user/iklan/set_gambar",'class="form-horizontal"');
							?>
									<h4>Tambah Gambar</h4>
									<input type="file" name="userfile" />
									<input type="hidden" name="id_iklan" value="<?php echo $id_iklan; ?>" />
									<button type="submit" class="btn btn-primary">Upload Gambar</button>
							<?php
									echo form_close();
									echo $daftar_gambar_iklan;
								}
							?>
						</div>
					</div>
				</div>