<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

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
	$this->load->model ('category_model');
    $this->load->model ('crud_model');
    $this->load->model ('history_model');
    $this->load->model ('member_model');
	error_reporting(E_ALL);
	}
	public function index()
	{
        $data['total_member']                   =  (int)$this->member_model->total_member()[0]['total_member'] ?? 0;
        $data['total_member_register']          =   (int)$this->member_model->total_member_register()[0]['total_member_register'] ?? 0;
        // $data['total_member']                   =   count($this->member_model->get_Totalrequest()) ?? 0;
        $data['stats_member_total_poin_daily']  =   (int)$this->history_model->get_all_poin_perday(date("Y-m-d"),date("Y-m-d"))[0]['Total'] ?? 0;

        // $data['get_poin_redeem']                =   $this->history_model->get_distribution_redeem(date("Y-m-d"),date("Y-m-d"));
        // $data['get_poin_exchange']              =   $this->history_model->get_distribution(date("Y-m-d"),date("Y-m-d"));


        $data['get_poin_redeem_day']            =   $this->history_model->get_poin_redeem_day()[0]['Total'] ?? 0;
        $data['get_poin_exchange_day']          =   $this->history_model->get_poin_exchange_day()[0]['Total'] ?? 0;  

        // print_r(json_encode($data['total_member_register']));
        print_r(json_encode($data));
	}


}
