<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class iklan extends CI_Controller {

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
			
			$d['dt_retrieve'] = $this->app_global_web_model->generate_indexs_iklan_member_edit($this->session->userdata("id_member"),$_SESSION['site_limit_iklan_kategori'],$uri);
			
			$this->breadcrumb->append_crumb('BERANDA', base_url());
			$this->breadcrumb->append_crumb('DASHBOARD', base_url().'user/dashboard');
			$this->breadcrumb->append_crumb('MANAJEMEN IKLAN', '/');
			
			$this->load->view($_SESSION['site_theme'].'/bg_header',$d);
			$this->load->view($_SESSION['site_theme'].'/user/iklan/bg_home');
			$this->load->view($_SESSION['site_theme'].'/bg_left');
			$this->load->view($_SESSION['site_theme'].'/bg_footer');
		}
		else
		{
			redirect(base_url());
		}
			
	}

	function tambah()
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
			
			$d['st'] = "tambah";
			
			$d['combo_lokasi_iklan'] = $this->app_global_web_model->generate_combo_lokasi_iklan();
			$d['combo_kategori_iklan'] = $this->app_global_web_model->generate_combo_kategori_iklan();
			$d['id_iklan'] = "";
			$d['id_lokasi'] = "";
			$d['id_kategori'] = "";
			$d['id_member'] = $this->session->userdata("id_member");
			$d['judul_iklan'] = "";
			$d['keterangan'] = "";
			$d['harga'] = "";
			$d['kondisi'] = "";
			$d['tipe'] = "";
			
			$this->breadcrumb->append_crumb('BERANDA', base_url());
			$this->breadcrumb->append_crumb('DASHBOARD', base_url().'user/dashboard');
			$this->breadcrumb->append_crumb('IKLAN', base_url().'user/iklan');
			$this->breadcrumb->append_crumb('TAMBAH IKLAN', '/');
			
			$this->load->view($_SESSION['site_theme'].'/bg_header',$d);
			$this->load->view($_SESSION['site_theme'].'/user/iklan/bg_input');
			$this->load->view($_SESSION['site_theme'].'/bg_left');
			$this->load->view($_SESSION['site_theme'].'/bg_footer');
		}
		else
		{
			redirect(base_url());
		}
			
	}

	function edit($id_param)
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
			
			$d['st'] = "edit";
			$where['id_iklan'] = $id_param;
			$q = $this->db->get_where("dlmbg_iklan",$where)->row();
			$d['id_iklan'] = $id_param;
			$d['id_lokasi'] = $q->id_lokasi;
			$d['id_kategori'] = $q->id_kategori;
			$d['id_member'] = $this->session->userdata("id_member");
			$d['judul_iklan'] = $q->judul_iklan;
			$d['keterangan'] = $q->keterangan;
			$d['harga'] = $q->harga;
			$d['kondisi'] = $q->kondisi;
			$d['tipe'] = $q->tipe;
			
			if($this->session->userdata("id_member")!=$q->id_member)
			{
				redirect("user/dashboard");
			}
			
			$d['combo_lokasi_iklan'] = $this->app_global_web_model->generate_combo_lokasi_iklan($d['id_lokasi']);
			$d['combo_kategori_iklan'] = $this->app_global_web_model->generate_combo_kategori_iklan($d['id_kategori']);
			$d['daftar_gambar_iklan'] = $this->app_global_web_model->generate_gambar_edit_iklan($d['id_iklan']);
			
			$this->breadcrumb->append_crumb('BERANDA', base_url());
			$this->breadcrumb->append_crumb('DASHBOARD', base_url().'user/dashboard');
			$this->breadcrumb->append_crumb('IKLAN', base_url().'user/iklan');
			$this->breadcrumb->append_crumb('EDIT IKLAN', '/');
			
			$this->load->view($_SESSION['site_theme'].'/bg_header',$d);
			$this->load->view($_SESSION['site_theme'].'/user/iklan/bg_input');
			$this->load->view($_SESSION['site_theme'].'/bg_left');
			$this->load->view($_SESSION['site_theme'].'/bg_footer');
		}
		else
		{
			redirect(base_url());
		}
			
	}

	function set()
	{
		if($this->session->userdata('logged_in')!="")
		{
			$st = $this->input->post("st");
			if($st=="tambah")
			{
				$in['id_lokasi'] = $this->input->post("id_lokasi");
				$in['id_kategori'] = $this->input->post("id_kategori");
				$in['id_member'] = $this->input->post("id_member");
				$in['judul_iklan'] = $this->input->post("judul");
				$in['keterangan'] = $this->input->post("keterangan");
				$in['harga'] = $this->input->post("harga");
				$in['tanggal'] = time()+3600*7;
				$in['kondisi'] = $this->input->post("kondisi");
				$in['tipe'] = $this->input->post("tipe");
				$in['st'] = "0";
				$this->db->insert("dlmbg_iklan",$in);
				$id = mysql_insert_id();
				redirect("user/iklan/edit/".$id."");
			}
			else if($st=="edit")
			{
				$id['id_iklan'] = $this->input->post("id_iklan");
				$in['id_lokasi'] = $this->input->post("id_lokasi");
				$in['id_kategori'] = $this->input->post("id_kategori");
				$in['id_member'] = $this->input->post("id_member");
				$in['judul_iklan'] = $this->input->post("judul");
				$in['keterangan'] = $this->input->post("keterangan");
				$in['harga'] = $this->input->post("harga");
				$in['tanggal'] = time()+3600*7;
				$in['kondisi'] = $this->input->post("kondisi");
				$in['tipe'] = $this->input->post("tipe");
				$this->db->update("dlmbg_iklan",$in,$id);
				redirect("user/iklan/edit/".$id['id_iklan']."");
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	function upload_file()
	{
		if($this->session->userdata('logged_in')!="")
		{
			if(!empty($_FILES['file']['name']))
			{
				$config['upload_path'] = './asset/file';
				$config['allowed_types'] = 'zip|txt|pdf';
				$config['encrypt_name']	= TRUE;
				$config['remove_spaces']= TRUE;	
				$config['max_size']     = '4000';
				
				$this->load->library('upload', $config);
				if($this->upload->do_upload('file'))
				{
					$file_data = $this->upload->data(); 
					$this->db->insert('dlmbg_file',array(
						'keterangan'=>$file_data['file_name']
					)); 
					
					$title = $_FILES['file']['name'];
					if(!empty($_POST['title'])){$title=$_POST['title'];}
					
					$json = array(
						'filelink' => base_url("asset/file/{$file_data['file_name']}"),
						'filename' => $title
					);
					echo stripslashes(json_encode($json));
				}
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	function set_gambar()
	{
		if($this->session->userdata('logged_in')!="")
		{
			$config['upload_path'] = './asset/images/iklan/';
			$config['allowed_types']= 'gif|jpg|png|jpeg';
			$config['encrypt_name']	= TRUE;
			$config['remove_spaces']	= TRUE;	
			$config['max_size']     = '2000';
			$config['max_width']  	= '2000';
			$config['max_height']  	= '2000';
	 
			$this->load->library('upload', $config);

			if ($this->upload->do_upload("userfile")) {
				$data	 	= $this->upload->data();
	 
				/* PATH */
				$source             = "./asset/images/iklan/".$data['file_name'] ;
				$destination_thumb	= "./asset/images/iklan/thumb/" ;
	 
				// Permission Configuration
				chmod($source, 0777) ;
	 
				/* Resizing Processing */
				// Configuration Of Image Manipulation :: Static
				$this->load->library('image_lib') ;
				$img['image_library'] = 'GD2';
				$img['create_thumb']  = TRUE;
				$img['maintain_ratio']= TRUE;
	 
				/// Limit Width Resize
				$limit_thumb    = 320 ;
	 
				// Size Image Limit was using (LIMIT TOP)
				$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
	 
				// Percentase Resize
				if ($limit_use > $limit_thumb) {
					$percent_thumb  = $limit_thumb/$limit_use ;
				}
	 
				//// Making THUMBNAIL ///////
				$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
				$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;
	 
				// Configuration Of Image Manipulation :: Dynamic
				$img['thumb_marker'] = '';
				$img['quality']      = '80%' ;
				$img['source_image'] = $source ;
				$img['new_image']    = $destination_thumb ;
	 
				// Do Resizing
				$this->image_lib->initialize($img);
				$this->image_lib->resize();
				$this->image_lib->clear() ;
				
				$in['gambar'] = $data['file_name'];
				$in['id_iklan'] = $this->input->post("id_iklan");
				$this->db->insert("dlmbg_gambar_iklan",$in);
				$this->session->set_flashdata('result', 'Berhasil menambah gambar');
				redirect("user/iklan/edit/".$in['id_iklan']."");
				
			}
			else 
			{
				echo $this->upload->display_errors('<p>','</p>');
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	function hapus_gambar($id_iklan,$id_param,$gambar)
	{
		if($this->session->userdata('logged_in')!="")
		{
			$where['id_gambar_iklan'] = $id_param;
			$this->db->delete("dlmbg_gambar_iklan",$where);
			$url = "./asset/images/iklan/".$gambar."";
			$url2 = "./asset/images/iklan/thumb/".$gambar."";
			unlink($url);
			unlink($url2);
			redirect("user/iklan/edit/".$id_iklan."");
		}
	}

	function hapus($id_param)
	{
		if($this->session->userdata('logged_in')!="")
		{
			$where['id_iklan'] = $id_param;
			$this->db->delete("dlmbg_iklan",$where);
			$get = $this->db->get_where("dlmbg_gambar_iklan",$where);
			foreach($get->result() as $del)
			{
				$url = "./asset/images/iklan/".$del->gambar."";
				$url2 = "./asset/images/iklan/thumb/".$del->gambar."";
				unlink($url);
				unlink($url2);
			}
			$this->db->delete("dlmbg_gambar_iklan",$where);
			redirect("user/iklan");
		}
	}
}
