<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportgiift extends MY_Controller {

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
		$this->load->model ('program_model');
		$this->load->model ('category_model');
		$this->load->model ('merchant_model');
		$this->load->model ('member_model');
		$this->load->model ('reportgiift_model');
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
		// $data['merchant_id']	= ($this->input->get_post('merchant_id'))?$this->input->get_post('merchant_id'):0;
		$data['from_date']		= ($this->input->get_post('from_date'))?$this->input->get_post('from_date'):'';
		$data['to_date']		= ($this->input->get_post('to_date'))?$this->input->get_post('to_date'):'';
		$data['target']			= ($this->input->get_post('target'))?$this->input->get_post('target'):'';
		

		if ($data['from_date'] == "" || $data['to_date'] == ""	) {
			$this->session->set_flashdata('msgalert', 'Please select from date and date to date');

			$data['report']					= $result;
			$parseData ['header']			= $this->load->view ( 'header', '', true);
			$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
			$parseData ['content']			= $this->load->view ( 'content/reportgiift_redeem', $data, true);
			$parseData ['footer']			= $this->load->view ( 'footer', '', true);
			$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
			$this->load->view ( 'vside', $parseData);
		}else{
				if(strtotime($data['to_date']) < strtotime($data['from_date'])){
					// 2019-01-05 
										$date 						= explode("-", $data['from_date']);
										$date2 						= explode("-", $data['to_date']);
					                    $data['from_date']	= str_replace(' 00:00:00',' ',$date[1].'/'.$date[2].'/'.$date[0]);
					                    $data['to_date']	= str_replace(' 00:00:00',' ',$date2[1].'/'.$date2[2].'/'.$date2[0]);
					// print_r($data);
					// die();

					$this->session->set_flashdata('msgalert', 'to date lebih kecil dari from date');
					$data['report']					= $result;
					$parseData ['header']			= $this->load->view ( 'header', '', true);
					$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
					$parseData ['content']			= $this->load->view ( 'content/reportgiift_redeem', $data, true);
					$parseData ['footer']			= $this->load->view ( 'footer', '', true);
					$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
					$this->load->view ( 'vside', $parseData);
				}else{
				
				$report_redeem 				= $this->reportgiift_model->get_Reportgiift_download( $data['from_date'], $data['to_date']);
				

						$this->excel->getProperties()->setCreator("Report_giift_Redeem");
						$this->excel->getProperties()->setLastModifiedBy("Report_giift");
						$this->excel->getProperties()->setTitle("Report_giift_Redeem".date('Y-m-d'));
						$this->excel->getProperties()->setSubject("Report_giift_Redeem".date('Y-m-d'));
						$this->excel->getProperties()->setDescription("Report redeem Generate at ".date('Y-m-d'));	
							$styleArray = array(
							'borders' => array(
								'allborders' => array(
								'style' => PHPExcel_Style_Border::BORDER_THIN
								)
							)
							);
							// $merchant				= $this->merchant_model->select_merchant();
							$titleWS = ' Report Redeem Voucher';
							
							$WS1 = $this->excel->createSheet(0);
								if($data['target'] == 'internal'){
								$WS1->setCellValue('A1',   $titleWS .' '.$data['target'] .' '.str_replace(' 00:00:00',' ',$data['from_date']).' Sd '.str_replace(' 00:00:00',' ',$data['to_date']))
									->setCellValue('A2', 'Member Id')
									->setCellValue('B2', 'Name')
									->setCellValue('C2', 'Cif')
									->setCellValue('D2', 'Rekening')
									->setCellValue('E2', 'Phone')
									->setCellValue('F2', 'Transcode btn')	
									->setCellValue('G2', 'Transcode btn date')
									->setCellValue('H2', 'Redeem poin')
									->setCellValue('I2', 'Email tujuan')
									->setCellValue('J2', 'Giift dmo id')
									->setCellValue('K2', 'Giift name')
									->setCellValue('L2', 'Giift order id')
									->setCellValue('M2', 'Giift value')
									->setCellValue('N2', 'Status')
									->setCellValue('O2', 'Status Message')

									;
								}else{
								$WS1->setCellValue('A1',    $titleWS .' '.$data['target'] .' '.str_replace(' 00:00:00',' ',$data['from_date']).' Sd '.str_replace(' 00:00:00',' ',$data['to_date']))
									->setCellValue('A2', 'Member Id')
									->setCellValue('B2', 'Name')
									->setCellValue('C2', 'Cif')
									->setCellValue('D2', 'Rekening')
									->setCellValue('E2', 'Phone')
									->setCellValue('F2', 'Transcode btn')	
									->setCellValue('G2', 'Transcode btn date')
									->setCellValue('H2', 'Redeem poin')
									->setCellValue('I2', 'Email tujuan')
									->setCellValue('J2', 'Giift dmo id')
									->setCellValue('K2', 'Giift name')
									->setCellValue('L2', 'Giift order id')
									->setCellValue('M2', 'Giift value')
									->setCellValue('N2', 'Status')
									->setCellValue('O2', 'Status Message')
									;	
								}
							if(count($report_redeem) > 0){
								for($i=0; $i<count($report_redeem); $i++){
								// $member	= $this->member_model->select_member($report_redeem[$i]['member_id']);
								$s=$i+3;
								$phone =$report_redeem[$i]['phone'];						
								$norek =$report_redeem[$i]['rekening'];
								
									if($data['target'] == 'internal'){
										$WS1->setCellValue('A'.$s, $report_redeem[$i]['member_id'])
											->setCellValue('B'.$s, $report_redeem[$i]['first_name'])
											->setCellValue('C'.$s, $report_redeem[$i]['cif'])
											->setCellValue('D'.$s, " ".$norek." ")
											->setCellValue('E'.$s, " ".$phone." ")
											->setCellValue('F'.$s, $report_redeem[$i]['transcode_btn'])
											->setCellValue('G'.$s, $report_redeem[$i]['transcode_btn_date'])
											->setCellValue('H'.$s, $report_redeem[$i]['redeem_poin'])
											->setCellValue('I'.$s, $report_redeem[$i]['email_tujuan'])
											->setCellValue('J'.$s, $report_redeem[$i]['giift_dmo_id'])
											->setCellValue('K'.$s, $report_redeem[$i]['giift_name'])
											->setCellValue('L'.$s, $report_redeem[$i]['giift_order_id'])
											->setCellValue('M'.$s, $report_redeem[$i]['giift_value'])
											->setCellValue('N'.$s, $report_redeem[$i]['status'])
											->setCellValue('O'.$s, $report_redeem[$i]['status_msg'])

											;
									}else{
										$WS1->setCellValue('A'.$s, $report_redeem[$i]['member_id'])
											->setCellValue('B'.$s, $report_redeem[$i]['first_name'])
											->setCellValue('C'.$s, $report_redeem[$i]['cif'])
											->setCellValue('D'.$s, " ".$norek." ")
											->setCellValue('E'.$s, " ".$phone." ")
											->setCellValue('F'.$s, $report_redeem[$i]['transcode_btn'])
											->setCellValue('G'.$s, $report_redeem[$i]['transcode_btn_date'])
											->setCellValue('H'.$s, $report_redeem[$i]['redeem_poin'])
											->setCellValue('I'.$s, $report_redeem[$i]['email_tujuan'])
											->setCellValue('J'.$s, $report_redeem[$i]['giift_dmo_id'])
											->setCellValue('K'.$s, $report_redeem[$i]['giift_name'])
											->setCellValue('L'.$s, $report_redeem[$i]['giift_order_id'])
											->setCellValue('M'.$s, $report_redeem[$i]['giift_value'])
											->setCellValue('N'.$s, $report_redeem[$i]['status'])
											->setCellValue('O'.$s, $report_redeem[$i]['status_msg'])

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
						$filename=$titleWS.'_'.$data['target'].'_'.$data['from_date'].'-'.$data['to_date'].'.xls';
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
    }
    
	
    
	public function redeem(){

				$data['from_date']		= ($this->input->get_post('from_date'))?$this->input->get_post('from_date'):'';
       			$data['to_date']		= ($this->input->get_post('to_date'))?$this->input->get_post('to_date'):'';
						if(strtotime($data['to_date']) < strtotime($data['from_date'])){
							

									$this->session->set_flashdata('msgalert', 'to date lebih kecil dari from date');
									$data['report']					= $result;
									$parseData ['header']			= $this->load->view ( 'header', '', true);
									$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
									$parseData ['content']			= $this->load->view ( 'content/reportgiift_redeem', $data, true);
									$parseData ['footer']			= $this->load->view ( 'footer', '', true);
									$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
									$this->load->view ( 'vside', $parseData);

						}else{
       			

						if($data['from_date'] != "" || $data['from_date'] != ""){
							
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
								
						            $data['report']					= $this->reportgiift_model->get_Reportgiift($data['explode_from_date'],$data['explode_to_date']);
						           // print_r($data);
						           // die();
									$result	= array();
											for($i=0; $i<count($data['report']); $i++){
											// $merchant						= $this->merchant_model->select_merchant($data['report']->data[$i]->merchant_id);
											// $merchant							= $data['report'][$i]["merchant_id"];
											$result[$i]['member_id'] 		= $data['report'][$i]["member_id"];
											$result[$i]['transcode_btn'] 	= $data['report'][$i]["transcode_btn"];
											$result[$i]['transcode_btn_date'] = $data['report'][$i]["transcode_btn_date"];
											$result[$i]['redeem_poin'] 		= $data['report'][$i]["redeem_poin"];
											$result[$i]['redeem_date'] 		= $data['report'][$i]["redeem_date"];
						                    $result[$i]['email_tujuan'] 	= $data['report'][$i]["email_tujuan"];
						                    $result[$i]['giift_dmo_id'] 	= $data['report'][$i]["giift_dmo_id"];
						                    $result[$i]['giift_name'] 		= $data['report'][$i]["giift_name"];
						                    $result[$i]['giift_order_id'] 	= $data['report'][$i]["giift_order_id"];
											$result[$i]['giift_value'] 		= $data['report'][$i]["giift_value"];
											$result[$i]['first_name'] 		= $data['report'][$i]["first_name"];
											$result[$i]['cif'] 		= $data['report'][$i]["cif"];
											$result[$i]['rekening'] 		= $data['report'][$i]["rekening"];
											$result[$i]['phone'] 		= $data['report'][$i]["phone"];
											$result[$i]['status'] 		= $data['report'][$i]["status"];
											$result[$i]['status_msg'] 		= $data['report'][$i]["status_msg"];
											}
											// print_r($result);
											// die();
						}else
						{
							$this->session->set_flashdata('msgalert', 'Please select from date and to date');
						}
								
		
						$data['merchant']				= $this->merchant_model->select_merchant();
						$data['report']					= $result;
						$parseData ['header']			= $this->load->view ( 'header', '', true);
						$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
						$parseData ['content']			= $this->load->view ( 'content/reportgiift_redeem', $data, true);
						$parseData ['footer']			= $this->load->view ( 'footer', '', true);
						$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
						$this->load->view ( 'vside', $parseData);

					}
	}
	
	public function report_rule(){

		$date	= $this->input->get_post('date');
		$_SESSION["date"] = $date;
		
		if($date !=	""){
			$data['get_point_by_poincode']  	=   $this->history_model->get_point_by_poincode($date);
		}
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/report_rule', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
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

}

