<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emailsubscribe extends MY_Controller {

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
	$this->load->model ('emailsubscribe_model');
	$this->load->model ('crud_model');

	$this->load->library('excel');
	error_reporting(E_ALL);
	}
	public function index()
	{
        $parseData ['header']			= $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);


        if ($_SESSION['user_data_web']['role'] == 4){
            $parseData ['content']			= $this->load->view ( 'content/forbiden-access', '', true);
        }else{
            $parseData ['content']			= $this->load->view ( 'content/emailsubscribe', '', true);
        }

        $parseData ['footer']			= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
        $this->load->view ( 'vside', $parseData);
	}
	public function datatables()
	{
        $email					= $this->emailsubscribe_model->get_email();
        $get_Totalrequest		= $this->emailsubscribe_model->get_Totalrequest();
        $data 		= array();
		if(count($email) > 0){
			for($i=0; $i<count($email); $i++){

			$nestedData		= array();

			$nestedData[] 	= $email[$i]["email"];
			$nestedData[] 	= $email[$i]["date_sub"];
			// $nestedData[] 	= $email[$i]["updated_date"];
			// $nestedData[] 	= $email[$i]["updated_by"];


				// if($this->session->userdata['user_data_web']['role'] == 1 or $this->session->userdata['user_data_web']['id'] == 2){
				// $nestedData[] 	= '<a href="'.$this->config->item('base_url').'email/update/'.$email[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp</a> &nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'email/delete/'.$email[$i]["id"].'" class="fa fa-fw fa-trash" id="delete" data-confirm="Are you sure you want to Delete this data?">&nbsp;</a> ';
				// $data[] = $nestedData;
				// }else if($this->session->userdata['user_data_web']['role'] == 3){
				// $nestedData[] 	= '<a href="'.$this->config->item('base_url').'email/update/'.$email[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>';
				// $data[] = $nestedData;
				//
				// }else if($this->session->userdata['user_data_web']['role'] == 5){
				// 	$nestedData[]	= '';
				// 	$data[] = $nestedData;
				//
				// }else{
				// 	$nestedData[]	= '';
				// 	$data[] = $nestedData;
				//
				// }
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







	function download_email_letter_sub(){

	$report_member  	=   $this->emailsubscribe_model->download_email_letter_sub();




		$this->excel->getProperties()->setCreator("download_email_letter_sub");
		$this->excel->getProperties()->setLastModifiedBy("Report");
		$this->excel->getProperties()->setTitle("download_email_letter_sub".date('Y-m-d'));
		$this->excel->getProperties()->setSubject("download_email_letter_sub".date('Y-m-d'));
		$this->excel->getProperties()->setDescription("Report download_email_letter_sub Generate at ".date('Y-m-d'));
			$styleArray = array(
			'borders' => array(
				'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
				)
			)
			);
			$titleWS = 'email letter sub'.$dec;



			$WS1 = //$this->excel->setActiveSheetIndex(0);
			$this->excel->createSheet(0);

			$WS1->setCellValue('A1', 'Email letter sub'.$dec.' '.date('M Y',strtotime($date.'-1')))
				->setCellValue('A2', 'No')
				->setCellValue('B2', 'Email');
				// ->setCellValue('C2', 'Email')
				// ->setCellValue('D2', 'Tanggal Lahir')
				// ->setCellValue('E2', 'CIF')
				// ->setCellValue('F2', 'Phone')
				// ->setCellValue('G2', 'Rekening')
				// ->setCellValue('H2', 'Activation date');

			if(count($report_member) > 0){
				for($i=0; $i<count($report_member); $i++){
				$s=$i+3;



						$WS1->setCellValue('A'.$s, $i+1)
							->setCellValue('B'.$s, $report_member[$i]['email']);
							// ->setCellValue('C'.$s, $report_member[$i]['email'])
							// ->setCellValue('D'.$s, $report_member[$i]['dob'])
							// ->setCellValue('E'.$s, $report_member[$i]['cif'])
							// ->setCellValue('F'.$s, " ".$report_member[$i]['phone']." ")
							// ->setCellValue('G'.$s, " ".$report_member[$i]['rekening']." ")
							// ->setCellValue('H'.$s, " ".$report_member[$i]['activation_date']." ");

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
		$filename=$titleWS.'_'.date('M Y') .'.xls'; //save our workbook as this file name
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
