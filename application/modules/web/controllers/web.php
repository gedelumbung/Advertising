<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class web extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 **/

	function index()
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
		
		$d['front_kategori'] = $this->app_global_web_model->generate_front_kategori($_SESSION['site_limit_kategori_front'],0);
		$d['front_artikel_newest'] = $this->app_global_web_model->generate_front_artikel(2,0,"id_artikel");
		$d['front_artikel_newest_list'] = $this->app_global_web_model->generate_front_artikel_list(4,2);
		$d['front_iklan_new'] = $this->app_global_web_model->generate_front_iklan(4,"id_iklan");
		$d['front_iklan_hot'] = $this->app_global_web_model->generate_front_iklan(4,"counter");
		
 		$this->load->view($_SESSION['site_theme'].'/bg_header',$d);
 		$this->load->view($_SESSION['site_theme'].'/bg_home');
 		$this->load->view($_SESSION['site_theme'].'/bg_left');
 		$this->load->view($_SESSION['site_theme'].'/bg_footer');
	}
}
