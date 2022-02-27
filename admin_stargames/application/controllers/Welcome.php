<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

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
        $this->load->model ('history_model');
        $this->load->model ('member_model');
        $this->load->model('admin_model');
        $this->load->library('excel');
        error_reporting(0);
	}
    public function index()
	{

       $data['jumlah'] = $this->admin_model->get_jumlah_user()[0]['jumlah'];
       $data['reddem_poin'] = $this->admin_model->get_reddem_poin()[0]['reddem'];
       $data['poin_didapat'] = $this->admin_model->get_poin_didapat()[0]['poin_didapat'];
       $data['poin_today'] = $this->admin_model->get_poin_today()[0]['poin_didapat'];
			 $data['jumlah_aktif'] = $this->admin_model->get_jumlah_user_aktif()[0]['jumlah'];
       $data['jumlah_user_login_hari_ini'] = $this->admin_model->get_jumlah_user_login_hari_ini()[0]['jumlah'];
       // print_r($data);
			 // print_r(date("Y-m-d"));
       $parseData['header']                = $this->load->view('header', '', true);
        $parseData['left_coloumn']            = $this->load->view('left_coloumn', '', true);
        $parseData['content']                = $this->load->view('content/dashboard', $data, true);
        $parseData['footer']                = $this->load->view('footer', '', true);
        $parseData['control_sidebar']        = $this->load->view('control_sidebar', '', true);
        $this->load->view('vside', $parseData);
    }
    public function index_test()
	{
        // $data['total_member'] =count($this->member_model->total_member());
        // $data['stats_member_total_poin_daily'] = $this->history_model->get_all_poin_perday(date("Y-m-d"),date("Y-m-d"));

        // // $data['get_poin_redeem'] = $this->history_model->get_distribution_redeem(date("Y-m-d"),date("Y-m-d"));
        // // $data['get_poin_exchange']  = $this->history_model->get_distribution(date("Y-m-d"),date("Y-m-d"));


        // $data['get_poin_redeem_day'] = $this->history_model->get_poin_redeem_day();
        // $data['get_poin_exchange_day']  = $this->history_model->get_poin_exchange_day();

        //SELECT (SUM(point)) AS Total FROM M_point_history
        // $date_start= '2018-06-25 00:00:00';//
        $date_start= date('Y-m-d 00:00:00');//
        // date('Y-m-d 00:00:00');
        $date_end = date('Y-m-d 00:00:00',strtotime('+1 day', strtotime($date_start)));
        //strtotime($date_start)+86400;//$date_start->modify('+1 day');//
        //count interval date
        $begin = new DateTime($date_start);//('2010-05-01');
        $end = new DateTime($date_end);//('2010-05-10');
        $start=$date_start;
        $last = $date_end;
        //echo "begin = $begin</br> start = $start last = $last</br>";
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);

        $now = time(); // or your date as well
        $your_date = strtotime("2010-01-01");
        $datediff = strtotime($last)- strtotime($start);

        $datediff= round($datediff / (60 * 60 * 24));

        if($datediff<=7){
            $i=0;
            foreach ($period as $dt) {
                $date = $dt->format("Y-m-d");
                $data['member_total_poin_perday'][$i] = $this->history_model->get_all_poin_daybyday($date);
                $data['date'][$i]=$date;
                // echo "date = $date</br>";
                // print_r($data['member_total_poin_perday'][$i]);
                // echo "</br>";
                $i++;

            }
            //print_r($data['member_total_poin_daily']);
            // die;
        }
        $date = $dt->format("Y-m-d");
        $data['total_poin_perday'] = $this->history_model->get_all_poin_daybyday($date);



        $data['get_all_poin_permonth'] = $this->history_model->get_all_poin_permonth();
        $data['member_total_poin_daily'] = $this->history_model->get_all_poin_perday($date_start,$date_end);
        $data['member_total_poin'] = $this->history_model->get_all_poin();
        $data['member_history']				= $this->history_model->get_member_history();
        $data['member_transaction_history']	= $this->history_model->get_member_transaction_history();
        // print_r($data['member_transaction_history'] );
        // die();
        $parseData ['header']				= $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']			= $this->load->view ( 'left_coloumn', '', true);
        $parseData ['content']				= $this->load->view ( 'content/welcome', $data, true);
        $parseData ['footer']				= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']		= $this->load->view ( 'control_sidebar', '', true);
        $this->load->view ( 'vside', $parseData);
    }

    public function analitics()
	{



        // $data['stats_member_total_poin_daily'] = $this->history_model->get_all_poin_perday(date("Y-m-d"),date("Y-m-d"));

        // $data['get_poin_redeem_day'] = $this->history_model->get_poin_redeem_day();
        // $data['get_poin_exchange_day']  = $this->history_model->get_poin_exchange_day();

        // $data['total_member'] =count($this->member_model->total_member());
        //SELECT (SUM(point)) AS Total FROM M_point_history
        // $date_start= '2018-06-25 00:00:00';//
        $date_start= date('Y-m-d 00:00:00');//
        // date('Y-m-d 00:00:00');
        $date_end = date('Y-m-d 00:00:00',strtotime('+1 day', strtotime($date_start)));
        //strtotime($date_start)+86400;//$date_start->modify('+1 day');//
        $data['get_all_poin_permonth'] = $this->history_model->get_all_poin_permonth();
        $data['member_total_poin_daily'] = $this->history_model->get_all_poin_perday($date_start,$date_end);
        $data['member_total_poin'] = $this->history_model->get_all_poin();

        $data['member_history']				= $this->history_model->get_member_history();
        $data['member_transaction_history']	= $this->history_model->get_member_transaction_history();

		$data['program_code']	= ($this->input->get_post('program_code'))?$this->input->get_post('program_code'):'';
		$data['from_date']		= ($this->input->get_post('from_date'))?$this->input->get_post('from_date'):'';
        $data['to_date']		= ($this->input->get_post('to_date'))?$this->input->get_post('to_date'):'';



        $_SESSION["session_data"] = $data;
        if($data['to_date'] != ''){
            $date 						= explode("/", $data['to_date']);
            $data['explode_from_date']	= $date[2].'-'.$date[0].'-'.$date[1];
        }else{
            $data['explode_from_date']	= "2018-04-29";
        }

        if($data['from_date'] != ''){
            $date 						= explode("/", $data['from_date']);
            $tanggal = $date[1];
            $data['explode_to_date']	= $date[2].'-'.$date[0].'-'.$tanggal;
        }else{
            $data['explode_to_date']	= "2018-05-03";
        }

        //count interval date
        $begin = new DateTime($data['explode_from_date']);//('2010-05-01');
        $end = new DateTime($data['explode_to_date']);//('2010-05-10');
        $start=$data['explode_from_date'];
        $last = $data['explode_to_date'];
        //echo "begin = $begin</br> start = $start last = $last</br>";
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);

        $now = time(); // or your date as well
        $your_date = strtotime("2010-01-01");
        $datediff = strtotime($last)- strtotime($start);

        $datediff= round($datediff / (60 * 60 * 24));

		if ($data['program_code'] == 'point_daily'){
            if($datediff<=7){
                $i=0;
                foreach ($period as $dt) {
                    $date = $dt->format("Y-m-d");
                    $data['member_total_poin_perday'][$i] = $this->history_model->get_all_poin_daybyday($date);
                    $data['date'][$i]=$date;
                    // echo "date = $date</br>";
                    // print_r($data['member_total_poin_perday'][$i]);
                    // echo "</br>";
                    $i++;

                }
                //print_r($data['member_total_poin_daily']);
                // die;
            }else{
                //echo "wrong";
                $this->session->set_flashdata('msgalert', "Please select Weekly point your date renge is $datediff");
               // console.log("go to weekly");
            }
        }
        else if($data['program_code']  == "point_weekly"){

           // echo "start = $start last = $last";  $data['member_total_poin_weekly']
           $weekly = $this->history_model->get_all_poin_byWeek($start,$last);

            // echo "<pre>";
            // print_r($weekly);
            // echo "</pre>";
            // echo count($weekly)."</br>";
            $data['member_total_poin_weekly'] = $weekly;
            // for($i=0; $i< count($weekly); $i++){
            //    echo "total = ".$data['member_total_poin_weekly'][$i]['Total']."</br>";
            //    echo "week = ".$data['member_total_poin_weekly'][$i]['week']."</br>";
            // }
           // die;

        }
        else if($data['program_code']  == "point_monthly"){

            // echo "start = $start last = $last";  $data['member_total_poin_weekly']
            $weekly = $this->history_model->get_all_poin_byMonth($start,$last);

             // echo "<pre>";
             // print_r($weekly);
             // echo "</pre>";
             // echo count($weekly)."</br>";
             $data['member_total_poin_monthly'] = $weekly;
             // for($i=0; $i< count($weekly); $i++){
             //    echo "total = ".$data['member_total_poin_weekly'][$i]['Total']."</br>";
             //    echo "week = ".$data['member_total_poin_weekly'][$i]['week']."</br>";
             // }
            // die;

         }
         else if($data['program_code']  == "point_distribution_redeem"){
            $get_distribution_redeem = $this->history_model->get_distribution_redeem($start,$last);

             $data['get_distribution_redeem'] = $get_distribution_redeem;


            //  print_r($data['get_distribution_redeem']);
         }
         else if($data['program_code']  == "point_distribution_exchange"){

            $get_distribution_exchange = $this->history_model->get_distribution($start,$last);

             $data['get_distribution_exchange'] = $get_distribution_exchange;
            //  print_r($data);
         }
		else{
			//$this->session->set_flashdata('msgalert', 'Please select Program');
			//$data['program']				= $this->program_model->select_program();
			//$data['report']					= $result;
			// $parseData ['header']			= $this->load->view ( 'header', '', true);
			// $parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
			// $parseData ['content']			= $this->load->view ( 'content/welcome', $data, true);
			// $parseData ['footer']			= $this->load->view ( 'footer', '', true);
			// $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
			// $this->load->view ( 'vside', $parseData);

        }

        $parseData ['header']				= $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']			= $this->load->view ( 'left_coloumn', '', true);
        $parseData ['content']				= $this->load->view ( 'content/welcome', $data, true);
        $parseData ['footer']				= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']		= $this->load->view ( 'control_sidebar', '', true);
        $this->load->view ( 'vside', $parseData);


    }

    public function datatables()
    {
             $member					= $this->member_model->get_approval_list();
            //  <th>No</th>
            //  <th>Account No</th>
            //  <th>Point adjust</th>
            //  <th>Request by</th>
            //  <th>Poin Code</th>
            //  <th>Status</th>
            //  <th>Date Request</th>
            //  <th> approve </th>


            $data 		= array();
            if(count($member) > 0){
                for($i=0; $i<count($member); $i++){
                    $status ="pending";
                    if($member[$i]["status"]==1){
                        $status  = "Approved";
                    }
                    $nestedData		= array();
                    $nestedData[] 	= $member[$i]["id"];
                    $nestedData[] 	= $member[$i]["member_id"];
                    $nestedData[] 	= $member[$i]["ACCTNO"];
                    $nestedData[] 	= $member[$i]["point_adjust"];
                    //$nestedData[] 	= $member[$i]["requester_id"];
                    $nestedData[] 	= $member[$i]["requester_name"];
                    $nestedData[] 	= $member[$i]["poin_code"];
                    $nestedData[] 	= $status;//$member[$i]["status"];
                    $nestedData[] 	= $member[$i]["date_request"];
                    $nestedData[] 	= $member[$i]["approver_name"];
                    $nestedData[] 	= $member[$i]["date_approved"];

                    if($member[$i]["status"]==0){
                        // $nestedData[] 	= '<a href="'.$this->config->item('base_url').'member/update_point/'.$member[$i]["id"].'?point='.$member[$i]["point_adjust"].'&poin_code='.$member[$i]['poin_code'].'&member_id='.$member[$i]["member_id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'member/detail/'.$member[$i]["member_id"].'" class="fa fa-fw fa-user">&nbsp;</a>';
                        // $nestedData[] 	= '<a href="'.$this->config->item('base_url').'member/update_point/'.$member[$i]["member_id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'member/detail/'.$member[$i]["member_id"].'" class="fa fa-fw fa-user">&nbsp;</a>';
                        $nestedData[] 	= '<a href="'.$this->config->item('base_url').'member/update_point/'.$member[$i]["id"].'?point='.$member[$i]["point_adjust"].'&poin_code='.$member[$i]['poin_code'].'&member_id='.$member[$i]["ACCTNO"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'member/detail/'.$member[$i]["ACCTNO"].'" class="fa fa-fw fa-user">&nbsp;</a>';

                    }else{
                        $nestedData[] 	= '<a href="'.$this->config->item('base_url').'member/detail/'.$member[$i]["ACCTNO"].'" class="fa fa-fw fa-user">&nbsp;</a>';
                    }

                    $data[] = $nestedData;
                    }
            }
            $json_data = array(
                    "draw"            => intval(@$_REQUEST['draw']),
                    "data"            => $data   // total data array
                    );

            echo json_encode($json_data);  // send data as json format
    }

    public function download_analitics(){
		//$this->output->enable_profiler(TRUE);
		$data['program_code']	= ($this->input->get_post('program_code'))?$this->input->get_post('program_code'):0;
		$data['from_date']		= ($this->input->get_post('from_date'))?$this->input->get_post('from_date'):'';
		$data['to_date']		= ($this->input->get_post('to_date'))?$this->input->get_post('to_date'):'';
        $data['target']			= ($this->input->get_post('target'))?$this->input->get_post('target'):'';
        $data['detail_point']			= ($this->input->get_post('detail_point'))?$this->input->get_post('detail_point'):'';
        $data['detail_date']			= ($this->input->get_post('detail_date'))?$this->input->get_post('detail_date'):'';
        $member_total_poin_perday =($data['detail_point']);
        $dateDet=$data['detail_date'];
       // $unse=unserialize($member_total_poin_perday );
       print_r($data);
        echo "<pre>";
        // print_r($member_total_poin_perday);
        echo "</pre>";
        //$serialized = serialize($member_total_poin_perday);
        //echo "point ".$member_total_poin_perday;
        for ($i=0; $i<count($member_total_poin_perday); $i++){
            // echo "<br>Point con". $dateDet[$i]." = ".$member_total_poin_perday[$i];
        };
        //die;
		$vars 							= array(
											'program_code' 	=> $data['program_code'],
											'type' 			=> "exchange",
											'from_date' 	=> $data['from_date'],
											'to_date' 		=> $data['to_date']
                                        );


		//$report_exchange 				= $this->report_model->get_Reportexchange($data['program_code'], $data['from_date'], $data['to_date']);
		//$report							= $this->curl(json_encode($vars), 'http://127.0.0.1:8081/log/exchange_report');//'http://10.255.0.140:8081/log/exchange_report');
        //$data['report']					= json_decode($report);

				$this->excel->getProperties()->setCreator("Report_analitics");
				$this->excel->getProperties()->setLastModifiedBy("Report");
				$this->excel->getProperties()->setTitle("Report_analitics".date('Y-m-d'));
				$this->excel->getProperties()->setSubject("Report_analitics".date('Y-m-d'));
				$this->excel->getProperties()->setDescription("Report analitics Generate at ".date('Y-m-d'));
					$styleArray = array(
					'borders' => array(
						'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
					);
					$titleWS = $data['program_code'];
					// $program = $this->program_model->select_program();
					// if(count($program) > 0){
					// 	for($i=0; $i<count($program); $i++){
					// 		if ($program[$i]['program_code'] == $data['program_code']){
					// 			//echo '<h2>'.$program[$i]['program_name'].' Exchange report</h2><br>';
					// 			$titleWS = $program[$i]['program_name'];
					// 		}

					// 	}
					//}


                    $WS1 = //$this->excel->setActiveSheetIndex(0);
                    $this->excel->createSheet(0);
					//$ws1 =$this->excel->createSheet(0)->setTitle($titleWS, true);
					if($data['target'] == 'internal'){
					$WS1->setCellValue('A1', 'No')
						->setCellValue('B1', 'Date')
						->setCellValue('C1', 'Total Point')

						;
                    }
                    $no=1;
					if(count($member_total_poin_perday) > 0){
						for($i=0; $i<count($member_total_poin_perday); $i++){
						//$member	= $this->member_model->select_member($report_exchange[$i]->member_id);
						$s=$i+2;
							if($data['target'] == 'internal'){
								$WS1->setCellValue('A'.$s, $no++)
									->setCellValue('B'.$s, $dateDet[$i])
									->setCellValue('C'.$s,  $member_total_poin_perday[$i])
									;
							}
						}
					}else{
					    $s = 2;
					}
				$WS1->getStyle('A1:W'.$s)->applyFromArray($styleArray);
				$WS1->getStyle('V1:V'.$s)->getNumberFormat()->setFormatCode('00000000000');
				$WS1->getStyle('W1:W'.$s)->getNumberFormat()->setFormatCode('00000000000');
				$WS1->getColumnDimension("A:W")->setAutoSize(true);
				//$WS1->getColumnDimension('A1:Y'.$s)->setAutoSize(true);
				$WS1->setTitle($titleWS.'_'.$data['target']	);
				$this->excel->setActiveSheetIndex(0);
				ob_end_clean();
				$filename=$titleWS.'_'.$data['from_date'].'s/d'.$data['to_date'].'.xls'; //save our workbook as this file name
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
				header('Cache-Control: max-age=0'); //no cache
				//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
				//if you want to save it as .XLSX Excel 2007 format
				$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
				//force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');

                $this->db->last_query();
		//die;
		//$this->load->library('excel');
    }

}
