<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Point extends MY_Controller {

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
	$this->load->model ('point_model');
	$this->load->model ('program_model');
	$this->load->model ('crud_model');
	}
	public function index()
	{
	$parseData ['header']			= $this->load->view ( 'header', '', true);
	$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
	$parseData ['content']			= $this->load->view ( 'content/point', '', true);
	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
	$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	$this->load->view ( 'vside', $parseData);
	}
	public function datatables()
	{
	$point					= $this->point_model->get_point();
	$get_Totalrequest		= $this->point_model->get_Totalrequest();
	$data 		= array();
		if(count($point) > 0){
			for($i=0; $i<count($point); $i++){
			$nestedData		= array();
			$nestedData[] 	= $point[$i]["from_name"];
			$nestedData[] 	= $point[$i]["to_name"];
			$nestedData[] 	= $point[$i]["from_ratio"];
			$nestedData[] 	= $point[$i]["to_ratio"];
				if($this->session->userdata['user_data']['role'] == 1 or $this->session->userdata['user_data']['id'] == 2){
				$nestedData[] 	= '<a href="'.$this->config->item('base_url').'point/update/'.$point[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'point/delete/'.$point[$i]["id"].'" class="fa fa-fw fa-trash" data-confirm="Are you sure you want to Delete this data?">&nbsp;</a>';
				}else if($this->session->userdata['user_data']['role'] == 2){
				$nestedData[] 	= '<a href="'.$this->config->item('base_url').'point/update/'.$point[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'point/delete/'.$point[$i]["id"].'" class="fa fa-fw fa-trash" data-confirm="Are you sure you want to Delete this data?">&nbsp;</a>';
				}else if($this->session->userdata['user_data']['role'] == 3){
				$nestedData[] 	= '<a href="'.$this->config->item('base_url').'point/update/'.$point[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>';
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
        $data['Poinserbu']				= $this->program_model->select_program('', '', 'Poinserbu');
        $data['program']				= $this->program_model->select_program();
        $parseData ['header']			= $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
        $parseData ['content']			= $this->load->view ( 'content/point_create', $data, true);
        $parseData ['footer']			= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
        $this->load->view ( 'vside', $parseData);
	}
	public function update($id)
	{
	$data['Poinserbu']				= $this->program_model->select_program('', '', 'Poinserbu');
	$data['program']				= $this->program_model->select_program();
	$data['get_point']				= $this->point_model->select_point_management($id);
	$parseData ['header']			= $this->load->view ( 'header', '', true);
	$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
	$parseData ['content']			= $this->load->view ( 'content/point_update', $data, true);
	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
	$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	$this->load->view ( 'vside', $parseData);
	}
	public function action_update()
	{
	$data['from_program_id']= ($this->input->get_post('from_program'))?$this->input->get_post('from_program'):'';
	$data['to_program_id']	= ($this->input->get_post('to_program'))?$this->input->get_post('to_program'):'';
	$data['from_ratio']		= ($this->input->get_post('from_ratio'))?$this->input->get_post('from_ratio'):'';
	$data['to_ratio']		= ($this->input->get_post('to_ratio'))?$this->input->get_post('to_ratio'):'';
	$data['id']				= ($this->input->get_post('id'))?$this->input->get_post('id'):'';
	$this->form_validation->set_rules('from_program', 'from_program', 'required');
	$this->form_validation->set_rules('to_program', 'to_program', 'required');
		if ($this->form_validation->run() == TRUE){
			if($data['from_ratio'] != '' and $data['to_ratio']){
						$field 		= array(
						"from_program_id"	=> $data['from_program_id'],
						"to_program_id" 	=> $data['to_program_id'],
						"from_ratio" 		=> $data['from_ratio'],
						"to_ratio" 			=> $data['to_ratio']
						);
				$update_point	= $this->crud_model->update("T_point_management", $field, $data['id']);
				if($update_point){
				$this->session->set_flashdata('msgalert', 'Update data Success');
				header("location: ".$this->config->item('base_url')."point");
				die;
				}else{
				$this->session->set_flashdata('msgalert', 'Update data Failed, please try again');
				header("location: ".$this->config->item('base_url')."point/update/".$data['id']);
				die;	
				}
			}else{
			$this->session->set_flashdata('msgalert', 'Update data Failed, ratio can not empty');
			header("location: ".$this->config->item('base_url')."point/update/".$data['id']);
			die;	
			}
		}else{
		$this->session->set_flashdata('msgalert', 'Update data Failed, please try again');
		header("location: ".$this->config->item('base_url')."point/update/".$data['id']);
		die;	
		}
	}
	public function action_create()
	{
	$data['from_program_id']= ($this->input->get_post('from_program'))?$this->input->get_post('from_program'):'';
	$data['to_program_id']	= ($this->input->get_post('to_program'))?$this->input->get_post('to_program'):'';
	$data['from_ratio']		= ($this->input->get_post('from_ratio'))?$this->input->get_post('from_ratio'):'';
	$data['to_ratio']		= ($this->input->get_post('to_ratio'))?$this->input->get_post('to_ratio'):'';
	$this->form_validation->set_rules('from_program', 'from_program', 'required');
	$this->form_validation->set_rules('to_program', 'to_program', 'required');
		if ($this->form_validation->run() == TRUE){
			//mod contesso
			
				if($data['from_ratio'] != '' and $data['to_ratio']){
							$field 		= array(
							"from_program_id"	=> $data['from_program_id'],
							"to_program_id" 	=> $data['to_program_id'],
							"from_ratio" 		=> $data['from_ratio'],
							"to_ratio" 			=> $data['to_ratio']
							);
					$update_point	= $this->crud_model->create("T_point_management", $field, $data['id']);
					if($update_point){
					$this->session->set_flashdata('msgalert', 'Create data Success');
					header("location: ".$this->config->item('base_url')."point");
					die;
					}else{
					$this->session->set_flashdata('msgalert', 'Create data Failed, please try again');
					header("location: ".$this->config->item('base_url')."point/create/");
					die;	
					}
				}else{
				$this->session->set_flashdata('msgalert', 'Create data Failed, ratio can not empty');
				header("location: ".$this->config->item('base_url')."point/create/");
				die;	
				}
		}else{
			$this->session->set_flashdata('msgalert', 'Create data Failed, please try again');
			header("location: ".$this->config->item('base_url')."point/create/");
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
	$delete_point	= $this->crud_model->delete("T_point_management", array("id" => $id));
		if($delete_point){
		$this->session->set_flashdata('msgalert', 'Delete data Success');
		header("location: ".$this->config->item('base_url')."point");
		die;
		}else{
		$this->session->set_flashdata('msgalert', 'Delete data Failed, please try again');
		header("location: ".$this->config->item('base_url')."point");
		die;
		}

	}
}
