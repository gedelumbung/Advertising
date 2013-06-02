<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 **/
	 
	function index()
	{
		if($this->session->userdata('logged_in_admin')!="")
		{
			$this->load->view('bg_header');
			$this->load->view('bg_home');
			$this->load->view('bg_footer');
		}
		else
		{
			redirect("superadmin");
		}
	}
}
