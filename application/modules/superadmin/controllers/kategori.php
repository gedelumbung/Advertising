<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class kategori extends MX_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 **/
 
   public function index($uri=0)
   {
		if($this->session->userdata("logged_in_admin")!="")
		{
			$this->breadcrumb->append_crumb('Dashboard', base_url().'superadmin');
			$this->breadcrumb->append_crumb("Kategori", '/');
			
			$d['data_retrieve'] = $this->app_global_superadmin_model->generate_indexs_kategori($this->config->item("limit_item"),$uri);
			
			$this->load->view('bg_header',$d);
			$this->load->view('kategori/bg_home');
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
			$this->breadcrumb->append_crumb("kategori", base_url().'superadmin/kategori');
			$this->breadcrumb->append_crumb("Input kategori", '/');
			
			$d['kategori'] = "";
			$d['icon'] = "";
			$d['custom_fields'] = "";
			
			$d['id_param'] = "";
			$d['tipe'] = "tambah";
			
			$this->load->view('bg_header',$d);
			$this->load->view('kategori/bg_input');
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
			$this->breadcrumb->append_crumb("kategori", base_url().'superadmin/kategori');
			$this->breadcrumb->append_crumb("Update kategori", '/');
			
			$where['id_kategori'] = $id_param;
			$get = $this->db->get_where("dlmbg_kategori",$where)->row();
			
			$d['kategori'] = $get->kategori;
			$d['icon'] = $get->icon;
			$d['custom_fields'] = $get->custom_fields;
			
			$d['id_param'] = $get->id_kategori;
			$d['tipe'] = "edit";
			
			$this->load->view('bg_header',$d);
			$this->load->view('kategori/bg_input');
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
			$id['id_kategori'] = $this->input->post("id_param");
			if($tipe=="tambah")
			{
				$in['kategori'] = $this->input->post("kategori");
				$in['icon'] = $this->input->post("icon");
				$in['custom_fields'] = $this->input->post("custom_fields");
				
				$this->db->insert("dlmbg_kategori",$in);
			}
			else if($tipe=="edit")
			{
				$in['kategori'] = $this->input->post("kategori");
				$in['icon'] = $this->input->post("icon");
				$in['custom_fields'] = $this->input->post("custom_fields");
				
				$this->db->update("dlmbg_kategori",$in,$id);
			}
			
			redirect("superadmin/kategori");
		}
		else
		{
			redirect("auth/user_login");
		}
   }
 
	public function hapus($id_param)
	{
		if($this->session->userdata("logged_in_admin")!="")
		{
			$where['id_kategori'] = $id_param;
			$this->db->delete("dlmbg_kategori",$where);
			redirect("superadmin/kategori");
		}
		else
		{
			redirect("web");
		}
   }
}
 
/* End of file superadmin.php */
