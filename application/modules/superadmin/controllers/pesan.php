<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pesan extends MX_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 **/
 
   public function index($uri=0)
   {
		if($this->session->userdata("logged_in_admin")!="")
		{
			$this->breadcrumb->append_crumb('Dashboard', base_url().'superadmin');
			$this->breadcrumb->append_crumb("pesan", '/');
			
			$d['data_retrieve'] = $this->app_global_superadmin_model->generate_indexs_pesan($this->config->item("limit_item"),$uri);
			
			$this->load->view('bg_header',$d);
			$this->load->view('pesan/bg_home');
			$this->load->view('bg_footer');
		}
		else
		{
			redirect("auth/user_login");
		}
   }
 
   public function detail($id_param,$uri=0)
   {
		if($this->session->userdata("logged_in_admin")!="")
		{
			$this->breadcrumb->append_crumb('Dashboard', base_url().'superadmin');
			$this->breadcrumb->append_crumb("pesan", base_url().'superadmin/pesan');
			$this->breadcrumb->append_crumb("Input pesan", '/');
			
			$d['id_penerima'] = $id_param;
			$d['data_retrieve'] = $this->app_global_superadmin_model->generate_indexs_pesan_admin($id_param,$this->config->item("limit_item"),$uri);
			
			$this->load->view('bg_header',$d);
			$this->load->view('pesan/bg_detail');
			$this->load->view('bg_footer');
		}
		else
		{
			redirect("auth/user_login");
		}
   }
 
   public function kirim()
   {
		if($this->session->userdata("logged_in_admin")!="")
		{
			$in['id_pengirim'] = $this->input->post("id_pengirim");
			$in['isi'] = $this->input->post("isi");
			$in['admin'] = 1;
			$in['waktu'] = time()+3600*7;
			$this->db->insert("dlmbg_pesan_admin",$in);
			redirect("superadmin/pesan/detail/".$in['id_pengirim']."");
		}
		else
		{
			redirect("auth/user_login");
		}
   }
}
 
/* End of file superadmin.php */
