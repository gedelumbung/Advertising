<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class inbox extends CI_Controller {

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
			
			$d['dt_retrieve'] = $this->app_user_web_model->generate_indexs_pesan($this->session->userdata("id_member"),$_SESSION['site_limit_iklan_kategori'],$uri);
			
			$this->breadcrumb->append_crumb('BERANDA', base_url());
			$this->breadcrumb->append_crumb('DASHBOARD', base_url().'user/dashboard');
			$this->breadcrumb->append_crumb('INBOX', '/');
			
			$this->load->view($_SESSION['site_theme'].'/bg_header',$d);
			$this->load->view($_SESSION['site_theme'].'/user/inbox/bg_home');
			$this->load->view($_SESSION['site_theme'].'/bg_left');
			$this->load->view($_SESSION['site_theme'].'/bg_footer');
		}
		else
		{
			redirect(base_url());
		}
			
	}

	function detail_pesan($id_param,$uri=0)
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
			
			$d['dt_retrieve'] = $this->app_user_web_model->generate_detail_pesan($id_param,$_SESSION['site_limit_iklan_kategori'],$uri);
			$up['stts'] = "Y";
			$id['id_pesan'] = $id_param;
			$this->db->update("dlmbg_pesan",$up,$id);
			
			$this->breadcrumb->append_crumb('BERANDA', base_url());
			$this->breadcrumb->append_crumb('DASHBOARD', base_url().'user/dashboard');
			$this->breadcrumb->append_crumb('INBOX', '/');
			
			$this->load->view($_SESSION['site_theme'].'/bg_header',$d);
			$this->load->view($_SESSION['site_theme'].'/user/inbox/bg_detail');
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
			$in['id_sampul'] = $this->input->post("id_sampul");
			$in['id_penerima'] = $this->input->post("id_penerima");
			$in['id_pengirim'] = $this->session->userdata("id_member");
			$in['isi'] = $this->input->post("isi");
			$in['stts'] = "N";
			$in['waktu'] = time()+3600*7;
			$this->db->insert("dlmbg_pesan",$in);
			redirect("user/inbox/detail_pesan/".$in['id_sampul']."");
		}
		else
		{
			redirect(base_url());
		}	
	}

	function kirim_new()
	{
		if($this->session->userdata('logged_in')!="")
		{
			$get_id_sampul = $this->db->query("select IFNULL(max(id_sampul),0+1) as max_id from dlmbg_pesan")->row();
			$in['id_sampul'] = $get_id_sampul->max_id;
			$in['id_penerima'] = $this->input->post("id_penerima");
			$in['id_pengirim'] = $this->session->userdata("id_member");
			$in['isi'] = $this->input->post("isi");
			$in['stts'] = "N";
			$in['waktu'] = time()+3600*7;
			$this->db->insert("dlmbg_pesan",$in);
			redirect("user/inbox/detail_pesan/".$in['id_sampul']."");
		}
		else
		{
			redirect(base_url());
		}	
	}

	function set($id_param)
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
			$this->breadcrumb->append_crumb('KIRIM PESAN', '/');
			
			if($this->app_user_web_model->cek_history_pesan($id_param,$this->session->userdata("id_member"))->num_rows() > 0)
			{
				$ck = $this->app_user_web_model->cek_history_pesan($id_param,$this->session->userdata("id_member"))->row();
				$id_sampul = $ck->id_sampul;
				redirect("user/inbox/detail_pesan/".$id_sampul."");
			}
			
			else if($this->app_user_web_model->cek_history_pesan($this->session->userdata("id_member"),$id_param)->num_rows() > 0)
			{
				$ck = $this->app_user_web_model->cek_history_pesan($this->session->userdata("id_member"),$id_param)->row();
				$id_sampul = $ck->id_sampul;
				redirect("user/inbox/detail_pesan/".$id_sampul."");
			}
			else
			{
				$d['id_penerima'] = $id_param;
				$this->load->view($_SESSION['site_theme'].'/bg_header',$d);
				$this->load->view($_SESSION['site_theme'].'/user/inbox/bg_kirim');
				$this->load->view($_SESSION['site_theme'].'/bg_left');
				$this->load->view($_SESSION['site_theme'].'/bg_footer');
			}
		}
		else
		{
			redirect(base_url());
		}	
	}
}
