<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Redeem extends MY_Controller {

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
	$this->load->model ('redeem_model');
	$this->load->model ('program_model');
	$this->load->model ('merchant_model');
	$this->load->model ('crud_model');
	}
	public function index()
	{
	$parseData ['header']			= $this->load->view ( 'header', '', true);
	$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
	$parseData ['content']			= $this->load->view ( 'content/redeem', '', true);
	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
	$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	$this->load->view ( 'vside', $parseData);
	}
	public function datatables()
	{
	$redeem					= $this->redeem_model->get_redeem();
	$get_Totalrequest		= $this->redeem_model->get_Totalrequest();
	$data 		= array();
		if(count($redeem) > 0){
			for($i=0; $i<count($redeem); $i++){
			$nestedData		= array();
			$nestedData[] 	= $redeem[$i]["program_name"];
			$nestedData[] 	= $redeem[$i]["point"].' PS';
			$nestedData[] 	= $redeem[$i]["name"];
			$nestedData[] 	= 'Rp. '.$redeem[$i]["amount"];
				if($this->session->userdata['user_data']['role'] == 1 or $this->session->userdata['user_data']['id'] == 2){
				$nestedData[] 	= '<a href="'.$this->config->item('base_url').'redeem/update/'.$redeem[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'redeem/delete/'.$redeem[$i]["id"].'" class="fa fa-fw fa-trash" data-confirm="Are you sure you want to Delete this data?">&nbsp;</a>';
				}else if($this->session->userdata['user_data']['role'] == 3){
				$nestedData[] 	= '<a href="'.$this->config->item('base_url').'redeem/update/'.$redeem[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>';
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
		$data['program']				= $this->program_model->select_program();
		$data['merchant']				= $this->merchant_model->select_merchant();
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/redeem_create', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	}
	public function update($id)
	{
		$data['program']				= $this->program_model->select_program();
		$data['merchant']				= $this->merchant_model->select_merchant();
		$data['redeem']					= $this->redeem_model->select_redeem_management($id);
		$data['get_program']			= $this->program_model->select_program(@$data['redeem'][0]['program_id']);
		$data['get_merchant']			= $this->merchant_model->select_merchant(@$data['redeem'][0]['merchant_id']);
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/redeem_update', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	}
	public function action_update()
	{
		$data['program_id']		= ($this->input->get_post('program_id'))?$this->input->get_post('program_id'):'';
		$data['merchant_id']	= ($this->input->get_post('merchant_id'))?$this->input->get_post('merchant_id'):'';
		$data['point']			= ($this->input->get_post('point'))?$this->input->get_post('point'):'';
		$data['amount']			= ($this->input->get_post('amount'))?$this->input->get_post('amount'):'';
		$data['id']				= ($this->input->get_post('id'))?$this->input->get_post('id'):'';
		$this->form_validation->set_rules('program_id', 'program_id', 'required');
		$this->form_validation->set_rules('merchant_id', 'merchant_id', 'required');
			if ($this->form_validation->run() == TRUE){
				if($data['point'] != '' and $data['amount']){
							$field 		= array(
							"program_id"	=> $data['program_id'],
							"merchant_id" 	=> $data['merchant_id'],
							"point" 		=> $data['point'],
							"amount" 		=> $data['amount']
							);
					$update_point	= $this->crud_model->update("T_redeem_management", $field, $data['id']);
					if($update_point){
					$this->session->set_flashdata('msgalert', 'Update data Success');
					header("location: ".$this->config->item('base_url')."redeem");
					die;
					}else{
					$this->session->set_flashdata('msgalert', 'Update data Failed, please try again');
					header("location: ".$this->config->item('base_url')."redeem/update/".$data['id']);
					die;	
					}
				}else{
				$this->session->set_flashdata('msgalert', 'Insert data Failed, point can not empty');
				header("location: ".$this->config->item('base_url')."redeem/update/".$data['id']);
				die;	
				}
			}else{
			$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
			header("location: ".$this->config->item('base_url')."redeem/update/".$data['id']);
			die;	
			}
	}
	public function action_create()
	{
		$data['program_id']		= ($this->input->get_post('program_id'))?$this->input->get_post('program_id'):'';
		$data['merchant_id']	= ($this->input->get_post('merchant_id'))?$this->input->get_post('merchant_id'):'';
		$data['point']			= ($this->input->get_post('point'))?$this->input->get_post('point'):'';
		$data['amount']			= ($this->input->get_post('amount'))?$this->input->get_post('amount'):'';
		$this->form_validation->set_rules('program_id', 'program_id', 'required');
		$this->form_validation->set_rules('merchant_id', 'merchant_id', 'required');
		// print_r($data['point']);
		// if($data['point'][0] == ""){
		// 	echo "yes";
		// }

			if ($this->form_validation->run() == TRUE){
				if($data['point'][0]	!= "" and $data['amount'][0]){
					for($i=0; $i<count($data['point']); $i++){
						if($data['point'][$i] != '' and $data['amount'][$i]){
							$field 		= array(
							"program_id"	=> $data['program_id'],
							"merchant_id" 	=> $data['merchant_id'],
							"point" 		=> $data['point'][$i],
							"amount" 		=> $data['amount'][$i],
							"date_created"	=> date('Y-m-d H:i:s')
							);
						$this->crud_model->create("T_redeem_management", $field);
						}
					}
				$this->session->set_flashdata('msgalert', 'Insert data Success');
				header("location: ".$this->config->item('base_url')."redeem");
				die;
				}else{
				$this->session->set_flashdata('msgalert', 'Create data Failed, Point or Amount can not empty');
				header("location: ".$this->config->item('base_url')."redeem/create");
				die;	
				}
			}else{
			$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again 2');
			header("location: ".$this->config->item('base_url')."redeem/create");
			die;	
			}
	}
	public function delete($id)
	{
		$data['id']	= ($id != '' && is_numeric($id))? $id:0;
		$delete_redeem	= $this->crud_model->delete("T_redeem_management", array("id" => $id));
			if($delete_redeem){
			$this->session->set_flashdata('msgalert', 'Delete data Success');
			header("location: ".$this->config->item('base_url')."redeem");
			die;
			}else{
			$this->session->set_flashdata('msgalert', 'Delete data Failed, please try again');
			header("location: ".$this->config->item('base_url')."redeem");
			die;
			}

	}
}
