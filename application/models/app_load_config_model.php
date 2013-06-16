<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app_load_config_model extends CI_Model {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 * @keterangan : Model untuk melakukan konfigurasi sistem
	 **/
	 
	//query login
	public function __construct()
	{
		$dt = $this->db->get("dlmbg_setting");
		$i = 1;
		foreach($dt->result() as $d)
		{
			$_SESSION['konfig_app_'.$i] = $d->content_setting;
			$_SESSION[$d->tipe] = $_SESSION['konfig_app_'.$i];
			$i++;
		}
		
		$waktu_sekarang = gmdate("Y/m/d",time()-3600*8);
		$cek = $this->db->query("delete FROM dlmbg_iklan where DATE_FORMAT(FROM_UNIXTIME(tanggal_expired-3600*8), '%Y/%m/%d')<='".$waktu_sekarang."'");
	}
}

/* End of file app_load_config_model.php */
/* Location: ./application/models/app_load_config_model.php */