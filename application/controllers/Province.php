<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Province extends MY_Controller {

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
	$this->load->model ('province_model');
	$this->load->model ('crud_model');
	error_reporting(E_ALL);
	}
	public function index()
	{
	$parseData ['header']			= $this->load->view ( 'header', '', true);
    $parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
    
    
    if ($_SESSION['user_data_web']['role'] == 4){
        $parseData ['content']			= $this->load->view ( 'content/forbiden-access', '', true);
    }else{
        $parseData ['content']			= $this->load->view ( 'content/province', '', true);
    }
    
	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
	$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	$this->load->view ( 'vside', $parseData);
	}
	public function datatables()
	{
	$province				= $this->province_model->get_province();
	$get_Totalrequest		= $this->province_model->get_Totalrequest();
	$data 		= array();
		if(count($province) > 0){
			for($i=0; $i<count($province); $i++){
			$nestedData		= array();
			$nestedData[] 	= $province[$i]["name"];
				if($this->session->userdata['user_data_web']['role'] == 1 or $this->session->userdata['user_data_web']['id'] == 2){
				$nestedData[] 	= '<a href="'.$this->config->item('base_url').'province/update/'.$province[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'province/delete/'.$province[$i]["id"].'" class="fa fa-fw fa-trash" data-confirm="Are you sure you want to Delete this data?">&nbsp;</a>';
				$data[] = $nestedData;
				}else if($this->session->userdata['user_data_web']['role'] == 3){
				$nestedData[] 	= '<a href="'.$this->config->item('base_url').'province/update/'.$province[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>';
				}else{
				$nestedData[]	= '';	
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
	$parseData ['content']			= $this->load->view ( 'content/province_create', '', true);
	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
	$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	$this->load->view ( 'vside', $parseData);
	}
	public function update($id)
	{
	$data['id']						= ($id != '' && is_numeric($id))? $id:0;
	$data['province']				= $this->province_model->select_province($data['id'], '');
	$parseData ['header']			= $this->load->view ( 'header', '', true);
	$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
	$parseData ['content']			= $this->load->view ( 'content/province_update', $data, true);
	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
	$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	$this->load->view ( 'vside', $parseData);
	}
	public function action_update()
	{
	$data['id']			= ($this->input->get_post('id'))?$this->input->get_post('id'):'';
	$data['name']		= ($this->input->get_post('name'))?$this->input->get_post('name'):'';
	$this->form_validation->set_rules('name', 'name', 'required');
		if ($this->form_validation->run() == TRUE){
			$province	= $this->province_model->select_province('', $data['name']);
			if(count($province) > 0){
			$this->session->set_flashdata('msgalert', 'Update data Failed, Province already exists');
			header("location: ".$this->config->item('base_url')."province/update/".$data['id']);
			die;
			}else{
				$field 	= array("name" => $data['name']);
				$update_province	= $this->crud_model->update("M_province", $field, $data['id']);
				$this->session->set_flashdata('msgalert', 'Update success');
				header("location: ".$this->config->item('base_url')."province");
				die;
			}
		}else{
		$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
		header("location: ".$this->config->item('base_url')."province/update/".$data['id']);
		die;
		}
	}
	public function action_create()
	{
	$data['name']		= ($this->input->get_post('name'))?$this->input->get_post('name'):'';
	$this->form_validation->set_rules('name', 'name', 'required');
		if ($this->form_validation->run() == TRUE){
			$province	= $this->province_model->select_province('', $data['name']);
			if(count($province) > 0){
			$this->session->set_flashdata('msgalert', 'Insert data Failed, Province already exists');
			header("location: ".$this->config->item('base_url')."province/create");
			die;
			}else{
				$field 		= array("name" => $data['name']);
				$create_admin	= $this->crud_model->create("M_province", $field);
				if($create_admin){
				$this->session->set_flashdata('msgalert', 'Insert data Success');
				header("location: ".$this->config->item('base_url')."province");
				die;
				}else{
				$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
				header("location: ".$this->config->item('base_url')."province/create");
				die;	
				}
			}
		}else{
		$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
		header("location: ".$this->config->item('base_url')."province/create");
		die;
		}
	}
	public function delete($id)
	{
	$data['id']	= ($id != '' && is_numeric($id))? $id:0;
	$delete_admin	= $this->crud_model->delete("M_province", array("id" => $id));
		if($delete_admin){
		$this->session->set_flashdata('msgalert', 'Delete data Success');
		header("location: ".$this->config->item('base_url')."province");
		die;
		}else{
		$this->session->set_flashdata('msgalert', 'Delete data Failed, please try again');
		header("location: ".$this->config->item('base_url')."province");
		die;
		}

	}
}
