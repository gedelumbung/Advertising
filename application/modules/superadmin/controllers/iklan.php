<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class iklan extends MX_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 **/
 
   public function index($uri=0)
   {
		if($this->session->userdata("logged_in_admin")!="")
		{
			$this->breadcrumb->append_crumb('Dashboard', base_url().'superadmin');
			$this->breadcrumb->append_crumb("iklan", '/');
			
			$filter = $this->session->userdata("filter_iklan");
			$d['data_retrieve'] = $this->app_global_superadmin_model->generate_indexs_iklan(8,$uri,$filter);
			
			$this->load->view('bg_header',$d);
			$this->load->view('iklan/bg_home');
			$this->load->view('bg_footer');
		}
		else
		{
			redirect("auth/user_login");
		}
   }

	function hapus($id_param)
	{
		if($this->session->userdata('logged_in_admin')!="")
		{
			$where['id_iklan'] = $id_param;
			$this->db->delete("dlmbg_iklan",$where);
			$get = $this->db->get_where("dlmbg_gambar_iklan",$where);
			foreach($get->result() as $del)
			{
				$url = "./asset/images/iklan/".$del->gambar."";
				$url2 = "./asset/images/iklan/thumb/".$del->gambar."";
				unlink($url);
				unlink($url2);
			}
			$this->db->delete("dlmbg_gambar_iklan",$where);
			redirect("superadmin/iklan");
		}
	}

	function approve($id_param,$upd)
	{
		if($this->session->userdata('logged_in_admin')!="")
		{
			$where['id_iklan'] = $id_param;
			$updt['st'] = $upd;
			$this->db->update("dlmbg_iklan",$updt,$where);
			redirect("superadmin/iklan");
		}
	}

	function filter()
	{
		if($this->session->userdata('logged_in_admin')!="")
		{
			$set['filter_iklan'] = $_POST['filter'];
			$this->session->set_userdata($set);
			redirect("superadmin/iklan");
		}
	}
}
 
/* End of file superadmin.php */
