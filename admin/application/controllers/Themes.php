<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// require 'oRapid.lib.php';

class Themes extends MY_Controller {

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
    	$this->load->library("Rapid/RapidDataModel");
		$data = array();
		RapidDataModel::use('default');
		$read = RapidDataModel::read('M_themes', [])["rows"];
    	$data = ["data" => $read];
		$parseData ['header']			= $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
       	$parseData ['content']			= $this->load->view ( 'content/themes', $data, true);
    	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	    $this->load->view ( 'vside', $parseData);
    }

    public function create()
	{
		$this->load->helper("url");
		$field = $this->session->flashdata('field');
		$data = [];
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/themes_add', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
    }

		public function edit($id)
	{
		$this->load->helper("url");
		$field = $this->session->flashdata('field');
		// $data = [];

		$this->load->library("Rapid/RapidDataModel");

		$data = array();
		RapidDataModel::use('default');
		$read = RapidDataModel::read('M_themes', [
			"where"=> [
						"id" => $id,		]
		])["rows"];
		$data = ["data" => $read];


		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/themes_edit', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
		}




    public function upload($file){
    	$this->load->library("Rapid/RapidDataModel");
        $config['upload_path']          =   './uploads/home-banner/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $new_name = sha1(time()).".".basename($filename['name']);
        $config['encrypt_name'] = TRUE;
        $config['file_name'] = $new_name;
        $config['overwrite'] = TRUE;
     	$config['remove_spaces'] = TRUE;
		$this->load->library('upload', $config);

        if ($this->upload->do_upload('userfile')){
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
		}else{
			return false;
		}
    }

      public function save()
	{
		$this->load->library("Rapid/RapidDataModel");
		$directory = substr(str_shuffle(rand() . uniqid() . strtoupper(uniqid())), 0, 10);
		$upload_error = [];
		foreach ($_FILES as $key => $value) {
			// print_r($key);
			// die();
			if (!empty($value["name"])) {
		        $config['upload_path']          =   './uploads/home-banner/';
		        $config['allowed_types']        = 'gif|jpg|png|jpeg';
		        $new_name = $key;
		        $config['encrypt_name'] = TRUE;
		        $config['file_name'] = $new_name;
		        $config['overwrite'] = TRUE;
				$config['remove_spaces'] = TRUE;
				if($key == 'themes_logo_file'){
					$config['max_width'] 	= 280;
					$config['max_height'] = 90;
					$config['max_size']   = 40;
				}else {
					$this->session->set_flashdata('themes_logo_file_alert', 'themes_logo_file Tidak Memenuhi syarat');
				}
				if($key == 'themes_banner_file'){
					$config['max_width'] 	= 1061;
					$config['max_height'] = 893;
					$config['max_size']   = 4000;
				}else{
						$this->session->set_flashdata('themes_banner_file_alert', 'themes_banner_file Tidak Memenuhi syarat');
				}

				if($key == 'themes_bendera_kiri'){
					$config['max_width'] 	= 179;
					$config['max_height'] = 379;
					$config['max_size']   = 30;
				}else {
						$this->session->set_flashdata('themes_bendera_kiri_alert', 'themes_bendera_kiri Tidak Memenuhi syarat');
				}
				if($key == 'themes_bendera_kanan'){
					$config['max_width'] 	= 179;
					$config['max_height'] = 379;
					$config['max_size']   = 30;
				}else {

							$this->session->set_flashdata('themes_bendera_kanan_alert', 'themes_bendera_kanan Tidak Memenuhi syarat');
				}

				if($key == 'themes_content_divider_file'){
					$config['max_width'] = 1600;
					$config['max_height'] = 328;
					$config['max_size']   = 100;
				}else {

							$this->session->set_flashdata('themes_content_divider_file_alert', 'themes_content_divider_file Tidak Memenuhi syarat');
				}
				if($key == 'themes_footer_left_file'){
					$config['max_width'] = 224;
					$config['max_height'] = 235;
					$config['max_size']   = 40;

				}else {
						$this->session->set_flashdata('themes_footer_left_file_alert', 'themes_footer_left_file Tidak Memenuhi syarat');

				}
				if($key == 'themes_footer_right_file'){
					$config['max_width'] = 509;
					$config['max_height'] = 234;
					$config['max_size']   = 40;

				}else{
					$this->session->set_flashdata('themes_footer_right_file_alert', 'themes_footer_right_file Tidak Memenuhi syarat');
				}
				$this->load->library('upload', $config);

		        if ($this->upload->do_upload($key)){
			    	$uploadRequest = array(
					    'fileName' => basename($this->upload->data()["full_path"]),
					    'fileData' => base64_encode(file_get_contents($this->upload->data()["full_path"]))
					);
			    	$uploader_id = sha1(uniqid());
					RapidDataModel::use('default');
					$create = RapidDataModel::create('F_uploader', array(
						array(
							"id" => $uploader_id,
							"filename" => $config['file_name'] . ".png",
							"file_encoded" => $uploadRequest["fileData"],
							"date_created" => date("Y-m-d H:i:s")
						)
					));
					if ($create) {
						$resp2 = shell_exec('curl -d "uploader_id='. $uploader_id .'&directory='.$directory.'" -X POST "'.$this->config->item("assets_url_portal").'"/index.php/theme-image-receiver');

						$resp = json_decode($resp2);

				        if ($resp->status == false) {
				        	// Upload Failed
				        	$upload_error [] = $key;
				        }
					}
				}else{
					$_SESSION["create_theme"] = [
						"status" => false,
						"message" => "Failed while trying to upload. One or more The image you are attempting to upload doesn't fit into the allowed dimensions."
					];
					header("Location: ".$this->config->item('base_url')."themes/");
					return false;
				}
			}
		}
		if (empty($upload_error)) {
			$create = RapidDataModel::create('M_themes', array(
				array(
					"directory"			=> $directory,
					"theme_name" 		=> $_POST["themes_name"] ?? "No Name",
					"theme_accent" 	=> $_POST["themes_accent_color"] ?? "#f6d22f",
					"is_default" 		=> 0,
					"date_created" 	=> date("Y-m-d H:i:s"),
					"create_by" 		=> $this->session->userdata['user_data']['name']
				)
			));
			$_SESSION["create_theme"] = [
				"status" => true,
				"message" => "Theme successfully created"
			];
		}else{
			$_SESSION["create_theme"] = [
				"status" => false,
				"message" => 'Failed while trying to upload ('. implode(", ", $upload_error).')'
			];
		}
        header("Location: ".$this->config->item('base_url')."themes/");
    }


		public function update($id)
{
	$this->load->library("Rapid/RapidDataModel");
	$directory = $_POST["directory"];
	$upload_error = [];
	foreach ($_FILES as $key => $value) {
		// echo $value["name"];
		if (!empty($value["name"])) {
					$config['upload_path']          =   './uploads/home-banner/';
					$config['allowed_types']        = 'gif|jpg|png|jpeg';
					$new_name = $key;
					$config['encrypt_name'] = TRUE;
					$config['file_name'] = $new_name;
					$config['overwrite'] = TRUE;
					$config['remove_spaces'] = TRUE;
					if($key == 'themes_logo_file'){
						$config['max_width'] 	= 280;
						$config['max_height'] = 90;
						$config['max_size']   = 40;
					}else {
						$this->session->set_flashdata('themes_logo_file_alert', 'themes_logo_file Tidak Memenuhi syarat');
					}
					if($key == 'themes_banner_file'){
						$config['max_width'] 	= 1061;
						$config['max_height'] = 893;
						$config['max_size']   = 4000;
					}else{
							$this->session->set_flashdata('themes_banner_file_alert', 'themes_banner_file Tidak Memenuhi syarat');
					}

					if($key == 'themes_bendera_kiri'){
						$config['max_width'] 	= 179;
						$config['max_height'] = 379;
						$config['max_size']   = 30;
					}else {
							$this->session->set_flashdata('themes_bendera_kiri_alert', 'themes_bendera_kiri Tidak Memenuhi syarat');
					}
					if($key == 'themes_bendera_kanan'){
						$config['max_width'] 	= 179;
						$config['max_height'] = 379;
						$config['max_size']   = 30;
					}else {

								$this->session->set_flashdata('themes_bendera_kanan_alert', 'themes_bendera_kanan Tidak Memenuhi syarat');
					}

					if($key == 'themes_content_divider_file'){
						$config['max_width'] = 1600;
						$config['max_height'] = 328;
						$config['max_size']   = 100;
					}else {

								$this->session->set_flashdata('themes_content_divider_file_alert', 'themes_content_divider_file Tidak Memenuhi syarat');
					}
					if($key == 'themes_footer_left_file'){
						$config['max_width'] = 224;
						$config['max_height'] = 235;
						$config['max_size']   = 40;

					}else {
							$this->session->set_flashdata('themes_footer_left_file_alert', 'themes_footer_left_file Tidak Memenuhi syarat');

					}
					if($key == 'themes_footer_right_file'){
						$config['max_width'] = 509;
						$config['max_height'] = 234;
						$config['max_size']   = 40;

					}else{
						$this->session->set_flashdata('themes_footer_right_file_alert', 'themes_footer_right_file Tidak Memenuhi syarat');
					}
					$this->load->library('upload', $config);

					if ($this->upload->do_upload($key)){
					$uploadRequest = array(
						'fileName' => basename($this->upload->data()["full_path"]),
						'fileData' => base64_encode(file_get_contents($this->upload->data()["full_path"]))
				);
					$uploader_id = sha1(uniqid());
					RapidDataModel::use('default');
					$create = RapidDataModel::create('F_uploader', array(
					array(
						"id" => $uploader_id,
						"filename" => $config['file_name'] . ".png",
						"file_encoded" => $uploadRequest["fileData"],
						"date_created" => date("Y-m-d H:i:s")
					)
				));
				if ($create) {
					$resp2 = shell_exec('curl -d "uploader_id='. $uploader_id .'&directory='.$directory.'" -X POST "'.$this->config->item("assets_url_portal").'"/index.php/theme-image-receiver');

					$resp = json_decode($resp2);

							if ($resp->status == false) {
								// Upload Failed
								$upload_error [] = $key;
							}
				}
			}else{
				$_SESSION["create_theme"] = [
					"status" => false,
					"message" => "Failed while trying to upload. One or more The image you are attempting to upload doesn't fit into the allowed dimensions."
				];
				header("Location: ".$this->config->item('base_url')."themes/");
				return false;
			}
		}
	}
					// if (empty($upload_error)) {
					// print_r($_POST);
					// print_r($id);
					// die();
								$field 		= array(

											"theme_name" 		=> $_POST["themes_name"] ?? "No Name",
											"theme_accent" 	=> $_POST["themes_accent_color"] ?? "#f6d22f",
											"date_created" 	=> date("Y-m-d H:i:s"),
											"create_by" 		=> $this->session->userdata['user_data']['name']

								);
								$update_themes	= $this->crud_model->update("M_themes", $field, $id);
								if ($update_themes) {
									$_SESSION["create_theme"] = [
										"status" => true,
										"message" => "Theme successfully updated"
									];
								}else{
									$_SESSION["create_theme"] = [
										"status" => false,
										"message" => "Theme not successfully updated"
									];
								}

					// }else{
					// 	$_SESSION["create_theme"] = [
					// 		"status" => false,
					// 		"message" => 'Failed while trying to upload ('. implode(", ", $upload_error).')'
					// 	];
					// }
			header("Location: ".$this->config->item('base_url')."themes/");
	}

    public function apply(){
		$this->load->library("Rapid/RapidDataModel");
    	if (isset($_GET["id"])) {
    		$update_all	 = RapidDataModel::update('M_themes', [
    			"data" => [
    				"is_default" => 0
    			]
    		]);
    		if ($update_all) {
    			$update = RapidDataModel::update('M_themes', [
	    			"key" => [
	    				"id" => $_GET["id"]
	    			],
	    			"data" => [
	    				"is_default" => 1
	    			]
	    		]);
    		}
    	}
        header("Location: ".$this->config->item('base_url')."themes/");
    }

    public function delete(){
		$this->load->library("Rapid/RapidDataModel");
    	if (isset($_GET["id"])) {
    		$delete	 = RapidDataModel::delete('M_themes', [
    			"key" => [
    				"id" => $_GET["id"]
    			]
    		]);
    	}
        header("Location: ".$this->config->item('base_url')."themes/");
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
					"publish_by"=> $this->session->userdata['user_data']['name'] ,
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

			        if ($resp->status == true) {
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
