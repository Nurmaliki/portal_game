<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adjust_poin extends MY_Controller {

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
	$this->load->model ('AdjustPoin_model');
	$this->load->model ('member_model');
    $this->load->model ('crud_model');
    $this->db = $this->load->database('default',TRUE);
    $this->load->model('datatables_model','DT');

	}
	public function index()
	{
		// $point					= $this->AdjustPoin_model->rulecode();
		$data['get_poin_code']				= $this->AdjustPoin_model->rulecode();

		// print_r($data['rule_code']);
		// die();
	$parseData ['header']			= $this->load->view ( 'header', '', true);
	$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
	$parseData ['content']			= $this->load->view ( 'content/adjust_poin', $data, true);
	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
	$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	$this->load->view ( 'vside', $parseData);
	}

	public function adjust_poin_member()
	{

			$parseData ['header']			= $this->load->view ( 'header', '', true);
			$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
			$parseData ['content']			= $this->load->view ( 'content/adjust_poin_member', $data, true);
			$parseData ['footer']			= $this->load->view ( 'footer', '', true);
			$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
			$this->load->view ( 'vside', $parseData);
	}
	public function show_member()
	{
		$cif  = $this->input->get_post('cif');

		// See data member
		$data_member = $this->AdjustPoin_model->get_member_by_phone($cif);

		// see poin member
		$current_point=$this->crud_model->select_rek("M_cif_map_rek",$data_member[0]['rekening']);

		$point =  array('current_point' => $current_point, );

	 echo	json_encode(array_merge($data_member[0],$point));


	}
	public function action_adjust_poin_member()
	{
			$cif  = $this->input->get_post('cif');
			$konversi = $this->input->get_post('konversi');
			$value_adjust_poin   = $this->input->get_post('value_adjust_poin');
			print_r($cif);
			$data_member = $this->AdjustPoin_model->get_member_cif_or_rek($cif);

			// cek member already
			if (count($data_member) < 1) {
				$this->session->set_flashdata('msgalert', 'Cif atau Rekening tidak terdaftar');
                    header("location: ".$this->config->item('base_url')."adjust_poin/adjust_poin_member");
                    die;
			}else{

					$data['rekening'] = $data_member[0]['rekening'];
					$data['id'] = $data_member[0]['id'];


					$point_adjust= '';
					if ($konversi == 'tambah') {
						$point_adjust .= $value_adjust_poin;
					}else{
						$point_adjust .= '-'.$value_adjust_poin;
					}


					$data['point'] = $point_adjust ;

					// Cek poin ,jika hasil min makan di tolak



					$current_point=$this->AdjustPoin_model->select_total_poin_by_cif($data_member[0]['cif']);

			        $point1=intval($data['point']);
			        $current_point=intval($current_point);
			        $point=$point1+$current_point;

					if ($point < 0) {
						// echo "Poin minus, adjust poin di tolak";
						$this->session->set_flashdata('msgalert', 'Poin minus, adjust poin di tolak');
	                    header("location: ".$this->config->item('base_url')."adjust_poin/adjust_poin_member");
	                    die;
					}else{
						// echo "Boleh adjust poin ";

						$data['rule_code'] ='add_point_manual';
						$creator_name=$this->session->userdata['user_data']['name'];
		       			$creator_id=$this->session->userdata['user_data']['id'];


					  	$field_approval_request =array(
		                "member_id" =>$data['id'],
		                "requester_id" 	=> $creator_id,
		                "requester_name" => $creator_name,
		                "status"        => 0,
		                "poin_code"     => $data['rule_code'],
		                "ACCTNO" 		=> $data['rekening'],
		                "point_adjust" 	=> $data['point'],

		            	);


					  	$request_approval	= $this->crud_model->create("M_approval_status", $field_approval_request);
		                $this->session->set_flashdata('alertSuccess', 'addjust point waiting for approval');
		                    header("location: ".$this->config->item('base_url')."adjust_poin/adjust_poin_member");
		                    die;
					}
			}
	}

	public function action_adjust_poin()
	{

		$rule_code  = $this->input->get_post('rule_code');
		$date_start = $this->input->get_post('date_start');
		$date_end   = $this->input->get_post('date_end');

							// A sample PHP Script to POST data using cURL
					// Data in JSON format

					$data = array(
					    'rule_code'  => $rule_code,
					    'date_start' => $date_start,
					    'date_end'   => $date_end
					);

					$payload = json_encode($data);

					// Prepare new cURL resource
					$ch = curl_init($this->config->item('assets_url_core').":8081/log/adjust_point_by_rule_code");
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLINFO_HEADER_OUT, true);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

					// Set HTTP Header for POST request
					curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					   "Content-Type: application/json",
						"apikey:NxoklkZDL0Cz8GrHAFYzViA8cVv16wP5" )
					);

					// Submit the POST request
					$result = curl_exec($ch);

					// Close cURL session handle
					curl_close($ch);

				// print_r($result);
				// die();

		  	$res =json_decode($result);
		  // print_r($res); die();
		  	if($res->status == 200){

		  		 $faild = array(
		            'rule_code'  => $rule_code,
		            'tanggal'    => $date_start.' sd '.$date_end,
		            'user'		 => $this->session->userdata['user_data']['name'],
		            'message'	 => $res->message.'  '.!empty($res->display_message)?$res->display_message:'',
		            'status'	 => 'Berhasil',
		            'date'		 => date("Y-m-d h:i:sa")
		        );

		        $action_insert = $this->crud_model->create("M_log_adjust_poin", $faild);
	            $this->session->set_flashdata('alertSuccess', 'Adjust poin Berhasil ');
				header("location: ".$this->config->item('base_url')."adjust_poin");
				die;


			}else{



		        $faild = array(
		            'rule_code'  => $rule_code,
		            'tanggal'    => $date_start.' sd '.$date_end,
		            'user'		 => $this->session->userdata['user_data']['name'],
		            'message'	 => !empty($res->display_message)?$res->display_message:$res->display_message[0]->msg.' '.$res->display_message[1]->msg.' '.$res->display_message[2]->msg,
		            'status'	 => 'Gagal',
		            'date'		 => date("Y-m-d h:i:sa")
		        );

		        $action_insert = $this->crud_model->create("M_log_adjust_poin", $faild);

	            $this->session->set_flashdata('msgalert', 'Gagal Adjust poin ');
				header("location: ".$this->config->item('base_url')."adjust_poin");
				die;

			}
		// }



	}
	public function datatables()
	{
	$point					= $this->AdjustPoin_model->get_adjust_poin();
	$get_Totalrequest		= $this->AdjustPoin_model->get_Totalrequest();

	$data 		= array();
		if(count($point) > 0){
			for($i=0; $i<count($point); $i++){
			$nestedData		= array();
			$nestedData[] 	= $point[$i]["rule_code"];
			$nestedData[] 	= $point[$i]["tanggal"];
			$nestedData[] 	= $point[$i]["user"];
			$nestedData[] 	= $point[$i]["message"];
			$nestedData[] 	= $point[$i]["status"];
			$nestedData[] 	= $point[$i]["date"];


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
}
