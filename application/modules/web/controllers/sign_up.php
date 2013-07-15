<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sign_up extends CI_Controller {

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
			$this->breadcrumb->append_crumb('SIGN UP', '/');
			
			$d['captcha'] = $this->generate_captcha();
			
			$this->load->view($_SESSION['site_theme'].'/bg_header',$d);
			$this->load->view($_SESSION['site_theme'].'/sign_up/bg_home');
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
		$in['nama'] = $this->input->post("nama");
		$in['email'] = $this->input->post("email");
		$in['alamat'] = $this->input->post("alamat");
		$in['no_telpon'] = $this->input->post("no_telpon");
		$in['no_hp'] = $this->input->post("no_hp");
		$in['jk'] = $this->input->post("jk");
		$in['tgl_bergabung'] = time()+3600*7;
		$in['password'] = md5($this->input->post("password").$this->config->item("key_login"));
		
		$expiration = time()-3600;
		$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);
		
		$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND captcha_time > ?";
		$binds = array($_POST['captcha'], $expiration);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();
		
		if ($row->count == 0)
		{
			$this->session->set_flashdata('result', 'Captcha tidak valid');
			redirect("web/sign_up");
		}
		else
		{
			$cek_email = $this->db->get_where("dlmbg_member",array("email"=>$in['email']))->num_rows();
			if($cek_email>0)
			{
				$this->session->set_flashdata('result', 'Email telah terpakai');
				redirect("web/sign_up");
			}
			else
			{
				$pass1 = $this->input->post("password");
				$pass2 = $this->input->post("password2");
				
				if($pass1==$pass2)
				{
					if($_SESSION['site_send_activation']=="yes")
					{
						$in['kode_aktivasi'] = md5($in['email'].time());
						$in['stts'] = 0;
						$this->db->insert("dlmbg_member",$in);
						$id = mysql_insert_id();
						
						$this->email->from($_SESSION['site_email_server'], $_SESSION['site_title']);
						$this->email->to($in['email']);
						$this->email->set_mailtype('html');
						$this->email->subject('Link Aktivasi - '.$_SESSION['site_title']);
						$this->email->message(base_url().'sign_up/aktif/'.$id.'/'.$in['kode_aktivasi']);
						$this->email->send();
					
						$this->session->set_flashdata('result', 'Email verifikasi telah terkirim ke email anda');
						redirect("web/sign_up");
					}
					else
					{
						$in['stts'] = 1;
						$this->db->insert("dlmbg_member",$in);
						$this->session->set_flashdata('result', 'Sign Up sukses, silahkan login dengan akun anda');
						redirect("web/sign_up");
					}
				}
				else
				{
						$this->session->set_flashdata('result', 'password tidak sama');
						redirect("web/sign_up");
				}
				
			}
		}
	}

	function aktif($id_param,$kode)
	{
		$where['kode_aktivasi'] = $kode;
		$where['id_member'] = $id_param;
		$id['id_member'] = $id_param;
		$cek = $this->db->get_where("dlmbg_member",$where)->num_rows();
		if($cek>0)
		{
			$up['stts'] = 1;
			$this->db->update("dlmbg_member",$up,$id);
			$this->session->set_flashdata('result', 'Akun berhasil diaktifkan');
			redirect("web/sign_up");
		}
		else
		{
			$this->session->set_flashdata('result', 'Kode tidak valid');
			redirect("web/sign_up");
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
}
