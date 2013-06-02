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
	}
}

/* End of file app_load_config_model.php */
/* Location: ./application/models/app_load_config_model.php */