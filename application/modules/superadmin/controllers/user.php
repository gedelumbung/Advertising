<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends MX_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 **/
 
   public function index($uri=0)
   {
		if($this->session->userdata("logged_in_admin")!="")
		{
			$this->breadcrumb->append_crumb('Dashboard', base_url().'superadmin');
			$this->breadcrumb->append_crumb("User Management", '/');
			
			$d['aktif_slide_banner'] = "";
			$d['aktif_category'] = "";
			$d['aktif_product'] = "";
			
			$filter['nama_user'] = $this->session->userdata("search_nama_user");
			$d['data_retrieve'] = $this->app_global_superadmin_model->generate_index_user($this->config->item("limit_item"),$uri,$filter);
			
			$this->load->view('bg_header',$d);
			$this->load->view('user/bg_home');
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
			$this->breadcrumb->append_crumb("User Management", '/');
			$this->breadcrumb->append_crumb("Add User", '/');
			
			$d['aktif_slide_banner'] = "";
			$d['aktif_category'] = "";
			$d['aktif_product'] = "";
			
			$d['nama_user'] = "";
			$d['username'] = "";
			
			$d['id_param'] = "";
			$d['tipe'] = "tambah";
			
			$this->load->view('bg_header',$d);
			$this->load->view('user/bg_input');
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
			$this->breadcrumb->append_crumb("User Management", '/');
			$this->breadcrumb->append_crumb("Edit User", '/');
			
			$d['aktif_slide_banner'] = "";
			$d['aktif_category'] = "";
			$d['aktif_product'] = "";
			
			$where['id_admin'] = $id_param;
			$get = $this->db->get_where("dlmbg_admin",$where)->row();
			
			$d['nama_user'] = $get->nama;
			$d['username'] = $get->username;
			
			$d['id_param'] = $get->id_admin;
			$d['tipe'] = "edit";
			
			$this->load->view('bg_header',$d);
			$this->load->view('user/bg_input');
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
			$id['id_admin'] = $this->input->post("id_param");
			if($tipe=="tambah")
			{
				$cek = $this->db->get_where("dlmbg_admin",array("username"=>$this->input->post("username")))->num_rows();
				if($cek>0)
				{
					$this->session->set_flashdata("simpan_akun","Username telah terpakai, gunakan username lainnya");
					redirect("superadmin/user/tambah");
				}
				else
				{
					$in['nama'] = $this->input->post("nama_user");
					$in['username'] = $this->input->post("username");
					$in['password'] = md5($this->input->post("password").$this->config->item("key_login"));
					
					$this->db->insert("dlmbg_admin",$in);
					redirect("superadmin/user");
				}
			}
			else if($tipe=="edit")
			{	
				if($_POST['password']!="")
				{
					$cek = $this->db->get_where("dlmbg_admin",array("username"=>$this->input->post("username")))->num_rows();
					if($cek>0 && $this->input->post("username_temp")!=$this->input->post("username"))
					{
						$this->session->set_flashdata("simpan_akun","Username telah terpakai, gunakan username lainnya atau tetap gunakan username ini");
						redirect("superadmin/user/edit/".$id['id_admin']."");
					}
					else
					{
						$in['nama'] = $this->input->post("nama_user");
						$in['username'] = $this->input->post("username");
						$in['password'] = md5($this->input->post("password").$this->config->item("key_login"));
					
						$this->db->update("dlmbg_admin",$in,$id);
						redirect("superadmin/user");
					}
				}
				else
				{
					$cek = $this->db->get_where("dlmbg_admin",array("username"=>$this->input->post("username")))->num_rows();
					if($cek>0 && $this->input->post("username_temp")!=$this->input->post("username"))
					{
						$this->session->set_flashdata("simpan_akun","Username telah terpakai, gunakan username lainnya atau tetap gunakan username ini");
						redirect("superadmin/user/edit/".$id['id_admin']."");
					}
					else
					{
						$in['nama'] = $this->input->post("nama_user");
						$in['username'] = $this->input->post("username");
					
						$this->db->update("dlmbg_admin",$in,$id);
						redirect("superadmin/user");
					}
				}
			}
		}
		else
		{
			redirect("auth/user_login");
		}
   }
 
	public function set()
	{
		if($this->session->userdata("logged_in_admin")!="")
		{
			$sess['search_nama_user'] = $this->input->post("by_nama");
			$this->session->set_userdata($sess);
			redirect("superadmin/user");
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
			$where['id_admin'] = $id_param;
			$this->db->delete("dlmbg_admin",$where);
			redirect("superadmin/user");
		}
		else
		{
			redirect("web");
		}
   }
}
 
/* End of file superadmin.php */
