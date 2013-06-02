<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app_user_login_model extends CI_Model {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 * @keterangan : Model untuk manajemen user login
	 **/
	 
	public function cekUserLogin($data)
	{
		$cek['email'] 	= mysql_real_escape_string($data['email']);
		$cek['password'] 	= $data['password'];
		$cek['stts'] 	= 1;
		
		$q_cek_login = $this->db->get_where('dlmbg_member', $cek);
		if($q_cek_login->num_rows()>0)
		{
			foreach($q_cek_login->result() as $qad)
			{
				$sess_data['logged_in'] = 'yesGetMeLoginBaby';
				$sess_data['nama'] = $qad->nama;
				$sess_data['id_member'] = $qad->id_member;
				$sess_data['email'] = $qad->email;
				$sess_data['alamat'] = $qad->alamat;
				$sess_data['no_telpon'] = $qad->no_telpon;
				$sess_data['no_hp'] = $qad->no_hp;
				$sess_data['jk'] = $qad->jk;
				$sess_data['tgl_bergabung'] = generate_tanggal($qad->tgl_bergabung);
				$sess_data['gambar'] = $qad->gambar;
				
				$this->session->set_userdata($sess_data);
			}
			redirect("user/dashboard");
		}
		else
		{
			$this->session->set_flashdata("result","Gagal Login. Email dan Password Tidak Cocok....");
			redirect("web/sign_in");
		}
	}
	 
	public function cekAdminLogin($data)
	{
		$cek['username'] 		= mysql_real_escape_string($data['username']);
		$cek['password'] 	= $data['password'];
		
		$q_cek_login = $this->db->get_where('dlmbg_admin', $cek);
		if($q_cek_login->num_rows()>0)
		{
			foreach($q_cek_login->result() as $qad)
			{
				$sess_data['logged_in_admin'] = 'yesGetMeLoginBaby';
				$sess_data['nama'] = $qad->nama;
				$sess_data['id_admin'] = $qad->id_admin;
				$sess_data['username'] = $qad->username;
				
				$this->session->set_userdata($sess_data);
			}
			redirect("superadmin/dashboard");
		}
		else
		{
			$this->session->set_flashdata("result","Gagal Login. Username dan Password Tidak Cocok....");
			redirect("superadmin");
		}
	}
}

/* End of file app_user_login_model.php */
/* Location: ./application/models/app_user_login_model.php */