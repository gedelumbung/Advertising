<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class profile extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 **/

	function index()
	{
		if($this->session->userdata('logged_in')!="")
		{
			$d['left_top_menu'] = $this->app_global_web_model->generate_menu("kiri","nav pull-left");
			$d['right_top_menu'] = $this->app_global_web_model->generate_menu("kanan","nav pull-right");
			$d['center_bottom_menu'] = $this->app_global_web_model->generate_menu("footer");
			$d['combo_lokasi'] = $this->app_global_web_model->generate_combo_lokasi();
			$d['combo_kategori'] = $this->app_global_web_model->generate_combo_kategori();
			$d['list_kategori'] = $this->app_global_web_model->generate_list_kategori("nav nav-list");
			$d['left_artikel_hot'] = $this->app_global_web_model->generate_front_artikel($_SESSION['site_limit_artikel_hot'],0,"counter",1);
			$d['left_iklan_hot'] = $this->app_global_web_model->generate_list_iklan($_SESSION['site_limit_sidebar'],"counter");
			$d['left_iklan_new'] = $this->app_global_web_model->generate_list_iklan($_SESSION['site_limit_sidebar'],"id_iklan");
			
			$this->breadcrumb->append_crumb('BERANDA', base_url());
			$this->breadcrumb->append_crumb('DASHBOARD', base_url().'user/dashboard');
			$this->breadcrumb->append_crumb('EDIT PROFILE MEMBER', '/');
			
			$this->load->view($_SESSION['site_theme'].'/bg_header',$d);
			$this->load->view($_SESSION['site_theme'].'/user/profile/bg_home');
			$this->load->view($_SESSION['site_theme'].'/bg_left');
			$this->load->view($_SESSION['site_theme'].'/bg_footer');
		}
		else
		{
			redirect(base_url());
		}
			
	}

	function set()
	{
		if($this->session->userdata('logged_in')!="")
		{
			$id['id_member'] = $this->session->userdata("id_member");
			$in['nama'] = $this->input->post("nama");
			$in['email'] = $this->input->post("email");
			$in['alamat'] = $this->input->post("alamat");
			$in['no_telpon'] = $this->input->post("no_telpon");
			$in['no_hp'] = $this->input->post("no_hp");
			$in['jk'] = $this->input->post("jk");
			
			$cek_email = $this->db->get_where("dlmbg_member",array("email"=>$in['email']))->num_rows();
			if($cek_email>0 && $this->input->post("email_temp")!=$this->input->post("email"))
			{
				$this->session->set_flashdata('result', 'Email telah terpakai');
				redirect("user/profile");
			}
			else
			{
				if(empty($_FILES['userfile']['name']))
				{
					$this->db->update("dlmbg_member",$in,$id);
					$this->session->set_userdata($in);
					$this->session->set_flashdata('result', 'Berhasil memperbaharui data profil');
					redirect("user/dashboard");
				}
				else
				{
					$config['upload_path'] = './asset/images/member/';
					$config['allowed_types']= 'gif|jpg|png|jpeg';
					$config['encrypt_name']	= TRUE;
					$config['remove_spaces']	= TRUE;	
					$config['max_size']     = '2000';
					$config['max_width']  	= '2000';
					$config['max_height']  	= '2000';
			 
					$this->load->library('upload', $config);
	 
					if ($this->upload->do_upload("userfile")) {
						$data	 	= $this->upload->data();
			 
						/* PATH */
						$source             = "./asset/images/member/".$data['file_name'] ;
						$destination_thumb	= "./asset/images/member/thumb/" ;
			 
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
						
						if($this->input->post("gambar")!="")
						{
							$old_thumb	= "./asset/images/member/thumb/".$this->input->post("gambar")."" ;
							unlink($old_thumb);
						}
						unlink($source);
						
						$in['gambar'] = $data['file_name'];
						$this->db->update("dlmbg_member",$in,$id);
						$this->session->set_userdata($in);
						$this->session->set_flashdata('result', 'Berhasil memperbaharui data profil');
						redirect("user/dashboard");
						
					}
					else 
					{
						echo $this->upload->display_errors('<p>','</p>');
					}
				}
			}
		}
		else
		{
			redirect(base_url());
		}
	}
}
