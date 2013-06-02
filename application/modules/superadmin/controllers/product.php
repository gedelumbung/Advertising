<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class product extends MX_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 **/
 
   public function index($uri=0)
   {
		if($this->session->userdata("logged_in_admin")!="")
		{
			$this->breadcrumb->append_crumb('Dashboard', base_url().'superadmin');
			$this->breadcrumb->append_crumb("Product", '/');
			
			$d['aktif_slide_banner'] = "";
			$d['aktif_category'] = "";
			$d['aktif_product'] = "active";
			
			$d['combo_kategori'] = $this->app_global_superadmin_model->generate_combo_category();
			
			$filter['nama_produk'] = $this->session->userdata("search_nama_produk");
			$filter['id_menu'] = $this->session->userdata("search_id_menu");
			$d['data_retrieve'] = $this->app_global_superadmin_model->generate_index_product($filter,$this->config->item("limit_item_medium"),$uri);
			
			$this->load->view('bg_header',$d);
			$this->load->view('product/bg_home');
			$this->load->view('bg_footer');
		}
		else
		{
			redirect("auth/user_login");
		}
   }
 
   public function tambah()
   {
		if($this->session->userdata("logged_in_admin")!="")
		{
			$this->breadcrumb->append_crumb('Dashboard', base_url().'superadmin');
			$this->breadcrumb->append_crumb("Product", base_url().'superadmin/product');
			$this->breadcrumb->append_crumb("Add Product", '/');
			
			$d['aktif_slide_banner'] = "";
			$d['aktif_category'] = "";
			$d['aktif_product'] = "active";
			
			$where['jenis'] = "kategori";
			$d['menu_list'] = $this->db->get_where("dlmbg_menu",$where);
			
			$d['id_param'] = "";
			$d['id_menu'] = "";
			$d['nama_produk'] = "";
			$d['keterangan'] = "";
			
			$d['gambar'] = "";
			
			$d['id_param'] = "";
			$d['tipe'] = "tambah";
			
			$this->load->view('bg_header',$d);
			$this->load->view('product/bg_input');
			$this->load->view('bg_footer');
		}
		else
		{
			redirect("auth/user_login");
		}
   }
 
   public function edit($id_param)
   {
		if($this->session->userdata("logged_in_admin")!="")
		{
			$this->breadcrumb->append_crumb('Dashboard', base_url().'superadmin');
			$this->breadcrumb->append_crumb("Product", base_url().'superadmin/product');
			$this->breadcrumb->append_crumb("Edit Product", '/');
			
			$d['aktif_slide_banner'] = "";
			$d['aktif_category'] = "";
			$d['aktif_product'] = "active";
			
			$where['jenis'] = "kategori";
			$d['menu_list'] = $this->db->get_where("dlmbg_menu",$where);
			
			$where_get['id_produk'] = $id_param;
			$get = $this->db->get_where("dlmbg_produk",$where_get)->row();
			
			$d['id_param'] = $get->id_produk;
			$d['id_menu'] = $get->id_menu;
			$d['nama_produk'] = $get->nama_produk;
			$d['keterangan'] = $get->keterangan;
			
			$d['list_gambar'] = $this->app_global_superadmin_model->generate_index_list_gambar($get->id_produk);
			
			$d['tipe'] = "edit";
			
			$this->load->view('bg_header',$d);
			$this->load->view('product/bg_input');
			$this->load->view('bg_footer');
		}
		else
		{
			redirect("auth/user_login");
		}
   }
 
   public function simpan()
   {
		if($this->session->userdata("logged_in_admin")!="")
		{
			$tipe = $this->input->post("tipe");
			$id['id_produk'] = $this->input->post("id_param");
			if($tipe=="tambah")
			{
				$in['id_menu'] = $this->input->post("id_menu");
				$in['nama_produk'] = $this->input->post("nama_produk");
				$in['keterangan'] = $this->input->post("keterangan");
				
				$this->db->insert("dlmbg_produk",$in);
				$id_in = mysql_insert_id();
				redirect("superadmin/product/edit/".$id_in."");
			}
			else if($tipe=="edit")
			{	
				$in['id_menu'] = $this->input->post("id_menu");
				$in['nama_produk'] = $this->input->post("nama_produk");
				$in['keterangan'] = $this->input->post("keterangan");
				
				$this->db->update("dlmbg_produk",$in,$id);
				redirect("superadmin/product/edit/".$id['id_produk']."");
			}
		}
		else
		{
			redirect("auth/user_login");
		}
   }
 
	public function tambah_gambar()
	{
		if($this->session->userdata("logged_in_admin")!="")
		{
			$in['id_produk'] = $this->input->post("id_produk");
			
			$config['upload_path'] = './asset/produk/';
			$config['allowed_types']= 'gif|jpg|png|jpeg';
			$config['encrypt_name']	= TRUE;
			$config['remove_spaces']= TRUE;	
			$config['max_size']     = '2000';
			$config['max_width']  	= '2000';
			$config['max_height']  	= '2000';
	 
			$this->load->library('upload', $config);

			if ($this->upload->do_upload("userfile")) {
				$data	 	= $this->upload->data();
	 
				/* PATH */
				$source             = "./asset/produk/".$data['file_name'] ;
				$destination_thumb	= "./asset/produk/thumb/" ;
				$destination_medium	= "./asset/produk/medium/" ;
	 
				// Permission Configuration
				chmod($source, 0777) ;
	 
				/* Resizing Processing */
				// Configuration Of Image Manipulation :: Static
				$this->load->library('image_lib') ;
				$img['image_library'] = 'GD2';
				$img['create_thumb']  = TRUE;
				$img['maintain_ratio']= TRUE;
	 
				/// Limit Width Resize
				$limit_thumb    = 320 ;
				$limit_medium    = 660 ;
	 
				// Size Image Limit was using (LIMIT TOP)
				$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
	 
				// Percentase Resize
				if ($limit_use > $limit_thumb) {
					$percent_thumb  = $limit_thumb/$limit_use ;
				}
	 
				//// Making THUMBNAIL ///////
				$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
				$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;
	 
				// Configuration Of Image Manipulation :: Dynamic
				$img['thumb_marker'] = '';
				$img['quality']      = '80%' ;
				$img['source_image'] = $source ;
				$img['new_image']    = $destination_thumb ;
	 
				// Do Resizing
				$this->image_lib->initialize($img);
				$this->image_lib->resize();
				$this->image_lib->clear() ;
	 
				// Percentase Resize
				if ($limit_use > $limit_medium) {
					$percent_thumb2  = $limit_medium/$limit_use ;
				}
	 
				//// Making THUMBNAIL ///////
				$img['width']  = $limit_use > $limit_medium ?  $data['image_width'] * $percent_thumb2 : $data['image_width'] ;
				$img['height'] = $limit_use > $limit_medium ?  $data['image_height'] * $percent_thumb2 : $data['image_height'] ;
	 
				// Configuration Of Image Manipulation :: Dynamic
				$img['thumb_marker'] = '';
				$img['quality']      = '80%' ;
				$img['source_image'] = $source ;
				$img['new_image']    = $destination_medium ;
	 
				// Do Resizing
				$this->image_lib->initialize($img);
				$this->image_lib->resize();
				$this->image_lib->clear() ;
				
				$in['gambar'] = $data['file_name'];
				$this->db->insert("dlmbg_gambar_produk",$in);
				unlink($source);
				$this->session->set_flashdata('result', 'Berhasil menambah gambar');
				redirect("superadmin/product/edit/".$in['id_produk']."");
				
			}
			else 
			{
				echo $this->upload->display_errors('<p>','</p>');
			}
		}
		else
		{
			redirect("web");
		}
   }
 
	public function set()
	{
		if($this->session->userdata("logged_in_admin")!="")
		{
			$sess['search_id_menu'] = $this->input->post("id_menu");
			$sess['search_nama_produk'] = $this->input->post("by_nama");
			$this->session->set_userdata($sess);
			redirect("superadmin/product");
		}
		else
		{
			redirect("web");
		}
   }
 
	public function hapus($id_param)
	{
		if($this->session->userdata("logged_in_admin")!="")
		{
			$where['id_produk'] = $id_param;
			$this->db->delete("dlmbg_produk",$where);
			
			$get = $this->db->get_where("dlmbg_gambar_produk",$where);
			foreach($get->result() as $del)
			{
				unlink("./asset/produk/thumb/".$del->gambar."") ;
				unlink("./asset/produk/medium/".$del->gambar."") ;
				$this->db->delete("dlmbg_gambar_produk",$where);
			}
			
			redirect("superadmin/product");
		}
		else
		{
			redirect("web");
		}
   }
 
	public function hapus_gambar($id_param,$id_produk,$file)
	{
		if($this->session->userdata("logged_in_admin")!="")
		{
			unlink("./asset/produk/thumb/".$file."") ;
			unlink("./asset/produk/medium/".$file."") ;
			$where['id_gambar_produk'] = $id_param;
			$this->db->delete("dlmbg_gambar_produk",$where);
			redirect("superadmin/product/edit/".$id_produk."");
		}
		else
		{
			redirect("web");
		}
   }
}
 
/* End of file superadmin.php */
