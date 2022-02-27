<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

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
	$this->load->model ('admin_model');
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
            $parseData ['content']			= $this->load->view ( 'content/admin', '', true);
        }

        $parseData ['footer']			= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
        $this->load->view ( 'vside', $parseData);
	}
	
	public function datatables()
	{
        $admin					= $this->admin_model->get_admin();
        $get_Totalrequest		= $this->admin_model->get_Totalrequest();
        $data 		= array();
		if(count($admin) > 0){
			for($i=0; $i<count($admin); $i++){
			$role 			= '';
				if($admin[$i]["role_id"] == 1){
				$role 		= 'Administrator';
				}else if($admin[$i]["role_id"] == 2){
				$role 		= 'Operation';
				}else if($admin[$i]["role_id"] == 3){
				$role 		= 'User';
				}else if($admin[$i]["role_id"] == 5){
					$role 		= 'Admin Bisnis';
				}else if($admin[$i]["role_id"] == 4){
				$role 		= 'Manager';
				}
			$nestedData		= array();
			$nestedData[] 	= $admin[$i]["name"];
			$nestedData[] 	= $admin[$i]["username"];
			// $nestedData[] 	= $admin[$i]["status"];
			$nestedData[] 	= $role;
			if ($admin[$i]["status"] == "1") {
				$nestedData[] 	= "<span class='badge bg-green' style='background:rgb(40,220,20) !important;'>Aktif </span>";
			}else{
				$nestedData[] 	= "<span title='Jika status admin tidak aktif, admin tidak mempunyai hak akses ke halaman manapun' class='badge bg-red'> Tidak Aktif </span>";
			}
			// $nestedData[] 	= $admin[$i]["password"];
				if($this->session->userdata['user_data_web']['role'] == 1 or $this->session->userdata['user_data_web']['id'] == 2){
				$nestedData[] 	= '<a href="'.$this->config->item('base_url').'admin/update/'.$admin[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp</a>';
				$data[] = $nestedData;
				}else if($this->session->userdata['user_data_web']['role'] == 2){
					$nestedData[] 	= '<a href="'.$this->config->item('base_url').'admin/update/'.$admin[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp</a>';
				$data[] = $nestedData;
				}else if($this->session->userdata['user_data_web']['role'] == 3){
					$nestedData[] 	= '<a href="'.$this->config->item('base_url').'admin/update/'.$admin[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp</a>';
				}else if($this->session->userdata['user_data_web']['role'] == 5){
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
        $parseData ['content']			= $this->load->view ( 'content/admin_create', '', true);
        $parseData ['footer']			= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
        $this->load->view ( 'vside', $parseData);
    }

	public function update($id)
	{
        $data['id']						= ($id != '' && is_numeric($id))? $id:0;
        $data['admin']					= $this->admin_model->select_admin($data['id'], '');
        $parseData ['header']			= $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
        $parseData ['content']			= $this->load->view ( 'content/admin_update', $data, true);
        $parseData ['footer']			= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
        $this->load->view ( 'vside', $parseData);
	}



	public function action_update()
	{
		$data['id']			= ($this->input->get_post('id'))?$this->input->get_post('id'):'';
        $data['name']		= ($this->input->get_post('name'))?$this->input->get_post('name'):'';
        $data['username']	= ($this->input->get_post('username'))?$this->input->get_post('username'):'';
        if (!empty($this->input->get_post('password'))) {
        	$data['password']	= sha1($this->input->get_post('password'))?sha1($this->input->get_post('password')):'';
        }
        $data['status']	= $this->input->get_post('status')?$this->input->get_post('status'): 0;
        $data['role_id']	= ($this->input->get_post('role_id'))?$this->input->get_post('role_id'):'';
		$this->form_validation->set_rules('id', 'id', 'required');
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('username', 'username', 'required');
		// $this->form_validation->set_rules('password', 'password', '');
		$this->form_validation->set_rules('role_id', 'role_id', 'required');
		if ($this->form_validation->run() == TRUE){
			// $admin	= $this->admin_model->select_admin('', $data['name']);
			// if(count($admin) > 0){
			// $this->session->set_flashdata('msgalert', 'Update data Failed, admin already exists');
			// header("location: ".$this->config->item('base_url')."admin");
			// die;
			// }else{
				// $field 	= array("name" => $data['name']);
        	if (!empty($this->input->get_post('password'))) {
				$field 		= array(
					"username" 		=> $data['username'],
					"password" 		=> $data['password'],
					"name" 			=> $data['name'],
					"status" 			=> $data['status'] ?? 0,
					"role_id" 		=> $data['role_id']
					);
			}else{
				$field 		= array(
					"username" 		=> $data['username'],
					"name" 			=> $data['name'],
					"status" 			=> $data['status'] ?? 0,
					"role_id" 		=> $data['role_id']
					);
			}
				$update_admin	= $this->crud_model->update("M_admin", $field, $data['id']);

				$this->session->set_flashdata('msgalert', 'Update success');
				header("location: ".$this->config->item('base_url')."admin");
				die;
			// }
		}else{

		$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
		header("location: ".$this->config->item('base_url')."admin/update/".$data['id']);
		die;
		}
	}


	public function action_create()
	{
        $data['name']		= ($this->input->get_post('name'))?$this->input->get_post('name'):'';
        $data['username']	= ($this->input->get_post('username'))?$this->input->get_post('username'):'';
        //$password = sha1($this->input->post('password'));

        $data['password']	= sha1($this->input->get_post('password'))?sha1($this->input->get_post('password')):'';
		$data['role_id']	= ($this->input->get_post('role_id'))?$this->input->get_post('role_id'):'';
		$this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
		if ($this->form_validation->run() == TRUE){
			$admin	= $this->admin_model->select_admin('', $data['username']);
			if(count($admin) > 0){
			$this->session->set_flashdata('msgalert', 'Insert data Failed, Username already exists');
			header("location: ".$this->config->item('base_url')."admin/create");
			die;
			}else{
				$field 		= array(
				"username" 		=> $data['username'],
				"password" 		=> $data['password'],
				"name" 			=> $data['name'],
				"status" => 0,
				"role_id" 		=> $data['role_id']
				);
				$create_admin	= $this->crud_model->create("M_admin", $field);
				if($create_admin){
                    $this->session->set_flashdata('msgalert', 'Insert data Success');
                    header("location: ".$this->config->item('base_url')."admin");
                    die;
				}else{
				$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
				header("location: ".$this->config->item('base_url')."admin/create");
				die;
				}
			}
		}else{
			$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
			$this->session->set_flashdata('field', $data);
            header("location: ".$this->config->item('base_url')."admin/create");
            die;
		}
    }

	public function delete($id)
	{
        $data['id']	= ($id != '' && is_numeric($id))? $id:0;
        $delete_admin	= $this->crud_model->delete("M_admin", array("id" => $id));
		if($delete_admin){
		$this->session->set_flashdata('msgalert', 'Delete data Success');
		header("location: ".$this->config->item('base_url')."admin");
		die;
		}else{
		$this->session->set_flashdata('msgalert', 'Delete data Failed, please try again');
		header("location: ".$this->config->item('base_url')."admin");
		die;
		}

	}
}
