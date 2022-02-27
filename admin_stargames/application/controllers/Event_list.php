<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_list extends MY_Controller {

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
        $this->load->model ('event_content_model');
        $this->load->model ('crud_model');

		$this->load->library('Rapid/RapidDataModel');
        error_reporting(E_ALL);
	}
	public function index()
	{
        // print_r($_SESSION['user_data']);
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
        // $parseData ['content']			= $this->load->view ( 'content/event_list', '', true);
        if ($_SESSION['user_data']['role'] == 4){
		    $parseData ['content']			= $this->load->view ( 'content/forbiden-access', '', true);
        }else{
		    $parseData ['content']			= $this->load->view ( 'content/event_list', '', true);
        }
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
    }

	public function datatables()
	{
		$category				= $this->event_content_model->get_category();
		$get_Totalrequest		= $this->event_content_model->get_Totalrequest();
		$data 		= array();
		if(count($category) > 0){
			for($i=0; $i<count($category); $i++){
				if($category[$i]["enabled"] == 1){
				$nestedData		= array();
				$nestedData[] 	= $category[$i]["name"];
				// $nestedData[] 	= $category[$i]["category"];
				$nestedData[] 	= date($category[$i]["date_end"]) >= date('Y-m-d h:i:s') && date($category[$i]["date_start"]) <= date('Y-m-d h:i:s') ? "Aktif" : "Tidak aktif";
				$nestedData[] 	= date('d-m-Y', strtotime($category[$i]["last_update"]));
					if($this->session->userdata['user_data']['role'] == 1 or $this->session->userdata['user_data']['id'] == 2){
						$nestedData[] 	= '<a href="'.$this->config->item('base_url').'event_list/update/'.$category[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'event_list/delete/'.$category[$i]["id"].'" class="fa fa-fw fa-trash" data-confirm="Are you sure you want to Delete this data?">&nbsp;</a>';
						$data[] = $nestedData;
					}else if($this->session->userdata['user_data']['role'] == 3){
						$nestedData[] 	= '<a href="'.$this->config->item('base_url').'event_list/update/'.$category[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>';
						$data[] = $nestedData;
					}else if($this->session->userdata['user_data']['role'] == 5){
						$nestedData[]	= '';
						$data[] = $nestedData;
					}else{
						$nestedData[]	= '';
					}
				}
			}
		}
		$json_data = array(
			"draw"            => intval(@$_REQUEST['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
			"recordsTotal"    => intval(count($get_Totalrequest)),  // total number of records
			"recordsFiltered" => intval(count($get_Totalrequest)),  // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

		echo json_encode($json_data);  // send data as json format
	}

    public function create()
	{
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/event_list_create', '', true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	}

    public function update($id)
	{
		$data['id']						= ($id != '' && is_numeric($id))? $id:0;
		$data['data']				= $this->event_content_model->select_category($data['id'], '');
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/event_list_update', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
    }

	public function action_update($id)
	{
		$data['name']		= ($this->input->get_post('name'))?$this->input->get_post('name'):'';
		$this->form_validation->set_rules('name', 'name', 'required');


		if ($this->form_validation->run() == TRUE){

			$create_id = uniqid();
			$config['upload_path']          = './uploads/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 200;
			$config['max_width']            = 180;
			$config['max_height']           = 120;
			$config['file_name']            = $create_id;
			$config['overwrite']			= true;
			$this->load->library('upload', $config);







	if($_FILES["img"]["size"] == 0){

		$field 		= array(
			'name' => $data['name'],
			// 'img' => 	$config['file_name'] ,
			'value' => $this->input->get_post('value'),
			'price' => $this->input->get_post('price'),
			'points' => $this->input->get_post('points'),
			'unit' => $this->input->get_post('unit'),
			'tc' => $this->input->get_post('tc'),
			'description' => $this->input->get_post('description'),
			'date_start' => $this->input->get_post('date_start'),
			'date_end' => $this->input->get_post('date_end'),
			'country' => 'ID',
			'enabled' => '1',
			'last_update' => date('Y-m-d')
		);

		$create_admin	= $this->crud_model->update("M_grand_prize_event",  $field, $id);
		if($create_admin){
			$this->session->set_flashdata('msggrandPrizeTrue', 'Update data success');
			header("location: ".$this->config->item('base_url')."event_list");
			die;
		}else{
			$this->session->set_flashdata('msggrandPrizeFalse', 'Insert data failed, please try again');
			header("location: ".$this->config->item('base_url')."event_list/create");
			die;
		}
	}else{
		if ($this->upload->do_upload('img')) {


					$uploadRequest = array(
									'fileName' => basename($this->upload->data()["full_path"]),
									'fileData' => base64_encode(file_get_contents($this->upload->data()["full_path"]))
							);
							$uploader_id = sha1(uniqid());
							RapidDataModel::use('default');
							RapidDataModel::create('F_uploader', array(
								array(
									"id" => $uploader_id,
									"filename" => $uploadRequest["fileName"],
									"file_encoded" => $uploadRequest["fileData"],
									"date_created" => date("Y-m-d H:i:s")
								)
							));
					$resp = shell_exec('curl -k -X POST -F "uploader_id='.$uploader_id.'" '.$this->config->item("assets_url_portal").'/index.php/file-receiver/');
					$resp = json_decode($resp);

					if ($resp->status == 1) {
						// Upload Success
						$this->session->set_flashdata('msggrandPrizeTrue', 'Upload data success'.$config['upload_path'].$img);
					}else{
						// Upload Failed
						$this->session->set_flashdata('msggrandPrizeFalse', 'Failed upload image to the portal1');
					}

					$file_info = $this->upload->data();
					$img = $file_info['file_name'];
					$path = $img;

			$field 		= array(
				'name' => $data['name'],
				'img' => $path,
				'value' => $this->input->get_post('value'),
				'price' => $this->input->get_post('price'),
				'points' => $this->input->get_post('points'),
				'unit' => $this->input->get_post('unit'),
				'tc' => $this->input->get_post('tc'),
				'description' => $this->input->get_post('description'),
				'date_start' => $this->input->get_post('date_start'),
				'date_end' => $this->input->get_post('date_end'),
				'country' => 'ID',
				'enabled' => '1',
				'last_update' => date('Y-m-d')
			);

			// print_r($field);
			// die();

			$create_admin	= $this->crud_model->update("M_grand_prize_event",  $field, $id);
			if($create_admin){
				$this->session->set_flashdata('msggrandPrizeTrue', 'Update data success');
				header("location: ".$this->config->item('base_url')."event_list");
				die;
			}else{
				$this->session->set_flashdata('msggrandPrizeFalse', 'Insert data failed, please try again');
				header("location: ".$this->config->item('base_url')."event_list/create");
				die;
			}


		}else{
			$this->session->set_flashdata('msggrandPrizeFalse', 'gagal upload foto');
			header("location: ".$this->config->item('base_url')."event_list/create");
			die;
		}

	}


		}else{
		$this->session->set_flashdata('msggrandPrizeFalse', 'Insert data failed, please try again');
		header("location: ".$this->config->item('base_url')."event_list/create");
		die;
		}
    }

	public function action_create()
	{


		$data['name']		= ($this->input->get_post('name'))?$this->input->get_post('name'):'';
		$this->form_validation->set_rules('name', 'name', 'required');
		if ($this->form_validation->run() == TRUE){


			$create_id = uniqid();
			$config['upload_path']          = './uploads/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 200;
			$config['max_width']            = 180;
			$config['max_height']           = 120;
			$config['file_name']            = $create_id;
			$config['overwrite']			= true;
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('img')) {

				$uploadRequest = array(
								'fileName' => basename($this->upload->data()["full_path"]),
								'fileData' => base64_encode(file_get_contents($this->upload->data()["full_path"]))
						);
						$uploader_id = sha1(uniqid());
						RapidDataModel::use('default');
						RapidDataModel::create('F_uploader', array(
							array(
								"id" => $uploader_id,
								"filename" => $uploadRequest["fileName"],
								"file_encoded" => $uploadRequest["fileData"],
								"date_created" => date("Y-m-d H:i:s")
							)
						));
				$resp = shell_exec('curl -k -X POST -F "uploader_id='.$uploader_id.'" '.$this->config->item("assets_url_portal").'/index.php/file-receiver/');
				$resp = json_decode($resp);

				if ($resp->status == 1) {
					// Upload Success
					$this->session->set_flashdata('msggrandPrizeTrue', 'Upload data success'.$config['upload_path'].$img);
				}else{
					// Upload Failed
					$this->session->set_flashdata('msggrandPrizeFalse', 'Failed upload image to the portal1');
				}

				$file_info = $this->upload->data();
				$img = $file_info['file_name'];
				$path = $img;


						$field 		= array(
							'name' 	=> $data['name'],
							'img' 	=> $path,
							'value' => str_replace(',','', str_replace('.','', $this->input->get_post('value'))),
							'price' => str_replace(',','', str_replace('.','', $this->input->get_post('price'))),
							'points' => str_replace(',','', str_replace(',','', $this->input->get_post('points'))),
							'unit' => $this->input->get_post('unit'),
							'tc' => $this->input->get_post('tc'),
							'description' => $this->input->get_post('description'),
							'date_start' =>  $this->input->get_post('date_start')." ". $this->input->get_post('time_start').":00",
							'date_end' =>        $this->input->get_post('date_end')." ". $this->input->get_post('time_end').":00",
							// 'time_start' => $this->input->get_post('time_start'),
							// 'time_end' => $this->input->get_post('time_end'),
							'country' => 'ID',
							'enabled' => '1',
							'last_update' => date('Y-m-d')
							);

							// print_r($field);
							// die();
						$create_admin	= $this->crud_model->create("M_grand_prize_event", $field);
						if($create_admin){
							$this->session->set_flashdata('msggrandPrizeTrue', 'Insert data Success');
							header("location: ".$this->config->item('base_url')."event_list");
							die;
						}else{
							$this->session->set_flashdata('msggrandPrizeFalse', 'Insert data Failed, please try again');
							header("location: ".$this->config->item('base_url')."event_list/create");
							die;
						}

		 }else{
			 $this->session->set_flashdata('msggrandPrizeFalse', 'File terlalu besar atau resolusi terlalu besar');
			 header("location: ".$this->config->item('base_url')."event_list/create");
			 die;
		 }
		}else{
						$this->session->set_flashdata('msggrandPrizeFalse', 'File terlalu besar atau resolusi terlalu besar');
						header("location: ".$this->config->item('base_url')."event_list/create");
						die;
		}
	}
	public function delete($id)
	{
		$data['id']	= ($id != '' && is_numeric($id))? $id:0;
		//$delete_admin	= $this->crud_model->delete("M_grand_prize_event", array("id" => $id));
		$delete_admin	= $this->crud_model->update("M_grand_prize_event", array('enabled' => 0), $data['id']);
		if($delete_admin){
		$this->session->set_flashdata('msggrandPrizeTrue', 'Delete data Success');
			header("location: ".$this->config->item('base_url')."event_list");
			die;
		}else{
		$this->session->set_flashdata('msggrandPrizeFalse', 'Delete data Failed, please try again');
			header("location: ".$this->config->item('base_url')."event_list");
			die;
		}

	}
}
