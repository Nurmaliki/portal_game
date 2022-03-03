<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends MY_Controller {

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
		// error_reporting(0);
		$this->load->model ('program_model');
		$this->load->model ('category_model');
		$this->load->model ('merchant_model');
		$this->load->model ('member_model');
		$this->load->model ('report_model');
		$this->load->model ('history_model');
		$this->load->library('excel');
	}
	public function index()
	{
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/welcome', '', true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	//$this->output->enable_profiler(TRUE);
    }

	public function download_redeem(){
		$data['merchant_id']	= ($this->input->get_post('merchant_id'))?$this->input->get_post('merchant_id'):0;
		$data['from_date']		= ($this->input->get_post('from_date'))?$this->input->get_post('from_date'):'';
		$data['to_date']		= ($this->input->get_post('to_date'))?$this->input->get_post('to_date'):'';
		$data['target']			= ($this->input->get_post('target'))?$this->input->get_post('target'):'';
		$vars 							= array(
											'merchant_id' 	=> $data['merchant_id'],
											'type' 			=> "redeem",
											'from_date' 	=> $data['from_date'],
											'to_date' 		=> $data['to_date']
										);
		$report_redeem 				= $this->report_model->get_Reportredeem($data['program_code'], $data['from_date'], $data['to_date']);
		// print_r($report_redeem);
		//$report							= $this->curl(json_encode($vars), 'http://127.0.0.1:8081/log/redeem_report'//'http://10.255.0.140:8081/log/redeem_report' //'http://202.43.164.206:8081/log/redeem_report'
		//);




        $program_name   =$this->report_model->program_name($data['program_code'])[0]['program_name'];
		$data['report']					= json_decode($report);
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
					$merchant				= $this->merchant_model->select_merchant();
					$titleWS = '';
					if(count($merchant) > 0){
						for($i=0; $i<count($merchant); $i++){
							if ($merchant[$i]['id'] == $data['merchant_id']){
								//echo '<h2>'.$program[$i]['program_name'].' Exchange report</h2><br>';
								$titleWS = $merchant[$i]['name'];
							}

						}
					}
					//$titleWS = ''.$data['merchant_id'];
					$WS1 = $this->excel->createSheet(0);
						if($data['target'] == 'internal'){
						$WS1->setCellValue('A1',   $titleWS .' Redeen Report')
							->setCellValue('A2', 'Name')
							->setCellValue('B2', 'CIF')
							->setCellValue('C2', 'Rekening')
							->setCellValue('D2', 'HP')
							->setCellValue('E2', 'Email')
							->setCellValue('F2', 'Redeem Point')
							->setCellValue('G2', 'Current Point')
							->setCellValue('H2', 'Program name')
							->setCellValue('I2', 'Redeem Date')
							;
						}else{
						$WS1->setCellValue('A1',   $titleWS .' Redeen Report')
							->setCellValue('A2', 'HP')
							->setCellValue('B2', 'Email')
							->setCellValue('C2', 'Redeem Point')
							->setCellValue('D2', 'Program name')
							->setCellValue('E2', 'Redeem Date')
							;
						}
					if(count($report_redeem) > 0){
						for($i=0; $i<count($report_redeem); $i++){
						// $member	= $this->member_model->select_member($report_redeem[$i]['member_id']);
						$s=$i+3;
						$phone =$report_redeem[$i]['phone'];
						$norek =$report_redeem[$i]['rekening'];

							if($data['target'] == 'internal'){
								$WS1->setCellValue('A'.$s, $report_redeem[$i]['first_name'])
									->setCellValue('B'.$s, $report_redeem[$i]['cif'])
									->setCellValue('C'.$s, " ".$norek." ")
									->setCellValue('D'.$s, 	" ".$phone." ")
									->setCellValue('E'.$s, $report_redeem[$i]['email'])
									->setCellValue('F'.$s, $report_redeem[$i]['redeem_poin'])
									->setCellValue('G'.$s, $report_redeem[$i]['total'])
									->setCellValue('H'.$s,  $titleWS)
									->setCellValue('I'.$s, $report_redeem[$i]['redeem_date'])
									;
							}else{
								$WS1->setCellValue('A'.$s, " ".$phone." ")
									->setCellValue('B'.$s, $report_redeem[$i]['email'])
									->setCellValue('C'.$s, $report_redeem[$i]['redeem_poin'])
									->setCellValue('D'.$s, $titleWS)
									->setCellValue('E'.$s, $report_redeem[$i]['redeem_date'])
									;
							}
						}
					}else{
						$s = 2;
					}
				$WS1->getStyle('A1:W'.$s)->applyFromArray($styleArray);
				// $WS1->getStyle('V1:V'.$s)->getNumberFormat()->setFormatCode('00000000000');
				// $WS1->getStyle('W1:W'.$s)->getNumberFormat()->setFormatCode('00000000000');
				$WS1->getStyle('D')->getNumberFormat()->setFormatCode(PHPExcel_style_NumberFormat::FORMAT_TEXT);
				$WS1->getStyle('E')->getNumberFormat()->setFormatCode(PHPExcel_style_NumberFormat::FORMAT_TEXT);

				$WS1->getStyle('A')->getNumberFormat()->setFormatCode(PHPExcel_style_NumberFormat::FORMAT_TEXT);
				$WS1->getStyle('B')->getNumberFormat()->setFormatCode(PHPExcel_style_NumberFormat::FORMAT_TEXT);
				$WS1->getColumnDimension("A:W")->setAutoSize(true);
				//$WS1->getColumnDimension('A1:Y'.$s)->setAutoSize(true);
				$WS1->setTitle(titleWS.'-redeem');
				$this->excel->setActiveSheetIndex(0);
				ob_end_clean();
				//$filename='Report_redeem.xls'; //save our workbook as this file name
				$filename=$titleWS.'_'.$data['from_date'].'-'.$data['to_date'].'.xls';
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
				header('Cache-Control: max-age=0'); //no cache
				//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
				//if you want to save it as .XLSX Excel 2007 format
				$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');
    }

	public function download_exchange(){
		//$this->output->enable_profiler(TRUE);
		$data['program_code']	= ($this->input->get_post('program_code'))?$this->input->get_post('program_code'):0;
		$data['from_date']		= ($this->input->get_post('from_date'))?$this->input->get_post('from_date'):'';
		$data['to_date']		= ($this->input->get_post('to_date'))?$this->input->get_post('to_date'):'';
		$data['target']			= ($this->input->get_post('target'))?$this->input->get_post('target'):'';
		$vars 							= array(
											'program_code' 	=> $data['program_code'],
											'type' 			=> "exchange",
											'from_date' 	=> $data['from_date'],
											'to_date' 		=> $data['to_date']
                                        );


		$report_exchange 				= $this->report_model->get_Reportexchange($data['program_code'], $data['from_date'], $data['to_date']);
		//$report							= $this->curl(json_encode($vars), 'http://127.0.0.1:8081/log/exchange_report');//'http://10.255.0.140:8081/log/exchange_report');
        //$data['report']					= json_decode($report);

        // ========================get program name=========================
        $program_name   =$this->report_model->program_name($data['program_code'])[0]['program_name'];


        // print_r($report_exchange );


				$this->excel->getProperties()->setCreator("Report_exchange");
				$this->excel->getProperties()->setLastModifiedBy("Report");
				$this->excel->getProperties()->setTitle("Report_exchange".date('Y-m-d'));
				$this->excel->getProperties()->setSubject("Report_exchange".date('Y-m-d'));
				$this->excel->getProperties()->setDescription("Report exchange Generate at ".date('Y-m-d'));
					$styleArray = array(
					'borders' => array(
						'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
					);
					$titleWS = '';
					$program = $this->program_model->select_program();
					if(count($program) > 0){
						for($i=0; $i<count($program); $i++){
							if ($program[$i]['program_code'] == $data['program_code']){
								//echo '<h2>'.$program[$i]['program_name'].' Exchange report</h2><br>';
								$titleWS = $program[$i]['program_name'];
							}

						}
					}


                    $WS1 = //$this->excel->setActiveSheetIndex(0);
                    $this->excel->createSheet(0);
					//$ws1 =$this->excel->createSheet(0)->setTitle($titleWS, true);
					if($data['target'] == 'internal'){
                    $WS1->setCellValue('A1',   $program_name .' Exchange report')
                        ->setCellValue('A2', 'Name')
						->setCellValue('B2', 'CIF')
						->setCellValue('C2', 'Rekening')
                        ->setCellValue('D2', 'HP')
						->setCellValue('E2', 'Phone Tujuan')
						->setCellValue('F2', 'Email')
						->setCellValue('G2', 'Exchange Point')
						->setCellValue('H2', 'Current Point')
						->setCellValue('I2', 'Program name')
						->setCellValue('J2', 'Exchange Date')
						;
					}else{
                    $WS1->setCellValue('A1',   $program_name .' Exchange report')
                        ->setCellValue('A2', 'HP')
						->setCellValue('B2', 'Phone Tujuan')
						->setCellValue('C2', 'Email')
						->setCellValue('D2', 'Exchange Point')
						->setCellValue('E2', 'Program name')
						->setCellValue('F2', 'Exchange Date')
						;
					}
					if(count($report_exchange) > 0){
						for($i=0; $i<count($report_exchange); $i++){
						//$member	= $this->member_model->select_member($report_exchange[$i]->member_id);
						$s=$i+3;

							$phone =$report_exchange[$i]['phone'];
							$phone_tujuan =$report_exchange[$i]['phone_tujuan'];

							$norek =$report_exchange[$i]['rekening'];

							if($data['target'] == 'internal'){
								$WS1->setCellValue('A'.$s, $report_exchange[$i]['first_name'])
									->setCellValue('B'.$s, $report_exchange[$i]['cif'])
									->setCellValue('C'.$s, 	" ".$norek." ")
                                    ->setCellValue('D'.$s,	" ".$phone." ")
									->setCellValue('E'.$s, " ".$phone_tujuan." ")
									->setCellValue('F'.$s, $report_exchange[$i]['email'])
									->setCellValue('G'.$s, $report_exchange[$i]['exchange_poin'])
									->setCellValue('H'.$s, $report_exchange[$i]['total'])
									->setCellValue('I'.$s, $report_exchange[$i]['program_name'])
									->setCellValue('J'.$s, $report_exchange[$i]['exchange_date'])
									;
							}else{
                                $WS1->setCellValue('A'.$s, " ".$phone. " ")
									->setCellValue('B'.$s, " ".$phone_tujuan." ")
									->setCellValue('C'.$s, $report_exchange[$i]['email'])
									->setCellValue('D'.$s, $report_exchange[$i]['exchange_poin'])
									->setCellValue('E'.$s, $report_exchange[$i]['program_name'])
									->setCellValue('F'.$s, $report_exchange[$i]['exchange_date'])
									;
							}
						}
					}else{
					$s = 2;
					}


				// $objPHPExcel->$WS1
				// 	->getStyle('D')
				// 	->getNumberFormat()
				// 	->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
				// $WS1->getStyle('D')->getNumberFormat()
				// 	->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
				$WS1->getStyle('A1:W'.$s)->applyFromArray($styleArray);
				$WS1->getStyle('D')->getNumberFormat()->setFormatCode(PHPExcel_style_NumberFormat::FORMAT_TEXT);
				$WS1->getStyle('E')->getNumberFormat()->setFormatCode(PHPExcel_style_NumberFormat::FORMAT_TEXT);

				$WS1->getStyle('A')->getNumberFormat()->setFormatCode(PHPExcel_style_NumberFormat::FORMAT_TEXT);
				$WS1->getStyle('B')->getNumberFormat()->setFormatCode(PHPExcel_style_NumberFormat::FORMAT_TEXT);
				$WS1->getColumnDimension("A:W")->setAutoSize(true);
				//$WS1->getColumnDimension('A1:Y'.$s)->setAutoSize(true);
				$WS1->setTitle($titleWS.'_'.$data['target']	);
				$this->excel->setActiveSheetIndex(0);
				ob_end_clean();
				$filename=$titleWS.'_'.$data['target']	.'_'.$data['from_date'].'-'.$data['to_date'].'.xls'; //save our workbook as this file name
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
				header('Cache-Control: max-age=0'); //no cache
				//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
				//if you want to save it as .XLSX Excel 2007 format
				$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
				//force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');



                if(isset($_SESSION["current_selected_program"])){
                    unset($_SESSION["current_selected_program"]);
                }

                // $this->db->last_query();
		//die;
		//$this->load->library('excel');
    }

	public function exchange()
	{
		$data['program_code']	= ($this->input->get_post('program_code'))?$this->input->get_post('program_code'):'';
		$data['from_date']		= ($this->input->get_post('from_date'))?$this->input->get_post('from_date'):'';
		$data['to_date']		= ($this->input->get_post('to_date'))?$this->input->get_post('to_date'):'';
		// $this->form_validation->set_rules('program_code', 'program_code', 'program_code');
		// $this->form_validation->set_rules('from_date', 'from_date', 'from_date');
		// $this->form_validation->set_rules('to_date', 'to_date', 'to_date');
		if ($data['program_code'] != '' || $data['program_code'] != null){
			$_SESSION["current_selected_program"] = $data;
			if($data['from_date'] != ''){
				$date 						= explode("/", $data['from_date']);
				$data['explode_from_date']	= $date[2].'-'.$date[0].'-'.$date[1].' 00:00:00';
			}else{
				$data['explode_from_date']	= "2018-04-29 00:00:00";
			}
			if($data['to_date'] != ''){
				$date 						= explode("/", $data['to_date']);
				$tanggal = $date[1]+1;
				$data['explode_to_date']	= $date[2].'-'.$date[0].'-'.$tanggal.' 00:00:00';
			}else{
				$data['explode_to_date']	= "2018-05-03 00:00:00";
			}
			$vars 							= array(
											'program_code' 	=> $data['program_code'],
											'type' 			=> "exchange",
											'from_date' 	=> $data['explode_from_date'],
											'to_date' 		=> $data['explode_to_date']
                                        );

            // echo "<pre>";
            // print_r($vars);
            // echo "</pre>";
            // die;
            $report							= $this->curl(json_encode($vars), 'http://127.0.0.1:8081/log/exchange_report');
            // 'http://10.255.0.140:8081/log/exchange_report');
			$data['report']					= json_decode($report);


            // $report					= $this->report_model->get_Reportexchange($data['program_code'], $vars['from_date'], $data['to_date']);
            // $data['report']			= $report;
            // print_r($report);
            // print_r($vars);
            // print_r($data['from_date']);

            // print_r($data['to_date']);

			$result	= array();
				if($data['report']->status == '200' and count($data['report']->data) > 0){
					for($i=0; $i<count($data['report']->data); $i++){

					$member								= $this->member_model->select_member($data['report']->data[$i]->member_id);
					$result[$i]['member'] 				= $member[0]['first_name'].' '.$member[0]['last_name'];
					$result[$i]['program_id'] 			= $data['report']->data[$i]->program_id;
					$result[$i]['transcode_btn'] 		= $data['report']->data[$i]->transcode_btn;
					$result[$i]['transcode_btn_poin'] 	= $data['report']->data[$i]->transcode_btn_poin;
					$result[$i]['transcode_btn_date'] 	= $data['report']->data[$i]->transcode_btn_date;
					$result[$i]['exchange_code'] 		= $data['report']->data[$i]->exchange_code;
                    // $result[$i]['exchange_date'] 		= date('Y-m-d h:i:s',strtotime($data['report']->data[$i]->exchange_date)+60*60*7);
                    $result[$i]['exchange_date'] 		= date('Y-m-d ',strtotime($data['report']->data[$i]->exchange_date));
                    // $result[$i]['exchange_date'] 		= $data['report']->data[$i]->exchange_date;

                    $result[$i]['exchange_poin'] 		= $data['report']->data[$i]->exchange_poin;
                    $result[$i]['current_point'] 	    = $data['report']->data[$i]->current_point;
					}
				}
			$data['program']				= $this->program_model->select_program();
			$data['report']					= $result;
			$parseData ['header']			= $this->load->view ( 'header', '', true);
			$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
			$parseData ['content']			= $this->load->view ( 'content/report_exchange', $data, true);
			$parseData ['footer']			= $this->load->view ( 'footer', '', true);
			$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
			$this->load->view ( 'vside', $parseData);
		}
		else{
			$this->session->set_flashdata('msgalert', 'Please select Program');
			$data['program']				= $this->program_model->select_program();
			//$data['report']					= $result;
			$parseData ['header']			= $this->load->view ( 'header', '', true);
			$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
			$parseData ['content']			= $this->load->view ( 'content/report_exchange', $data, true);
			$parseData ['footer']			= $this->load->view ( 'footer', '', true);
			$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
			$this->load->view ( 'vside', $parseData);

		}


    }

	public function redeem(){
		$data['merchant_id']	= ($this->input->get_post('merchant_id'))?$this->input->get_post('merchant_id'):0;
		$data['from_date']		= ($this->input->get_post('from_date'))?$this->input->get_post('from_date'):'';
    $data['to_date']		= ($this->input->get_post('to_date'))?$this->input->get_post('to_date'):'';


        // print_r($data);

		if($data['merchant_id'] !=0 ||$data['merchant_id'] !=''){

            $_SESSION["current_selected_merchant"] = $data;
                if($data['from_date'] != ''){
                    $date 						= explode("/", $data['from_date']);
                    $data['explode_from_date']	= $date[2].'-'.$date[0].'-'.$date[1].' 00:00:00';
                }else{
                    $data['explode_from_date']	= "2018-04-29 00:00:00";
                }
                if($data['to_date'] != ''){
                    $date 						= explode("/", $data['to_date']);
                    $tanggal = $date[1]+1;
                    $data['explode_to_date']	= $date[2].'-'.$date[0].'-'.$tanggal.' 00:00:00';
                }else{
                    $data['explode_to_date']	= "2018-05-03 00:00:00";
                }

                $vars 							= array(
                    'merchant_id' 	=> $data['merchant_id'],
                    'type' 			=> "redeem",
                    'from_date' 	=> $data['explode_from_date'],
                    'to_date' 		=> $data['explode_to_date']
                );
            // print_r($vars);

			$report							= $this->curl(json_encode($vars), 'http://127.0.0.1:8081/log/redeem_report');//'http://10.255.0.140:8081/log/redeem_report');
            $data['report']					= json_decode($report);

            // print_r($data['report']);

			$result	= array();
				if($data['report']->status == '200' and count($data['report']->data) > 0){
					for($i=0; $i<count($data['report']->data); $i++){
					$merchant						= $this->merchant_model->select_merchant($data['report']->data[$i]->merchant_id);
					$member								= $this->member_model->select_member($data['report']->data[$i]->member_id);
					$result[$i]['name'] 				= $member[0]['first_name'].' '.$member[0]['last_name'];
					$result[$i]['cif'] 					= $member[0]['cif'];
					$result[$i]['merchant'] 			= $merchant[0]['name'];
					$result[$i]['transcode_btn'] 		= $data['report']->data[$i]->transcode_btn;
                    $result[$i]['transcode_btn_poin'] 	= $data['report']->data[$i]->transcode_btn_poin;

					$result[$i]['transcode_btn_date'] 		= date('Y-m-d H:i:s',strtotime($data['report']->data[$i]->transcode_btn_date));
                    $result[$i]['redeem_code'] 			= $data['report']->data[$i]->redeem_code;

                    $result[$i]['redeem_date'] 		= date('Y-m-d ',strtotime($data['report']->data[$i]->redeem_date));
					$result[$i]['redeem_poin'] 		= $data['report']->data[$i]->redeem_poin;
					}
				}
		}else{
			$this->session->set_flashdata('msgalert', 'Please select Merchants');
		}

		$data['merchant']				= $this->merchant_model->select_merchant();
		$data['report']					= $result;
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/report_redeem', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	}

	public function report_rule(){

				$date	= $this->input->get_post('date');
				$order_by	= $this->input->get_post('order_by');
				$_SESSION["date"] = $date;
				$_SESSION["order_by"] = $order_by;

				if($date !=	""){
					if (!empty($order_by)) {
						$data['get_point_by_poincode']  	=   $this->history_model->get_point_by_poincode($date,$order_by);

					}else{
						$order_by="";
						$data['get_point_by_poincode']  	=   $this->history_model->get_point_by_poincode($date,$order_by);

					}

				}
				$parseData ['header']			= $this->load->view ( 'header', '', true);
				$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
				$parseData ['content']			= $this->load->view ( 'content/report_rule', $data, true);
				$parseData ['footer']			= $this->load->view ( 'footer', '', true);
				$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
				$this->load->view ( 'vside', $parseData);

	}
	public function download_report_rule(){

				$date	= $this->input->get_post('date');
				$order_by	= $this->input->get_post('order_by');
				$_SESSION["date"] = $date;
				$_SESSION["order_by"] = $order_by;

				if($date !=	""){
					if (!empty($order_by)) {
							$report_rule 	=   $this->history_model->get_point_by_poincode($date,$order_by);

					}else{
						$order_by="";
						$report_rule  	=   $this->history_model->get_point_by_poincode($date,$order_by);

					}

				}



					$this->excel->getProperties()->setCreator("Report rule monthly ");
					$this->excel->getProperties()->setLastModifiedBy("Report");
					$this->excel->getProperties()->setTitle("Report rule monthly ".date('Y-m-d'));
					$this->excel->getProperties()->setSubject("Report rule monthly ".date('Y-m-d'));
					$this->excel->getProperties()->setDescription("Report rule monthly  Generate at ".date('Y-m-d'));
						$styleArray = array(
						'borders' => array(
							'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
							)
						)
						);
						$titleWS = 'Report rule monthly ';



						$WS1 = //$this->excel->setActiveSheetIndex(0);
						$this->excel->createSheet(0);

						$WS1->setCellValue('A1',  'Report Rule '.date('M Y',strtotime($date.'-1')))
							->setCellValue('A2', 'No')
							->setCellValue('B2', 'Poin Code')
							->setCellValue('C2', 'Description')
							->setCellValue('D2', 'Total Poin');

						if(count($report_rule) > 0){
							for($i=0; $i<count($report_rule); $i++){
							$s=$i+3;


									$dec ="";
									if(trim($report_rule[$i]['poin_code_ps'], "") == " 1001"){
										$dec = "Debit BTN Online";
										 }else if(trim($report_rule[$i]['poin_code_ps'], " ") == "1002"){
										$dec = "Transaksi Pembayaran dan Pembelian";
										 }else if(trim($report_rule[$i]['poin_code_ps'], " ") == "1003"){
										$dec = "Penarikan Tunai Luar Negeri";
										}else if(trim($report_rule[$i]['poin_code_ps'], " ") == "1004"){
										$dec = "Transaksi Transfer Kerekening Bank Lain";
										}else if(trim($report_rule[$i]['poin_code_ps'], " ") == "1005"){
										$dec = "Setoran";
										}else if(trim($report_rule[$i]['poin_code_ps'], " ") == "1006"){
										$dec = "Pencetakan Rekening Koran Melalui Mesin ATM";
										}else if(trim($report_rule[$i]['poin_code_ps'], " ") == "add_point_manual"){
										$dec = "Penambahan poin manual";
										}else if(trim($report_rule[$i]['poin_code_ps'], " ") == "ultah"){
										$dec = "Poin Ulang Tahun";
										}else if(trim($report_rule[$i]['poin_code_ps'], " ") == "open_acc"){
										$dec = "Pembukaan Akun Baru";
										}else if(trim($report_rule[$i]['poin_code_ps'], " ") == "akd"){
										$dec = "Aktivasi Kartu Debit";
										}else if(trim($report_rule[$i]['poin_code_ps'], " ") == "aib"){
										$dec = "Aktivasi Internet Banking";
										}else if(trim($report_rule[$i]['poin_code_ps'], " ") == "agf"){
										$dec = "Aktivasi AGF";
										}else if(trim($report_rule[$i]['poin_code_ps'], " ") == "aft"){
											$dec = "Aktivasi AFT";
										}else if(trim($report_rule[$i]['poin_code_ps'], " ") == "mstr_mob"){
										$dec = "Master Mobile";
										}else{
										$dec =  trim($report_rule[$i]['poin_code_ps'], "");
										}
									$WS1->setCellValue('A'.$s, $i+1)
										->setCellValue('B'.$s, $report_rule[$i]['poin_code_ps'])
										->setCellValue('C'.$s, $dec)
										->setCellValue('D'.$s, $report_rule[$i]['Total']);

							}
						}else{
						$s = 2;
						}


					$WS1->getStyle('A1:W'.$s)->applyFromArray($styleArray);
					$WS1->getStyle('D')->getNumberFormat()->setFormatCode(PHPExcel_style_NumberFormat::FORMAT_TEXT);
					$WS1->getStyle('E')->getNumberFormat()->setFormatCode(PHPExcel_style_NumberFormat::FORMAT_TEXT);

					$WS1->getStyle('A')->getNumberFormat()->setFormatCode(PHPExcel_style_NumberFormat::FORMAT_TEXT);
					$WS1->getStyle('B')->getNumberFormat()->setFormatCode(PHPExcel_style_NumberFormat::FORMAT_TEXT);
					$WS1->getColumnDimension("A:W")->setAutoSize(true);
					//$WS1->getColumnDimension('A1:Y'.$s)->setAutoSize(true);
					$WS1->setTitle($titleWS.'_'.$data['target']	);
					$this->excel->setActiveSheetIndex(0);
					ob_end_clean();
					$filename=$titleWS.'_'.date('M Y',strtotime($date.'-1')) .'.xls'; //save our workbook as this file name
					header('Content-Type: application/vnd.ms-excel'); //mime type
					header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
					header('Cache-Control: max-age=0'); //no cache
					//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
					//if you want to save it as .XLSX Excel 2007 format
					$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
					//force user to download the Excel file without writing it to server's HD
					$objWriter->save('php://output');


	}



	public function report_rule_expire_poin_monthly(){

		$date	= $this->input->get_post('date');
		$order_by	= $this->input->get_post('order_by');
		$_SESSION["date"] = $date;
		$_SESSION["order_by"] = $order_by;

		if($date !=	""){
			if (!empty($order_by)) {
				$data['get_point_by_poincode']  	=   $this->history_model->get_point_expire_by_poincode($date,$order_by);

			}else{
				$order_by="";
				$data['get_point_by_poincode']  	=   $this->history_model->get_point_expire_by_poincode($date,$order_by);

			}

		}else{
			if (!empty($order_by)) {
				$date = date('Y-m');
				$data['get_point_by_poincode']  	=   $this->history_model->get_point_expire_by_poincode($date,$order_by);

			}else{
				$date = date('Y-m');
				$order_by="desc";
				$data['get_point_by_poincode']  	=   $this->history_model->get_point_expire_by_poincode($date,$order_by);

			}
		}
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/report_rule_expire_poin_monthly', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);

	}
	public function report_rule_expire_poin_daily(){

		$data['get_poin_code']  	=   $this->history_model->get_poin_code();

		// print_r($data);

		$data['poin_code']	    = ($this->input->get_post('poin_code'))?$this->input->get_post('poin_code'):'1001';
		$data['from_date']		= ($this->input->get_post('from_date'))?$this->input->get_post('from_date'):'';
		$data['to_date']		= ($this->input->get_post('to_date'))?$this->input->get_post('to_date'):'';

		$date_start = 	date('Y-m-d',strtotime($data['from_date']));
		$date_end = 	date('Y-m-d',strtotime($data['to_date']));

		$_SESSION['expire_poin_daily_date_start'] = $date_start;
		$_SESSION['expire_poin_daily_date_end']   = $date_end;
		$_SESSION['expire_poin_daily_poin_code']  = $data['poin_code'];


		$data['get_poin_poincode_bydate']  	=   $this->history_model->get_poin_expire_poincode_bydate($data['poin_code'],$date_start,$date_end);

		$_SESSION["current_selected_program"] = $data;
		$parseData ['header']									= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']						= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']								= $this->load->view ( 'content/report_rule_expire_poin_daily', $data, true);
		$parseData ['footer']									= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']				= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);

	}
	public function report_rule_all(){
		$data['get_poin_code']  	=   $this->history_model->get_poin_code();

		// print_r($data);

		$data['poin_code']	    = ($this->input->get_post('poin_code'))?$this->input->get_post('poin_code'):'1001';
		$data['from_date']		= ($this->input->get_post('from_date'))?$this->input->get_post('from_date'):'';
		$data['to_date']		= ($this->input->get_post('to_date'))?$this->input->get_post('to_date'):'';

		$date_start = 	date('Y-m-d',strtotime($data['from_date']));
		$date_end = 	date('Y-m-d',strtotime($data['to_date']));

		$data['get_poin_poincode_bydate']  	=   $this->history_model->get_poin_poincode_bydate($data['poin_code'],$date_start,$date_end);

		$_SESSION["current_selected_program"] = $data;
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/report_rule_all', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);

	}
    public function curl($vars, $url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$vars);  //Post Fields
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$headers = [
		    'Content-Type: application/json',
		    'apikey: NxoklkZDL0Cz8GrHAFYzViA8cVv16wP5'
		];
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$server_output = curl_exec ($ch);
		curl_close ($ch);
		return $server_output;
	}
	function download_report_rull(){


		$date_from	= $this->input->get_post('date_from');
		$date_to	= $this->input->get_post('date_to');

		$_SESSION["date_from"] = $date_from;
		$_SESSION["date_to"]   = $date_to;

		if($date_from != ""){

			$report_rule  	=   $this->history_model->get_point_by_poincode($date_from,$date_to);
		}


		$this->excel->getProperties()->setCreator("Report_exchange");
		$this->excel->getProperties()->setLastModifiedBy("Report");
		$this->excel->getProperties()->setTitle("Report_exchange".date('Y-m-d'));
		$this->excel->getProperties()->setSubject("Report_exchange".date('Y-m-d'));
		$this->excel->getProperties()->setDescription("Report exchange Generate at ".date('Y-m-d'));
			$styleArray = array(
			'borders' => array(
				'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
				)
			)
			);
			$titleWS = 'Report rule monthly ';



			$WS1 = //$this->excel->setActiveSheetIndex(0);
			$this->excel->createSheet(0);

			$WS1->setCellValue('A1',  'Report Rule '.date('M Y',strtotime($date.'-1')))
				->setCellValue('A2', 'No')
				->setCellValue('B2', 'Poin Code')
				->setCellValue('C2', 'Description')
				->setCellValue('D2', 'Total Poin');

			if(count($report_rule) > 0){
				for($i=0; $i<count($report_rule); $i++){
				$s=$i+3;


						$dec ="";
						if(trim($report_rule[$i]['poin_code'], "") == " 1001"){
							$dec = "Debit BTN Online";
							 }else if(trim($report_rule[$i]['poin_code'], " ") == "1002"){
							$dec = "Transaksi Pembayaran dan Pembelian";
							 }else if(trim($report_rule[$i]['poin_code'], " ") == "1003"){
							$dec = "Penarikan Tunai Luar Negeri";
							}else if(trim($report_rule[$i]['poin_code'], " ") == "1004"){
							$dec = "Transaksi Transfer Kerekening Bank Lain";
							}else if(trim($report_rule[$i]['poin_code'], " ") == "1005"){
							$dec = "Setoran";
							}else if(trim($report_rule[$i]['poin_code'], " ") == "1006"){
							$dec = "Pencetakan Rekening Koran Melalui Mesin ATM";
							}else if(trim($report_rule[$i]['poin_code'], " ") == "add_point_manual"){
							$dec = "Penambahan poin manual";
							}else if(trim($report_rule[$i]['poin_code'], " ") == "ultah"){
							$dec = "Poin Ulang Tahun";
							}else if(trim($report_rule[$i]['poin_code'], " ") == "open_acc"){
							$dec = "Pembukaan Akun Baru";
							}else if(trim($report_rule[$i]['poin_code'], " ") == "akd"){
							$dec = "Aktivasi Kartu Debit";
							}else if(trim($report_rule[$i]['poin_code'], " ") == "aib"){
							$dec = "Aktivasi Internet Banking";
							}else if(trim($report_rule[$i]['poin_code'], " ") == "agf"){
							$dec = "Aktivasi AGF";
							}else if(trim($report_rule[$i]['poin_code'], " ") == "aft"){
								$dec = "Aktivasi AFT";
							}else if(trim($report_rule[$i]['poin_code'], " ") == "mstr_mob"){
							$dec = "Master Mobile";
							}else{
							$dec =  trim($report_rule[$i]['poin_code'], "");
							}
						$WS1->setCellValue('A'.$s, $i+1)
							->setCellValue('B'.$s, $report_rule[$i]['poin_code'])
							->setCellValue('C'.$s, $dec)
							->setCellValue('D'.$s, $report_rule[$i]['Total']);

				}
			}else{
			$s = 2;
			}


		$WS1->getStyle('A1:W'.$s)->applyFromArray($styleArray);
		$WS1->getStyle('D')->getNumberFormat()->setFormatCode(PHPExcel_style_NumberFormat::FORMAT_TEXT);
		$WS1->getStyle('E')->getNumberFormat()->setFormatCode(PHPExcel_style_NumberFormat::FORMAT_TEXT);

		$WS1->getStyle('A')->getNumberFormat()->setFormatCode(PHPExcel_style_NumberFormat::FORMAT_TEXT);
		$WS1->getStyle('B')->getNumberFormat()->setFormatCode(PHPExcel_style_NumberFormat::FORMAT_TEXT);
		$WS1->getColumnDimension("A:W")->setAutoSize(true);
		//$WS1->getColumnDimension('A1:Y'.$s)->setAutoSize(true);
		$WS1->setTitle($titleWS.'_'.$data['target']	);
		$this->excel->setActiveSheetIndex(0);
		ob_end_clean();
		$filename=$titleWS.'_'.date('M Y',strtotime($date.'-1')) .'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}

	function download_report_expire_poin_monthly(){

		if($this->input->get_post('date') != ""){
			$date = $this->input->get_post('date');
			$order_by = $this->input->get_post('order_by');
		}else{
			$date = date('Y-m');
			$order_by = "desc";
		}


		$report_rule=$this->history_model->get_point_expire_by_poincode($date,$order_by);

		$this->excel->getProperties()->setCreator("Report_exchange");
		$this->excel->getProperties()->setLastModifiedBy("Report");
		$this->excel->getProperties()->setTitle("Report_exchange".date('Y-m-d'));
		$this->excel->getProperties()->setSubject("Report_exchange".date('Y-m-d'));
		$this->excel->getProperties()->setDescription("Report exchange Generate at ".date('Y-m-d'));
			$styleArray = array(
			'borders' => array(
				'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
				)
			)
			);
			$titleWS = 'Report Expire Poin Monthly';



			$WS1 = //$this->excel->setActiveSheetIndex(0);
			$this->excel->createSheet(0);

			$WS1->setCellValue('A1', 'Report Expire Poin Monthly '.date('M Y',strtotime($date.'-1')))
				->setCellValue('A2', 'No')
				->setCellValue('B2', 'Poin Code')
				->setCellValue('C2', 'Description')
				->setCellValue('D2', 'Total Poin');

			if(count($report_rule) > 0){
				for($i=0; $i<count($report_rule); $i++){
				$s=$i+3;


						$dec ="";
						if(trim($report_rule[$i]['poin_code'], "") == " 1001"){
							$dec = "Debit BTN Online";
							 }else if(trim($report_rule[$i]['poin_code'], " ") == "1002"){
							$dec = "Transaksi Pembayaran dan Pembelian";
							 }else if(trim($report_rule[$i]['poin_code'], " ") == "1003"){
							$dec = "Penarikan Tunai Luar Negeri";
							}else if(trim($report_rule[$i]['poin_code'], " ") == "1004"){
							$dec = "Transaksi Transfer Kerekening Bank Lain";
							}else if(trim($report_rule[$i]['poin_code'], " ") == "1005"){
							$dec = "Setoran";
							}else if(trim($report_rule[$i]['poin_code'], " ") == "1006"){
							$dec = "Pencetakan Rekening Koran Melalui Mesin ATM";
							}else if(trim($report_rule[$i]['poin_code'], " ") == "add_point_manual"){
							$dec = "Penambahan poin manual";
							}else if(trim($report_rule[$i]['poin_code'], " ") == "ultah"){
							$dec = "Poin Ulang Tahun";
							}else if(trim($report_rule[$i]['poin_code'], " ") == "open_acc"){
							$dec = "Pembukaan Akun Baru";
							}else if(trim($report_rule[$i]['poin_code'], " ") == "akd"){
							$dec = "Aktivasi Kartu Debit";
							}else if(trim($report_rule[$i]['poin_code'], " ") == "aib"){
							$dec = "Aktivasi Internet Banking";
							}else if(trim($report_rule[$i]['poin_code'], " ") == "agf"){
							$dec = "Aktivasi AGF";
							}else if(trim($report_rule[$i]['poin_code'], " ") == "aft"){
								$dec = "Aktivasi AFT";
							}else if(trim($report_rule[$i]['poin_code'], " ") == "mstr_mob"){
							$dec = "Master Mobile";
							}else{
							$dec =  trim($report_rule[$i]['poin_code'], "");
							}
						$WS1->setCellValue('A'.$s, $i+1)
							->setCellValue('B'.$s, $report_rule[$i]['poin_code'])
							->setCellValue('C'.$s, $dec)
							->setCellValue('D'.$s, $report_rule[$i]['Total']);

				}
			}else{
			$s = 2;
			}


		$WS1->getStyle('A1:W'.$s)->applyFromArray($styleArray);
		$WS1->getStyle('D')->getNumberFormat()->setFormatCode(PHPExcel_style_NumberFormat::FORMAT_TEXT);
		$WS1->getStyle('E')->getNumberFormat()->setFormatCode(PHPExcel_style_NumberFormat::FORMAT_TEXT);

		$WS1->getStyle('A')->getNumberFormat()->setFormatCode(PHPExcel_style_NumberFormat::FORMAT_TEXT);
		$WS1->getStyle('B')->getNumberFormat()->setFormatCode(PHPExcel_style_NumberFormat::FORMAT_TEXT);
		$WS1->getColumnDimension("A:W")->setAutoSize(true);
		//$WS1->getColumnDimension('A1:Y'.$s)->setAutoSize(true);
		$WS1->setTitle($titleWS.'_'.$data['target']	);
		$this->excel->setActiveSheetIndex(0);
		ob_end_clean();
		$filename=$titleWS.'_'.date('M Y',strtotime($date.'-1')) .'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	function download_report_expire_poin_daily(){



		$date_start	       = ($this->input->get_post('expire_poin_daily_date_start'))?$this->input->get_post('expire_poin_daily_date_start'):'1001';
		$date_end		   = ($this->input->get_post('expire_poin_daily_date_end'))?$this->input->get_post('expire_poin_daily_date_end'):'';
		$data['poin_code'] = ($this->input->get_post('expire_poin_daily_poin_code'))?$this->input->get_post('expire_poin_daily_poin_code'):'';

						$dec ="";
						if(trim($data['poin_code'], "") == " 1001"){
							$dec = "Debit BTN Online";
							 }else if(trim($data['poin_code'], " ") == "1002"){
							$dec = "Transaksi Pembayaran dan Pembelian";
							 }else if(trim($data['poin_code'], " ") == "1003"){
							$dec = "Penarikan Tunai Luar Negeri";
							}else if(trim($data['poin_code'], " ") == "1004"){
							$dec = "Transaksi Transfer Kerekening Bank Lain";
							}else if(trim($data['poin_code'], " ") == "1005"){
							$dec = "Setoran";
							}else if(trim($data['poin_code'], " ") == "1006"){
							$dec = "Pencetakan Rekening Koran Melalui Mesin ATM";
							}else if(trim($data['poin_code'], " ") == "add_point_manual"){
							$dec = "Penambahan poin manual";
							}else if(trim($data['poin_code'], " ") == "ultah"){
							$dec = "Poin Ulang Tahun";
							}else if(trim($data['poin_code'], " ") == "open_acc"){
							$dec = "Pembukaan Akun Baru";
							}else if(trim($data['poin_code'], " ") == "akd"){
							$dec = "Aktivasi Kartu Debit";
							}else if(trim($data['poin_code'], " ") == "aib"){
							$dec = "Aktivasi Internet Banking";
							}else if(trim($data['poin_code'], " ") == "agf"){
							$dec = "Aktivasi AGF";
							}else if(trim($data['poin_code'], " ") == "aft"){
								$dec = "Aktivasi AFT";
							}else if(trim($data['poin_code'], " ") == "mstr_mob"){
							$dec = "Master Mobile";
							}else{
							$dec =  trim($data['poin_code'], "");
							}


		$get_poin_poincode_bydate  	=   $this->history_model->get_poin_expire_poincode_bydate($data['poin_code'],$date_start,$date_end);

		// print_r($data['get_poin_poincode_bydate']);
		// print_r($date_start	 );
		// print_r($date_end);
		// print_r($data['poin_code']);
		// die();
		// $report_rule=$this->history_model->get_point_expire_by_poincode($date,$order_by);

		$this->excel->getProperties()->setCreator("Report_exchange");
		$this->excel->getProperties()->setLastModifiedBy("Report");
		$this->excel->getProperties()->setTitle("Report_exchange".date('Y-m-d'));
		$this->excel->getProperties()->setSubject("Report_exchange".date('Y-m-d'));
		$this->excel->getProperties()->setDescription("Report exchange Generate at ".date('Y-m-d'));
			$styleArray = array(
			'borders' => array(
				'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
				)
			)
			);
			$titleWS = 'Report Expire Poin Daily'.$dec;



			$WS1 = //$this->excel->setActiveSheetIndex(0);
			$this->excel->createSheet(0);

			$WS1->setCellValue('A1', 'Report Expire Poin Daily '.$dec.' '.date('M Y',strtotime($date.'-1')))
				->setCellValue('A2', 'No')
				->setCellValue('B2', 'Date')
				->setCellValue('C2', 'Poin Code')
				->setCellValue('D2', 'Total Poin');

			if(count($get_poin_poincode_bydate) > 0){
				for($i=0; $i<count($get_poin_poincode_bydate); $i++){
				$s=$i+3;



						$WS1->setCellValue('A'.$s, $i+1)
							->setCellValue('B'.$s, $get_poin_poincode_bydate[$i]['date_related'])
							->setCellValue('C'.$s, $get_poin_poincode_bydate[$i]['poin_code'])
							->setCellValue('D'.$s, $get_poin_poincode_bydate[$i]['Total']);

				}
			}else{
			$s = 2;
			}


		$WS1->getStyle('A1:W'.$s)->applyFromArray($styleArray);
		$WS1->getStyle('D')->getNumberFormat()->setFormatCode(PHPExcel_style_NumberFormat::FORMAT_TEXT);
		$WS1->getStyle('E')->getNumberFormat()->setFormatCode(PHPExcel_style_NumberFormat::FORMAT_TEXT);

		$WS1->getStyle('A')->getNumberFormat()->setFormatCode(PHPExcel_style_NumberFormat::FORMAT_TEXT);
		$WS1->getStyle('B')->getNumberFormat()->setFormatCode(PHPExcel_style_NumberFormat::FORMAT_TEXT);
		$WS1->getColumnDimension("A:W")->setAutoSize(true);
		//$WS1->getColumnDimension('A1:Y'.$s)->setAutoSize(true);
		$WS1->setTitle($titleWS.'_'.$data['target']	);
		$this->excel->setActiveSheetIndex(0);
		ob_end_clean();
		$filename=$titleWS.'_'.date('M Y',strtotime($date.'-1')) .'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}

	public function report_member_poin_serbu(){


		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/report_member_poin_serbu', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	}
	public function datatables_member()
	{

			$report_member  	=   $this->report_model->report_member();
			$get_Totalrequest		= $this->report_model->get_Totalrequest_report_member();
		$data 		= array();
		if(count($report_member) > 0){
			for($i=0; $i<count($report_member); $i++){
			$nestedData		= array();
			$nestedData[] 	= $report_member[$i]["first_name"];
			$nestedData[] 	= $report_member[$i]["email"];
			$nestedData[] 	= $report_member[$i]["dob"];
			$nestedData[] 	= $report_member[$i]["cif"];
			$nestedData[] 	= $report_member[$i]["phone"];
			$nestedData[] 	= $report_member[$i]["rekening"];
			$nestedData[] 	= $report_member[$i]["activation_date"];
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
	function download_report_member_regis(){

	$report_member  	=   $this->report_model->download_report_member_regis();




		$this->excel->getProperties()->setCreator("Report_member_registration");
		$this->excel->getProperties()->setLastModifiedBy("Report");
		$this->excel->getProperties()->setTitle("Report_member_registration".date('Y-m-d'));
		$this->excel->getProperties()->setSubject("Report_member_registration".date('Y-m-d'));
		$this->excel->getProperties()->setDescription("Report exchange Generate at ".date('Y-m-d'));
			$styleArray = array(
			'borders' => array(
				'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
				)
			)
			);
			$titleWS = 'Report Member Registration'.$dec;



			$WS1 = //$this->excel->setActiveSheetIndex(0);
			$this->excel->createSheet(0);

			$WS1->setCellValue('A1', 'Report Member Registration'.$dec.' '.date('M Y',strtotime($date.'-1')))
				->setCellValue('A2', 'No')
				->setCellValue('B2', 'Name')
				->setCellValue('C2', 'Email')
				->setCellValue('D2', 'Tanggal Lahir')
				->setCellValue('E2', 'CIF')
				->setCellValue('F2', 'Phone')
				->setCellValue('G2', 'Rekening')
				->setCellValue('H2', 'Activation date');

			if(count($report_member) > 0){
				for($i=0; $i<count($report_member); $i++){
				$s=$i+3;



						$WS1->setCellValue('A'.$s, $i+1)
							->setCellValue('B'.$s, $report_member[$i]['first_name'])
							->setCellValue('C'.$s, $report_member[$i]['email'])
							->setCellValue('D'.$s, $report_member[$i]['dob'])
							->setCellValue('E'.$s, $report_member[$i]['cif'])
							->setCellValue('F'.$s, " ".$report_member[$i]['phone']." ")
							->setCellValue('G'.$s, " ".$report_member[$i]['rekening']." ")
							->setCellValue('H'.$s, " ".$report_member[$i]['activation_date']." ");

				}
			}else{
			$s = 2;
			}


		$WS1->getStyle('A1:W'.$s)->applyFromArray($styleArray);
		$WS1->getStyle('D')->getNumberFormat()->setFormatCode(PHPExcel_style_NumberFormat::FORMAT_TEXT);
		$WS1->getStyle('E')->getNumberFormat()->setFormatCode(PHPExcel_style_NumberFormat::FORMAT_TEXT);

		$WS1->getStyle('A')->getNumberFormat()->setFormatCode(PHPExcel_style_NumberFormat::FORMAT_TEXT);
		$WS1->getStyle('B')->getNumberFormat()->setFormatCode(PHPExcel_style_NumberFormat::FORMAT_TEXT);
		$WS1->getColumnDimension("A:W")->setAutoSize(true);
		//$WS1->getColumnDimension('A1:Y'.$s)->setAutoSize(true);
		$WS1->setTitle($titleWS.'_'.$data['target']	);
		$this->excel->setActiveSheetIndex(0);
		ob_end_clean();
		$filename=$titleWS.'_'.date('M Y',strtotime($date.'-1')) .'.xls'; //save our workbook as this file name
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
