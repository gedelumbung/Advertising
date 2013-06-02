<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class lokasi extends MX_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 **/
 
   public function index($uri=0)
   {
		if($this->session->userdata("logged_in_admin")!="")
		{
			$this->breadcrumb->append_crumb('Dashboard', base_url().'superadmin');
			$this->breadcrumb->append_crumb("lokasi", '/');
			
			$d['data_retrieve'] = $this->app_global_superadmin_model->generate_indexs_lokasi($this->config->item("limit_item"),$uri);
			
			$this->load->view('bg_header',$d);
			$this->load->view('lokasi/bg_home');
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
			$this->breadcrumb->append_crumb("lokasi", base_url().'superadmin/lokasi');
			$this->breadcrumb->append_crumb("Input lokasi", '/');
			
			$d['lokasi'] = "";
			
			$d['id_param'] = "";
			$d['tipe'] = "tambah";
			
			$this->load->view('bg_header',$d);
			$this->load->view('lokasi/bg_input');
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
			$this->breadcrumb->append_crumb("lokasi", base_url().'superadmin/lokasi');
			$this->breadcrumb->append_crumb("Update lokasi", '/');
			
			$where['id_lokasi'] = $id_param;
			$get = $this->db->get_where("dlmbg_lokasi",$where)->row();
			
			$d['lokasi'] = $get->lokasi;
			
			$d['id_param'] = $get->id_lokasi;
			$d['tipe'] = "edit";
			
			$this->load->view('bg_header',$d);
			$this->load->view('lokasi/bg_input');
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
			$id['id_lokasi'] = $this->input->post("id_param");
			if($tipe=="tambah")
			{
				$in['lokasi'] = $this->input->post("lokasi");
				
				$this->db->insert("dlmbg_lokasi",$in);
			}
			else if($tipe=="edit")
			{
				$in['lokasi'] = $this->input->post("lokasi");
				
				$this->db->update("dlmbg_lokasi",$in,$id);
			}
			
			redirect("superadmin/lokasi");
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
			$where['id_lokasi'] = $id_param;
			$this->db->delete("dlmbg_lokasi",$where);
			redirect("superadmin/lokasi");
		}
		else
		{
			redirect("web");
		}
   }
}
 
/* End of file superadmin.php */
