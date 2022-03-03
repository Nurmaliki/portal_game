<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends MY_Controller {

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
	$this->load->model ('email_model');
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
            $parseData ['content']			= $this->load->view ( 'content/email', '', true);
        }

        $parseData ['footer']			= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
        $this->load->view ( 'vside', $parseData);
	}
	public function datatables()
	{
        $email					= $this->email_model->get_email();
        $get_Totalrequest		= $this->email_model->get_Totalrequest();
        $data 		= array();
		if(count($email) > 0){
			for($i=0; $i<count($email); $i++){

			$nestedData		= array();

			$nestedData[] 	= $email[$i]["email"];
			$nestedData[] 	= $email[$i]["updated_date"];
			$nestedData[] 	= $email[$i]["updated_by"];


				if($this->session->userdata['user_data']['role'] == 1 or $this->session->userdata['user_data']['id'] == 2){
				$nestedData[] 	= '<a href="'.$this->config->item('base_url').'email/update/'.$email[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp</a> &nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'email/delete/'.$email[$i]["id"].'" class="fa fa-fw fa-trash" id="delete" data-confirm="Are you sure you want to Delete this data?">&nbsp;</a> ';
				$data[] = $nestedData;
				}else if($this->session->userdata['user_data']['role'] == 3){
				$nestedData[] 	= '<a href="'.$this->config->item('base_url').'email/update/'.$email[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>';
				$data[] = $nestedData;

				}else if($this->session->userdata['user_data']['role'] == 5){
					$nestedData[]	= '';
					$data[] = $nestedData;

				}else{
					$nestedData[]	= '';
					$data[] = $nestedData;

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
        $parseData ['content']			= $this->load->view ( 'content/email_create', '', true);
        $parseData ['footer']			= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
        $this->load->view ( 'vside', $parseData);
    }

	public function update($id)
	{
        $data['id']						= ($id != '' && is_numeric($id))? $id:0;
        $data['email']					= $this->email_model->select_email($data['id'], '');
        $parseData ['header']			= $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
        $parseData ['content']			= $this->load->view ( 'content/email_update', $data, true);
        $parseData ['footer']			= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
        $this->load->view ( 'vside', $parseData);
	}



	public function action_update()
	{
		$data['id']			= ($this->input->get_post('id'))?$this->input->get_post('id'):'';
        $data['email']		= ($this->input->get_post('email'))?$this->input->get_post('email'):'';


		$this->form_validation->set_rules('id', 'id', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');

		if ($this->form_validation->run() == TRUE){

				 $field 		= array(
				"email" 		=> $data['email'],
				"updated_by" 		=> $_SESSION['user_data']['name'],

				);

				$update_email	= $this->crud_model->update("M_giift_email", $field, $data['id']);

				$this->session->set_flashdata('emailTrue', 'Update success');
				header("location: ".$this->config->item('base_url')."email");
				die;

		}else{

		$this->session->set_flashdata('emailFalse', 'Insert data Failed, please try again');
		header("location: ".$this->config->item('base_url')."email/update/".$data['id']);
		die;
		}
	}


	public function action_create()
	{
        $data['email']		= ($this->input->get_post('email'))?$this->input->get_post('email'):'';


        $this->form_validation->set_rules('email', 'email', 'required');
		if ($this->form_validation->run() == TRUE){
			$email	= $this->email_model->select_email('', $data['email']);
			if(count($email) > 0){
			$this->session->set_flashdata('emailFalse', 'Insert data Failed, Email already exists');
			$this->session->set_flashdata('field', $data['email']);
			header("location: ".$this->config->item('base_url')."email/create");
			die;
			}else{

				$field 		= array(
				"email" 		=> $data['email'],
				"updated_by" 	=> $_SESSION['user_data']['name'],

				);

				$create_email	= $this->crud_model->create("M_giift_email", $field);
				if($create_email){
                    $this->session->set_flashdata('emailTrue', 'Insert data Success');
                    header("location: ".$this->config->item('base_url')."email");
                    die;
				}else{
				$this->session->set_flashdata('emailFalse', 'Insert data Failed, please try again');
				header("location: ".$this->config->item('base_url')."email/create");
				die;
				}
			}
		}else{
			$this->session->set_flashdata('emailFalse', 'Insert data Failed, please try again');
			$this->session->set_flashdata('field', $data);
            header("location: ".$this->config->item('base_url')."email/create");
            die;
		}
    }

	public function delete($id)
	{
        $data['id']	= ($id != '' && is_numeric($id))? $id:0;
        $delete_admin	= $this->crud_model->delete("M_giift_email", array("id" => $id));
		if($delete_admin){
		$this->session->set_flashdata('emailTrue', 'Delete data Success');
		header("location: ".$this->config->item('base_url')."email");
		die;
		}else{
		$this->session->set_flashdata('emailFalse', 'Delete data Failed, please try again');
		header("location: ".$this->config->item('base_url')."email");
		die;
		}

	}
}
