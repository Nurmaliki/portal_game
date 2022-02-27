<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sosial_media extends MY_Controller {

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
	$this->load->model ('sosial_model');
	$this->load->model ('crud_model');
	error_reporting(E_ALL);
	}
	public function index()
	{

		$data['instagram'] 				= $this->sosial_model->select_sosial(1,'')[0];
		$data['facebook'] 				= $this->sosial_model->select_sosial(2,'')[0];
		$data['twitter'] 				= $this->sosial_model->select_sosial(3,'')[0];
		$data['youtube'] 				= $this->sosial_model->select_sosial(4,'')[0];
		$data['appstore'] 				= $this->sosial_model->select_sosial(7,'')[0];
		$data['playstore'] 				= $this->sosial_model->select_sosial(8,'')[0];
		$data['telepon'] 				= $this->sosial_model->select_sosial(6,'')[0];
		$data['email'] 					= $this->sosial_model->select_sosial(5,'')[0];
		$data['ojk'] 					= $this->sosial_model->select_sosial(9,'')[0];

        $parseData ['header']			= $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
        $parseData ['content']			= $this->load->view ( 'content/setting_sosial_media', $data, true);
        $parseData ['footer']			= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
        $this->load->view ( 'vside', $parseData);
	}
	public function datatables()
	{
// echo "test";

        $data['id']						= ($id != '' && is_numeric($id))? $id:0;
        $data['admin']					= $this->admin_model->select_admin($data['id'], '');
        $parseData ['header']			= $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
        $parseData ['content']			= $this->load->view ( 'content/setting_sosial_media', $data, true);
        $parseData ['footer']			= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
        $this->load->view ( 'vside', $parseData);


    }
	public function action_update()
	{


		$data['facebook']	= ($this->input->get_post('facebook'))?$this->input->get_post('facebook'):'';
        $data['instagram']	= ($this->input->get_post('instagram'))?$this->input->get_post('instagram'):'';
        $data['twitter']	= ($this->input->get_post('twitter'))?$this->input->get_post('twitter'):'';


        $data['youtube']	= ($this->input->get_post('youtube'))?$this->input->get_post('youtube'): '';

        $data['appstore']	= ($this->input->get_post('appstore'))?$this->input->get_post('appstore'):'';
        $data['playstore']	= ($this->input->get_post('playstore'))?$this->input->get_post('playstore'):'';
        $data['telepon']	= ($this->input->get_post('telepon'))?$this->input->get_post('telepon'):'';
        $data['email']		= ($this->input->get_post('email'))?$this->input->get_post('email'):'';
        $data['ojk']		= ($this->input->get_post('ojk'))?$this->input->get_post('ojk'):'';


  //       print_r($data);
		// die();
		$this->form_validation->set_rules('ojk', 'ojk', 'required');
		// $this->form_validation->set_rules('name', 'name', 'required');
		// $this->form_validation->set_rules('username', 'username', 'required');
		// $this->form_validation->set_rules('role_id', 'role_id', 'required');
		if ($this->form_validation->run() == TRUE){

        		// update facebook

				$facebook 		= array(
					"url" 		=> $data['facebook'],
					"update_at" 	=> date('Y-m-d H:i:s'),
					"updated_by" 		=>  $this->session->userdata['user_data_web']['name'],
					);
				$update_facebook	= $this->crud_model->update("M_sosial_media", $facebook, 2);

				// Update twitter

				$twitter 		= array(
					"url" 		=> $data['twitter'],
					"update_at" 	=> date('Y-m-d H:i:s'),
					"updated_by" 		=>  $this->session->userdata['user_data_web']['name'],
					);
				$update_twitter	= $this->crud_model->update("M_sosial_media", $twitter, 3);

				// update instagram

				$instagram 		= array(
					"url" 		=> $data['instagram'],
					"update_at" 	=> date('Y-m-d H:i:s'),
					"updated_by" 		=>  $this->session->userdata['user_data_web']['name'],
					);
				$update_instagram	= $this->crud_model->update("M_sosial_media", $instagram, 1);

				// update youtube

				$youtube 		= array(
					"url" 		=> $data['youtube'],
					"update_at" 	=> date('Y-m-d H:i:s'),
					"updated_by" 		=>  $this->session->userdata['user_data_web']['name'],
					);
				$update_youtube	= $this->crud_model->update("M_sosial_media", $youtube, 4);

				// email

				$email 		= array(
					"url" 		=> $data['email'],
					"update_at" 	=> date('Y-m-d H:i:s'),
					"updated_by" 		=>  $this->session->userdata['user_data_web']['name'],
					);
				$update_email	= $this->crud_model->update("M_sosial_media", $email, 5);


				$telepon 		= array(
					"url" 		=> $data['telepon'],
					"update_at" 	=> date('Y-m-d H:i:s'),
					"updated_by" 		=>  $this->session->userdata['user_data_web']['name'],
					);
				$update_telepon	= $this->crud_model->update("M_sosial_media", $telepon, 6);

				// appstore

				$appstore 		= array(
					"url" 		=> $data['appstore'],
					"update_at" 	=> date('Y-m-d H:i:s'),
					"updated_by" 		=>  $this->session->userdata['user_data_web']['name'],
					);
				$update_appstore	= $this->crud_model->update("M_sosial_media", $appstore, 7);

				// playstore

				$playstore 		= array(
					"url" 		=> $data['playstore'],
					"update_at" 	=> date('Y-m-d H:i:s'),
					"updated_by" 		=>  $this->session->userdata['user_data_web']['name'],
					);
				$update_playstore	= $this->crud_model->update("M_sosial_media", $playstore, 8);

				$ojk 		= array(
					"url" 		=> $data['ojk'],
					"update_at" 	=> date('Y-m-d H:i:s'),
					"updated_by" 		=>  $this->session->userdata['user_data_web']['name'],
					);

				$update_ojk	= $this->crud_model->update("M_sosial_media", $ojk, 9);

				$web 		= array(
					"url" 		=> $data['ojk'],
					"update_at" 	=> date('Y-m-d H:i:s'),
					"updated_by" 		=>  $this->session->userdata['user_data_web']['name'],
					);

				$update_web	= $this->crud_model->update("M_sosial_media", $web, 10);


				$this->session->set_flashdata('sosialMediaTrue', 'Update success');
				header("location: ".$this->config->item('base_url')."sosial_media");
				die;
		}else{

		$this->session->set_flashdata('sosialMediaFalse', 'Insert data Failed, please try again');
		header("location: ".$this->config->item('base_url')."sosial_media");
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
