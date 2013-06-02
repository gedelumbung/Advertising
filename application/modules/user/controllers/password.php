<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class password extends CI_Controller {

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
			$this->breadcrumb->append_crumb('EDIT PASSWORD MEMBER', '/');
			
			$this->load->view($_SESSION['site_theme'].'/bg_header',$d);
			$this->load->view($_SESSION['site_theme'].'/user/password/bg_home');
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
			$id['email'] = $this->session->userdata("email");
			$id['password'] = md5($this->input->post("pass_lama").$this->config->item('key_login'));
			
			$in['pass_lama'] = md5($this->input->post("pass_lama").$this->config->item('key_login'));
			$in['pass_baru'] = $this->input->post("pass_baru");
			$in['ulangi_pass'] = $this->input->post("ulangi_pass");
			
			$cek_pass = $this->db->get_where("dlmbg_member",$id)->num_rows();
			if($cek_pass>0)
			{
				if($in['pass_baru']==$in['ulangi_pass'])
				{
					$up['password'] = md5($this->input->post("ulangi_pass").$this->config->item('key_login'));
					$id_up['id_member'] = $this->session->userdata("id_member");
					$id_up['email'] = $this->session->userdata("email");
					$this->db->update("dlmbg_member",$up,$id_up);
					$this->session->set_flashdata('result', 'Password Berhasil Diperbaharui');
					redirect("user/password");
				}
				else
				{
					$this->session->set_flashdata('result', 'Password Tidak Sama');
					redirect("user/password");
				}
			}
			else
			{
				$this->session->set_flashdata('result', 'Password Lama Salah');
				redirect("user/password");
			}
		}
		else
		{
			redirect(base_url());
		}
	}
}
