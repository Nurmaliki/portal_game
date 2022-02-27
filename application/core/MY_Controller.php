<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    function __construct(){
    parent::__construct();
	error_reporting(0);
	$this->load->library('session');
		if (!$this->session->userdata['user_data_web']['id'] && !$this->session->userdata['user_data_web']['username']){
		$this->session->set_userdata($data_session);	
		header("location: ".$this->config->item('base_url')."login");
		die;
		}else{
	    
		}
    }
}