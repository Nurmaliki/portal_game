<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merchantgiift extends MY_Controller {

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
	$this->load->model ('merchantgiift_model');
	$this->load->model ('encription_model');
	// $this->load->model ('category_model');
	$this->load->model ('crud_model');
	// $this->load->model ('province_model');
	$this->load->library('Rapid/RapidDataModel');
	$this->load->helper(array('form', 'url'));

	}
	public function index()
	{
	$merchant['merchant']				= $this->merchantgiift_model->get_merchant_new();
	$merchant['category']				= $this->merchantgiift_model->get_category();
	// print_r($merchant);
	// die();
	$parseData ['header']			= $this->load->view ( 'header', '', true);
	$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
	$parseData ['content']			= $this->load->view ( 'content/merchantgiift2', $merchant, true);
	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
	$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	$this->load->view ( 'vside', $parseData);
	}
	public function datatables()
	{
	$merchant				= $this->merchantgiift_model->get_merchant();
	$get_Totalrequest		= $this->merchantgiift_model->get_Totalrequest();
	// print_r($merchant);
	// die();
	$data 		= array();
		if(count($merchant) > 0){
			for($i=0; $i<count($merchant); $i++){
			$nestedData		= array();
			$nestedData[] 	= $merchant[$i]["name"];
			$nestedData[] 	= $merchant[$i]["category"];
			$nestedData[] 	= number_format($merchant[$i]["value"],0,",",".");
			$nestedData[] 	= number_format($merchant[$i]["price"],0,",",".");
			$nestedData[] 	= number_format($merchant[$i]["points"],0,",",".");
			// $nestedData[] 	= $merchant[$i]["address"].', '.$merchant[$i]["pname"];
				if($this->session->userdata['user_data']['role'] == 1 or $this->session->userdata['user_data']['id'] == 2){
				$nestedData[] 	= '<a href="'.$this->config->item('base_url').'merchantgiift/detail/'.$merchant[$i]["id"].'" class="fa fa-fw fa-eye">&nbsp;';


				}else if($this->session->userdata['user_data']['role'] == 3){
				// $nestedData[] 	= '<a href="'.$this->config->item('base_url').'merchant/update/'.$merchant[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>';
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
	public function detail($id='', $type='')
	{
	$data['merchantgiift']				= $this->merchantgiift_model->select_merchant_new($id,$type);

	$parseData ['header']			= $this->load->view ( 'header', '', true);
	$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
	$parseData ['content']			= $this->load->view ( 'content/merchantgiift_detail', $data, true);
	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
	$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	$this->load->view ( 'vside', $parseData);
	// print_r($merchant);

	}

	public function update($id='', $type='')
	{
	$data['merchantgiift']			= $this->merchantgiift_model->select_merchant_btn($id,$type);
	if(count($data['merchantgiift']) > 0){
		$data['category']				= $this->merchantgiift_model->get_category();
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/merchantgiift_update', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	} else {
		$parseData ['heading'] = "Data not found";
		$parseData ['message'] = "Data not found or cannot be edited";
		$this->load->view ( 'errors/html/error_404', $parseData);
	}
	}

	public function sync_giift_list($id='')
	{

		$curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "".$this->config->item('assets_url_core').":8081/redeem/get_giift_list",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            // CURLOPT_POSTFIELDS => json_encode(),
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
                // "x-api-token:53FC78B2C7EC5D03F4FC7A3917F5AEB2",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            $this->session->set_flashdata('merchantGiiftFalse', "cURL Error #:" .  $err);
        		redirect("merchantgiift?failed");
        } else {

        	$res=json_decode($response);

        	$this->load->helper("url");

        	if ($res->status == 200) {
        		$this->session->set_flashdata('merchantGiiftTrue', 'Update merchants success ');
        		redirect("merchantgiift?success");

        	}else{
        		$this->session->set_flashdata('merchantGiiftFalse', 'Update merchants failed ('. $res->display_message.')');
        		redirect("merchantgiift?failed");

        	}

        }





	}

















}
