<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Giiftmanagement extends MY_Controller {

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
	$this->load->model ('merchantgiiftmanagement_model');
	$this->load->model ('program_model');
	$this->load->model ('crud_model');
	}
	public function index()
	{
	$parseData ['header']			= $this->load->view ( 'header', '', true);
	$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
	$parseData ['content']			= $this->load->view ( 'content/giiftmanagement', '', true);
	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
	$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	$this->load->view ( 'vside', $parseData);
	}
	public function datatables()
	{
	$point					= $this->merchantgiiftmanagement_model->get_merchantgiiftmanagement();
	$get_Totalrequest		= $this->merchantgiiftmanagement_model->get_Totalrequest();
	// print_r($point);
	// print_r($get_Totalrequest);
	// die();
	$data 		= array();
		if(count($point) > 0){
			for($i=0; $i<count($point); $i++){
			$nestedData		= array();
			$nestedData[] 	= $point[$i]["point_value"];
			$nestedData[] 	= $point[$i]["margin"];
			$nestedData[] 	= $point[$i]["date"];
				if($this->session->userdata['user_data']['role'] == 1 or $this->session->userdata['user_data']['id'] == 2){
				$nestedData[] 	= '<a href="'.$this->config->item('base_url').'giiftmanagement/update/'.$point[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;

				</a>&nbsp;';
				}else if($this->session->userdata['user_data']['role'] == 2){
				$nestedData[] 	= '<a href="'.$this->config->item('base_url').'giiftmanagement/update/'.$point[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;

				</a>&nbsp;';
				}else if($this->session->userdata['user_data']['role'] == 3){
				$nestedData[] 	= '<a href="'.$this->config->item('base_url').'giiftmanagement/update/'.$point[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>';
				}else{
				$nestedData[]	= '';
				}

			$data[] = $nestedData;
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
        $parseData ['content']			= $this->load->view ( 'content/giiftmanagement_create', $data, true);
        $parseData ['footer']			= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
        $this->load->view ( 'vside', $parseData);
	}
	public function update($id)
	{

	$data['get_point']				= $this->merchantgiiftmanagement_model->select_point_management($id);

	$parseData ['header']			= $this->load->view ( 'header', '', true);
	$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
	$parseData ['content']			= $this->load->view ( 'content/giiftmanagement_update', $data, true);
	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
	$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	$this->load->view ( 'vside', $parseData);
	}
	public function action_update()
	{
	$data['point_value']		= ($this->input->get_post('point_value'))?$this->input->get_post('point_value'):'';
	$data['margin']		= ($this->input->get_post('margin'))?$this->input->get_post('margin'):'';
	$data['id']				= ($this->input->get_post('id'))?$this->input->get_post('id'):'';
	$this->form_validation->set_rules('point_value', 'point_value', 'required');
	$this->form_validation->set_rules('margin', 'margin', 'required');
		if ($this->form_validation->run() == TRUE){
			if($data['point_value'] != '' and $data['margin']){
						$field 		= array(
						"point_value" 		=> $data['point_value'],
						"margin" 			=> $data['margin'],
						"date" 				=>  date("Y-m-d h:i:sa")
						);
				$update_point	= $this->crud_model->update("M_giift_point_value", $field, $data['id']);
				if($update_point){
				$this->session->set_flashdata('poinSettingTrue', 'Update data Success');
				header("location: ".$this->config->item('base_url')."giiftmanagement");
				die;
				}else{
				$this->session->set_flashdata('poinSettingFalse', 'Update data Failed, please try again');
				header("location: ".$this->config->item('base_url')."giiftmanagement/update/".$data['id']);
				die;
				}
			}else{
			$this->session->set_flashdata('poinSettingFalse', 'Update data Failed, margin  can not empty');
			header("location: ".$this->config->item('base_url')."giiftmanagement/update/".$data['id']);
			die;
			}
		}else{
		$this->session->set_flashdata('poinSettingFalse', 'Update data Failed, please try again');
		header("location: ".$this->config->item('base_url')."giiftmanagement/update/".$data['id']);
		die;
		}
	}
	public function action_create()
	{

	$data['point_value']		= ($this->input->get_post('point_value'))?$this->input->get_post('point_value'):'';
	$data['margin']		= ($this->input->get_post('margin'))?$this->input->get_post('margin'):'';
	$data['id']				= ($this->input->get_post('id'))?$this->input->get_post('id'):'';

	$this->form_validation->set_rules('point_value', 'point_value', 'required');
	$this->form_validation->set_rules('margin', 'margin', 'required');
		if ($this->form_validation->run() == TRUE){
			//mod contesso

				if($data['point_value'] != '' and $data['margin']){
							$field 		= array(
							"point_value" 		=> $data['point_value'],
							"margin" 			=> $data['margin'],
							"date" 				=>  date("Y-m-d h:i:sa")
							);
					$update_point	= $this->crud_model->create("M_giift_point_value", $field, $data['id']);
					if($update_point){
					$this->session->set_flashdata('poinSettingTrue', 'Create data Success');
					header("location: ".$this->config->item('base_url')."giiftmanagement");
					die;
					}else{
					$this->session->set_flashdata('poinSettingFalse', 'Create data Failed, please try again');
					header("location: ".$this->config->item('base_url')."giiftmanagement/create/");
					die;
					}
				}else{
				$this->session->set_flashdata('poinSettingFalse', 'Create data Failed, ratio can not empty');
				header("location: ".$this->config->item('base_url')."giiftmanagement/create/");
				die;
				}
		}else{
			$this->session->set_flashdata('poinSettingFalse', 'Create data Failed, please try again');
			header("location: ".$this->config->item('base_url')."giiftmanagement/create/");
			die;
		}
			/*
			if(count($data['from_point']) > 0 && count($data['to_point']) > 0){
				for($i=0; $i<count($data['from_point']); $i++){
					if($data['from_point'][$i] != '' and $data['to_point'][$i]){
						$field 		= array(
						"from_program_id"	=> $data['from_program_id'],
						"to_program_id" 	=> $data['to_program_id'],
						"from_ratio" 		=> $data['from_ratio'][$i],
						"to_ratio" 			=> $data['to_ratio'][$i]
						);
					$this->crud_model->create("T_point_management", $field);
					}
				}
				$this->session->set_flashdata('msgalert', 'Insert data Success');
				header("location: ".$this->config->item('base_url')."point");
				die;
			}else{
				$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again 1');
				header("location: ".$this->config->item('base_url')."point/create");
				die;
			}
		}else{
			$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again validation error');
			header("location: ".$this->config->item('base_url')."point/create");
			die;
		}
		*/
	}
	public function delete($id)
	{
	$data['id']	= ($id != '' && is_numeric($id))? $id:0;
	$delete_point	= $this->crud_model->delete("M_giift_point_value", array("id" => $id));
		if($delete_point){
		$this->session->set_flashdata('poinSettingTrue', 'Delete data Success');
		header("location: ".$this->config->item('base_url')."giiftmanagement");
		die;
		}else{
		$this->session->set_flashdata('poinSettingFalse', 'Delete data Failed, please try again');
		header("location: ".$this->config->item('base_url')."giiftmanagement");
		die;
		}

	}
}
