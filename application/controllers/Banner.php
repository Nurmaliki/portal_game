<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
        parent::__construct();
        $this->load->model ('news_content_model');
        $this->load->model ('news_model');
        $this->load->model ('crud_model');
        error_reporting(E_ALL);
	}
	public function index()
	{
		
		$this->load->helper("url");
		$data = array();
		$banner = scandir("./uploads/home-banner/");
        foreach ($banner as $key => $value) {
        	if ($value != ".." && $value != ".") {
        		$data["banner"][] = $value;
        	}
        }
    
		$parseData ['header']			= $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
       	$parseData ['content']			= $this->load->view ( 'content/banner', $data, true);
    	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	    $this->load->view ( 'vside', $parseData);
    }

    public function detail($id)
	{
		$field = $this->session->flashdata('field');
		$data['field']=$field;
		$data['id']						= ($id != '' && is_numeric($id))? $id:0;
        $data['content']				= $this->news_content_model->select_category($data['id'], '');
        $data['category']				= $this->news_model->select_category();
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/news_content_detail', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
    }
    
	public function do_upload()
    {
    		$this->load->library("Rapid/RapidDataModel");
            $config['upload_path']          =   './uploads/home-banner/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $new_name = sha1(time()).".".basename($_FILES["userfile"]['name']);
            $config['encrypt_name'] = TRUE;
			$config['file_name'] = $new_name;
            $config['overwrite'] = TRUE;
        	$config['remove_spaces'] = TRUE;

			$this->load->library('upload', $config);

            if ($this->upload->do_upload('userfile'))
            {
				// $this->upload->do_upload('userfile');
            	$data = array('upload_data' => $this->upload->data());
				$file_info = $this->upload->data();
				$img = $file_info['file_name']; 
				// $path =$this->config->item('assets_url')."uploads/".$img;
				$path =$img;
		        $error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('msgalert', 'Upload data Failed,'.$this->upload->display_errors().' please try again');
				//data form isian
                $data['name']		= ($this->input->get_post('name'))?$this->input->get_post('name'):'';
                //data form isian
                $data['sub_title']		= ($this->input->get_post('sub_title'))?$this->input->get_post('sub_title'):'';
				// category_id
				$data['category_id']		= ($this->input->get_post('category_id'))?$this->input->get_post('category_id'):'';
				$data['body']		= ($this->input->get_post('body'))?$this->input->get_post('body'):'';
				// publish_by
				//$data['publish_by']		= ($this->input->get_post('publish_by'))?$this->input->get_post('publish_by'):'';
				$data['status']		= ($this->input->get_post('publish_by'))?$this->input->get_post('status'):'';
				//$data['picture']		= ($this->input->get_post('picture'))?$this->input->get_post('picture'):'';
				$data['video']		= ($this->input->get_post('video'))?$this->input->get_post('video'):'none';
				$data['picture']		= ($this->input->get_post('picture'))?$this->input->get_post('picture'):'none';
				$field 		= array(
                    "title" => $data['name'],
                    "sub_title" => $data['sub_title'],
					"category_id" => $data['category_id'],
					"body" => $data['body'],
					"status" => $data['status'],
					"picture" => basename($this->upload->data()["full_path"]),
					"video"	=> $data['video'],
					"publish_by"=> $this->session->userdata['user_data_web']['name'] ,
				);
				$this->session->set_flashdata('path',$path);
				$this->session->set_flashdata('field',$field);
				$uploadRequest = array(
		            'fileName' => basename($this->upload->data()["full_path"]),
		            'fileData' => base64_encode(file_get_contents($this->upload->data()["full_path"]))
		        );
				$uploader_id = sha1(uniqid());
		        RapidDataModel::use('default');
		        $create = RapidDataModel::create('F_uploader', array(
		        	array(
		        		"id" => $uploader_id,
		        		"filename" => $uploadRequest["fileName"],
		        		"file_encoded" => $uploadRequest["fileData"],
		        		"date_created" => date("Y-m-d H:i:s")
		        	)
		        ));
		 
		        if ($create) {
					$resp2 = shell_exec('curl -k -X POST -F "uploader_id='.$uploader_id.'" '.$this->config->item("assets_url_portal").'/index.php/banner-receiver/');
					$resp = json_decode($resp2);	
				
						
			        if ($resp->status == 1) {
			        	// Upload Success
						$this->session->set_flashdata('msgalert', 'Upload data success'.$config['upload_path'].$img);
			        }else{
			        	// Upload Failed
						$this->session->set_flashdata('msgalert', 'Failed upload image to the portal');
			        }
			    }else{
					$this->session->set_flashdata('msgalert', 'Failed inserting image to database');
			    }
		        // Now delete local temp file
                header("location: ".$this->config->item('base_url')."banner/");
            }
		
	}
	public function banner_delete()
	{
	
		$this->load->helper("url");
		$delete = unlink("./uploads/home-banner/". $this->uri->segment(3));
		if ($delete) {
			$uploadRequest = array(
		        'fileName' => basename($this->uri->segment(3)),
		    );
			$resp1 = shell_exec('curl -k -X POST -F  "fileName='.$uploadRequest["fileName"].'"  '.$this->config->item("assets_url_portal").'/index.php/banner-delete/');
			
			$resp = json_decode($resp1);
		
		
		       if ($resp->status == 1) {
		       	// Upload Success
				$this->session->set_flashdata('msgalert', 'Delete from microsite successfull');
		       }else{
		       	// Upload Failed
				$this->session->set_flashdata('msgalert', 'Failed deleted from portal');
		       }
		}else{
			$this->session->set_flashdata('msgalert', 'Failed deleted image');
		}
       header("location: ".$this->config->item('base_url')."banner/");
    }
	
}
