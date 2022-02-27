<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loyaltypoin extends MY_Controller {

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
	$this->load->model ('loyaltypoin_model');
	$this->load->model ('crud_model');
	error_reporting(E_ALL);
	}
	public function index()
	{
		$parseData ['header']			= $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);

        if ($_SESSION['user_data']['role'] == 4){
            $parseData ['content']			= $this->load->view ( 'content/forbiden-access', '', true);
        }else{
            $parseData ['content']			= $this->load->view ( 'content/loyaltypoin', '', true);
        }
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	}
	public function datatables()
	{
		$loyalty				= $this->loyaltypoin_model->get_loyalty();
		$get_Totalrequest		= $this->loyaltypoin_model->get_Totalrequest();

		$data 		= array();
		if(count($loyalty) > 0){
			for($i=0; $i<count($loyalty); $i++){
			$nestedData		= array();
			$nestedData[] 	= $loyalty[$i]["code_conf"];
				$nestedData[] 	= $loyalty[$i]["name"];
				$nestedData[] 	= $loyalty[$i]["aktiv"];
				$nestedData[] 	= $loyalty[$i]["poin"];
				$nestedData[] 	= $loyalty[$i]["date_created"];
				if($this->session->userdata['user_data']['role'] == 1 or $this->session->userdata['user_data']['id'] == 2){
					$nestedData[] 	= '<a href="'.$this->config->item('base_url').'loyaltypoin/update/'.$loyalty[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'loyaltypoin/delete/'.$loyalty[$i]["id"].'" class="fa fa-fw fa-trash" data-confirm="Are you sure you want to Delete this data?">&nbsp;</a>';
					$data[] = $nestedData;
				}else if($this->session->userdata['user_data']['role'] == 2){
					$nestedData[] 	= '<a href="'.$this->config->item('base_url').'loyaltypoin/update/'.$loyalty[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'loyaltypoin/delete/'.$loyalty[$i]["id"].'" class="fa fa-fw fa-trash" data-confirm="Are you sure you want to Delete this data?">&nbsp;</a>';
					$data[] = $nestedData;
				}else if($this->session->userdata['user_data']['role'] == 3){


					$nestedData[] 	= '<a href="'.$this->config->item('base_url').'loyaltypoin/update/'.$loyalty[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>';
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
		$parseData ['content']			= $this->load->view ( 'content/loyaltypoin_create', '', true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	}
	public function update($id)
	{
		$data['id']						= ($id != '' && is_numeric($id))? $id:0;
		$data['category']				= $this->loyaltypoin_model->select_loyalty($data['id'], '');
		print_r($data['category']);
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/loyaltypoin_update', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	}
	public function action_update()
	{
		$data['id']			= ($this->input->get_post('id'))?$this->input->get_post('id'):'';
		$data['code_conf']		= ($this->input->get_post('code_conf'))?$this->input->get_post('code_conf'):'';
		$data['name']		= ($this->input->get_post('name')) ? $this->input->get_post('name') : '';
		$data['poin']		= ($this->input->get_post('poin')) ? $this->input->get_post('poin') : '';
		$data['aktiv']		=  $this->input->get_post('aktiv') ;
		// print_r($data);
		// die();
		$this->form_validation->set_rules('name', 'name', 'required');
		if ($this->form_validation->run() == TRUE){
			$loyaltypoin	= $this->loyaltypoin_model->select_loyalty('', $data['name']);
			// if(count($loyaltypoin) > 0){
			// $this->session->set_flashdata('msgalert', 'Update data Failed, loyaltypoin already exists');
			// header("location: ".$this->config->item('base_url'). "loyaltypoin/update/".$data['id']);
			// die;
			// }else{
				$field 	= $data;
				$update_province	= $this->crud_model->update("g_konfigurasi", $field, $data['id']);
				$this->session->set_flashdata('msgalert', 'Update success');
				header("location: ".$this->config->item('base_url')."loyaltypoin");
				die;
			// }
		}else{
		$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
		header("location: ".$this->config->item('base_url'). "loyaltypoin/update/".$data['id']);
		die;
		}
	}
	public function action_create()
	{
		$data['id']			= ($this->input->get_post('id')) ? $this->input->get_post('id') : '';
		$data['code_conf']		= ($this->input->get_post('code_conf')) ? $this->input->get_post('code_conf') : '';
		$data['name']		= ($this->input->get_post('name')) ? $this->input->get_post('name') : '';
		$data['poin']		= ($this->input->get_post('poin')) ? $this->input->get_post('poin') : '';
		$data['aktiv']		=  $this->input->get_post('aktiv');
		$this->form_validation->set_rules('name', 'name', 'required');
		if ($this->form_validation->run() == TRUE){
			$category	= $this->loyaltypoin_model->select_loyalty('', $data['code_conf']);
			if(count($category) > 0){
			$this->session->set_flashdata('msgalert', 'Insert data Failed, Category already exists');
			header("location: ".$this->config->item('base_url')."loyaltypoin/create");
			die;
			}else{
				$field 		= $data;
				$create_admin	= $this->crud_model->create("g_konfigurasi", $field);
				if($create_admin){
				$this->session->set_flashdata('msgalert', 'Insert data Success');
				header("location: ".$this->config->item('base_url'). "loyaltypoin");
				die;
				}else{
				$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
				header("location: ".$this->config->item('base_url'). "loyaltypoin/create");
				die;	
				}
			}
		}else{
		$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
		header("location: ".$this->config->item('base_url'). "loyaltypoin/create");
		die;
		}
	}
	public function delete($id)
	{
		$data['id']	= ($id != '' && is_numeric($id))? $id:0;
		$delete_admin	= $this->crud_model->delete("g_konfigurasi", array("id" => $id));
		if($delete_admin){
		$this->session->set_flashdata('msgalert', 'Delete data Success');
			header("location: ".$this->config->item('base_url'). "loyaltypoin");
			die;
		}else{
		$this->session->set_flashdata('msgalert', 'Delete data Failed, please try again');
			header("location: ".$this->config->item('base_url')."loyaltypoin");
			die;
		}

	}
}
