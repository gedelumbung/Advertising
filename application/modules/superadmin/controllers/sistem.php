<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sistem extends MX_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 **/
 
   public function index($uri=0)
   {
		if($this->session->userdata("logged_in_admin")!="")
		{
			$this->breadcrumb->append_crumb('Dashboard', base_url().'superadmin');
			$this->breadcrumb->append_crumb("System", '/');
			
			$d['aktif_slide_banner'] = "";
			$d['aktif_category'] = "";
			$d['aktif_product'] = "";
			
			$d['data_retrieve'] = $this->app_global_superadmin_model->generate_index_sistem($this->config->item("limit_item"),$uri);
			
			$this->load->view('bg_header',$d);
			$this->load->view('sistem/bg_home');
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
			$this->breadcrumb->append_crumb("System", base_url().'superadmin/sistem');
			$this->breadcrumb->append_crumb("Edit", '/');
			
			$d['aktif_slide_banner'] = "";
			$d['aktif_category'] = "";
			$d['aktif_product'] = "";
			
			$where['id_setting'] = $id_param;
			$get = $this->db->get_where("dlmbg_setting",$where)->row();
			
			$d['tipe'] = $get->tipe;
			$d['title'] = $get->title;
			$d['content_setting'] = $get->content_setting;
			
			$d['id_param'] = $get->id_setting;
			
			$this->load->view('bg_header',$d);
			$this->load->view('sistem/bg_input');
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
			$id['id_setting'] = $this->input->post("id_param");
			
			$in['tipe'] = $this->input->post("tipe");
			$in['title'] = $this->input->post("title");
			$in['content_setting'] = $this->input->post("content_setting");
			
			$this->db->update("dlmbg_setting",$in,$id);
			
			redirect("superadmin/sistem");
		}
		else
		{
			redirect("auth/user_login");
		}
   }
}
 
/* End of file superadmin.php */
