<?php

class Reportpoin_model extends CI_Model
{
	
	public function __construct(){
	parent::__construct();
	$this->db = $this->load->database('default',TRUE);
	$this->load->model('datatables_model','DT');
	$this->load->library('excel');

	
	}
	public function get_reportpoin() {




					$filename = date('Ymd_His').'-export.csv';

					//output the headers for the CSV file
					header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
					header('Content-Description: File Transfer');
					header("Content-type: text/csv");
					header("Content-Disposition: attachment; filename={$filename}");
					header("Expires: 0");
					header("Pragma: public");

					//open the file stream
					$fh = @fopen( 'php://output', 'w' );

					// $headerDisplayed = false;



		 $sqlid	= "SELECT COUNT(c.CIFNO) AS total FROM btn_loyalty_program.M_cif_map_rek c WHERE c.point>0";
	        $queryid		= $this->db->query($sqlid);
	        $ids		= $queryid->result_array();

// print_r($ids[0]['total']);

// die();

	        $count=$ids[0]['total'];
		$perpage =200;

		for ($i=0; $i < $count; $i+=$perpage) { 
			 $sql	= "SELECT m.cif, m.phone, m.first_name, c.point FROM `M_member` m, M_cif_map_rek c WHERE m.rekening=c.ACCTNO AND c.point>0 LIMIT ".$perpage." OFFSET ".$i ;
	        $query		= $this->db->query($sql);
	        $data		= $query->result_array();

	        $y=$data;
	        for ($x=0; $x < count($y) ; $x++) { 
	        	$line= array($y[$x]["CIFNO"],$y[$x]["phone"],$y[$x]["first_name"],$y[$x]["point"]);
	        	fputcsv($fh, $line);
	        }
		}
	
       
      
        // return $data;
    }
    

    public function get_reportpoin2() {// file name 
				$filename = 'Report_poin_'.date('Y:m:d').'.csv'; 
				header("Content-Description: File Transfer"); 
				header("Content-Disposition: attachment; filename=$filename"); 
				header("Content-Type: application/csv; ");
				
				// get data 
				// $usersData = $this->Main_model->getUserDetails();
			

				$sql	= "SELECT m.cif, m.phone, m.first_name, c.point FROM `M_member` m, M_cif_map_rek c WHERE m.rekening=c.ACCTNO AND c.point>0  " ;
			    $query		= $this->db->query($sql);
			    $data		= $query->result_array();
			 
				// file creation 
				$file = fopen('php://output', 'w');
			  
				$header = array("CIF","Phone","Name","Poin"); 
				fputcsv($file, $header);
			

					foreach ($data as $key=>$line){ 
					fputcsv($file,$line); 
					}
			
				fclose($file); 

    }
   
  

}


