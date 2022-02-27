<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rule_new extends MY_Controller {

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
	$this->load->model ('rule_new_model');
	$this->load->model ('program_model');
	$this->load->model ('merchant_model');
	$this->load->model ('crud_model');
	$this->load->library('excel');
	}
	public function index()
	{
	$parseData ['header']			= $this->load->view ( 'header', '', true);
	$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
	$parseData ['content']			= $this->load->view ( 'content/rule_new', '', true);
	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
	$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	$this->load->view ( 'vside', $parseData);
	}
		public function detail($id='')
	{
	$parseData ['header']			= $this->load->view ( 'header', '', true);
	$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
	$parseData ['content']			= $this->load->view ( 'content/rule_new_detail', '', true);
	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
	$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	$this->load->view ( 'vside', $parseData);
	}
	public function datatables_detail($id)
	{
		$get_transcode					= $this->rule_new_model->get_transcode($id);
		$get_Totalrequest_transcode		= $this->rule_new_model->get_Totalrequest_transcode($id);
		$data 		= array();

		if(count($get_transcode) > 0){
			for($i=0; $i<count($get_transcode); $i++){
			$nestedData		= array();
			$nestedData[] 	= $get_transcode[$i]["transcode"];

				if($this->session->userdata['user_data_web']['role'] == 1 or $this->session->userdata['user_data_web']['id'] == 2){
					$nestedData[] 	= '<a href="'.$this->config->item('base_url').'rule_new/update_transcode/'.$get_transcode[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'rule_new/delete_transcode/'.$get_transcode[$i]["id"].'" class="fa fa-fw fa-trash" data-confirm="Are you sure you want to Delete this data?">&nbsp;</a>';
				}else if($this->session->userdata['user_data_web']['role'] == 2){
					$nestedData[] 	= '<a href="'.$this->config->item('base_url').'rule_new/update_transcode/'.$get_transcode[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'rule_new/delete_transcode/'.$get_transcode[$i]["id"].'" class="fa fa-fw fa-trash" data-confirm="Are you sure you want to Delete this data?">&nbsp;</a>';
				}else if($this->session->userdata['user_data_web']['role'] == 3){
					$nestedData[] 	= '<a href="'.$this->config->item('base_url').'rule_new/update_transcode/'.$get_transcode[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>';
				}else{
				$nestedData[]	= '';
				}
			$data[] = $nestedData;
			}
		}
		$json_data = array(
			"draw"            => intval(@$_REQUEST['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
			"recordsTotal"    => intval(count($get_Totalrequest_transcode)),  // total number of records
			"recordsFiltered" => intval(count($get_Totalrequest_transcode)),  // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);
	echo json_encode($json_data);  // send data as json format
	}
	public function datatables()
	{
		$role					= $this->rule_new_model->get_role();
		$get_Totalrequest		= $this->rule_new_model->get_Totalrequest();
		$data 		= array();
		if(count($role) > 0){
			for($i=0; $i<count($role); $i++){
			$nestedData		= array();
			$nestedData[] 	= $role[$i]["description"];
			$nestedData[] 	= $role[$i]["rule_code"];
			$nestedData[] 	= $role[$i]["point"];
			if ( $role[$i]["kelipatan"] == 1) {
				$nestedData[] 	= '<p class="btn btn-success"> Ya </p>';
			}else{
					$nestedData[] 	= '<p class="btn btn-danger"> Bukan  </p>';
			}

			$nestedData[] 	= number_format( $role[$i]["min_amount"],0,',','.');
			$nestedData[] 	= number_format( $role[$i]["nominal_kelipatan"],0,',','.');
			$nestedData[] 	= $role[$i]["max_poin"];

			// $nestedData[] 	= $role[$i]["rule_type"];
			// $nestedData[] 	= $role[$i]["rule_expire"];
			// $nestedData[] 	= $role[$i]["rule_expire_type"];
			$nestedData[] 	= $role[$i]["date_created"];
				if($this->session->userdata['user_data_web']['role'] == 1 or $this->session->userdata['user_data_web']['id'] == 2){
					$nestedData[] 	= '<a href="'.$this->config->item('base_url').'rule_new/detail/'.$role[$i]["id"].'" class="fa fa-fw fa-eye">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'rule_new/update/'.$role[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'rule_new/delete/'.$role[$i]["id"].'" class="fa fa-fw fa-trash" data-confirm="Are you sure you want to Delete this data?">&nbsp;</a>';
				}else if($this->session->userdata['user_data_web']['role'] == 2){
					$nestedData[] 	= '<a href="'.$this->config->item('base_url').'rule_new/update/'.$role[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'rule_new/delete/'.$role[$i]["id"].'" class="fa fa-fw fa-trash" data-confirm="Are you sure you want to Delete this data?">&nbsp;</a>';
				}else if($this->session->userdata['user_data_web']['role'] == 3){
					$nestedData[] 	= '<a href="'.$this->config->item('base_url').'rule_new/update/'.$role[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>';
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
		$parseData ['content']			= $this->load->view ( 'content/rule_new_create', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	}
	public function update($id)
	{
		$data['program']				= $this->program_model->select_program();
		$data['role']					= $this->rule_new_model->select_role($id);
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/rule_new_update', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	}
	public function action_update()
	{
		$data['program_id']		= ($this->input->get_post('program_id'))?$this->input->get_post('program_id'):'';
		$data['point']			= ($this->input->get_post('point'))?$this->input->get_post('point'):'';
		// $data['nominal']			= ($this->input->get_post('nominal'))?$this->input->get_post('nominal'):'';
		$data['rule_expire']	= ($this->input->get_post('rule_expire'))?$this->input->get_post('rule_expire'):'';
		$data['rule_expire_type']	= ($this->input->get_post('rule_expire_type'))?$this->input->get_post('rule_expire_type'):'';
		// $data['rule_type']		= ($this->input->get_post('rule_type'))?$this->input->get_post('rule_type'):'';
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


		$this->form_validation->set_rules('point', 'point', 'required');
		// $this->form_validation->set_rules('nominal', 'nominal', 'required');
		// $this->form_validation->set_rules('rule_expire', 'rule_expire', 'required');
		// $this->form_validation->set_rules('rule_expire_type', 'rule_expire_type', 'required');
		$this->form_validation->set_rules('id', 'id', 'required');
		// $this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_rules('rule_code', 'rule_code', 'required');
		$this->form_validation->set_rules('program_id', 'program_id', 'required');
		if ($this->form_validation->run() == TRUE){
			$rule_code=$data['rule_code'] ;

						$field 		= array(
						"point" 			=>  str_replace(',', '', str_replace('.','', $data['point'])),
						"nominal" 			=>  str_replace(',', '', str_replace('.','', $data['nominal_kelipatan'])),
						"rule_expire" 		=> $data['rule_expire'],
						// "rule_type" 		=> $data['rule_type'],
						"rule_type" 		=> "feeder_daily",
						"rule_expire_type"	=> $data['rule_expire_type'],//$rule_expire_type,
                        "rule_code"			=> $rule_code,
						"description" 		=> $data['description'],
						"min_amount"		=>  str_replace(',', '', str_replace('.','', $data['min_amount'])),
            "kelipatan"			=> str_replace(',', '', str_replace('.','',  $data['kelipatan'])),
            "nominal_kelipatan"	=>  str_replace(',', '', str_replace('.','', $data['nominal_kelipatan'])),
            "max_poin"			=>  str_replace(',', '', str_replace('.','', $data['max_poin'])),
						);
				$update_role	= $this->crud_model->update("M_rules_new", $field, $data['id']);
				if($update_role){
					$this->session->set_flashdata('ruleNewTrue', 'Update data Success');
					header("location: ".$this->config->item('base_url')."rule_new");
					die;
				}else{
					$this->session->set_flashdata('ruleNewFalse', 'Update data Failed, please try again');
					header("location: ".$this->config->item('base_url')."rule_new/update/".$data['id']);
					die;
				}
		}else{
			$this->session->set_flashdata('ruleNewFalse', 'Insert data Failed, please try again  ');
			header("location: ".$this->config->item('base_url')."rule_new/update/".$data['id']);
			die;
		}
	}
	public function action_create()
	{

		$data['program_id']		= ($this->input->get_post('program_id'))?$this->input->get_post('program_id'):'';
		$data['point']			= ($this->input->get_post('point'))?$this->input->get_post('point'):'';
		// $data['nominal']		= ($this->input->get_post('nominal'))?$this->input->get_post('nominal'):'';
		$data['rule_expire']	= ($this->input->get_post('rule_expire'))?$this->input->get_post('rule_expire'):'';
		// $data['rule_type']		= ($this->input->get_post('rule_type'))?$this->input->get_post('rule_type'):'';
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

		$this->session->set_flashdata('faild', $data);

		$this->form_validation->set_rules('program_id', 'program_id', 'required');
		$this->form_validation->set_rules('point', 'point', 'required');
		// $this->form_validation->set_rules('nominal', 'nominal', 'required');
		// $this->form_validation->set_rules('rule_expire', 'rule_expire', 'required');
		// $this->form_validation->set_rules('rule_type', 'rule_type', 'required');
		// $this->form_validation->set_rules('rule_expire_type', 'rule_expire_type', 'required');
		$this->form_validation->set_rules('rule_code', 'rule_code', 'required');
		// $this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_rules('min_amount', 'min_amount', 'required');
		$this->form_validation->set_rules('kelipatan', 'kelipatan', 'required');


		if ($this->form_validation->run() == TRUE){
					$rule_code = $data['rule_code'] ;

						$field 		= array(
						"program_id"		=> $data['program_id'],
						"nominal" 			=>  str_replace(',', '', str_replace('.','', $data['nominal_kelipatan'])),
						"point" 			=>  str_replace(',', '', str_replace('.','', $data['point'])),
						"rule_expire" 		=> $data['rule_expire'],
						// "rule_type" 		=> $data['rule_type'],
						"rule_type" 		=> "feeder_daily",
						"rule_expire_type"	=> $data['rule_expire_type'],
            "rule_code"			=> $rule_code,
            "description"		=> $data['description'],
            "min_amount"		=>  str_replace(',', '', str_replace('.','', $data['min_amount'])),
            "kelipatan"			=>  str_replace(',', '', str_replace('.','', $data['kelipatan'])),
            "nominal_kelipatan"	=>  str_replace(',', '', str_replace('.','', $data['nominal_kelipatan'])),
            "max_poin"			=>  str_replace(',', '', str_replace('.','', $data['max_poin'])),
						"date_created"		=> date('Y-m-d H:i:s')
						);
					$this->crud_model->create("M_rules_new", $field);
			$this->session->set_flashdata('ruleNewTrue', 'Insert data Success');
			header("location: ".$this->config->item('base_url')."rule_new");
			die;
		}else{
		$this->session->set_flashdata('ruleNewFalse', 'Insert data Failed, please try again ');
		header("location: ".$this->config->item('base_url')."rule_new/create");
		die;
		}
	}
	public function delete($id)
	{
		$data['id']	= ($id != '' && is_numeric($id))? $id:0;
		$delete_redeem	= $this->crud_model->delete("M_rules_new", array("id" => $id));
		if($delete_redeem){
		$this->session->set_flashdata('ruleNewTrue', 'Delete data Success');
		header("location: ".$this->config->item('base_url')."rule_new");
		die;
		}else{
		$this->session->set_flashdata('ruleNewFalse', 'Delete data Failed, please try again');
		header("location: ".$this->config->item('base_url')."rule_new");
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
		$role		= $this->rule_new_model->get_role_all();

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
			$titleWS = 'report Role';

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





			if(count($role) > 0){
				for($i=0; $i<count($role); $i++){

				$s=$i+3;
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
	public function create_transcode($id)
	{
		// echo "test";
		// $data['program']				= $this->program_model->select_program();
		// $data['role']					= $this->rule_new_model->select_role($id);
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/rule_new_create_transcode', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	}

	public function update_transcode($id)
	{
		// echo "test";
		// $data['program']				= $this->program_model->select_program();
		$data['get_transcode_by_id']					= $this->rule_new_model->get_transcode_by_id($id);
		// print_r($data);
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/rule_new_update_transcode', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	}

	public function action_create_transcode()
	{


		$data['transcode']	= ($this->input->get_post('transcode'))?$this->input->get_post('transcode'):'';
		$data['rule_id']	= ($this->input->get_post('rule_id'))?$this->input->get_post('rule_id'):'';


		$this->session->set_flashdata('faild', $data);

		$this->form_validation->set_rules('transcode', 'transcode', 'required');


		if ($this->form_validation->run() == TRUE){
					$rule_code = $data['rule_code'] ;

						$field 		= array(
						"rule_id"			=> $data['rule_id'],
						"transcode" 		=> $data['transcode'],
						"date_created"		=> date('Y-m-d H:i:s')
						);
					$this->crud_model->create("M_rules_transcode", $field);
			$this->session->set_flashdata('ruleNewDetailTrue', 'Insert data Success');
			header("location: ".$this->config->item('base_url')."rule_new/detail/".$data['rule_id']);
			die;
		}else{
		$this->session->set_flashdata('ruleNewDetailFalse', 'Insert data Failed, please try again');
		header("location: ".$this->config->item('base_url')."rule_new/create_transcode/".$data['rule_id']);
		die;
		}
	}
	public function action_update_transcode($id)
	{
		// print_r($id);
		// die();
		$data['transcode']		= ($this->input->get_post('transcode'))?$this->input->get_post('transcode'):'';
		$data['rule_id']		= ($this->input->get_post('rule_id'))?$this->input->get_post('rule_id'):'';


		$this->form_validation->set_rules('transcode', 'transcode', 'required');

		if ($this->form_validation->run() == TRUE){
			$rule_code=$data['rule_code'] ;

						$field 		= array(
						"transcode" 		=> $data['transcode'],

						);
				$update_role	= $this->crud_model->update("M_rules_transcode", $field, $id);
				if($update_role){
					$this->session->set_flashdata('ruleNewDetailTrue', 'Update data Success');
					header("location: ".$this->config->item('base_url')."rule_new/detail/".$data['rule_id']);
					die;
				}else{
					$this->session->set_flashdata('ruleNewDetailFalse', 'Update data Failed, please try again');
					header("location: ".$this->config->item('base_url')."rule_new/update/".$data['rule_id']);
					die;
				}
		}else{
			$this->session->set_flashdata('ruleNewDetailFalse', 'Insert data Failed, please try again');
			header("location: ".$this->config->item('base_url')."rule_new/update_transcode/".$id);
			die;
		}

	}
		public function delete_transcode($id)
	{

		$data['get_transcode_by_id']					= $this->rule_new_model->get_transcode_by_id($id);

		$data['id']	= ($id != '' && is_numeric($id))? $id:0;
		$delete_redeem	= $this->crud_model->delete("M_rules_transcode", array("id" => $id));
		if($delete_redeem){
		$this->session->set_flashdata('ruleNewDetailTrue', 'Delete data Success');
		header("location: ".$this->config->item('base_url')."rule_new/detail/".$data['get_transcode_by_id'][0]['rule_id']);
		die;
		}else{
		$this->session->set_flashdata('ruleNewDetailFalse', 'Delete data Failed, please try again');
		header("location: ".$this->config->item('base_url')."rule_new/detail/".$data['get_transcode_by_id'][0]['rule_id']);
		die;
		}

	}
}
