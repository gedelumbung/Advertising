				<div class="span3">
					<h3 class="title nm"><i class="icon-refresh"></i> TELUSURI IKLAN</h3>
					<div class="accordion right-col" id="accordion">
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
									<h3 class="title nm nl"><i class="icon-list"></i> Kategori Iklan</h3>
								</a>
							</div>
							<div id="collapseOne" class="accordion-body collapse in">
								<div class="accordion-inner">
									<?php echo $list_kategori; ?>
								</div>
							</div>
						</div>
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
									<h3 class="title nl nm"><i class="icon-tasks"></i> Iklan Terbaru</h3>
								</a>
							</div>
							<div id="collapseTwo" class="accordion-body collapse">
								<div class="accordion-inner">
									<?php echo $left_iklan_new; ?>
								</div>
							</div>
						</div>
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
									<h3 class="title nl nm"><i class="icon-th"></i> Iklan Terpopuler</h3>
								</a>
							</div>
							<div id="collapseThree" class="accordion-body collapse">
								<div class="accordion-inner">
									<?php echo $left_iklan_hot; ?>
								</div>
							</div>
						</div>
					</div>				
					<h3 class="title nmb"><i class="icon-file"></i> ARTIKEL TERPOPULER</h3>
					<?php echo $left_artikel_hot; ?>
					<h3 class="title nmb"><i class="icon-file"></i> STATISTIK KUNJUNGAN</h3>
					<?php 
						if($this->session->userdata("counter_pengunjung")=="")
						{
							$d['counter_pengunjung'] = "set";
							$this->session->set_userdata($d);
							$this->db->query("update dlmbg_counter set counter=counter+1");
						}
						$get = $this->db->get("dlmbg_counter")->row();
						$counter = $get->counter;
						echo "<p>Browser : ".$this->agent->browser()." - ".$this->agent->version()."</p>";
						echo "<p>Sistem Operasi : ".$this->agent->platform()."</p>";
						echo "<p>Dikunjungi sebanyak : ".$counter." kali</p>";
					
					 ?>
				</div>

			</div>
		</div>