<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class   Burndate extends MY_Controller {

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
	$this->load->model ('burndate_model');
	$this->load->model ('program_model');
	$this->load->model ('crud_model');
	}
	public function index()
	{
	$parseData ['header']			= $this->load->view ( 'header', '', true);
	$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
	$parseData ['content']			= $this->load->view ( 'content/burndate', '', true);
	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
	$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	$this->load->view ( 'vside', $parseData);
	}
	public function datatables()
	{
	$get_burndate			= $this->burndate_model->get_burndate();
    $get_Totalrequest		= $this->burndate_model->get_Totalrequest();


	$data 		= array();
		if(count($get_burndate) > 0){
			for($i=0; $i<count($get_burndate); $i++){
			$nestedData		= array();
			$nestedData[] 	= $get_burndate[$i]["burn_date"];
			$nestedData[] 	= $get_burndate[$i]["last_update"];
			$nestedData[] 	= $get_burndate[$i]["updated_by"];
				if($this->session->userdata['user_data']['role'] == 1 or $this->session->userdata['user_data']['id'] == 2){
				$nestedData[] 	= '<a href="'.$this->config->item('base_url').'burndate/update/'.$get_burndate[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;

				</a>&nbsp;';
				}else if($this->session->userdata['user_data']['role'] == 2){
				$nestedData[] 	= '<a href="'.$this->config->item('base_url').'burndate/update/'.$get_burndate[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;

				</a>&nbsp;';
				}else if($this->session->userdata['user_data']['role'] == 3){
				$nestedData[] 	= '<a href="'.$this->config->item('base_url').'burndate/update/'.$get_burndate[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>';
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

    $data['burndate']				= $this->burndate_model->select_burndate($id);


	$parseData ['header']			= $this->load->view ( 'header', '', true);
	$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
	$parseData ['content']			= $this->load->view ( 'content/burndate_update', $data, true);
	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
	$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	$this->load->view ( 'vside', $parseData);
	}
	public function action_update()
	{
	$data['burndate']		= ($this->input->get_post('burndate'))?$this->input->get_post('burndate'):'';

    $data['id']				= ($this->input->get_post('id'))?$this->input->get_post('id'):'';

	$this->form_validation->set_rules('burndate', 'burndate', 'required');
		if ($this->form_validation->run() == TRUE){
			if($data['burndate'] != ''){
						$field 		= array(
						"burn_date" 		=> $data['burndate'],
                        "last_update" 	=> date("Y-m-d H:i:sa"),
                        "updated_by"     => $_SESSION['user_data']['name']
						);
						// print_r($field);
						// die();

				$update_burndate	= $this->crud_model->update("M_burn_date", $field, $data['id']);
				if($update_burndate){
				$this->session->set_flashdata('burnDateTrue', 'Update data Success');
				header("location: ".$this->config->item('base_url')."burndate");
				die;
				}else{
				$this->session->set_flashdata('burnDateFalse', 'Update data Failed, please try again');
				header("location: ".$this->config->item('base_url')."burndate/update/".$data['id']);
				die;
				}
			}else{
			$this->session->set_flashdata('burnDateFalse', 'Update data Failed, burn date  empty');
			header("location: ".$this->config->item('base_url')."burndate/update/".$data['id']);
			die;
			}
		}else{
		$this->session->set_flashdata('burnDateFalse', 'Update data Failed, please try again');
		header("location: ".$this->config->item('base_url')."burndate/update/".$data['id']);
		die;
		}
	}

	public function delete($id)
	{
	$data['id']	= ($id != '' && is_numeric($id))? $id:0;
	$delete_point	= $this->crud_model->delete("M_giift_point_value", array("id" => $id));
		if($delete_point){
		$this->session->set_flashdata('burnDateTrue', 'Delete data Success'); 
		header("location: ".$this->config->item('base_url')."giiftmanagement");
		die;
		}else{
		$this->session->set_flashdata('burnDateFalse', 'Delete data Failed, please try again');
		header("location: ".$this->config->item('base_url')."giiftmanagement");
		die;
		}

	}
}
