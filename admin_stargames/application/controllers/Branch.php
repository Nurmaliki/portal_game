<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch extends MY_Controller {

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
        $this->load->model ('branch_model');
        $this->load->model ('crud_model');
        error_reporting(E_ALL);
	}
	public function index()
	{
        // print_r($_SESSION['user_data']);
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
        // $parseData ['content']			= $this->load->view ( 'content/branch', '', true);
        if ($_SESSION['user_data']['role'] == 4){
		    $parseData ['content']			= $this->load->view ( 'content/forbiden-access', '', true);
        }else{
		    $parseData ['content']			= $this->load->view ( 'content/branch', '', true);
        }
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
    }
    
	public function datatables()
	{
		$category				= $this->branch_model->get_category();
		$get_Totalrequest		= $this->branch_model->get_Totalrequest();
		$data 		= array();
		if(count($category) > 0){
			for($i=0; $i<count($category); $i++){
			$nestedData		= array();
			$nestedData[] 	= $category[$i]["name"];
			$nestedData[] 	= $category[$i]["prefix_number"];
				if($this->session->userdata['user_data']['role'] == 1 or $this->session->userdata['user_data']['id'] == 2){
					$nestedData[] 	= '<a href="'.$this->config->item('base_url').'branch/update/'.$category[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'branch/delete/'.$category[$i]["id"].'" class="fa fa-fw fa-trash" data-confirm="Are you sure you want to Delete this data?">&nbsp;</a>';
					$data[] = $nestedData;
				}else if($this->session->userdata['user_data']['role'] == 3){
					$nestedData[] 	= '<a href="'.$this->config->item('base_url').'branch/update/'.$category[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>';
                    $data[] = $nestedData;
                }else if($this->session->userdata['user_data']['role'] == 5){
					$nestedData[]	= '';	
                	$data[] = $nestedData;
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
		$parseData ['content']			= $this->load->view ( 'content/branch_create', '', true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	}
    
    public function update($id)
	{
		$data['id']						= ($id != '' && is_numeric($id))? $id:0;
		$data['data']				= $this->branch_model->select_id($data['id']);
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/branch_update', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
    }
    
	public function action_update($id) 
	{
		$data['name']		= ($this->input->get_post('name'))?$this->input->get_post('name'):'';
		$data['prefix_number']  = ($this->input->get_post('prefix_number'))?$this->input->get_post('prefix_number'):'';
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('prefix_number', 'prefix_number', 'required');
		if ($this->form_validation->run() == TRUE){
				$field 	= array("name" => $data['name'], 'prefix_number' => $data['prefix_number']);
				$update_province	= $this->crud_model->update("M_branch", $field, $id);
				$this->session->set_flashdata('msgalert', 'Update success');
				header("location: ".$this->config->item('base_url')."branch");
				die;
		}else{
		$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
		header("location: ".$this->config->item('base_url')."branch/update/".$id);
		die;
		}
    }
    
	public function action_create()
	{
		$data['name']		= ($this->input->get_post('name'))?$this->input->get_post('name'):'';
		$data['prefix_number']  = ($this->input->get_post('prefix_number'))?$this->input->get_post('prefix_number'):'';
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('prefix_number', 'prefix_number', 'required');
		if ($this->form_validation->run() == TRUE){
			$category	= $this->branch_model->select_category($data['prefix_number'], $data['name']);
			if(count($category) > 0){
                $this->session->set_flashdata('msgalert', 'Insert data Failed, Branch or prefix already exists');
                header("location: ".$this->config->item('base_url')."branch/create");
                die;
			}else{
				$field 		= array("name" => $data['name']);
				$create_admin	= $this->crud_model->create("M_branch", $field);
				if($create_admin){
                    $this->session->set_flashdata('msgalert', 'Insert data Success');
                    header("location: ".$this->config->item('base_url')."branch");
                    die;
				}else{
                    $this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
                    header("location: ".$this->config->item('base_url')."branch/create");
                    die;	
				}
			}
		}else{
		$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
		header("location: ".$this->config->item('base_url')."branch/create");
		die;
		}
	}
	public function delete($id)
	{
		$data['id']	= ($id != '' && is_numeric($id))? $id:0;
		$delete_branch	= $this->crud_model->delete("M_branch", array("id" => $id));		
		if($delete_branch){
		$this->session->set_flashdata('msgalert', 'Delete data Success');
			header("location: ".$this->config->item('base_url')."branch");
			die;
		}else{
		$this->session->set_flashdata('msgalert', 'Delete data Failed, please try again');
			header("location: ".$this->config->item('base_url')."branch");
			die;
		}

	}
}
