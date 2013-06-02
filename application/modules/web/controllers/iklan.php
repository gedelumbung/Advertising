<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class iklan extends CI_Controller {

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
		$this->breadcrumb->append_crumb('IKLAN', base_url().'web/iklan');
		$d['dt_retrieve'] = $this->app_global_web_model->generate_indexs_iklan($_SESSION['site_limit_iklan_kategori'],$uri,"new");
		
		$this->load->view($_SESSION['site_theme'].'/bg_header',$d);
		$this->load->view($_SESSION['site_theme'].'/iklan/bg_home');
		$this->load->view($_SESSION['site_theme'].'/bg_left');
		$this->load->view($_SESSION['site_theme'].'/bg_footer');
			
	}

	function hot($uri=0)
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
		$this->breadcrumb->append_crumb('IKLAN', base_url().'web/iklan');
		$d['dt_retrieve'] = $this->app_global_web_model->generate_indexs_iklan($_SESSION['site_limit_iklan_kategori'],$uri,"hot");
		
		$this->load->view($_SESSION['site_theme'].'/bg_header',$d);
		$this->load->view($_SESSION['site_theme'].'/iklan/bg_home');
		$this->load->view($_SESSION['site_theme'].'/bg_left');
		$this->load->view($_SESSION['site_theme'].'/bg_footer');
			
	}

	function komentar()
	{
		$in['id_iklan'] = $_POST['id_iklan'];
		$in['id_member'] = $_POST['id_member'];
		$in['tanggal'] = time()+3600*7;
		$in['komentar'] = $_POST['komentar'];
		$this->db->insert("dlmbg_komentar_iklan",$in);
		redirect("web/iklan/get/".$in['id_iklan']."");
			
	}
	
	function hapus_komentar($id_iklan,$id_komentar)
	{
		if($this->session->userdata('logged_in')!="")
		{
			$where['id_iklan'] = $id_iklan;
			$where['id_komentar_iklan'] = $id_komentar;
			$this->db->delete("dlmbg_komentar_iklan ",$where);
			redirect("web/iklan/get/".$id_iklan."");
		}
	}


	function get($id_param)
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
		
		$where['id_iklan'] = $id_param;
		$gen_menu = $this->db->get_where("dlmbg_iklan",$where);
		if($gen_menu->num_rows()==0)
		{
			redirect(base_url());
		}
		
		$menu_crumb = $gen_menu->row();
		
		$where2['id_kategori'] = $menu_crumb->id_kategori;
		$gen_kat = $this->db->get_where("dlmbg_kategori",$where2)->row();
		
		$this->breadcrumb->append_crumb('BERANDA', base_url());
		$this->breadcrumb->append_crumb('KATEGORI', base_url().'web/kategori');
		$this->breadcrumb->append_crumb(strtoupper($gen_kat->kategori), base_url().'web/kategori/get/'.$gen_kat->id_kategori.'/'.url_title($gen_kat->kategori,'-',TRUE));
		$this->breadcrumb->append_crumb($menu_crumb->judul_iklan, '/');
		
		$d['dt_retrieve'] = $this->app_global_web_model->generate_detail_iklan($id_param);
		$this->db->query("update dlmbg_iklan set counter=counter+1 where id_iklan='".$id_param."'");
		
		$this->load->view($_SESSION['site_theme'].'/bg_header',$d);
		$this->load->view($_SESSION['site_theme'].'/iklan/bg_detail');
		$this->load->view($_SESSION['site_theme'].'/bg_left');
		$this->load->view($_SESSION['site_theme'].'/bg_footer');
			
	}
}
