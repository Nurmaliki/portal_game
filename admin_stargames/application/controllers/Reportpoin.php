<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class   Reportpoin extends MY_Controller {

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
	$this->load->model ('reportpoin_model');
	$this->load->model ('program_model');
    $this->load->model ('crud_model');
	$this->load->library('excel');
    
	}
	public function index()
	{
	// $get_reportpoin["get_reportpoin"]			= $this->reportpoin_model->get_reportpoin();
 //    print_r($get_reportpoin["get_reportpoin"]);
 //    die();
	$parseData ['header']			= $this->load->view ( 'header', '', true);
	$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
	$parseData ['content']			= $this->load->view ( 'content/reportpoin', $get_reportpoin, true);
	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
	$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	$this->load->view ( 'vside', $parseData);
	}
	public function datatables()
	{
       
	$get_reportpoin["get_reportpoin"]			= $this->reportpoin_model->get_reportpoin();
    $parseData ['header']			= $this->load->view ( 'header', '', true);
	$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
	$parseData ['content']			= $this->load->view ( 'content/reportpoin', $get_reportpoin, true);
	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
	$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	$this->load->view ( 'vside', $parseData);
        


    }
    public function download()
    {
    	
        $get_reportpoin =   $this->reportpoin_model->get_reportpoin2();

    
        die();


    }
	

}
