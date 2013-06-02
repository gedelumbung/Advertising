<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class artikel extends CI_Controller {

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
		$this->breadcrumb->append_crumb('ARTIKEL', '/');
		$d['dt_retrieve'] = $this->app_global_web_model->generate_indexs_artikel($this->config->item('limit_item_medium'),$uri);
		
		$this->load->view($_SESSION['site_theme'].'/bg_header',$d);
		$this->load->view($_SESSION['site_theme'].'/artikel/bg_home');
		$this->load->view($_SESSION['site_theme'].'/bg_left');
		$this->load->view($_SESSION['site_theme'].'/bg_footer');
	}

	function get($id_param)
	{
		$where['id_artikel'] = $id_param;
		$get_data = $this->db->get_where("dlmbg_artikel",$where);
		if($get_data->num_rows()>0)
		{
			$h = $get_data->row();
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
			
			$this->breadcrumb->append_crumb('BERANDA', base_url());
			$this->breadcrumb->append_crumb('ARTIKEL', base_url().'web/artikel/');
			$this->breadcrumb->append_crumb($h->judul, base_url().'web/artikel/');
			$d['dt_retrieve'] = $this->app_global_web_model->generate_detail_artikel($id_param);
			
			$this->load->view($_SESSION['site_theme'].'/bg_header',$d);
			$this->load->view($_SESSION['site_theme'].'/artikel/bg_detail');
			$this->load->view($_SESSION['site_theme'].'/bg_left');
			$this->load->view($_SESSION['site_theme'].'/bg_footer');
			
		}
		else
		{
			redirect(base_url());
		}
	}
}
