<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member extends MX_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 **/
 
   public function index($uri=0)
   {
		if($this->session->userdata("logged_in_admin")!="")
		{
			$this->breadcrumb->append_crumb('Dashboard', base_url().'superadmin');
			$this->breadcrumb->append_crumb("member", '/');
			
			$d['data_retrieve'] = $this->app_global_superadmin_model->generate_indexs_member($this->config->item("limit_item"),$uri);
			
			$this->load->view('bg_header',$d);
			$this->load->view('member/bg_home');
			$this->load->view('bg_footer');
		}
		else
		{
			redirect("auth/user_login");
		}
   }
 
   public function set($id_param,$set)
   {
		if($this->session->userdata("logged_in_admin")!="")
		{
			$id['id_member'] = $id_param;
			$up['stts'] = $set;
			$this->db->update("dlmbg_member",$up,$id);
			
			redirect("superadmin/member");
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
			//hapus iklan
			$where['id_member'] = $id_param;
			$get = $this->db->get_where("dlmbg_iklan",$where);
			foreach($get->result() as $del)
			{
				$where2['id_iklan'] = $del->id_iklan;
				$get = $this->db->get_where("dlmbg_gambar_iklan",$where2);
				foreach($get->result() as $del2)
				{
					unlink('./asset/images/iklan/'.$del2->gambar.'');
					unlink('./asset/images/iklan/thumb/'.$del2->gambar.'');
				}
				$this->db->delete("dlmbg_gambar_iklan",$where2);	
			}
			$this->db->delete("dlmbg_iklan",$where);
			$this->db->delete("dlmbg_member",$where);
			
			//hapus pesan
			$where3['id_penerima'] = $id_param;
			$this->db->delete("dlmbg_pesan",$where3);
			$where4['id_pengirim'] = $id_param;
			$this->db->delete("dlmbg_pesan",$where4);
			
			$where5['id_pengirim'] = $id_param;
			$this->db->delete("dlmbg_pesan_admin",$where5);
			
			redirect("superadmin/member");
		}
		else
		{
			redirect("web");
		}
   }
}
 
/* End of file superadmin.php */
