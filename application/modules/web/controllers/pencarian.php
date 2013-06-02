<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pencarian extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 **/

	function index($uri=0)
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
		$this->breadcrumb->append_crumb('PENCARIAN', '/');
		
		$d['dt_retrieve'] = $this->app_global_web_model->generate_indexs_pencarian($_SESSION['site_limit_iklan_kategori'],$uri);
		
		$this->load->view($_SESSION['site_theme'].'/bg_header',$d);
		$this->load->view($_SESSION['site_theme'].'/iklan/bg_home');
		$this->load->view($_SESSION['site_theme'].'/bg_left');
		$this->load->view($_SESSION['site_theme'].'/bg_footer');
			
	}

	function set()
	{
		$set['keyword'] = $this->input->post("keyword");
		$set['set_combo_kategori'] = $this->input->post("id_kategori");
		$set['set_combo_lokasi'] = $this->input->post("id_lokasi");
		$this->session->set_userdata($set);
		redirect("web/pencarian");
			
	}
}
