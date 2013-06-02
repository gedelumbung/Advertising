<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pesan_admin extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 **/

	function index($uri=0)
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
			
			$d['dt_retrieve'] = $this->app_user_web_model->generate_indexs_pesan_admin($this->session->userdata("id_member"),$_SESSION['site_limit_iklan_kategori'],$uri);
			
			$this->breadcrumb->append_crumb('BERANDA', base_url());
			$this->breadcrumb->append_crumb('DASHBOARD', base_url().'user/dashboard');
			$this->breadcrumb->append_crumb('PESAN ADMIN', '/');
			
			$this->load->view($_SESSION['site_theme'].'/bg_header',$d);
			$this->load->view($_SESSION['site_theme'].'/user/pesan_admin/bg_home');
			$this->load->view($_SESSION['site_theme'].'/bg_left');
			$this->load->view($_SESSION['site_theme'].'/bg_footer');
		}
		else
		{
			redirect(base_url());
		}
			
	}
	
	function kirim()
	{
		if($this->session->userdata('logged_in')!="")
		{
			$in['id_pengirim'] = $this->session->userdata("id_member");
			$in['isi'] = $this->input->post("isi");
			$in['admin'] = 0;
			$in['waktu'] = time()+3600*7;
			$this->db->insert("dlmbg_pesan_admin",$in);
			redirect("user/pesan_admin/");
		}
		else
		{
			redirect(base_url());
		}	
	}
}
