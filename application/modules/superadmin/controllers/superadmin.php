<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class superadmin extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 **/

	function index($uri=0)
	{
		if($this->session->userdata('logged_in_admin')=="")
		{
			$d['captcha'] = $this->generate_captcha();
			$this->load->view('bg_login',$d);
		}
		else
		{
			redirect('superadmin/dashboard');
		}	
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
	
	function login()
	{
		$d['username'] = $this->input->post("username");
		$d['password'] = md5($this->input->post("username").$this->config->item("key_login"));
		
		$expiration = time()-3600;
		$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);
		
		$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND captcha_time > ?";
		$binds = array($_POST['captcha'], $expiration);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();
		if ($row->count == 0)
		{
			$this->session->set_flashdata('result', 'Captcha tidak valid');
			redirect("superadmin");
		}
		else
		{
			$this->app_user_login_model->cekAdminLogin($d);
		}
	}
 
   public function logout()
   {
   		$this->session->sess_destroy();
		redirect(base_url());
   }
}
