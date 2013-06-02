<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class profil extends MX_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 **/
 
   public function index()
   {
		if($this->session->userdata("logged_in_admin")!="")
		{
			$this->breadcrumb->append_crumb('Dashboard', base_url().'superadmin');
			$this->breadcrumb->append_crumb("User Profile", '/');
			
			$where['id_admin'] = $this->session->userdata("id_admin");
			$get = $this->db->get_where("dlmbg_admin",$where)->row();
			
			$d['nama_user'] = $get->nama;
			$d['username'] = $get->username;
			
			$d['id_param'] = $get->id_admin;
			
			$this->load->view('bg_header',$d);
			$this->load->view('profil/bg_home');
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
			$id['id_admin'] = $this->input->post("id_param");
			
			$cek = $this->db->get_where("dlmbg_admin",array("username"=>$this->input->post("username")))->num_rows();
			if($cek>0 && $this->input->post("username_temp")!=$this->input->post("username"))
			{
				$this->session->set_flashdata("simpan_akun","Username telah terpakai, gunakan username lainnya");
				redirect("superadmin/profil");
			}
			else
			{
				$in['nama'] = $this->input->post("nama_user");
				$in['username'] = $this->input->post("username");
				
				$sess_data['nama'] = $in['nama'];
				$sess_data['username'] = $in['username'];
				$this->session->set_userdata($sess_data);
				
				$this->db->update("dlmbg_admin",$in,$id);
				redirect("superadmin/profil");
			}
	}
		else
		{
			redirect("auth/user_login");
		}
   }
}
 
/* End of file superadmin.php */
