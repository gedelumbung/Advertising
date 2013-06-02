<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app_user_web_model extends CI_Model {

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
							<span class="pull-right"><a href="'.base_url().'user/pesan_admin/">KIRIM PESAN KE ADMIN</a>  
							<span class="label label-warning">PRIVATE MESSAGE</span></span></h3>
						  <div class="span3">
						  <a href="'.base_url().'web/member/get/'.$h->id_member.'/'.url_title($h->nama,'-',TRUE).'">
						  <img src="'.base_url().'asset/images/member/thumb/'.$gbr.'"  class="img" width="150">
						  </a>
						  </div>
						  <div class="span7">
						  	<div class="btn-group">
							  <a class="btn btn-info btn-small" href="'.base_url().'user/iklan/tambah"><i class="icon-comment icon-white"></i> Tambah Iklan</a>
							  <a class="btn btn-info btn-small" href="'.base_url().'user/iklan"><i class="icon-star icon-white"></i> Manajemen Iklan</a>
							  <a class="btn btn-info btn-small" href="'.base_url().'user/inbox"><i class="icon-envelope icon-white"></i> Inbox</a>
							  <a class="btn btn-info btn-small" href="'.base_url().'user/password"><i class="icon-refresh icon-white"></i> Password</a>
							  <a class="btn btn-info btn-small" href="'.base_url().'user/profile"><i class="icon-user icon-white"></i> Profile</a>
							</div>	
						  <div class="cleaner_h20"></div>
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
						  <div class="cleaner_h20"></div>
					</div>';
		}
		$hasil .= '<div class="cleaner_h20"></div>';
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
							<p>
								<span class="label label-warning">Edit</span> 
								<span class="label label-important">Hapus</span>
							</p>
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
	 
	public function generate_indexs_pesan($id_param,$limit,$offset)
	{
		$hasil = "";

		$page=$offset;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		
		$where['id_member'] = $id_param;
		$tot_hal = $this->db->query("select * from dlmbg_pesan where id_penerima='".$id_param."' group by id_sampul");
		$config['base_url'] = base_url() . 'web/iklan/member/'.$id_param.'/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 5;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);
		
		$w = $this->db->query("select * from  (SELECT c.id_sampul,c.id_penerima,c.id_pengirim,c.stts,  (select max(id_pesan) from dlmbg_pesan a where a.id_sampul=c.id_sampul ) as max_id from dlmbg_pesan c group by c.id_sampul) x left join (select i.id_pesan,i.waktu,j.email,j.nama,i.isi,j.gambar from dlmbg_pesan i left join (select v.email,v.nama,v.id_member,v.gambar from dlmbg_member v) j on i.id_pengirim=j.id_member)  y on x.max_id =y.id_pesan where id_penerima='".$id_param."' or id_pengirim='".$id_param."' order by waktu DESC  LIMIT ".$offset.",".$limit."");
		$i = 0;
		foreach($w->result() as $h)
		{	
			$gbr = "no-image.png";
			if($h->gambar!="")
			{
				$gbr = $h->gambar;
			}
			$warna = "";
			$status = "Sudah Terbaca";
			if($h->stts=='N'){ $warna = "#D4E5A1"; $status="Belum Terbaca"; }
			$hasil .= '<table width="100%" border="0" cellspacing="0" cellpadding="10" bgcolor="#ECF5CF">
				<tr bgcolor="'.$warna.'">
				  <td width="520">
				  <div class="border-photo-profil2" style="float:left; margin-right:10px;"><div class="hide-photo-profil-medium2"><img src="'.base_url().'asset/images/member/thumb/'.$gbr.'" width="60" /></div></div>
				  <span class="date-txt2">'.generate_tanggal($h->waktu).' - ';
				  
				  if($h->id_penerima!=$this->session->userdata('id_member'))
				  {
				  	$hasil .= 'dari : '.$h->nama.' - '.$h->email.'</span>';
				  }
				  else if($h->id_pengirim!=$this->session->userdata('id_member'))
				  {
				  	$hasil .= 'oleh : '.$h->nama.' - '.$h->email.'';
				  }
					
				  $hasil .= '<br />
				  <strong><span class="h2-black"><a href="'.base_url().'user/inbox/detail_pesan/'.$h->id_sampul.'" 
				  title="Baca Pesan :';
				  if($h->id_penerima!=$this->session->userdata('id_member'))
				  { $hasil .= 'ke : '.$h->nama.' - '.$h->email; } 
				  else { $hasil .= 'untuk : '.$h->nama.' - '.$h->email; } 
				  $hasil .= 'Status Pesan : '.$status.'">'.strip_tags(substr($h->isi,0,80)).'</a></span></strong>
				  <div class="cleaner_h0"></div>
				  </td>
				  <td align="right"><span class="date-txt3">'.relativeTime($h->waktu).'&nbsp;&nbsp;</span></td>
				</tr>
				<tr>
      		</table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ECF5CF">
				<td>
            		<div class="line-grey"></div>
				</td>
				</tr>
			</table>';
		}
		$hasil .= '<div class="cleaner_h20"></div>';
		$hasil .= $this->pagination->create_links();
		return $hasil;
	}
	 
	public function generate_indexs_pesan_admin($id_param,$limit,$offset)
	{
		$hasil = "";

		$page=$offset;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		
		$where['id_member'] = $id_param;
		$tot_hal = $this->db->query("select * from dlmbg_pesan_admin a left join dlmbg_member b on a.id_pengirim=b.id_member where a.id_pengirim='".$id_param."' order by waktu DESC");
		$config['base_url'] = base_url() . 'user/pesan_admin/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);
		
		$w = $this->db->query("select * from dlmbg_pesan_admin a left join dlmbg_member b on a.id_pengirim=b.id_member where a.id_pengirim='".$id_param."' order by waktu DESC LIMIT ".$offset.",".$limit."");
		$i = 0;
		foreach($w->result() as $h)
		{	
			$gbr = "no-image.png";
			$nama = "Administrator";
			if($h->gambar!="")
			{
				if($h->admin==1)
				{
					$gbr = "admin.jpg";
					$nama = "Administrator";
				}
				else
				{
					$gbr = $h->gambar;
					$nama = $h->nama;
				}
			}
			else
			{
				if($h->admin==1)
				{
					$gbr = "admin.jpg";
					$nama = "Administrator";
				}
				else
				{
					$gbr = "no-image.png";
					$nama = $h->nama;
				}
			}
			$hasil .= '<table width="100%" border="0" cellspacing="0" cellpadding="10" bgcolor="#ECF5CF">
				<tr>
				  <td width="520">
				  <div class="border-photo-profil2" style="float:left; margin-right:10px;"><div class="hide-photo-profil-medium2"><img src="'.base_url().'asset/images/member/thumb/'.$gbr.'" width="60" /></div></div>
				  <span class="date-txt2">'.generate_tanggal($h->waktu).' - '.$nama;
				  $hasil .= '<br />
				  <strong><span class="h2-black">'.strip_tags($h->isi).'</span></strong>
				  <div class="cleaner_h0"></div>
				  </td>
				  <td align="right"><span class="date-txt3">'.relativeTime($h->waktu).'&nbsp;&nbsp;</span></td>
				</tr>
				<tr>
      		</table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ECF5CF">
				<td>
            		<div class="line-grey"></div>
				</td>
				</tr>
			</table>';
		}
		$hasil .= '<div class="cleaner_h20"></div>';
		$hasil .= $this->pagination->create_links();
		return $hasil;
	}
	 
	public function generate_detail_pesan($id_param,$limit,$offset)
	{
		$hasil = "";

		$page=$offset;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		
		$where['id_member'] = $id_param;
		$tot_hal = $this->db->query("select * from dlmbg_pesan where id_sampul='".$id_param."'");
		$config['base_url'] = base_url() . 'user/inbox/detail_pesan/'.$id_param.'/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 5;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);
		
		$w = $this->db->query("SELECT b.id_member,a.id_sampul,b.email,a.isi,a.id_penerima,a.id_pengirim,a.waktu,b.nama,b.gambar from dlmbg_pesan as a left join (select nama,email,x.id_member,gambar from dlmbg_member as x) as b on a.id_pengirim=b.id_member where id_sampul='".$id_param."' order by waktu DESC LIMIT ".$offset.",".$limit."");
		
		$w_get = $w->row();
		$id_penerima =  $w_get->id_penerima;
		if($w_get->id_penerima==$this->session->userdata("id_member"))
		{
			$id_penerima = $w_get->id_pengirim;
		}
		
		$hasil .='<div id="form_balas" style="display:none;">
							'.form_open("user/inbox/kirim").'
							<table  width="700" bgcolor="#ECF5CF" cellspacing="0" border="0" cellpadding="10">
							<tr>
							<td>
							<textarea id="keterangan" cols="10" name="isi"></textarea>
							</td>
							</tr>
							<tr>
								<td>
								<input type="submit" value="KIRIM PESAN" class="btn btn-primary" />
								<input type="hidden" name="id_sampul" value="'.$id_param.'" />
								<input type="hidden" name="id_penerima" value="'.$id_penerima.'" />
								</td>
							</tr>
							</table>
							'.form_close().'
						</div>';
		foreach($w->result() as $h)
		{	
			$gbr = "no-image.png";
			if($h->gambar!="")
			{
				$gbr = $h->gambar;
			}
			
			$hasil .='<table width="100%" border="0" cellspacing="0" cellpadding="10" bgcolor="#ECF5CF">
				<tr valign="top">
				  <td class="LeftBg">
				  <div class="border-photo-profil2" style="float:left; margin-right:10px;">
				  <div class="hide-photo-profil-medium2"><img src="'.base_url().'asset/images/member/thumb/'.$gbr.'" width="60" /></div></td>
				  <td width="640">
				   <strong><a href="'.base_url().'web/member/get/'.$h->id_pengirim.'">'.$h->nama.'</a></strong> | <span class="date-txt2">'.generate_tanggal($h->waktu).'</span>
				 '.$h->isi.'
				  <div class="cleaner_h0"></div>
				  </td>
				</tr>
				<tr>
      		</table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ECF5CF">
				<td>
            		<div class="line-grey"></div>
				</td>
				</tr>
			</table>';
		}
		$hasil .= '<div class="cleaner_h20"></div>';
		$hasil .= $this->pagination->create_links();
		return $hasil;
	}
	
	function cek_history_pesan($id_penerima,$id_pengirim)
	{
		$q = $this->db->query("select * from dlmbg_pesan where id_penerima='".$id_penerima."' and id_pengirim='".$id_pengirim."'");
		return $q;
	}
	
	
}

/* End of file app_user_web_model.php */