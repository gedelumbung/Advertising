<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app_global_web_model extends CI_Model {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 **/ 
	public function generate_captcha()
	{
		$vals = array(
			'img_path' => './captcha/',
			'img_url' => base_url().'captcha/',
			'font_path' => './system/fonts/impact.ttf',
			'img_width' => '150',
			'img_height' => 40
			);
		$cap = create_captcha($vals);
		$datamasuk = array(
			'captcha_time' => $cap['time'],
			//'ip_address' => $this->input->ip_address(),
			'word' => $cap['word']
			);
		$expiration = time()-3600;
		$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);
		$query = $this->db->insert_string('captcha', $datamasuk);
		$this->db->query($query);
		return $cap['image'];
	}
	 
	public function generate_menu($posisi,$custom_class="")
	{
		$hasil = "";
		$where['posisi']=$posisi;
		$w = $this->db->get_where("dlmbg_menu",$where);
		
		$hasil .= '<ul class="'.$custom_class.'">';
		foreach($w->result() as $h)
		{		
			$hasil .= '<li><a href="'.base_url().'web/pages/get/'.$h->id_menu.'/'.url_title($h->menu,'-',TRUE).'"><i class="'.$h->custom_fields.'"></i> '.$h->menu.'</a></li>';		
		}
		$hasil .= '</ul>';
		return $hasil;
	}
	 
	public function generate_combo_lokasi($custom_class="")
	{
		$hasil = "";
		$w = $this->db->get("dlmbg_lokasi");
		
		$hasil .= '<select class="'.$custom_class.'" name="id_lokasi">';
		$hasil .= '<option value="" selected="selected">Semua Lokasi</option>';
		foreach($w->result() as $h)
		{		
			if($this->session->userdata('set_combo_lokasi')==$h->id_lokasi)
			{
				$hasil .= '<option value="'.$h->id_lokasi.'" selected="selected">'.$h->lokasi.'</option>';	
			}
			else
			{
				$hasil .= '<option value="'.$h->id_lokasi.'">'.$h->lokasi.'</option>';	
			}	
		}
		$hasil .= '</select>';
		return $hasil;
	}
	 
	public function generate_combo_kategori($custom_class="")
	{
		$hasil = "";
		$w = $this->db->get("dlmbg_kategori");
		
		$hasil .= '<select class="'.$custom_class.'" name="id_kategori">';
		$hasil .= '<option value="" selected="selected">Semua Kategori</option>';
		foreach($w->result() as $h)
		{		
			if($this->session->userdata('set_combo_kategori')==$h->id_kategori)
			{
				$hasil .= '<option value="'.$h->id_kategori.'" selected="selected">'.$h->kategori.'</option>';	
			}
			else
			{
				$hasil .= '<option value="'.$h->id_kategori.'">'.$h->kategori.'</option>';	
			}	
		}
		$hasil .= '</select>';
		return $hasil;
	}
	 
	public function generate_list_kategori($custom_class="")
	{
		$hasil = "";
		$w = $this->db->query("select a.kategori, a.id_kategori, a.custom_fields, (select count(id_iklan) as jum from dlmbg_iklan where id_kategori=a.id_kategori) jum 
		from dlmbg_kategori a");
		
		$hasil .= '<ul class="'.$custom_class.'">';
		foreach($w->result() as $h)
		{		
				$hasil .= '<li><a href="'.base_url().'web/kategori/get/'.$h->id_kategori.'/'.url_title($h->kategori,'-',TRUE).'"><i class="'.$h->custom_fields.'"></i> '.$h->kategori.'</a> <span class="label pull-right label-info">'.$h->jum.'</span></li>';
		}
		$hasil .= '</select>';
		return $hasil;
	}
	 
	public function generate_front_kategori($limit,$offset)
	{
		$hasil = "";
		$w = $this->db->get("dlmbg_kategori",$limit,$offset);
		foreach($w->result() as $h)
		{		
			$hasil .= '<div class="span1">
						<div class="item">
							<a href="'.base_url().'web/kategori/get/'.$h->id_kategori.'/'.url_title($h->kategori,'-',TRUE).'">
							<img class="img-kategori" src="'.base_url().'asset/theme/'.$_SESSION['site_theme'].'/images/kategori/'.$h->icon.'" 
							alt="'.$h->kategori.'" title="'.$h->kategori.'">
							</a>
							<a href="'.base_url().'web/kategori/get/'.$h->id_kategori.'/'.url_title($h->kategori,'-',TRUE).'" class="title2">
							'.$h->kategori.'</a>									
						</div>
					</div>';
		}
		return $hasil;
	}
	 
	public function generate_front_artikel($limit,$offset,$order,$sidebar="0")
	{
		$hasil = "";
		$w = $this->db->order_by($order,"DESC")->get("dlmbg_artikel",$limit,$offset);
		foreach($w->result() as $h)
		{		
			if($sidebar==1){ $hasil .= '<div class="reviews-item">'; }
			$hasil .= '<div class="featured-item">
						<a href="#"><img src="'.base_url().'asset/images/artikel/'.$h->gambar.'" alt="'.$h->judul.'" title="'.$h->judul.'" class="img pull-left"></a>
						<strong><a href="'.base_url().'web/artikel/get/'.$h->id_artikel.'/'.url_title($h->judul,'-',TRUE).'">'.substr($h->judul,0,50).'...</a></strong>
						<p>Diposting pada : '.generate_tanggal($h->tanggal).'</p>
						<p>'.substr(strip_tags($h->isi),0,100).'...[<strong>Baca selengkapnya</strong>]</p>
					</div>';
			if($sidebar==1){ $hasil .= '</div>'; }
		}
		return $hasil;
	}
	 
	public function generate_front_artikel_list($limit,$offset)
	{
		$hasil = "";
		$w = $this->db->order_by("id_artikel","DESC")->get("dlmbg_artikel",$limit,$offset);
		foreach($w->result() as $h)
		{		
			$hasil .= '<p>
						<strong><a href="'.base_url().'web/artikel/get/'.$h->id_artikel.'/'.url_title($h->judul,'-',TRUE).'">'.substr($h->judul,0,50).'...</a></strong>
						<br>Diposting pada : '.generate_tanggal($h->tanggal).'				
					</p>';
		}
		return $hasil;
	}
	 
	public function generate_pages_content($id_param)
	{
		$hasil = "";
		$where['id_menu'] = $id_param;
		$get_data = $this->db->get_where("dlmbg_menu",$where)->row();
		$hasil .= '<h3 class="title"><span class="pull-left"><i class="icon-briefcase"></i> '.$get_data->menu.'</span></h3>
					<div class="container-fluid">
					'.$get_data->content.'
					</div>';
		return $hasil;
	}
	 
	public function generate_indexs_artikel($limit,$offset)
	{
		$hasil="";

		$page=$offset;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		
		$tot_hal = $this->db->get("dlmbg_artikel");
		$config['base_url'] = base_url() . 'web/artikel/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);
		
		$w = $this->db->order_by("id_artikel","DESC")->get("dlmbg_artikel",$limit,$offset);
		foreach($w->result() as $h)
		{		
			$hasil .= '<div class="featured-item">
						<a href="'.base_url().'web/artikel/get/'.$h->id_artikel.'/'.url_title($h->judul,'-',TRUE).'"><img src="'.base_url().'asset/images/artikel/'.$h->gambar.'" alt="'.$h->judul.'" title="'.$h->judul.'" class="img pull-left"></a>
						<strong><a href="'.base_url().'web/artikel/get/'.$h->id_artikel.'/'.url_title($h->judul,'-',TRUE).'"><h4>'.$h->judul.'</h4></a></strong>
						<p>Diposting pada : '.generate_tanggal($h->tanggal).'</p>
						<p>'.substr(strip_tags($h->isi),0,100).'...[<strong>Baca selengkapnya</strong>]</p>
					</div>';
		}
		$hasil .= '<div class="cleaner_h20"></div>';
		$hasil .= $this->pagination->create_links();
		return $hasil;
	}
	 
	public function generate_detail_artikel($id_param)
	{
		$hasil="";
		$where['id_artikel'] = $id_param;
		$w = $this->db->get_where("dlmbg_artikel",$where);
		$this->db->query("update dlmbg_artikel set counter=counter+1 where id_artikel='".$where['id_artikel']."'");
		foreach($w->result() as $h)
		{		
			$hasil .= '<div class="featured-item">
						<a href="'.base_url().'web/artikel/get/'.$h->id_artikel.'/'.url_title($h->judul,'-',TRUE).'"><img src="'.base_url().'asset/images/artikel/'.$h->gambar.'" alt="'.$h->judul.'" title="'.$h->judul.'" class="img pull-left"></a>
						<strong><a href="'.base_url().'web/artikel/get/'.$h->id_artikel.'/'.url_title($h->judul,'-',TRUE).'"><h4>'.$h->judul.'</h4></a></strong>
						<p>Diposting pada : '.generate_tanggal($h->tanggal).'</p>
						<p>'.$h->isi.'</p>
					</div>';
		}
		return $hasil;
	}
	 
	public function generate_indexs_kategori()
	{
		$i = 0;
		$hasil = "";
		$w = $this->db->get("dlmbg_kategori");
		foreach($w->result() as $h)
		{		
			if($i==0)
			{
				$hasil .= '</div>';
				$hasil .= '<div class="cleaner_h20"></div>';
				$hasil .= '<div class="row-fluid product_listing">';
			}
			$hasil .= '<div class="span2">
						<div class="item">
							<a href="'.base_url().'web/kategori/get/'.$h->id_kategori.'/'.url_title($h->kategori,'-',TRUE).'">
							<img class="img-kategori" src="'.base_url().'asset/theme/'.$_SESSION['site_theme'].'/images/kategori/'.$h->icon.'" 
							alt="'.$h->kategori.'" title="'.$h->kategori.'">
							</a>
							<a href="'.base_url().'web/kategori/get/'.$h->id_kategori.'/'.url_title($h->kategori,'-',TRUE).'" class="title2">
							'.$h->kategori.'</a>									
						</div>
					</div>';
				$i++;
			if($i>5)
			{
				$i=0;
			}
		}
		return $hasil;
	}
	 
	public function generate_front_iklan($limit,$order)
	{
		$hasil = "";
		$w = $this->db->query("SELECT a.id_iklan, a.judul_iklan, c.kategori, b.lokasi, a.harga, a.rentang_harga, a.tanggal_expired, a.tanggal, a.kondisi, a .tipe, (select x.gambar from dlmbg_gambar_iklan x where x.id_iklan=a.id_iklan order by RAND() LIMIT 1) as gambar_thumb FROM dlmbg_iklan a left join dlmbg_lokasi b on a.id_lokasi=b.id_lokasi left join dlmbg_kategori c on a.id_kategori=c.id_kategori where st='1' order by ".$order." DESC LIMIT ".$limit."");
		foreach($w->result() as $h)
		{	
			$gbr = "no-image.jpg";
			if($h->gambar_thumb!="")
			{
				$gbr = $h->gambar_thumb;
			}
			$hasil .= '<div class="span3">
						<div class="item">
							<a href="'.base_url().'web/iklan/get/'.$h->id_iklan.'/'.url_title($h->judul_iklan,'-',TRUE).'"><img class="img" src="'.base_url().'asset/images/iklan/thumb/'.$gbr.'" alt="'.$h->judul_iklan.'" title="'.$h->judul_iklan.'"></a>
							<a href="'.base_url().'web/iklan/get/'.$h->id_iklan.'/'.url_title($h->judul_iklan,'-',TRUE).'" class="title">'.$h->judul_iklan.'</a>
							<p>Rp. '.number_format($h->harga,2,',','.').'</p>
							<p>Rentang Harga : '.$h->rentang_harga.'</p>
							Lokasi : <strong>'.$h->lokasi.'</strong><br>Kategori : <strong>'.$h->kategori.'</strong>
							<p><span class="label label-warning">Jenis : '.$h->kondisi.'</span> <span class="label label-important">'.$h->tipe.'</span></p>
						</div>
					</div>';
		}
		return $hasil;
	}
	 
	public function generate_indexs_iklan_kategori($id_param,$limit,$offset)
	{
		$hasil = "";

		$page=$offset;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		
		$where['id_kategori'] = $id_param;
		$where['st'] = "1";
		$tot_hal = $this->db->get_where("dlmbg_iklan",$where);
		$config['base_url'] = base_url() . 'web/kategori/get/'.$id_param.'/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 5;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);
		
		$w = $this->db->query("SELECT a.id_iklan, a.judul_iklan, c.kategori, b.lokasi, a.harga, a.tanggal, a.tanggal_expired, a.rentang_harga, a.kondisi, a .tipe, (select x.gambar from dlmbg_gambar_iklan x 
		where x.id_iklan=a.id_iklan order by RAND() LIMIT 1) as gambar_thumb FROM dlmbg_iklan a left join dlmbg_lokasi b on a.id_lokasi=b.id_lokasi left join dlmbg_kategori c on 
		a.id_kategori=c.id_kategori where a.id_kategori='".$id_param."' and st='1' order by id_iklan DESC LIMIT ".$offset.",".$limit."");
		foreach($w->result() as $h)
		{	
			$gbr = "no-image.jpg";
			if($h->gambar_thumb!="")
			{
				$gbr = $h->gambar_thumb;
			}
			$hasil .= '<div class="span3">
						<div class="item">
							<a href="'.base_url().'web/iklan/get/'.$h->id_iklan.'/'.url_title($h->judul_iklan,'-',TRUE).'"><img class="img" src="'.base_url().'asset/images/iklan/thumb/'.$gbr.'" alt="'.$h->judul_iklan.'" title="'.$h->judul_iklan.'"></a>
							<a href="'.base_url().'web/iklan/get/'.$h->id_iklan.'/'.url_title($h->judul_iklan,'-',TRUE).'" class="title">'.$h->judul_iklan.'</a>
							<p>Rp. '.number_format($h->harga,2,',','.').'</p>
							<p>Rentang Harga : '.$h->rentang_harga.'</p>
							Lokasi : <strong>'.$h->lokasi.'</strong><br>Kategori : <strong>'.$h->kategori.'</strong>
							<p><span class="label label-warning">Jenis : '.$h->kondisi.'</span> <span class="label label-important">'.$h->tipe.'</span></p>
						</div>
					</div>';
		}
		$hasil .= '<div class="cleaner_h20"></div>';
		$hasil .= $this->pagination->create_links();
		return $hasil;
	}
	 
	public function generate_detail_iklan($id_param)
	{
		$hasil = "";
		
		$w = $this->db->query("SELECT a.judul_iklan, a.keterangan, a.harga, a.tanggal, d.email, a.rentang_harga, a.tanggal_expired, a.kondisi, a.tipe, b.lokasi, c.kategori, d.nama, d.alamat, d.no_hp, d.no_telpon, 
		d.jk, d.tgl_bergabung, d.gambar, d.id_member, a.id_iklan FROM `dlmbg_iklan` a left join dlmbg_lokasi b on a.id_lokasi=b.id_lokasi left join dlmbg_kategori c on 
		a.id_kategori=c.id_kategori left join dlmbg_member d on a.id_member=d.id_member where a.id_iklan='".$id_param."' and st='1'");
		if($w->num_rows()>0)
		{
			foreach($w->result() as $h)
			{	
				$gbr = "no-image.png";
				if($h->gambar!="")
				{
					$gbr = $h->gambar;
				}
				$hasil .= '<h3 class="title"><span class="pull-left"><i class="icon-tasks"></i> '.$h->judul_iklan.'</span><span class="pull-right">
				<span class="label label-warning">'.$h->tipe.'</span></span></h3>
							<div class="container-fluid">';
				$hasil .= '<div class="row-fluid product_listing">'.$this->generate_gambar_iklan($id_param,$h->judul_iklan).'</div>';
				$hasil .= '<div class="row-fluid product_listing"><div class="span1">Harga : </div><div class="span2"><strong>Rp. '.number_format($h->harga,2,',','.').'</strong></div>
								<div class="span1">Kondisi : </div><div class="span2"><strong>'.$h->kondisi.'</strong></div>
								<div class="span1">Lokasi : </div><div class="span2"><strong>'.$h->lokasi.'</strong></div>
								<div class="span1">Kategori </div><div class="span2"><strong>'.$h->kategori.'</strong></div>
								<div class="span4">Rentang Harga : </div><div class="span2"><strong>'.$h->rentang_harga.'</strong></div>
								<div class="cleaner_h5"></div>
									'.$h->keterangan.'
								</div>
								
							</div>
						</div>
						<div class="main_content">
							<div class="container-fluid">
								<div class="row-fluid product_listing">
								<h3 class="title"><i class="icon-user"></i> '.$h->nama.' - '.$h->email.'</h3>
								  <div class="span2">
								  <a href="'.base_url().'web/member/get/'.$h->id_member.'/'.url_title($h->nama,'-',TRUE).'">
								  <img src="'.base_url().'asset/images/member/thumb/'.$gbr.'"  class="img" width="70">
								  </a>
								  </div>
								  <div class="span8">
									  <table>
										<tr>
											<td width="100">Alamat</td><td>:</td><td>'.$h->alamat.'</td>
										</tr>
										<tr>
											<td>No.Telpon / HP</td><td>:</td><td>'.$h->no_telpon.' / '.$h->no_hp.'</td>
										</tr>
										<tr>
											<td>Jenis Kelamin</td><td>:</td><td>'.$h->jk.'</td>
										</tr>
										<tr>
											<td>Bergabung</td><td>:</td><td>'.generate_tanggal($h->tgl_bergabung).'</td>
										</tr>
									  </table>
								  </div>
								</div>
							</div>
						</div>';
				if($this->session->userdata('logged_in')!="")
				{
					$gbr_f = "no-image.png";
					if($this->session->userdata('gambar')!="")
					{
						$gbr_f = $this->session->userdata('gambar');
					}
					$hasil .= '<div class="main_content">
							<div class="container-fluid">
								<div class="row-fluid product_listing">
								<h3 class="title"><i class="icon-fire"></i> Form Komentar</h3>
								  <div class="span1">
								  <a href="'.base_url().'web/member/get/'.$this->session->userdata('id_member').'/'.url_title($h->nama,'-',TRUE).'">
								  <img src="'.base_url().'asset/images/member/thumb/'.$gbr_f.'"  class="img" width="40">
								  </a>
								  </div>
								  <div class="span10">
									 <form method="post" action="'.base_url().'web/iklan/komentar">
									 	<textarea name="komentar" id="keterangan"></textarea>
										<input type="hidden" name="id_iklan" value="'.$h->id_iklan.'">
										<input type="hidden" name="id_member" value="'.$this->session->userdata('id_member').'">
										<input type="submit" value="Kirim Pesan" class="btn btn-info">
									 </form>
								  </div>
								</div>
							</div>
						</div>';
				}
				
				$get_komentar = $this->db->query("select * from dlmbg_komentar_iklan a left join dlmbg_member b on a.id_member=b.id_member where a.id_iklan='".$h->id_iklan."'
				order by id_komentar_iklan DESC");
				foreach($get_komentar->result() as $gk)
				{
					$gbr_k = "no-image.png";
					if($gk->gambar!="")
					{
						$gbr_k = $gk->gambar;
					}
					$hasil .= '<div class="main_content">
							<div class="container-fluid">
								<div class="row-fluid product_listing">
								<h3 class="title"><i class="icon-user"></i> '.$gk->nama.' - '.$gk->email.' ';
					if($this->session->userdata("id_member")==$gk->id_member)
					{
						$hasil .= '<a href="'.base_url().'web/iklan/hapus_komentar/'.$gk->id_iklan.'/'.$gk->id_komentar_iklan.'" onClick=\'return confirm("Are you sure?");\' ><span class="pull-right">Hapus</span></a>';
					}		
					$hasil .= '</h3>
								  <div class="span1">
								  <a href="'.base_url().'web/member/get/'.$gk->id_member.'/'.url_title($h->nama,'-',TRUE).'">
								  <img src="'.base_url().'asset/images/member/thumb/'.$gbr_k.'"  class="img" width="40">
								  </a>
								  </div>
								  <div class="span10">
									  '.$gk->komentar.'
								  </div>
								</div>
							</div>
						</div>';
				}
			}
		}
		else
		{
			$hasil .= '<div class="container-fluid">';
			$hasil .= '<div class="row-fluid product_listing">Iklan tidak ditemukan</div>';
			$hasil .= '<div class="row-fluid product_listing"></div></div></div>
					<div class="main_content">
						<div class="container-fluid">
							<div class="row-fluid product_listing">
							<h3 class="title">Iklan tidak ditemukan atau belum disetujui administrator</h3>
							 </div>
						</div>
					</div>';
		}
		return $hasil;
	}
	 
	public function generate_gambar_iklan($id_param,$judul_iklan)
	{
		$hasil = "";
		$hasil .= '<div id="myCarousel" class="carousel slide">
						<div class="carousel-inner">';
		$where['id_iklan'] = $id_param;
		$w = $this->db->get_where("dlmbg_gambar_iklan",$where);
		$i = 0;
		foreach($w->result() as $h)
		{	
			$aktif = '';
			if($i==0){ $aktif = 'active'; }
			$hasil .= '<div class="item '.$aktif.'">
							<img src="'.base_url().'asset/images/iklan/'.$h->gambar.'" alt="'.$judul_iklan.'" title="'.$judul_iklan.'">
							<div class="carousel-caption">
							  <h4>'.$judul_iklan.'</h4>
							</div>
						  </div>';
			$i++;
		}
		$hasil .= '</div><a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
						<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
					  </div>';
		return $hasil;
	}
	 
	public function generate_list_iklan($limit,$order)
	{
		$hasil = "";
		$where['st'] = 1;
		$w = $this->db->order_by($order,"ASC")->get_where("dlmbg_iklan",$where,$limit,0);
		
		$hasil .= '<ul class="nav nav-list right-categories">';
		foreach($w->result() as $h)
		{	
			$hasil .= '<li><a href="'.base_url().'web/iklan/get/'.$h->id_iklan.'/'.url_title($h->judul_iklan,'-',TRUE).'">'.$h->judul_iklan.'</a></li>';
		}
		$hasil .= '</ul>';
		return $hasil;
	}
	 
	public function generate_indexs_iklan($limit,$offset,$urut)
	{
		$hasil = "";

		$page=$offset;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		$where['st'] = 1;
		
		$tot_hal = $this->db->get_where("dlmbg_iklan",$where);
		$config['base_url'] = base_url() . 'web/iklan/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);
		
		$order = "counter";
		if($urut=="new")
		{
			$order = "id_iklan";
		}
		
		$w = $this->db->query("SELECT a.id_iklan, a.judul_iklan, c.kategori, b.lokasi, a.harga, a.tanggal, a.tanggal_expired, a.rentang_harga, a.kondisi, a .tipe, (select x.gambar from dlmbg_gambar_iklan x 
		where x.id_iklan=a.id_iklan order by RAND() LIMIT 1) as gambar_thumb FROM dlmbg_iklan a left join dlmbg_lokasi b on a.id_lokasi=b.id_lokasi left join dlmbg_kategori c on 
		a.id_kategori=c.id_kategori where st='1' order by ".$order." DESC LIMIT ".$offset.",".$limit."");
		$i = 0;
		foreach($w->result() as $h)
		{	
			$gbr = "no-image.jpg";
			if($h->gambar_thumb!="")
			{
				$gbr = $h->gambar_thumb;
			}
			if($i==0)
			{
				$hasil .= '</div>';
				$hasil .= '<div class="cleaner_h20"></div>';
				$hasil .= '<div class="row-fluid product_listing">';
			}
			$hasil .= '<div class="span3">
						<div class="item">
							<a href="'.base_url().'web/iklan/get/'.$h->id_iklan.'/'.url_title($h->judul_iklan,'-',TRUE).'"><img class="img" src="'.base_url().'asset/images/iklan/thumb/'.$gbr.'" alt="'.$h->judul_iklan.'" title="'.$h->judul_iklan.'"></a>
							<a href="'.base_url().'web/iklan/get/'.$h->id_iklan.'/'.url_title($h->judul_iklan,'-',TRUE).'" class="title">'.$h->judul_iklan.'</a>
							<p>Rp. '.number_format($h->harga,2,',','.').'</p>
							<p>Rentang Harga : '.$h->rentang_harga.'</p>
							Lokasi : <strong>'.$h->lokasi.'</strong><br>Kategori : <strong>'.$h->kategori.'</strong>
							<p><span class="label label-warning">Jenis : '.$h->kondisi.'</span> <span class="label label-important">'.$h->tipe.'</span></p>
						</div>
					</div>';
			$i++;
			if($i>3)
			{
				$i=0;
			}
		}
		$hasil .= '<div class="cleaner_h20"></div>';
		$hasil .= $this->pagination->create_links();
		return $hasil;
	}
	 
	public function generate_indexs_pencarian($limit,$offset)
	{
		$hasil = "";

		$page=$offset;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		$tot_hal = "";
		$w = "";
		
		$id_lokasi = $this->session->userdata("set_combo_lokasi");
		$id_kategori = $this->session->userdata("set_combo_kategori");
		$keyword = $this->session->userdata("keyword");
		if($id_lokasi!="" && $id_kategori!="")
		{
			$tot_hal = $this->db->query("SELECT a.id_iklan FROM dlmbg_iklan a left join dlmbg_lokasi b on a.id_lokasi=b.id_lokasi left join dlmbg_kategori c on 
			a.id_kategori=c.id_kategori where a.id_lokasi='".$id_lokasi."' and a.id_kategori='".$id_kategori."' and a.judul_iklan like '%".$keyword."%'");
			
			$w = $this->db->query("SELECT a.id_iklan, a.judul_iklan, c.kategori, b.lokasi, a.harga, a.tanggal, a.kondisi, a .tipe, (select x.gambar from dlmbg_gambar_iklan x 
			where x.id_iklan=a.id_iklan order by RAND() LIMIT 1) as gambar_thumb FROM dlmbg_iklan a left join dlmbg_lokasi b on a.id_lokasi=b.id_lokasi left join dlmbg_kategori 
			c on a.id_kategori=c.id_kategori where a.id_lokasi='".$id_lokasi."' and a.id_kategori='".$id_kategori."' and a.judul_iklan like '%".$keyword."%' order by id_iklan 
			DESC LIMIT ".$offset.",".$limit."");
		}
		else if($id_kategori!="" && $id_lokasi=="")
		{
			$tot_hal = $this->db->query("SELECT a.id_iklan FROM dlmbg_iklan a left join dlmbg_lokasi b on a.id_lokasi=b.id_lokasi left join dlmbg_kategori c on 
			a.id_kategori=c.id_kategori where a.id_kategori='".$id_kategori."' and a.judul_iklan like '%".$keyword."%'");
			
			$w = $this->db->query("SELECT a.id_iklan, a.judul_iklan, c.kategori, b.lokasi, a.harga, a.tanggal, a.kondisi, a .tipe, (select x.gambar from dlmbg_gambar_iklan x 
			where x.id_iklan=a.id_iklan order by RAND() LIMIT 1) as gambar_thumb FROM dlmbg_iklan a left join dlmbg_lokasi b on a.id_lokasi=b.id_lokasi left join dlmbg_kategori 
			c on a.id_kategori=c.id_kategori where a.id_kategori='".$id_kategori."' and a.judul_iklan like '%".$keyword."%' order by id_iklan DESC LIMIT ".$offset.",".$limit."");
		}
		else if($id_lokasi!="" && $id_kategori=="")
		{
			$tot_hal = $this->db->query("SELECT a.id_iklan FROM dlmbg_iklan a left join dlmbg_lokasi b on a.id_lokasi=b.id_lokasi left join dlmbg_kategori c on 
			a.id_kategori=c.id_kategori where a.id_lokasi='".$id_lokasi."' and a.judul_iklan like '%".$keyword."%'");
			
			$w = $this->db->query("SELECT a.id_iklan, a.judul_iklan, c.kategori, b.lokasi, a.harga, a.tanggal, a.kondisi, a .tipe, (select x.gambar from dlmbg_gambar_iklan x 
			where x.id_iklan=a.id_iklan order by RAND() LIMIT 1) as gambar_thumb FROM dlmbg_iklan a left join dlmbg_lokasi b on a.id_lokasi=b.id_lokasi left join dlmbg_kategori 
			c on a.id_kategori=c.id_kategori where a.id_lokasi='".$id_lokasi."' and a.judul_iklan like '%".$keyword."%' order by id_iklan DESC LIMIT ".$offset.",".$limit."");
		}
		else
		{
			$tot_hal = $this->db->query("SELECT a.id_iklan FROM dlmbg_iklan a left join dlmbg_lokasi b on a.id_lokasi=b.id_lokasi left join dlmbg_kategori c on 
			a.id_kategori=c.id_kategori");
			
			$w = $this->db->query("SELECT a.id_iklan, a.judul_iklan, c.kategori, b.lokasi, a.harga, a.tanggal, a.kondisi, a .tipe, (select x.gambar from dlmbg_gambar_iklan x 
			where x.id_iklan=a.id_iklan order by RAND() LIMIT 1) as gambar_thumb FROM dlmbg_iklan a left join dlmbg_lokasi b on a.id_lokasi=b.id_lokasi left join dlmbg_kategori 
			c on a.id_kategori=c.id_kategori order by id_iklan DESC LIMIT ".$offset.",".$limit."");
		}
		
		$config['base_url'] = base_url() . 'web/pencarian/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);
		
		$i = 0;
		foreach($w->result() as $h)
		{	
			$gbr = "no-image.jpg";
			if($h->gambar_thumb!="")
			{
				$gbr = $h->gambar_thumb;
			}
			if($i==0)
			{
				$hasil .= '</div>';
				$hasil .= '<div class="cleaner_h20"></div>';
				$hasil .= '<div class="row-fluid product_listing">';
			}
			$hasil .= '<div class="span3">
						<div class="item">
							<a href="'.base_url().'web/iklan/get/'.$h->id_iklan.'/'.url_title($h->judul_iklan,'-',TRUE).'"><img class="img" src="'.base_url().'asset/images/iklan/thumb/'.$gbr.'" alt="'.$h->judul_iklan.'" title="'.$h->judul_iklan.'"></a>
							<a href="'.base_url().'web/iklan/get/'.$h->id_iklan.'/'.url_title($h->judul_iklan,'-',TRUE).'" class="title">'.$h->judul_iklan.'</a>
							<p>Rp. '.number_format($h->harga,2,',','.').'</p>
							Lokasi : <strong>'.$h->lokasi.'</strong><br>Kategori : <strong>'.$h->kategori.'</strong>
							<p><span class="label label-warning">Jenis : '.$h->kondisi.'</span> <span class="label label-important">'.$h->tipe.'</span></p>
						</div>
					</div>';
			$i++;
			if($i>3)
			{
				$i=0;
			}
		}
		$hasil .= '<div class="cleaner_h20"></div>';
		$hasil .= $this->pagination->create_links();
		return $hasil;
	}
	 
	public function generate_detail_member($id_param,$limit,$offset)
	{
		$hasil = "";
		
		$where['id_member'] = $id_param;
		$w = $this->db->get_where("dlmbg_member",$where);
		foreach($w->result() as $h)
		{	
			$gbr = "no-image.png";
			if($h->gambar!="")
			{
				$gbr = $h->gambar;
			}
			$hasil .= '<div class="container-fluid">
							<div class="row-fluid product_listing">
							<h3 class="title"><i class="icon-user"></i> '.$h->nama.' - '.$h->email.'
							<span class="pull-right"><a href="'.base_url().'user/inbox/set/'.$id_param.'">KIRIM PESAN PRIBADI</a>  
							<span class="label label-warning">PRIVATE MESSAGE</span></span></h3>
						  <div class="span3">
						  <a href="'.base_url().'web/member/get/'.$h->id_member.'/'.url_title($h->nama,'-',TRUE).'">
						  <img src="'.base_url().'asset/images/member/thumb/'.$gbr.'"  class="img" width="150">
						  </a>
						  </div>
						  <div class="span7">
							  <table>
								<tr>
									<td width="100">Nama</td><td>:</td><td>'.$h->nama.'</td>
								</tr>
								<tr>
									<td width="100">Email</td><td>:</td><td>'.$h->email.'</td>
								</tr>
								<tr>
									<td width="100">Alamat</td><td>:</td><td>'.$h->alamat.'</td>
								</tr>
								<tr>
									<td>No.Telpon / HP</td><td>:</td><td>'.$h->no_telpon.' / '.$h->no_hp.'</td>
								</tr>
								<tr>
									<td>Jenis Kelamin</td><td>:</td><td>'.$h->jk.'</td>
								</tr>
								<tr>
									<td>Bergabung</td><td>:</td><td>'.generate_tanggal($h->tgl_bergabung).'</td>
								</tr>
							  </table>
						  </div>
						</div>
						  </div>
						  <div class="cleaner_h30"></div>
						<div class="tabbable">
					  <ul class="nav nav-tabs">
						<li class="active"><a href="#tab1" data-toggle="tab">DATA MEMBER</a></li>
						<li><a href="#tab2" data-toggle="tab">DAFTAR IKLAN</a></li>
					  </ul>
					  <div class="tab-content">
						<div class="tab-pane active" id="tab1">
						 	 <table>
								<tr>
									<td width="100">Nama</td><td>:</td><td>'.$h->nama.'</td>
								</tr>
								<tr>
									<td width="100">Email</td><td>:</td><td>'.$h->email.'</td>
								</tr>
								<tr>
									<td width="100">Alamat</td><td>:</td><td>'.$h->alamat.'</td>
								</tr>
								<tr>
									<td>No.Telpon / HP</td><td>:</td><td>'.$h->no_telpon.' / '.$h->no_hp.'</td>
								</tr>
								<tr>
									<td>Jenis Kelamin</td><td>:</td><td>'.$h->jk.'</td>
								</tr>
								<tr>
									<td>Bergabung</td><td>:</td><td>'.generate_tanggal($h->tgl_bergabung).'</td>
								</tr>
							  </table>
						</div>
						<div class="tab-pane" id="tab2">
						<div>
						  '.$this->generate_indexs_iklan_member($id_param,$limit,$offset).'
						</div>
						</div>
					  </div>
					</div>
						</div>';
		}
		$hasil .= '<div class="cleaner_h20"></div>';
		$hasil .= $this->pagination->create_links();
		return $hasil;
	}
	 
	public function generate_indexs_iklan_member($id_param,$limit,$offset)
	{
		$hasil = "";

		$page=$offset;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		
		$where['id_member'] = $id_param;
		$tot_hal = $this->db->get_where("dlmbg_iklan",$where);
		$config['base_url'] = base_url() . 'web/iklan/member/'.$id_param.'/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 5;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);
		
		$w = $this->db->query("SELECT a.id_iklan, a.judul_iklan, c.kategori, b.lokasi, a.harga, a.tanggal, a.kondisi, a .tipe, (select x.gambar from dlmbg_gambar_iklan x 
		where x.id_iklan=a.id_iklan order by RAND() LIMIT 1) as gambar_thumb FROM dlmbg_iklan a left join dlmbg_lokasi b on a.id_lokasi=b.id_lokasi left join dlmbg_kategori c on 
		a.id_kategori=c.id_kategori where a.id_member='".$id_param."' order by id_iklan DESC LIMIT ".$offset.",".$limit."");
		$i = 0;
		foreach($w->result() as $h)
		{	
			$gbr = "no-image.jpg";
			if($h->gambar_thumb!="")
			{
				$gbr = $h->gambar_thumb;
			}
			if($i==0)
			{
				$hasil .= '</div>';
				$hasil .= '<div class="cleaner_h20"></div>';
				$hasil .= '<div class="row-fluid product_listing">';
			}
			$hasil .= '<div class="span3">
						<div class="item">
							<a href="'.base_url().'web/iklan/get/'.$h->id_iklan.'/'.url_title($h->judul_iklan,'-',TRUE).'"><img class="img" src="'.base_url().'asset/images/iklan/thumb/'.$gbr.'" alt="'.$h->judul_iklan.'" title="'.$h->judul_iklan.'"></a>
							<a href="'.base_url().'web/iklan/get/'.$h->id_iklan.'/'.url_title($h->judul_iklan,'-',TRUE).'" class="title">'.$h->judul_iklan.'</a>
							<p>Rp. '.number_format($h->harga,2,',','.').'</p>
							Lokasi : <strong>'.$h->lokasi.'</strong><br>Kategori : <strong>'.$h->kategori.'</strong>
							<p><span class="label label-warning">Jenis : '.$h->kondisi.'</span> <span class="label label-important">'.$h->tipe.'</span></p>
						</div>
					</div>';
			$i++;
			if($i>3)
			{
				$i=0;
			}
		}
		$hasil .= '<div class="cleaner_h20"></div>';
		$hasil .= $this->pagination->create_links();
		return $hasil;
	}
	 
	public function generate_indexs_member($limit,$offset)
	{
		$hasil = "";

		$page=$offset;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		
		$tot_hal = $this->db->get("dlmbg_member");
		$config['base_url'] = base_url() . 'web/member/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);
		
		$w = $this->db->get("dlmbg_member",$limit,$offset);
		$i = 0;
		foreach($w->result() as $h)
		{	
			$gbr = "no-image.png";
			if($h->gambar!="")
			{
				$gbr = $h->gambar;
			}
			$hasil .= '<div class="main_content">
						<div class="container-fluid">
							<div class="row-fluid product_listing">
							<h3 class="title"><i class="icon-user"></i> '.$h->nama.' - '.$h->email.'</h3>
							  <div class="span2">
							  <a href="'.base_url().'web/member/get/'.$h->id_member.'/'.url_title($h->nama,'-',TRUE).'">
							  <img src="'.base_url().'asset/images/member/thumb/'.$gbr.'"  class="img" width="70">
							  </a>
							  </div>
							  <div class="span8">
								  <table>
									<tr>
										<td width="100">Alamat</td><td>:</td><td>'.$h->alamat.'</td>
									</tr>
									<tr>
										<td>No.Telpon / HP</td><td>:</td><td>'.$h->no_telpon.' / '.$h->no_hp.'</td>
									</tr>
									<tr>
										<td>Jenis Kelamin</td><td>:</td><td>'.$h->jk.'</td>
									</tr>
									<tr>
										<td>Bergabung</td><td>:</td><td>'.generate_tanggal($h->tgl_bergabung).'</td>
									</tr>
								  </table>
							  </div>
							</div>
						</div>
					</div>';
			$i++;
			if($i>3)
			{
				$i=0;
			}
		}
		$hasil .= '<div class="cleaner_h20"></div>';
		$hasil .= $this->pagination->create_links();
		return $hasil;
	}
	
	public function generate_combo_lokasi_iklan($id_param="")
	{
		$hasil = "";
		$w = $this->db->get("dlmbg_lokasi");
		
		$hasil .= '<select name="id_lokasi">';
		$hasil .= '<option value="" selected="selected">Semua Lokasi</option>';
		foreach($w->result() as $h)
		{		
			if($id_param==$h->id_lokasi)
			{
				$hasil .= '<option value="'.$h->id_lokasi.'" selected="selected">'.$h->lokasi.'</option>';	
			}
			else
			{
				$hasil .= '<option value="'.$h->id_lokasi.'">'.$h->lokasi.'</option>';	
			}	
		}
		$hasil .= '</select>';
		return $hasil;
	}
	 
	public function generate_combo_kategori_iklan($id_param="")
	{
		$hasil = "";
		$w = $this->db->get("dlmbg_kategori");
		
		$hasil .= '<select name="id_kategori">';
		$hasil .= '<option value="" selected="selected">Semua Kategori</option>';
		foreach($w->result() as $h)
		{		
			if($id_param==$h->id_kategori)
			{
				$hasil .= '<option value="'.$h->id_kategori.'" selected="selected">'.$h->kategori.'</option>';	
			}
			else
			{
				$hasil .= '<option value="'.$h->id_kategori.'">'.$h->kategori.'</option>';	
			}	
		}
		$hasil .= '</select>';
		return $hasil;
	}
	 
	public function generate_gambar_edit_iklan($id_param)
	{
		$hasil = "";
		
		$where['id_iklan'] = $id_param;
		
		$w = $this->db->get_where("dlmbg_gambar_iklan",$where);
		$i = 0;
		foreach($w->result() as $h)
		{	
			if($i==0)
			{
				$hasil .= '</div>';
				$hasil .= '<div class="cleaner_h20"></div>';
				$hasil .= '<div class="row-fluid product_listing">';
			}
			$hasil .= '<div class="span3">
						<div class="item">
							<img class="img" src="'.base_url().'asset/images/iklan/thumb/'.$h->gambar.'">
							<a href="'.base_url().'user/iklan/hapus_gambar/'.$id_param.'/'.$h->id_gambar_iklan.'/'.$h->gambar.'"><span class="label label-important">Hapus</label></a>
						</div>
					</div>';
			$i++;
			if($i>3)
			{
				$i=0;
			}
		}
		return $hasil;
	}
	 
	public function generate_indexs_iklan_member_edit($id_param,$limit,$offset)
	{
		$hasil = "";

		$page=$offset;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		
		$where['id_member'] = $id_param;
		$tot_hal = $this->db->get_where("dlmbg_iklan",$where);
		$config['base_url'] = base_url() . 'web/iklan/member/'.$id_param.'/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 5;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);
		
		$w = $this->db->query("SELECT a.id_iklan, a.judul_iklan, c.kategori, b.lokasi, a.harga, a.tanggal, a.rentang_harga, a.kondisi, a .tipe, (select x.gambar from dlmbg_gambar_iklan x 
		where x.id_iklan=a.id_iklan order by RAND() LIMIT 1) as gambar_thumb FROM dlmbg_iklan a left join dlmbg_lokasi b on a.id_lokasi=b.id_lokasi left join dlmbg_kategori c on 
		a.id_kategori=c.id_kategori where a.id_member='".$id_param."' order by id_iklan DESC LIMIT ".$offset.",".$limit."");
		$i = 0;
		foreach($w->result() as $h)
		{	
			$gbr = "no-image.jpg";
			if($h->gambar_thumb!="")
			{
				$gbr = $h->gambar_thumb;
			}
			if($i==0)
			{
				$hasil .= '</div>';
				$hasil .= '<div class="cleaner_h20"></div>';
				$hasil .= '<div class="row-fluid product_listing">';
			}
			$hasil .= '<div class="span3">
						<div class="item">
						<p>
						<a href="'.base_url().'user/iklan/edit/'.$h->id_iklan.'"><span class="label label-success">Edit</span> </a>
						<a href="'.base_url().'user/iklan/hapus/'.$h->id_iklan.'"><span class="label label-info">Hapus</span></a>
						</p>
							<a href="'.base_url().'web/iklan/get/'.$h->id_iklan.'/'.url_title($h->judul_iklan,'-',TRUE).'"><img class="img" src="'.base_url().'asset/images/iklan/thumb/'.$gbr.'" alt="'.$h->judul_iklan.'" title="'.$h->judul_iklan.'"></a>
							<a href="'.base_url().'web/iklan/get/'.$h->id_iklan.'/'.url_title($h->judul_iklan,'-',TRUE).'" class="title">'.$h->judul_iklan.'</a>
							<p>Rp. '.number_format($h->harga,2,',','.').'</p>
							<p>Rentang Harga : '.$h->rentang_harga.'</p>
							Lokasi : <strong>'.$h->lokasi.'</strong><br>Kategori : <strong>'.$h->kategori.'</strong>
							<p><span class="label label-warning">Jenis : '.$h->kondisi.'</span> <span class="label label-important">'.$h->tipe.'</span></p>
						</div>
					</div>';
			$i++;
			if($i>3)
			{
				$i=0;
			}
		}
		$hasil .= '<div class="cleaner_h20"></div>';
		$hasil .= $this->pagination->create_links();
		return $hasil;
	}
	
}

/* End of file app_global_web_model.php */