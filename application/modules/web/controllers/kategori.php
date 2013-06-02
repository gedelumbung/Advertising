<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class kategori extends CI_Controller {

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
		
		$this->breadcrumb->append_crumb('BERANDA', base_url());
		$this->breadcrumb->append_crumb('KATEGORI', base_url().'web/kategori');
		$d['dt_retrieve'] = $this->app_global_web_model->generate_indexs_kategori();
		
		$this->load->view($_SESSION['site_theme'].'/bg_header',$d);
		$this->load->view($_SESSION['site_theme'].'/kategori/bg_home');
		$this->load->view($_SESSION['site_theme'].'/bg_left');
		$this->load->view($_SESSION['site_theme'].'/bg_footer');
			
	}

	function get($id_param,$title="",$uri=0)
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
		
		$where['id_kategori'] = $id_param;
		$gen_menu = $this->db->get_where("dlmbg_kategori",$where);
		if($gen_menu->num_rows()==0)
		{
			redirect(base_url());
		}
		
		$menu_crumb = $gen_menu->row();
		$this->breadcrumb->append_crumb('BERANDA', base_url());
		$this->breadcrumb->append_crumb('KATEGORI', base_url().'web/kategori');
		$this->breadcrumb->append_crumb(strtoupper($menu_crumb->kategori), base_url().'web/kategori/get/'.$id_param.'/'.url_title($menu_crumb->kategori,'-',TRUE));
		$d['dt_retrieve'] = $this->app_global_web_model->generate_indexs_iklan_kategori($id_param,$_SESSION['site_limit_iklan_kategori'],$uri);
		$d['kategori_title'] = strtoupper($menu_crumb->kategori);
		
		$this->load->view($_SESSION['site_theme'].'/bg_header',$d);
		$this->load->view($_SESSION['site_theme'].'/kategori/bg_detail');
		$this->load->view($_SESSION['site_theme'].'/bg_left');
		$this->load->view($_SESSION['site_theme'].'/bg_footer');
			
	}
}
