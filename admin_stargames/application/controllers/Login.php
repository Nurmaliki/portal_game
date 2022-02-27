<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
    }
    
	public function index()
	{
        $parseData ['header']			= '';
        $this->load->view ( 'login', $parseData);
	}
	public function authentication(){
        $data['username']	= ($this->input->get_post('username'))?$this->input->get_post('username'):'';
        $data['password']	= sha1($this->input->get_post('password'))?sha1($this->input->get_post('password')):'';	
        $admin	= $this->admin_model->select_admin('', $data['username'], $data['password']);
        // print_r($data);
        // print_r($admin);
        
            if(count($admin) > 0){
                if($data['password'] == $admin[0]['password']){
                    $data_session['user_data']	= array(
                                                    'id'		=> $admin[0]['id'],
                                                    'email'		=> $admin[0]['username'],
                                                    'name'      => $admin[0]['name'],
                                                    'status'		=> $admin[0]['status'],
                                                    'role'		=> $admin[0]['role_id']
                                                    );
                    $feriWasHere = 60*60*24*30;//30 days
                    $this->session->sess_expiration = $feriWasHere;	
                    $this->session->set_userdata($data_session);
                    header("location: ".$this->config->item('base_url'));
                    die;
                }else{
                    $this->session->set_flashdata('msgalert', '<div id="msgalert" class="mb-2 btn btn-danger">Username or Password empty </div>');
                    header("location: ".$this->config->item('base_url')."login");
                    die;
                }
            }else{
                $this->session->set_flashdata('msgalert', '<div id="msgalert" class="bg-danger m-5 btn btn-danger">Username and password not found</div>');
                header("location: ".$this->config->item('base_url')."login");
                die;
            }
    }
    
	public function logout(){
        $data_session['user_data']	= array('id' => '', 'email'	=> '', 'name'	=> '');
        $this->session->set_userdata($data_session);
        header("location: ".$this->config->item('base_url')."login");
        die;
	}
}
