<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Katalog extends MY_Controller {

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
	$this->load->model ('katalog_model');
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
            $parseData ['content']			= $this->load->view ( 'content/katalog', '', true);
        }
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	}
	public function datatables()
	{
		$katalog				= $this->katalog_model->get_katalog();
		$get_Totalrequest		= $this->katalog_model->get_Totalrequest();
		// print_r($katalog);
		// $data 		= array();
		if(count($katalog) > 0){
			for($i=0; $i<count($katalog); $i++){
			$nestedData		= array();
			// $nestedData[] 	= $katalog[$i]["id_news"];
				$nestedData[] 	= $katalog[$i]["name"];
				$nestedData[] 	= $katalog[$i]["descripsi"];
				$nestedData[] 	= $katalog[$i]["poin"];
				$nestedData[] 	= $katalog[$i]["prize_code"];
				$nestedData[] 	= $katalog[$i]["harga"];
				$nestedData[] 	= $katalog[$i]["jumlah"];
				$nestedData[] 	= $katalog[$i]["aktive"];
				$nestedData[] 	= $katalog[$i]["date_created"];
				if($this->session->userdata['user_data']['role'] == 1 or $this->session->userdata['user_data']['id'] == 2){
					$nestedData[] 	= '<a href="'.$this->config->item('base_url').'katalog/update/'.$katalog[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'katalog/delete/'.$katalog[$i]["id"].'" class="fa fa-fw fa-trash" data-confirm="Are you sure you want to Delete this data?">&nbsp;</a>';
					$data[] = $nestedData;
				}else if($this->session->userdata['user_data']['role'] == 2){
					$nestedData[] 	= '<a href="'.$this->config->item('base_url').'katalog/update/'.$katalog[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'katalog/delete/'.$katalog[$i]["id"].'" class="fa fa-fw fa-trash" data-confirm="Are you sure you want to Delete this data?">&nbsp;</a>';
					$data[] = $nestedData;
				}else if($this->session->userdata['user_data']['role'] == 3){


					$nestedData[] 	= '<a href="'.$this->config->item('base_url').'katalog/update/'.$katalog[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>';
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
		$parseData ['content']			= $this->load->view ( 'content/katalog_create', '', true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	}
	public function update($id)
	{
		$data['id']						= ($id != '' && is_numeric($id))? $id:0;
		$data['category']				= $this->katalog_model->select_katalog($data['id'], '');
		//print_r($data['category']);
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/katalog_update', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	}
	public function action_update()
	{
		$data['id']			= ($this->input->get_post('id'))?$this->input->get_post('id'):'';
		$data['descripsi']		= ($this->input->get_post('descripsi'))?$this->input->get_post('descripsi'):'';
		$data['name']		= ($this->input->get_post('name')) ? $this->input->get_post('name') : '';
		$data['poin']		= ($this->input->get_post('poin')) ? $this->input->get_post('poin') : '';
		$data['harga']		= ($this->input->get_post('harga')) ? $this->input->get_post('harga') : '';
		$data['jumlah']		= ($this->input->get_post('jumlah')) ? $this->input->get_post('jumlah') : '';
		$data['prize_code']		= ($this->input->get_post('prize_code')) ? $this->input->get_post('prize_code') : '';
		if(!empty($this->input->get_post('picture'))){
			$data['picture']		= ($this->input->get_post('picture')) ? $this->input->get_post('picture') : '';
		}
		$data['aktive']		=  $this->input->get_post('aktive') ;
		// print_r($data);
		// die();
		$this->form_validation->set_rules('name', 'name', 'required');
		if ($this->form_validation->run() == TRUE){
			$loyaltypoin	= $this->katalog_model->select_katalog('', $data['name']);
			// if(count($loyaltypoin) > 0){
			// $this->session->set_flashdata('msgalert', 'Update data Failed, loyaltypoin already exists');
			// header("location: ".$this->config->item('base_url'). "loyaltypoin/update/".$data['id']);
			// die;
			// }else{
				$field 	= $data;
				$update_province	= $this->crud_model->update("g_katalog", $field, $data['id']);
				$this->session->set_flashdata('msgalert', 'Update success');
				header("location: ".$this->config->item('base_url')."katalog");
				die;
			// }
		}else{
		$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
		header("location: ".$this->config->item('base_url'). "katalog/update/".$data['id']);
		die;
		}
	}
	public function action_create()
	{
		$data['id']			= ($this->input->get_post('id')) ? $this->input->get_post('id') : '';
		$data['descripsi']		= ($this->input->get_post('descripsi')) ? $this->input->get_post('descripsi') : '';
		$data['name']		= ($this->input->get_post('name')) ? $this->input->get_post('name') : '';
		$data['poin']		= ($this->input->get_post('poin')) ? $this->input->get_post('poin') : '';
		$data['harga']		= ($this->input->get_post('harga')) ? $this->input->get_post('harga') : '';
		$data['jumlah']		= ($this->input->get_post('jumlah')) ? $this->input->get_post('jumlah') : '';
		$data['picture']		= ($this->input->get_post('picture')) ? $this->input->get_post('picture') : '';
		$data['prize_code']		= ($this->input->get_post('prize_code')) ? $this->input->get_post('prize_code') : '';
		$data['aktive']		=  $this->input->get_post('aktive');
		$this->form_validation->set_rules('name', 'name', 'required');
		if ($this->form_validation->run() == TRUE){
			$category	= $this->katalog_model->select_katalog('', $data['name']);
			if(count($category) > 0){
			$this->session->set_flashdata('msgalert', 'Insert data Failed, katalog already exists');
			header("location: ".$this->config->item('base_url')."katalog/create");
			die;
			}else{
				$field 		= $data;
				$create_admin	= $this->crud_model->create("g_katalog", $field);
				if($create_admin){
				$this->session->set_flashdata('msgalert', 'Insert data Success');
				header("location: ".$this->config->item('base_url'). "katalog");
				die;
				}else{
				$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
				header("location: ".$this->config->item('base_url'). "katalog/create");
				die;
				}
			}
		}else{
		$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
		header("location: ".$this->config->item('base_url'). "katalog/create");
		die;
		}
	}
	public function delete($id)
	{
		$data['id']	= ($id != '' && is_numeric($id))? $id:0;
		$delete_admin	= $this->crud_model->delete("g_katalog", array("id" => $id));
		if($delete_admin){
		$this->session->set_flashdata('msgalert', 'Delete data Success');
			header("location: ".$this->config->item('base_url'). "katalog");
			die;
		}else{
		$this->session->set_flashdata('msgalert', 'Delete data Failed, please try again');
			header("location: ".$this->config->item('base_url')."katalog");
			die;
		}

	}
}
