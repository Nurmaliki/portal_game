<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends MY_Controller {

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
	$this->load->model ('role_model');
	$this->load->model ('program_model');
	$this->load->model ('merchant_model');
	$this->load->model ('crud_model');
	$this->load->library('excel');
	}
	public function index()
	{
	$parseData ['header']			= $this->load->view ( 'header', '', true);
	$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
	$parseData ['content']			= $this->load->view ( 'content/role', '', true);
	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
	$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	$this->load->view ( 'vside', $parseData);
	}
	public function datatables()
	{
		$role					= $this->role_model->get_role();
		$get_Totalrequest		= $this->role_model->get_Totalrequest();
		$data 		= array();
		if(count($role) > 0){
			for($i=0; $i<count($role); $i++){
			$nestedData		= array();
			$nestedData[] 	= $role[$i]["description"];
			$nestedData[] 	= $role[$i]["transcode"];
			$nestedData[] 	= $role[$i]["point"];
			$nestedData[] 	= number_format( $role[$i]["min_amount"],0,',','.');
			$nestedData[] 	= number_format( $role[$i]["nominal"],0,',','.');
			$nestedData[] 	= $role[$i]["rule_code"];
			// $nestedData[] 	= $role[$i]["rule_type"];
			// $nestedData[] 	= $role[$i]["rule_expire"];
			// $nestedData[] 	= $role[$i]["rule_expire_type"];
			$nestedData[] 	= $role[$i]["date_created"];
				if($this->session->userdata['user_data_web']['role'] == 1 or $this->session->userdata['user_data_web']['id'] == 2){
					$nestedData[] 	= '<a href="'.$this->config->item('base_url').'role/update/'.$role[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'role/delete/'.$role[$i]["id"].'" class="fa fa-fw fa-trash" data-confirm="Are you sure you want to Delete this data?">&nbsp;</a>';
				}else if($this->session->userdata['user_data_web']['role'] == 2){
					$nestedData[] 	= '<a href="'.$this->config->item('base_url').'role/update/'.$role[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'role/delete/'.$role[$i]["id"].'" class="fa fa-fw fa-trash" data-confirm="Are you sure you want to Delete this data?">&nbsp;</a>';
				}else if($this->session->userdata['user_data_web']['role'] == 3){
					$nestedData[] 	= '<a href="'.$this->config->item('base_url').'role/update/'.$role[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>';
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
		$data['program']				= $this->program_model->select_program();
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/role_create', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	}
	public function update($id)
	{
		$data['program']				= $this->program_model->select_program();
		$data['role']					= $this->role_model->select_role($id);
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/role_update', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	}
	public function action_update()
	{
		$data['program_id']		= ($this->input->get_post('program_id'))?$this->input->get_post('program_id'):'';
		$data['transcode']		= ($this->input->get_post('transcode'))?$this->input->get_post('transcode'):'';
		$data['point']			= ($this->input->get_post('point'))?$this->input->get_post('point'):'';
		$data['nominal']			= ($this->input->get_post('nominal'))?$this->input->get_post('nominal'):'';
		$data['rule_expire']	= ($this->input->get_post('rule_expire'))?$this->input->get_post('rule_expire'):'';
		$data['rule_expire_type']	= ($this->input->get_post('rule_expire_type'))?$this->input->get_post('rule_expire_type'):'';
		$data['rule_type']		= ($this->input->get_post('rule_type'))?$this->input->get_post('rule_type'):'';
		$data['id']				= ($this->input->get_post('id'))?$this->input->get_post('id'):'';
        $data['rule_code'] 	= ($this->input->get_post('rule_code'))?$this->input->get_post('rule_code'):'';
		$data['description'] 	= ($this->input->get_post('description'))?$this->input->get_post('description'):'';
		$data['min_amount'] 	= ($this->input->get_post('min_amount'))?$this->input->get_post('min_amount'):'';
		$data['kelipatan'] 		= ($this->input->get_post('kelipatan'))?$this->input->get_post('kelipatan'):'';
		if($data['kelipatan'] == 1){
			$data['nominal_kelipatan'] 	= ($this->input->get_post('nominal_kelipatan'))?$this->input->get_post('nominal_kelipatan'):'';
			$data['max_poin'] 		= ($this->input->get_post('max_poin'))?$this->input->get_post('max_poin'):'';

		}else{
			$data['nominal_kelipatan'] 	= "";
			$data['max_poin'] 			= "";
		}


		$this->form_validation->set_rules('transcode', 'transcode', 'required');
		// $this->form_validation->set_rules('point', 'point', 'required');
		// $this->form_validation->set_rules('nominal', 'nominal', 'required');
		// $this->form_validation->set_rules('rule_expire', 'rule_expire', 'required');
		// $this->form_validation->set_rules('rule_expire_type', 'rule_expire_type', 'required');
		// $this->form_validation->set_rules('id', 'id', 'required');
		// $this->form_validation->set_rules('description', 'description', 'required');
		// $this->form_validation->set_rules('rule_code', 'rule_code', 'required');
		// $this->form_validation->set_rules('program_id', 'program_id', 'required');
		if ($this->form_validation->run() == TRUE){
			$rule_code=$data['rule_code'] ;
						//$rule_expire_type 	= '';
						// $rule_code			= '';
						// if($data['rule_type'] == 'feeder_daily'){
						// //$rule_expire_type 	= 'day';
						// $rule_code			= 'FD-'.$this->rand_numeric(13);
						// }elseif($data['rule_type'] == 'feeder_monthly'){
						// //$rule_expire_type 	= 'monthly';
						// $rule_code			= 'FD-'.$this->rand_numeric(13);
						// }else if($data['rule_type'] == 'event_special'){
						// //$rule_expire_type 	= 'special';
						// $rule_code			= 'EV-'.$this->rand_numeric(13);
						// }else if($data['rule_type'] == 'event_other'){
						// //$rule_expire_type 	= 'other';
						// $rule_code			= 'EV-'.$this->rand_numeric(13);
						// }
						$field 		= array(
						"program_id"				=> $data['program_id'],
						"transcode" 				=> $data['transcode'],
						"point" 						=> $data['point'],
						"nominal" 					=> str_replace(',', '', str_replace('.','', $data['nominal_kelipatan'])) ,
						// "rule_expire" 			=> $data['rule_expire'],
						"rule_type" 				=> $data['rule_type'],
						"rule_expire_type"	=> $data['rule_expire_type'],//$rule_expire_type,
            "rule_code"					=> $rule_code,
						"description" 			=> $data['description'],
						"min_amount"				=> str_replace(',', '', str_replace('.','', $data['min_amount'])),
            "kelipatan"					=> $data['kelipatan'],
            "nominal_kelipatan"	=> str_replace(',', '', str_replace('.','', $data['nominal_kelipatan'])),
            "max_poin"					=> str_replace(',', '', str_replace('.','', $data['max_poin'])),
						);


				$update_role	= $this->crud_model->update("M_rules", $field, $data['id']);
				if($update_role){
					$this->session->set_flashdata('ruleTrue', 'Update data Success');
					header("location: ".$this->config->item('base_url')."role");
					die;
				}else{
					$this->session->set_flashdata('ruleFalse', 'Update data Failed, please try again');
					header("location: ".$this->config->item('base_url')."role/update/".$data['id']);
					die;
				}
		}else{
			$this->session->set_flashdata('ruleFalse', 'Insert data Failed, please try again');
			header("location: ".$this->config->item('base_url')."role/update/".$data['id']);
			die;
		}
	}
	public function action_create()
	{
		$data['program_id']		= ($this->input->get_post('program_id'))?$this->input->get_post('program_id'):'';
		$data['transcode']		= ($this->input->get_post('transcode'))?$this->input->get_post('transcode'):'';
		$data['point']			= ($this->input->get_post('point'))?$this->input->get_post('point'):'';
		$data['nominal']		= ($this->input->get_post('nominal'))?$this->input->get_post('nominal'):'';
		$data['rule_expire']	= ($this->input->get_post('rule_expire'))?$this->input->get_post('rule_expire'):'';
		$data['rule_type']		= ($this->input->get_post('rule_type'))?$this->input->get_post('rule_type'):'';
		$data['rule_expire_type']	= ($this->input->get_post('rule_expire_type'))?$this->input->get_post('rule_expire_type'):'';

        $data['rule_code'] 		= ($this->input->get_post('rule_code'))?$this->input->get_post('rule_code'):'';
		$data['description'] 	= ($this->input->get_post('description'))?$this->input->get_post('description'):'';
		$data['min_amount'] 	= ($this->input->get_post('min_amount'))?$this->input->get_post('min_amount'):'';
		$data['kelipatan'] 		= ($this->input->get_post('kelipatan'))?$this->input->get_post('kelipatan'):'';
		if($data['kelipatan'] == 1){
			$data['nominal_kelipatan'] 	= ($this->input->get_post('nominal_kelipatan'))?$this->input->get_post('nominal_kelipatan'):'';
			$data['max_poin'] 		= ($this->input->get_post('max_poin'))?$this->input->get_post('max_poin'):'';

		}else{
			$data['nominal_kelipatan'] 	= "";
			$data['max_poin'] 			= "";
		}

		// print_r($data);
		// die();
		$this->session->set_flashdata('faild', $data);
		// print_r($data);
		// $this->form_validation->set_rules('program_id','transcode','point','nominal','rule_expire','rule_type','rule_expire_type','rule_code','description',  'required');
		$this->form_validation->set_rules('program_id', 'program_id', 'required');
		// $this->form_validation->set_rules('transcode', 'transcode', 'required');
		// $this->form_validation->set_rules('point', 'point', 'required');
		// $this->form_validation->set_rules('nominal', 'nominal', 'required');
		// $this->form_validation->set_rules('rule_expire', 'rule_expire', 'required');
		// $this->form_validation->set_rules('rule_type', 'rule_type', 'required');
		// $this->form_validation->set_rules('rule_expire_type', 'rule_expire_type', 'required');
		// $this->form_validation->set_rules('rule_code', 'rule_code', 'required');
		// $this->form_validation->set_rules('description', 'description', 'required');
		// $this->form_validation->set_rules('min_amount', 'min_amount', 'required');
		// $this->form_validation->set_rules('kelipatan', 'kelipatan', 'required');
		// $this->form_validation->set_rules('nominal_kelipatan', 'nominal_kelipatan', 'required');
		// $this->form_validation->set_rules('max_poin', 'max_poin', 'required');



		if ($this->form_validation->run() == TRUE){
					$rule_code = $data['rule_code'] ;

						$field 		= array(
						"program_id"		=> $data['program_id'],
						"transcode" 		=> $data['transcode'],
						"nominal" 			=> str_replace(',', '', str_replace('.','', $data['nominal_kelipatan'])),
						"point" 			=> $data['point'],
						"rule_expire" 		=> $data['rule_expire'],
						"rule_type" 		=> $data['rule_type'],
						//"rule_expire_type"	=> $rule_expire_type,
						"rule_expire_type"	=> $data['rule_expire_type'],
                        "rule_code"			=> $rule_code,
                        "description"		=> $data['description'],
                        "min_amount"		=> str_replace(',', '', str_replace('.','', $data['min_amount'])),
                        "kelipatan"			=> $data['kelipatan'],
                        "nominal_kelipatan"	=> str_replace(',', '', str_replace('.','', $data['nominal_kelipatan'])),
                        "max_poin"			=> str_replace(',', '', str_replace('.','', $data['max_poin'])),
						"date_created"		=> date('Y-m-d H:i:s')
						);
					$this->crud_model->create("M_rules", $field);
			$this->session->set_flashdata('ruleTrue', 'Insert data Success');
			header("location: ".$this->config->item('base_url')."role");
			die;
		}else{
		$this->session->set_flashdata('ruleFalse', 'Insert data Failed, please try again');
		header("location: ".$this->config->item('base_url')."role/create");
		die;
		}
	}
	public function delete($id)
	{
		$data['id']	= ($id != '' && is_numeric($id))? $id:0;
		$delete_redeem	= $this->crud_model->delete("M_rules", array("id" => $id));
		if($delete_redeem){
		$this->session->set_flashdata('ruleTrue', 'Delete data Success');
		header("location: ".$this->config->item('base_url')."role");
		die;
		}else{
		$this->session->set_flashdata('ruleFalse', 'Delete data Failed, please try again');
		header("location: ".$this->config->item('base_url')."role");
		die;
		}

	}
	private function rand_numeric($digit){
		$digits_needed=8;
		$random_number=''; // set up a blank string

		$count=0;

		while ( $count < $digit ) {
		    $random_digit = mt_rand(0, 9);

		    $random_number .= $random_digit;
		    $count++;
		}
	return $random_number;
	}
	public function download_role(){
		$role					= $this->role_model->get_role_all();






		// $data['report']					= json_decode($report);
		$this->excel->getProperties()->setCreator("Report_Redeem");
		$this->excel->getProperties()->setLastModifiedBy("Report");
		$this->excel->getProperties()->setTitle("Report_Redeem".date('Y-m-d'));
		$this->excel->getProperties()->setSubject("Report_Redeem".date('Y-m-d'));
		$this->excel->getProperties()->setDescription("Report redeem Generate at ".date('Y-m-d'));
			$styleArray = array(
			'borders' => array(
				'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
				)
			)
			);
			// $merchant				= $this->merchant_model->select_merchant();
			$titleWS = 'report Role';
			// if(count($merchant) > 0){
			// 	for($i=0; $i<count($merchant); $i++){
			// 		if ($merchant[$i]['id'] == $data['merchant_id']){
			// 			//echo '<h2>'.$program[$i]['program_name'].' Exchange report</h2><br>';
			// 			$titleWS = $merchant[$i]['name'];
			// 		}

			// 	}
			// }
			//$titleWS = ''.$data['merchant_id'];
			$WS1 = $this->excel->createSheet(0);
				// if($data['target'] == 'internal'){
				$WS1->setCellValue('A1', 'Report Rule')
					->setCellValue('A2', 'Id')
					->setCellValue('B2', 'Program Id')
					->setCellValue('C2', 'Program Name')
					->setCellValue('D2', 'Transcode')
					->setCellValue('E2', 'Point')
					->setCellValue('F2', 'Nominal')
					->setCellValue('G2', 'Rule Code')
					->setCellValue('H2', 'Rule Type')
					->setCellValue('I2', 'Rule Expire')
					->setCellValue('J2', 'Rule Expire Type')
					->setCellValue('K2', 'Description')
					->setCellValue('L2', 'Date Created')
					;
				// }else{
				// $WS1->setCellValue('A1',   $titleWS .' Redeen Report')
				// 	->setCellValue('A2', 'HP')
				// 	->setCellValue('B2', 'Email')
				// 	->setCellValue('C2', 'Redeem Point')
				// 	->setCellValue('D2', 'Program name')
				// 	->setCellValue('E2', 'Redeem Date')
				// 	;
				// }



				// if(count($role) > 0){
				// 	for($i=0; $i<count($role); $i++){
				// 	$nestedData		= array();
				// 	$nestedData[] 	= $role[$i]["program_name"];
				// 	$nestedData[] 	= $role[$i]["transcode"];
				// 	$nestedData[] 	= $role[$i]["point"];
				// 	$nestedData[] 	= $role[$i]["nominal"];
				// 	$nestedData[] 	= $role[$i]["rule_code"];
				// 	$nestedData[] 	= $role[$i]["rule_type"];
				// 	$nestedData[] 	= $role[$i]["rule_expire"];
				// 	$nestedData[] 	= $role[$i]["rule_expire_type"];
				// 	$nestedData[] 	= $role[$i]["date_created"];
				// 		if($this->session->userdata['user_data_web']['role'] == 1 or $this->session->userdata['user_data_web']['id'] == 2){
				// 			$nestedData[] 	= '<a href="'.$this->config->item('base_url').'role/update/'.$role[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'role/delete/'.$role[$i]["id"].'" class="fa fa-fw fa-trash" data-confirm="Are you sure you want to Delete this data?">&nbsp;</a>';
				// 		}else if($this->session->userdata['user_data_web']['role'] == 3){
				// 			$nestedData[] 	= '<a href="'.$this->config->item('base_url').'role/update/'.$role[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>';
				// 		}else{
				// 		$nestedData[]	= '';
				// 		}
				// 	$data[] = $nestedData;
				// 	}
				// }






			if(count($role) > 0){
				for($i=0; $i<count($role); $i++){
				// $member	= $this->member_model->select_member($report_redeem[$i]['member_id']);
				$s=$i+3;
					// if($data['target'] == 'internal'){
						$WS1->setCellValue('A'.$s,$role[$i]["id"])
							->setCellValue('B'.$s,$role[$i]["program_id"])
							->setCellValue('C'.$s,$role[$i]["program_name"])
							->setCellValue('D'.$s,$role[$i]["transcode"])
							->setCellValue('E'.$s,$role[$i]["point"])
							->setCellValue('F'.$s,$role[$i]["nominal"])
							->setCellValue('G'.$s,$role[$i]["rule_code"])
							->setCellValue('H'.$s,$role[$i]["rule_type"])
							->setCellValue('I'.$s,$role[$i]["rule_expire"])
							->setCellValue('J'.$s,$role[$i]["rule_expire_type"])
							->setCellValue('K'.$s,$role[$i]["description"])
							->setCellValue('L'.$s,$role[$i]["date_created"])
							;
					// }else{
						// $WS1->setCellValue('A'.$s, $report_redeem[$i]['phone'])
						// 	->setCellValue('B'.$s, $report_redeem[$i]['email'])
						// 	->setCellValue('C'.$s, $report_redeem[$i]['redeem_poin'])
						// 	->setCellValue('D'.$s, $titleWS)
						// 	->setCellValue('E'.$s, $report_redeem[$i]['redeem_date'])
						// 	;
					// }
				}
			}else{
				$s = 2;
			}
		$WS1->getStyle('A1:W'.$s)->applyFromArray($styleArray);
		$WS1->getStyle('V1:V'.$s)->getNumberFormat()->setFormatCode('00000000000');
		$WS1->getStyle('W1:W'.$s)->getNumberFormat()->setFormatCode('00000000000');
		$WS1->getColumnDimension("A:W")->setAutoSize(true);
		//$WS1->getColumnDimension('A1:Y'.$s)->setAutoSize(true);
		$WS1->setTitle(titleWS.'-redeem');
		$this->excel->setActiveSheetIndex(0);
		ob_end_clean();
		//$filename='Report_redeem.xls'; //save our workbook as this file name
		$filename=$titleWS.' '.date('d-m-Y').'.xls';
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
}
