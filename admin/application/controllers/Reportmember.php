<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportmember extends MY_Controller {

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
	$this->load->model ('reportmember_model');
	$this->load->model('reportmember_model');
	$this->load->model ('crud_model');

	$this->load->library('excel');
	error_reporting(E_ALL);
	}
	public function index()
	{

	$parseData ['header']			= $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);


        $parseData ['content']			= $this->load->view ( 'content/reportmember', '', true);

		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	}
	public function reddem()
	{
		$data['reportreddem']				= $this->reportmember_model->get_report_reddem();
		//print_r($reportreddem);
		//die();
		$parseData ['header']			= $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);


        $parseData ['content']			= $this->load->view ( 'content/reportreddem', $data, true);

		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	}

	public function datatables()
	{
		//$reportmember				= $this->reportmember_model->get_reportmember();
		$reportmember				= $this->reportmember_model->get_report_member();
		//print_r($reportmembertest);
		//die();
		$get_Totalrequest		= $this->reportmember_model->get_Totalrequest();
		//print_r($reportmember);
		$data 		= array();
		if(count($reportmember) > 0){
			for($i=0; $i<count($reportmember); $i++){
			$nestedData		= array();
			 $nestedData[] 	= $reportmember[$i]["username"];
			 $nestedData[] 	= $reportmember[$i]["poin"];


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
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/reportmember_create', '', true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	}
	public function update($id)
	{
		$data['id']						= ($id != '' && is_numeric($id))? $id:0;
		$data['category']				= $this->reportmember_model->select_reportmember($data['id'], '');
		print_r($data['category']);
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/reportmember_update', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	}
	public function action_update()
	{
		$data['id']			= ($this->input->get_post('id'))?$this->input->get_post('id'):'';
		$data['descripsi']		= ($this->input->get_post('descripsi'))?$this->input->get_post('descripsi'):'';
		$data['name']		= ($this->input->get_post('name')) ? $this->input->get_post('name') : '';
		$data['poin']		= ($this->input->get_post('poin')) ? $this->input->get_post('poin') : '';
		$data['harga']		= ($this->input->get_post('harga')) ? $this->input->get_post('harga') : '';
		$data['aktive']		=  $this->input->get_post('aktive') ;
		// print_r($data);
		// die();
		$this->form_validation->set_rules('name', 'name', 'required');
		if ($this->form_validation->run() == TRUE){
			$loyaltypoin	= $this->reportmember_model->select_reportmember('', $data['name']);
			// if(count($loyaltypoin) > 0){
			// $this->session->set_flashdata('msgalert', 'Update data Failed, loyaltypoin already exists');
			// header("location: ".$this->config->item('base_url'). "loyaltypoin/update/".$data['id']);
			// die;
			// }else{
				$field 	= $data;
				$update_province	= $this->crud_model->update("g_reportmember", $field, $data['id']);
				$this->session->set_flashdata('msgalert', 'Update success');
				header("location: ".$this->config->item('base_url')."reportmember");
				die;
			// }
		}else{
		$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
		header("location: ".$this->config->item('base_url'). "reportmember/update/".$data['id']);
		die;
		}
	}
	public function action_create()
	{
		$data['id']			= ($this->input->get_post('id')) ? $this->input->get_post('id') : '';
		$data['descripsi']		= ($this->input->get_post('descripsi')) ? $this->input->get_post('descripsi') : '';
		$data['name']		= ($this->input->get_post('name')) ? $this->input->get_post('name') : '';
		$data['poin']		= ($this->input->get_post('poin')) ? $this->input->get_post('poin') : '';
		$data['harga']		= ($this->input->get_post('harga')) ? $this->input->get_post('harga') : '';
		$data['aktive']		=  $this->input->get_post('aktive');
		$this->form_validation->set_rules('name', 'name', 'required');
		if ($this->form_validation->run() == TRUE){
			$category	= $this->reportmember_model->select_reportmember('', $data['name']);
			if(count($category) > 0){
			$this->session->set_flashdata('msgalert', 'Insert data Failed, reportmember already exists');
			header("location: ".$this->config->item('base_url')."reportmember/create");
			die;
			}else{
				$field 		= $data;
				$create_admin	= $this->crud_model->create("g_reportmember", $field);
				if($create_admin){
				$this->session->set_flashdata('msgalert', 'Insert data Success');
				header("location: ".$this->config->item('base_url'). "reportmember");
				die;
				}else{
				$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
				header("location: ".$this->config->item('base_url'). "reportmember/create");
				die;
				}
			}
		}else{
		$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
		header("location: ".$this->config->item('base_url'). "reportmember/create");
		die;
		}
	}


public function per_poin_user()
{

	$data['from_date']		= ($this->input->get_post('from_date'))?$this->input->get_post('from_date'):'';
	$data['to_date']		= ($this->input->get_post('to_date'))?$this->input->get_post('to_date'):'';



	$result =array();
	if($data['to_date'] !='' && $data['from_date'] !=''){

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



					$akt_login_user	= $this->reportmember_model->per_poin_user($data['explode_from_date'],$data['explode_to_date']);

								// print_r($akt_login_user);

			if(count($akt_login_user) > 0){
				for($i=0; $i<count($akt_login_user); $i++){

				$result[$i]['username'] 				= 	$akt_login_user[$i]['username'];
				$result[$i]['type'] 			= 	$akt_login_user[$i]['type'];
				$result[$i]['poin'] 			= 	$akt_login_user[$i]['poin_didapat'];
				$result[$i]['date_time'] 			= 	$akt_login_user[$i]['date_time'];


				}
			}
	}else{
		$this->session->set_flashdata('msgalert', 'Please select date range');
	}

// print_r($result)
	$data['report']					= $result;
	$parseData ['header']			= $this->load->view ( 'header', '', true);
	$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
	$parseData ['content']			= $this->load->view ( 'content/per_poin_user', $data, true);
	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
	$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	$this->load->view ( 'vside', $parseData);

}
public function akt_login_user()
{

	$data['from_date']		= ($this->input->get_post('from_date'))?$this->input->get_post('from_date'):'';
	$data['to_date']		= ($this->input->get_post('to_date'))?$this->input->get_post('to_date'):'';



	$result =array();
	if($data['to_date'] !='' && $data['from_date'] !=''){

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



					$akt_login_user	= $this->reportmember_model->akt_login_user($data['explode_from_date'],$data['explode_to_date']);

								// print_r($akt_login_user);

			if(count($akt_login_user) > 0){
				for($i=0; $i<count($akt_login_user); $i++){

				$result[$i]['username'] 				= 	$akt_login_user[$i]['username'];
				$result[$i]['date_login'] 			= 	$akt_login_user[$i]['date_time'];


				}
			}
	}else{
		$this->session->set_flashdata('msgalert', 'Please select date range');
	}

// print_r($result)
	$data['report']					= $result;
	$parseData ['header']			= $this->load->view ( 'header', '', true);
	$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
	$parseData ['content']			= $this->load->view ( 'content/akt_login_user', $data, true);
	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
	$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	$this->load->view ( 'vside', $parseData);

}
	public function penukaran_poin()
	{

		$data['from_date']		= ($this->input->get_post('from_date'))?$this->input->get_post('from_date'):'';
		$data['to_date']		= ($this->input->get_post('to_date'))?$this->input->get_post('to_date'):'';



		$result =array();
		if($data['to_date'] !='' && $data['from_date'] !=''){

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



						$akt_login_user	= $this->reportmember_model->penukaran_poin($data['explode_from_date'],$data['explode_to_date']);

									// print_r($akt_login_user);
// get_katalog
				if(count($akt_login_user) > 0){
					for($i=0; $i<count($akt_login_user); $i++){

					$result[$i]['username'] 				= 	$akt_login_user[$i]['username'];
					$result[$i]['poin'] 			= 	$akt_login_user[$i]['poin_dipakai'];
					$result[$i]['nama_barang'] 			= 	 $this->reportmember_model->get_katalog($akt_login_user[$i]['id_katalog'])[0]['name'];
					$result[$i]['kode_barang'] 			= 	 $this->reportmember_model->get_katalog($akt_login_user[$i]['id_katalog'])[0]['prize_code'];
					$result[$i]['date_time'] 			= 	$akt_login_user[$i]['date_time'];


					}
				}
		}else{
			$this->session->set_flashdata('msgalert', 'Please select date range');
		}

// print_r($result)
		$data['report']					= $result;
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/penukaran_poin', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);

	}

	public function download_akt_login_user(){
		// $data['merchant_id']	= ($this->input->get_post('merchant_id'))?$this->input->get_post('merchant_id'):0;
		$data['from_date']		= ($this->input->get_post('from_date'))?$this->input->get_post('from_date'):'';
		$data['to_date']		= ($this->input->get_post('to_date'))?$this->input->get_post('to_date'):'';
		// $data['target']			= ($this->input->get_post('target'))?$this->input->get_post('target'):'';
		$vars 							= array(
											'merchant_id' 	=> $data['merchant_id'],
											'type' 			=> "redeem",
											'from_date' 	=> $data['from_date'],
											'to_date' 		=> $data['to_date']
										);


		$akt_login_user	= $this->reportmember_model->akt_login_user( $data['from_date'],$data['to_date']);


		// print_r($akt_login_user);


				// $program_name   =$this->report_model->program_name($data['program_code'])[0]['program_name'];
		$data['report']					= $akt_login_user;
				$this->excel->getProperties()->setCreator("Aktifitas_login_user");
				$this->excel->getProperties()->setLastModifiedBy("Report");
				$this->excel->getProperties()->setTitle("Aktifitas_login_user".date('Y-m-d'));
				$this->excel->getProperties()->setSubject("Aktifitas_login_user".date('Y-m-d'));
				$this->excel->getProperties()->setDescription("Report Aktifitas login user Generate at ".date('Y-m-d'));
					$styleArray = array(
					'borders' => array(
						'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
					);
					// $merchant				= $this->merchant_model->select_merchant();
					$titleWS = 'Aktifitas login user';

					//$titleWS = ''.$data['merchant_id'];
					$WS1 = $this->excel->createSheet(0);
						// if($data['target'] == 'internal'){
						$WS1->setCellValue('A1',   $titleWS .'  Report')
							->setCellValue('A2', 'Nomor Handphone')
							->setCellValue('B2', 'Poin')
							->setCellValue('C2', 'Date')

							;
						// }else{
						// 	$WS1->setCellValue('A1',   $titleWS .'  Report')
						// 		->setCellValue('A2', 'Nomor Handphone')
						// 		->setCellValue('B2', 'Poin')
						// 		->setCellValue('C2', 'Date')
						// 	;
						// }
					if(count($akt_login_user) > 0){
						for($i=0; $i<count($akt_login_user); $i++){
						// $member	= $this->member_model->select_member($report_redeem[$i]['member_id']);
						$s=$i+3;
						// $phone =$akt_login_user[$i]['phone'];
						// $norek =$akt_login_user[$i]['rekening'];

							// if($data['target'] == 'internal'){
								$WS1->setCellValue('A'.$s, $akt_login_user[$i]['username'])
									->setCellValue('B'.$s, $akt_login_user[$i]['poin'])
									->setCellValue('C'.$s, $akt_login_user[$i]['date_time'])

									;
							// }else{
							// 	$WS1->setCellValue('A'.$s, $report_redeem[$i]['username'])
							// 		->setCellValue('B'.$s, $report_redeem[$i]['poin'])
							// 		->setCellValue('C'.$s, $report_redeem[$i]['date_time'])
							// 		;
							// }
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

		public function download_penukaran_poin(){
			// $data['merchant_id']	= ($this->input->get_post('merchant_id'))?$this->input->get_post('merchant_id'):0;
			$data['from_date']		= ($this->input->get_post('from_date'))?$this->input->get_post('from_date'):'';
			$data['to_date']		= ($this->input->get_post('to_date'))?$this->input->get_post('to_date'):'';
			// $data['target']			= ($this->input->get_post('target'))?$this->input->get_post('target'):'';
			// $vars 							= array(
			// 									'merchant_id' 	=> $data['merchant_id'],
			// 									'type' 			=> "redeem",
			// 									'from_date' 	=> $data['from_date'],
			// 									'to_date' 		=> $data['to_date']
			// 								);


			$penukaran_poin	= $this->reportmember_model->penukaran_poin( $data['from_date'],$data['to_date']);


			// print_r($akt_login_user);


					// $program_name   =$this->report_model->program_name($data['program_code'])[0]['program_name'];
			$data['report']					= $penukaran_poin;
					$this->excel->getProperties()->setCreator("Penukaran_poin");
					$this->excel->getProperties()->setLastModifiedBy("Report");
					$this->excel->getProperties()->setTitle("Penukaran_poin".date('Y-m-d'));
					$this->excel->getProperties()->setSubject("Penukaran_poin".date('Y-m-d'));
					$this->excel->getProperties()->setDescription("Report Penukaran poin user Generate at ".date('Y-m-d'));
						$styleArray = array(
						'borders' => array(
							'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
							)
						)
						);
						// $merchant				= $this->merchant_model->select_merchant();
						$titleWS = 'Aktifitas Penukaran poin';

						//$titleWS = ''.$data['merchant_id'];
						$WS1 = $this->excel->createSheet(0);
							// if($data['target'] == 'internal'){
							$WS1->setCellValue('A1',   $titleWS .'  Report')
								->setCellValue('A2', 'Nomor Handphone')
								->setCellValue('B2', 'Nama_barang')
								->setCellValue('C2', 'Kode_barang')
								->setCellValue('D2', 'Poin')
								->setCellValue('E2', 'Date')

								;
							// }else{
							// 	$WS1->setCellValue('A1',   $titleWS .'  Report')
							// 		->setCellValue('A2', 'Nomor Handphone')
							// 		->setCellValue('B2', 'Poin')
							// 		->setCellValue('C2', 'Date')
							// 	;
							// }
						if(count($penukaran_poin) > 0){
							for($i=0; $i<count($penukaran_poin); $i++){
							// $member	= $this->member_model->select_member($report_redeem[$i]['member_id']);
							$s=$i+3;
							// $phone =$penukaran_poin[$i]['phone'];
							// $norek =$penukaran_poin[$i]['rekening'];

								// if($data['target'] == 'internal'){
									$WS1->setCellValue('A'.$s, $penukaran_poin[$i]['username'])
											->setCellValue('B'.$s, $this->reportmember_model->get_katalog($penukaran_poin[$i]['id_katalog'])[0]['name'])
											->setCellValue('C'.$s, $this->reportmember_model->get_katalog($penukaran_poin[$i]['id_katalog'])[0]['prize_code'])
											->setCellValue('D'.$s, $penukaran_poin[$i]['poin_dipakai'])
											->setCellValue('E'.$s, $penukaran_poin[$i]['date_time'])

										;
								// }else{
								// 	$WS1->setCellValue('A'.$s, $penukaran_poin[$i]['username'])
								// 		->setCellValue('B'.$s, $penukaran_poin[$i]['poin'])
								// 		->setCellValue('C'.$s, $penukaran_poin[$i]['date_time'])
								// 		;
								// }
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
			public function download_per_poin_user(){
				// $data['merchant_id']	= ($this->input->get_post('merchant_id'))?$this->input->get_post('merchant_id'):0;
				$data['from_date']		= ($this->input->get_post('from_date'))?$this->input->get_post('from_date'):'';
				$data['to_date']		= ($this->input->get_post('to_date'))?$this->input->get_post('to_date'):'';
				// $data['target']			= ($this->input->get_post('target'))?$this->input->get_post('target'):'';
				// $vars 							= array(
				// 									'merchant_id' 	=> $data['merchant_id'],
				// 									'type' 			=> "redeem",
				// 									'from_date' 	=> $data['from_date'],
				// 									'to_date' 		=> $data['to_date']
				// 								);


				$per_poin_user	= $this->reportmember_model->per_poin_user( $data['from_date'],$data['to_date']);


				// print_r($per_poin_user);


						// $program_name   =$this->report_model->program_name($data['program_code'])[0]['program_name'];
				$data['report']					= json_decode($report);
						$this->excel->getProperties()->setCreator("Perolehan_poin");
						$this->excel->getProperties()->setLastModifiedBy("Report");
						$this->excel->getProperties()->setTitle("Perolehan_poin".date('Y-m-d'));
						$this->excel->getProperties()->setSubject("Perolehan_poin".date('Y-m-d'));
						$this->excel->getProperties()->setDescription("Report Perolehan poin Generate at ".date('Y-m-d'));
							$styleArray = array(
							'borders' => array(
								'allborders' => array(
								'style' => PHPExcel_Style_Border::BORDER_THIN
								)
							)
							);
							// $merchant				= $this->merchant_model->select_merchant();
							$titleWS = 'Report Perolehan Poin';

							//$titleWS = ''.$data['merchant_id'];
							$WS1 = $this->excel->createSheet(0);
								// if($data['target'] == 'internal'){
								$WS1->setCellValue('A1',   $titleWS .'  Report')
									->setCellValue('A2', 'Nomor Handphone')
									->setCellValue('B2', 'Type')
									->setCellValue('C2', 'Poin')
									->setCellValue('D2', 'Date')

									;
								// }else{
								// 	$WS1->setCellValue('A1',   $titleWS .'  Report')
								// 		->setCellValue('A2', 'Nomor Handphone')
								// 		->setCellValue('B2', 'Poin')
								// 		->setCellValue('C2', 'Date')
								// 	;
								// }
							if(count($per_poin_user) > 0){
								for($i=0; $i<count($per_poin_user); $i++){
								// $member	= $this->member_model->select_member($report_redeem[$i]['member_id']);
								$s=$i+3;
								// $phone =$akt_login_user[$i]['phone'];
								// $norek =$akt_login_user[$i]['rekening'];

									// if($data['target'] == 'internal'){
										$WS1->setCellValue('A'.$s, $per_poin_user[$i]['username'])
										->setCellValue('B'.$s, $per_poin_user[$i]['type'])
											->setCellValue('C'.$s, $per_poin_user[$i]['poin_didapat'])
											->setCellValue('D'.$s, $per_poin_user[$i]['date_time'])

											;
									// }else{
									// 	$WS1->setCellValue('A'.$s, $per_poin_user[$i]['username'])
									// 		->setCellValue('B'.$s, $per_poin_user[$i]['poin'])
									// 		->setCellValue('C'.$s, $per_poin_user[$i]['date_time'])
									// 		;
									// }
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
}
