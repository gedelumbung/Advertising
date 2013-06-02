<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app_global_superadmin_model extends CI_Model {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 **/

	public function generate_menu($parent=0,$hasil)
	{
		$url = "routing_pages";
		
		$where['id_parent']=$parent;
		$w = $this->db->get_where("dlmbg_menu",$where);
		$w_q = $this->db->get_where("dlmbg_menu",$where)->row();
		if(($w->num_rows())>0)
		{
			$hasil .= "<table class='table table-striped table-condensed'>
					<thead>
					<tr>
					<th width='110' colspan='8'></th>
					</tr>
					</thead>";
		}
		foreach($w->result() as $h)
		{
			$where_sub['id_parent']=$h->id_menu;
			$w_sub = $this->db->get_where("dlmbg_menu",$where_sub);
			if(($w_sub->num_rows())>0)
			{
				$hasil .= "<tr><td>".$h->menu." </td><td><a href='".base_url()."superadmin/".$url."/edit/".$h->id_menu."' class='btn btn-small'><i class='icon-edit'></i> Edit</a><a href='".base_url()."superadmin/".$url."/hapus/".$h->id_menu."' class='btn btn-small' onClick=\"return confirm('Are you sure?');\" ><i class='icon-trash'></i> Hapus</a>";
			}
			else
			{
				if($h->id_parent==0)
				{
				$hasil .= "<tr><td>".$h->menu." </td><td><a href='".base_url()."superadmin/".$url."/edit/".$h->id_menu."' class='btn btn-small'><i class='icon-edit'></i> Edit</a><a href='".base_url()."superadmin/".$url."/hapus/".$h->id_menu."' class='btn btn-small' onClick=\"return confirm('Are you sure?');\" ><i class='icon-trash'></i> Hapus</a>";
				}
				else
				{
				$hasil .= "<tr><td width='250'>&raquo; ".$h->menu." </td><td><a href='".base_url()."superadmin/".$url."/edit/".$h->id_menu."' class='btn btn-small'><i class='icon-edit'></i> Edit</a><a href='".base_url()."superadmin/".$url."/hapus/".$h->id_menu."' class='btn btn-small' onClick=\"return confirm('Are you sure?');\" ><i class='icon-trash'></i> Hapus</a>";
				}
			}
			$hasil = $this->generate_menu($h->id_menu,$hasil);
			$hasil .= "</td></tr>";
		}
		if(($w->num_rows)>0)
		{
			$hasil .= "</table>";
		}
		return $hasil;
	}
	 
	public function generate_index_user($limit,$offset,$filter=array())
	{
		$hasil="";
		$tot_hal = $this->db->like('nama',$filter['nama_user'])->get("dlmbg_admin");

		$config['base_url'] = base_url() . 'superadmin/admin_dinas/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);

		$w = $this->db->like('nama',$filter['nama_user'])->get("dlmbg_admin",$limit,$offset);
		
		$hasil .= "<table class='table table-striped table-condensed'>
					<thead>
					<tr>
					<th>No.</th>
					<th>Superadmin Name</th>
					<th>Username</th>
					<th width='110'><a href='".base_url()."superadmin/user/tambah' class='btn btn'><i class='icon-plus'></i> Add New</a></th>
					</tr>
					</thead>";
		$i = $offset+1;
		foreach($w->result() as $h)
		{
			$hasil .= "<tr>
					<td>".$i."</td>
					<td>".$h->nama."</td>
					<td>".$h->username."</td>
					<td>";
			$hasil .= "<a href='".base_url()."superadmin/user/edit/".$h->id_admin."' class='btn btn-small'><i class='icon-edit'></i></a>";
			$hasil .= "<a href='".base_url()."superadmin/user/hapus/".$h->id_admin."' onClick=\"return confirm('Are you sure?');\" class='btn btn-small'><i class='icon-trash'></i></a></td>
					</tr>";
			$i++;
		}
		$hasil .= '</table>';
		$hasil .= '<div class="cleaner_h20"></div>';
		$hasil .= $this->pagination->create_links();
		return $hasil;
	}
	 
	public function generate_index_sistem($limit,$offset)
	{
		$hasil="";
		$tot_hal = $this->db->get("dlmbg_setting");

		$config['base_url'] = base_url() . 'superadmin/sistem/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);

		$w = $this->db->get("dlmbg_setting",$limit,$offset);
		
		$hasil .= "<table class='table table-striped table-condensed'>
					<thead>
					<tr>
					<th>No.</th>
					<th>Setting System</th>
					<th>Type</th>
					<th></th>
					</tr>
					</thead>";
		$i = $offset+1;
		foreach($w->result() as $h)
		{
			$hasil .= "<tr>
					<td>".$i."</td>
					<td>".$h->title."</td>
					<td>".$h->tipe."</td>
					<td>";
			$hasil .= "<a href='".base_url()."superadmin/sistem/edit/".$h->id_setting."' class='btn'><i class='icon-edit'></i> Edit</a></td>
					</tr>";
			$i++;
		}
		$hasil .= '</table>';
		$hasil .= '<div class="cleaner_h20"></div>';
		$hasil .= $this->pagination->create_links();
		return $hasil;
	}

	public function generate_indexs_kategori($limit,$offset)
	{
		$w = $this->db->order_by("id_kategori","DESC")->get("dlmbg_kategori",$limit,$offset);
		$hasil ="";
		$tot_hal = $this->db->get("dlmbg_setting");

		$config['base_url'] = base_url() . 'superadmin/kategori/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);
		$hasil .= "<table class='table table-striped table-condensed'>
					<thead>
					<tr>
					<th>No.</th>
					<th>Kategori</th>
					<th></th>
					</tr>
					</thead>";
		$no=$offset+1;
		foreach($w->result() as $h)
		{	
			$hasil .= "<tr>";
			$hasil .= "<td>".$no."</td>";
			$hasil .= "<td>".$h->kategori."</td>";
			$hasil .= "<td><a href='".base_url()."superadmin/kategori/edit/".$h->id_kategori."' class='btn'>Edit</a><a href='".base_url()."superadmin/kategori/hapus/".$h->id_kategori."' class='btn' onClick=\"return confirm('Are you sure?');\">Hapus</a></td>";
			$hasil .= "</tr>";
			$no++;
		}
		$hasil .= "</table>";
		$hasil .= '<div class="cleaner_h20"></div>';
		$hasil .= $this->pagination->create_links();
		return $hasil;
	}

	public function generate_indexs_lokasi($limit,$offset)
	{
		$w = $this->db->order_by("id_lokasi","DESC")->get("dlmbg_lokasi",$limit,$offset);
		$hasil ="";
		$tot_hal = $this->db->get("dlmbg_lokasi");

		$config['base_url'] = base_url() . 'superadmin/lokasi/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);
		$hasil .= "<table class='table table-striped table-condensed'>
					<thead>
					<tr>
					<th>No.</th>
					<th>Lokasi</th>
					<th></th>
					</tr>
					</thead>";
		$no=$offset+1;
		foreach($w->result() as $h)
		{	
			$hasil .= "<tr>";
			$hasil .= "<td>".$no."</td>";
			$hasil .= "<td>".$h->lokasi."</td>";
			$hasil .= "<td><a href='".base_url()."superadmin/lokasi/edit/".$h->id_lokasi."' class='btn'>Edit</a><a href='".base_url()."superadmin/lokasi/hapus/".$h->id_lokasi."' class='btn' onClick=\"return confirm('Are you sure?');\">Hapus</a></td>";
			$hasil .= "</tr>";
			$no++;
		}
		$hasil .= "</table>";
		$hasil .= '<div class="cleaner_h20"></div>';
		$hasil .= $this->pagination->create_links();
		return $hasil;
	}

	public function generate_indexs_member($limit,$offset)
	{
		$w = $this->db->order_by("id_member","DESC")->get("dlmbg_member",$limit,$offset);
		$hasil ="";
		$tot_hal = $this->db->get("dlmbg_member");

		$config['base_url'] = base_url() . 'superadmin/member/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);
		$hasil .= "<table class='table table-striped table-condensed'>
					<thead>
					<tr>
					<th>No.</th>
					<th>Nama</th>
					<th>Status</th>
					<th></th>
					</tr>
					</thead>";
		$no=$offset+1;
		foreach($w->result() as $h)
		{	
			$status = "Tidak Aktif";
			$teks = "Aktifkan";
			$param = "1";
			if($h->stts==1){$status="Aktif"; $teks = "NonAktifkan"; $param=0;}
			
			$hasil .= "<tr>";
			$hasil .= "<td>".$no."</td>";
			$hasil .= "<td><a href='".base_url()."web/member/get/".$h->id_member."' target='_blank'>".$h->nama."</a></td>";
			$hasil .= "<td>".$status."</td>";
			$hasil .= "<td><a href='".base_url()."superadmin/member/set/".$h->id_member."/".$param."' class='btn'>".$teks."</a><a href='".base_url()."superadmin/member/hapus/".$h->id_member."' class='btn' onClick=\"return confirm('Are you sure?');\">Hapus</a></td>";
			$hasil .= "</tr>";
			$no++;
		}
		$hasil .= "</table>";
		$hasil .= '<div class="cleaner_h20"></div>';
		$hasil .= $this->pagination->create_links();
		return $hasil;
	}

	public function generate_indexs_pesan($limit,$offset)
	{
		$w = $this->db->query("select b.id_member, b.nama from dlmbg_pesan_admin a left join dlmbg_member b on a.id_pengirim=b.id_member group by id_pengirim LIMIT ".$offset.",".$limit."");
		$hasil ="";
		$tot_hal = $this->db->query("select b.id_member, b.nama from dlmbg_pesan_admin a left join dlmbg_member b on a.id_pengirim=b.id_member group by id_pengirim");

		$config['base_url'] = base_url() . 'superadmin/pesan/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);
		$hasil .= "<table class='table table-striped table-condensed'>
					<thead>
					<tr>
					<th>No.</th>
					<th>Nama</th>
					<th></th>
					</tr>
					</thead>";
		$no=$offset+1;
		foreach($w->result() as $h)
		{	
			$hasil .= "<tr>";
			$hasil .= "<td>".$no."</td>";
			$hasil .= "<td>".$h->nama."</td>";
			$hasil .= "<td><a href='".base_url()."superadmin/pesan/detail/".$h->id_member."' class='btn'>Lihat Pesan</a></td>";
			$hasil .= "</tr>";
			$no++;
		}
		$hasil .= "</table>";
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
		$config['base_url'] = base_url() . 'superadmin/pesan/detail/'.$id_param.'/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 5;
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

	public function generate_indexs_artikel($limit,$offset)
	{
		$w = $this->db->order_by("id_artikel","DESC")->get("dlmbg_artikel",$limit,$offset);
		$hasil ="";
		$tot_hal = $this->db->get("dlmbg_artikel");

		$config['base_url'] = base_url() . 'superadmin/artikel/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);
		$hasil .= "<table class='table table-striped table-condensed'>
					<thead>
					<tr>
					<th>No.</th>
					<th>Judul</th>
					<th>Tanggal</th>
					<th>Dibaca</th>
					<th></th>
					</tr>
					</thead>";
		$no=$offset+1;
		foreach($w->result() as $h)
		{	
			$hasil .= "<tr>";
			$hasil .= "<td>".$no."</td>";
			$hasil .= "<td>".$h->judul."</td>";
			$hasil .= "<td>".generate_tanggal($h->tanggal)."</td>";
			$hasil .= "<td>".$h->counter."</td>";
			$hasil .= "<td><a href='".base_url()."superadmin/artikel/edit/".$h->id_artikel."' class='btn'>Edit</a><a href='".base_url()."superadmin/artikel/hapus/".$h->id_artikel."' class='btn' onClick=\"return confirm('Are you sure?');\">Hapus</a></td>";
			$hasil .= "</tr>";
			$no++;
		}
		$hasil .= "</table>";
		$hasil .= '<div class="cleaner_h20"></div>';
		$hasil .= $this->pagination->create_links();
		return $hasil;
	}

	public function generate_indexs_iklan($limit,$offset,$fill)
	{
		$hasil = "";

		$page=$offset;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		
		$filter['st'] = "";
		$set_fill = "";
		if($fill==2)
		{
			$set_fill = "";
			$filter['st'] = "";
		}
		else
		{
			$set_fill = "where a.st='".$fill."'";
			$filter['st'] = $fill;
		}
		
		$tot_hal = $this->db->get_where("dlmbg_iklan",$filter);
		$config['base_url'] = base_url() . 'superadmin/iklan/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);
		
		$w = $this->db->query("SELECT a.id_iklan, a.st, a.judul_iklan, a.id_member, c.kategori, b.lokasi, a.harga, a.tanggal, a.kondisi, a .tipe, (select x.gambar from 
		dlmbg_gambar_iklan x where x.id_iklan=a.id_iklan order by RAND() LIMIT 1) as gambar_thumb FROM dlmbg_iklan a left join dlmbg_lokasi b on 
		a.id_lokasi=b.id_lokasi left join dlmbg_kategori c on a.id_kategori=c.id_kategori ".$set_fill." order by id_iklan DESC LIMIT ".$offset.",".$limit."");
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
			$approve = "Approve";
			$upd_approve = "1";
			if($h->st==1)
			{
				$approve = "Unapprove";
				$upd_approve = "0";
			}
			
			$hasil .= '<div class="span3">
						<div class="item">
							<p>
								<a href="'.base_url().'superadmin/pesan/detail/'.$h->id_member.'" class="btn btn-small">Kirim Pesan</a>
								<a href="'.base_url().'superadmin/iklan/hapus/'.$h->id_iklan.'" class="btn btn-small" onClick=\'return confirm("Are you sure?");\'>Hapus</a>
								<a href="'.base_url().'superadmin/iklan/approve/'.$h->id_iklan.'/'.$upd_approve.'" class="btn btn-warning btn-small">'.$approve.'</a>
							</p>
							<a href="'.base_url().'web/iklan/get/'.$h->id_iklan.'/'.url_title($h->judul_iklan,'-',TRUE).'" target="_blank"><img class="img" src="'.base_url().'asset/images/iklan/thumb/'.$gbr.'" alt="'.$h->judul_iklan.'" title="'.$h->judul_iklan.'"></a>
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
}
