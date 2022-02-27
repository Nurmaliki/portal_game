<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class   Programperiod extends MY_Controller {

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
	$this->load->model ('programperiode_model');
	$this->load->model ('program_model');
	$this->load->model ('crud_model');
	}
	public function index()
	{
	$parseData ['header']			= $this->load->view ( 'header', '', true);
	$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
	$parseData ['content']			= $this->load->view ( 'content/programperiode', '', true);
	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
	$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	$this->load->view ( 'vside', $parseData);
	}
	public function datatables()
	{
	$get_programperiode		= $this->programperiode_model->get_programperiode();
	$get_Totalrequest		= $this->programperiode_model->get_Totalrequest();
	// print_r($get_programperiode);
	// print_r($get_Totalrequest);
	// die();


	$data 		= array();
		if(count($get_programperiode) > 0){
			for($i=0; $i<count($get_programperiode); $i++){
			$nestedData		= array();
			$nestedData[] 	= $get_programperiode[$i]["start_date"];
			$nestedData[] 	= $get_programperiode[$i]["end_date"];
			$nestedData[] 	= $get_programperiode[$i]["last_update"];
			$nestedData[] 	= $get_programperiode[$i]["updated_by"];
				if($this->session->userdata['user_data_web']['role'] == 1 or $this->session->userdata['user_data_web']['id'] == 2){
				$nestedData[] 	= '<a href="'.$this->config->item('base_url').'programperiod/update/'.$get_programperiode[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;

				</a>&nbsp;';
				}else if($this->session->userdata['user_data_web']['role'] == 2){
				$nestedData[] 	= '<a href="'.$this->config->item('base_url').'programperiod/update/'.$get_programperiode[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;

				</a>&nbsp;';
				}else if($this->session->userdata['user_data_web']['role'] == 3){
				$nestedData[] 	= '<a href="'.$this->config->item('base_url').'programperiod/update/'.$get_programperiode[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>';
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

	public function update($id)
	{

    $data['programperiode']				= $this->programperiode_model->select_programperiode($id);


	$parseData ['header']			= $this->load->view ( 'header', '', true);
	$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
	$parseData ['content']			= $this->load->view ( 'content/programperiode_update', $data, true);
	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
	$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	$this->load->view ( 'vside', $parseData);
	}
	public function action_update()
	{
	$data['startdate']		= ($this->input->get_post('startdate'))?$this->input->get_post('startdate'):'';
	$data['enddate']		= ($this->input->get_post('enddate'))?$this->input->get_post('enddate'):'';

	$data['id']				= ($this->input->get_post('id'))?$this->input->get_post('id'):'';
	// print_r($data);
	// die();

	$this->form_validation->set_rules('startdate', 'startdate', 'required');
	$this->form_validation->set_rules('enddate', 'enddate', 'required');
		if ($this->form_validation->run() == TRUE){
			if($data['startdate'] != '' and $data['enddate'] != ''){
						$field 		= array(
						"start_date" 		=> $data['startdate'],
						"end_date" 		=> $data['enddate'],
                        "last_update" 	=> date("Y-m-d H:i:sa"),
                        "updated_by"     => $_SESSION['user_data_web']['name']
						);
				$program_period	= $this->crud_model->update("M_program_period", $field, $data['id']);
				if($program_period){
				$this->session->set_flashdata('programPeriodeTrue', 'Update data Success');
				header("location: ".$this->config->item('base_url')."programperiod");
				die; 
				}else{
				$this->session->set_flashdata('programPeriodeFalse', 'Update data Failed, please try again');
				header("location: ".$this->config->item('base_url')."programperiod/update/".$data['id']);
				die;
				}
			}else{
			$this->session->set_flashdata('programPeriodeFalse', 'Update data Failed, burn date  empty');
			header("location: ".$this->config->item('base_url')."programperiod/update/".$data['id']);
			die;
			}
		}else{
		$this->session->set_flashdata('programPeriodeFalse', 'Update data Failed, please try again');
		header("location: ".$this->config->item('base_url')."programperiod/update/".$data['id']);
		die;
		}
	}

	public function delete($id)
	{
	$data['id']	= ($id != '' && is_numeric($id))? $id:0;
	$delete_point	= $this->crud_model->delete("M_giift_point_value", array("id" => $id));
		if($delete_point){
		$this->session->set_flashdata('programPeriodeTrue', 'Delete data Success');
		header("location: ".$this->config->item('base_url')."giiftmanagement");
		die;
		}else{
		$this->session->set_flashdata('programPeriodeFalse', 'Delete data Failed, please try again');
		header("location: ".$this->config->item('base_url')."giiftmanagement");
		die;
		}

	}
}
