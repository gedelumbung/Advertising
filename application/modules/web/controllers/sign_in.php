<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sign_in extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 **/

	function index()
	{
		if($this->session->userdata('logged_in')=="")
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
			$this->breadcrumb->append_crumb('SIGN IN', '/');
			
			$d['captcha'] = $this->generate_captcha();
			
			$this->load->view($_SESSION['site_theme'].'/bg_header',$d);
			$this->load->view($_SESSION['site_theme'].'/sign_in/bg_home');
			$this->load->view($_SESSION['site_theme'].'/bg_left');
			$this->load->view($_SESSION['site_theme'].'/bg_footer');
		}
		else
		{
			redirect("user/dashboard");
		}
			
	}

	function set()
	{
		$where['email'] = $this->input->post("email");
		$where['password'] = md5($this->input->post("password").$this->config->item("key_login"));
		
		$expiration = time()-3600;
		$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);
		
		$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND captcha_time > ?";
		$binds = array($_POST['captcha'], $expiration);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();
		if ($row->count == 0)
		{
			$this->session->set_flashdata('result', 'Captcha tidak valid');
			redirect("web/sign_in");
		}
		else
		{
			$this->app_user_login_model->cekUserLogin($where);
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect("web/sign_in");
	}
	
	function generate_captcha()
	{
		$vals = array(
			'img_path' => './captcha/',
			'img_url' => base_url().'captcha/',
			'font_path' => './system/fonts/impact.ttf',
			'img_width' => '150',
			'img_height' => 40
			);
		$cap = create_captcha($vals);
		$datamasuk = array(
			'captcha_time' => $cap['time'],
			//'ip_address' => $this->input->ip_address(),
			'word' => $cap['word']
			);
		$expiration = time()-3600;
		$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);
		$query = $this->db->insert_string('captcha', $datamasuk);
		$this->db->query($query);
		return $cap['image'];
	}
}
