<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class slide_banner extends MX_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 **/
 
   public function index($uri=0)
   {
		if($this->session->userdata("logged_in_admin")!="")
		{
			$this->breadcrumb->append_crumb('Dashboard', base_url().'superadmin');
			$this->breadcrumb->append_crumb("Slide Banner", '/');
			
			$d['aktif_slide_banner'] = "active";
			$d['aktif_category'] = "";
			$d['aktif_product'] = "";
			
			$d['data_retrieve'] = $this->app_global_superadmin_model->generate_index_slide_banner($this->config->item("limit_item"),$uri);
			
			$this->load->view('bg_header',$d);
			$this->load->view('slide_banner/bg_home');
			$this->load->view('bg_footer');
		}
		else
		{
			redirect("auth/user_login");
		}
   }
 
   public function tambah()
   {
		if($this->session->userdata("logged_in_admin")!="")
		{
			$this->breadcrumb->append_crumb('Dashboard', base_url().'superadmin');
			$this->breadcrumb->append_crumb("Slide Banner", base_url().'superadmin/slide_banner');
			$this->breadcrumb->append_crumb("Input Slide Banner", '/');
			
			$d['aktif_slide_banner'] = "active";
			$d['aktif_category'] = "";
			$d['aktif_product'] = "";
			
			$d['judul'] = "";
			$d['deskripsi'] = "";
			$d['gambar'] = "";
			$d['stts'] = "";
			
			$d['id_param'] = "";
			$d['tipe'] = "tambah";
			
			$this->load->view('bg_header',$d);
			$this->load->view('slide_banner/bg_input');
			$this->load->view('bg_footer');
		}
		else
		{
			redirect("auth/user_login");
		}
   }
 
   public function edit($id_param)
   {
		if($this->session->userdata("logged_in_admin")!="")
		{
			$this->breadcrumb->append_crumb('Dashboard', base_url().'superadmin');
			$this->breadcrumb->append_crumb("Category", base_url().'superadmin/category');
			$this->breadcrumb->append_crumb("Update Category", '/');
			
			$d['aktif_slide_banner'] = "active";
			$d['aktif_category'] = "";
			$d['aktif_product'] = "";
			
			$where['id_banner'] = $id_param;
			$get = $this->db->get_where("dlmbg_banner",$where)->row();
			
			$d['judul'] = $get->judul;
			$d['deskripsi'] = $get->deskripsi;
			$d['gambar'] = $get->gambar;
			$d['stts'] = $get->stts;
			
			$d['id_param'] = $get->id_banner;
			$d['tipe'] = "edit";
			
			$this->load->view('bg_header',$d);
			$this->load->view('slide_banner/bg_input');
			$this->load->view('bg_footer');
		}
		else
		{
			redirect("auth/user_login");
		}
   }
 
   public function simpan()
   {
		if($this->session->userdata("logged_in_admin")!="")
		{
			$tipe = $this->input->post("tipe");
			$id['id_banner'] = $this->input->post("id_param");
			if($tipe=="tambah")
			{
				$in['judul'] = $this->input->post("judul");
				$in['deskripsi'] = $this->input->post("deskripsi");
				$in['stts'] = $this->input->post("stts");
				
				$config['upload_path'] = './asset/slider/';
				$config['allowed_types']= 'gif|jpg|png|jpeg';
				$config['encrypt_name']	= TRUE;
				$config['remove_spaces']= TRUE;	
				$config['max_size']     = '5000';
				$config['max_width']  	= '5000';
				$config['max_height']  	= '5000';
		 
				$this->load->library('upload', $config);
		
				if ($this->upload->do_upload("userfile")) {
					$data	 	= $this->upload->data();
		 
					/* PATH */
					$source             = "./asset/slider/".$data['file_name'] ;
					$destination_medium	= "./asset/slider/medium/" ;
		 
					// Permission Configuration
					chmod($source, 0777) ;
		 
					/* Resizing Processing */
					// Configuration Of Image Manipulation :: Static
					$this->load->library('image_lib') ;
					$img['image_library'] = 'GD2';
					$img['create_thumb']  = TRUE;
					$img['maintain_ratio']= TRUE;
		 
					/// Limit Width Resize
					$limit_medium    = 950 ;
	 
					// Size Image Limit was using (LIMIT TOP)
					$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
		 
					// Percentase Resize
					if ($limit_use > $limit_medium) {
						$percent_thumb2  = $limit_medium/$limit_use ;
					}
		 
					//// Making THUMBNAIL ///////
					$img['width']  = $limit_use > $limit_medium ?  $data['image_width'] * $percent_thumb2 : $data['image_width'] ;
					$img['height'] = $limit_use > $limit_medium ?  $data['image_height'] * $percent_thumb2 : $data['image_height'] ;
		 
					// Configuration Of Image Manipulation :: Dynamic
					$img['thumb_marker'] = '';
					$img['quality']      = '80%' ;
					$img['source_image'] = $source ;
					$img['new_image']    = $destination_medium ;
		 
					// Do Resizing
					$this->image_lib->initialize($img);
					$this->image_lib->resize();
					$this->image_lib->clear() ;
					
					$in['gambar'] = $data['file_name'];
					$this->db->insert("dlmbg_banner",$in);
					unlink($source);
					redirect("superadmin/slide_banner");
					
				}
				else 
				{
					echo $this->upload->display_errors('<p>','</p>');
				}
				
			}
			else if($tipe=="edit")
			{
				if($_FILES['userfile']['name']=="")
				{
					$in['judul'] = $this->input->post("judul");
					$in['deskripsi'] = $this->input->post("deskripsi");
					$in['stts'] = $this->input->post("stts");
				
					$this->db->update("dlmbg_banner",$in,$id);
				}
				else
				{
					$config['upload_path'] = './asset/slider/';
					$config['allowed_types']= 'gif|jpg|png|jpeg';
					$config['encrypt_name']	= TRUE;
					$config['remove_spaces']= TRUE;	
					$config['max_size']     = '5000';
					$config['max_width']  	= '5000';
					$config['max_height']  	= '5000';
			 
					$this->load->library('upload', $config);
			
					if ($this->upload->do_upload("userfile")) {
						$data	 	= $this->upload->data();
			 
						/* PATH */
						$source             = "./asset/slider/".$data['file_name'] ;
						$destination_medium	= "./asset/slider/medium/" ;
			 
						// Permission Configuration
						chmod($source, 0777) ;
			 
						/* Resizing Processing */
						// Configuration Of Image Manipulation :: Static
						$this->load->library('image_lib') ;
						$img['image_library'] = 'GD2';
						$img['create_thumb']  = TRUE;
						$img['maintain_ratio']= TRUE;
			 
						/// Limit Width Resize
						$limit_medium    = 950 ;
						
						// Size Image Limit was using (LIMIT TOP)
						$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
			 
						// Percentase Resize
						if ($limit_use > $limit_medium) {
							$percent_thumb2  = $limit_medium/$limit_use ;
						}
			 
						//// Making THUMBNAIL ///////
						$img['width']  = $limit_use > $limit_medium ?  $data['image_width'] * $percent_thumb2 : $data['image_width'] ;
						$img['height'] = $limit_use > $limit_medium ?  $data['image_height'] * $percent_thumb2 : $data['image_height'] ;
			 
						// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '80%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_medium ;
			 
						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;
						
						$in['gambar'] = $data['file_name'];
						$in['judul'] = $this->input->post("judul");
						$in['deskripsi'] = $this->input->post("deskripsi");
						$in['stts'] = $this->input->post("stts");
					
						$this->db->update("dlmbg_banner",$in,$id);
						unlink($source);
						unlink("./asset/slider/medium/".$this->input->post("gambar")."");
						redirect("superadmin/slide_banner");
						
					}
					else 
					{
						echo $this->upload->display_errors('<p>','</p>');
					}
				}
			}
			
			redirect("superadmin/slide_banner");
		}
		else
		{
			redirect("auth/user_login");
		}
   }
 
	public function hapus($id_param,$file)
	{
		if($this->session->userdata("logged_in_admin")!="")
		{
			$where['id_banner'] = $id_param;
			$this->db->delete("dlmbg_banner",$where);
			unlink("./asset/slider/medium/".$file."");
			redirect("superadmin/slide_banner");
		}
		else
		{
			redirect("web");
		}
   }
 
	public function approve($id_param,$st)
	{
		if($this->session->userdata("logged_in_admin")!="")
		{
			$where['id_banner'] = $id_param;
			$up['stts'] = $st;
			$this->db->update("dlmbg_banner",$up,$where);
			redirect("superadmin/slide_banner");
		}
		else
		{
			redirect("web");
		}
   }
}
 
/* End of file superadmin.php */
