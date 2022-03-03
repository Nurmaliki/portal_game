<?php

class AdjustPoin_model extends CI_Model
{
	/*public function __construct() {
	}*/
	public function __construct(){
	parent::__construct();
	$this->db = $this->load->database('default',TRUE);
	$this->load->model('datatables_model','DT');

	}
	public function get_Totalrequest() {

		$where_sql	= '';
	if (isset($_GET['search']['value']) && $_GET['search']['value'] != "" ) {
		if(is_numeric($_GET['search']['value'])){
				$where_sql	.= "WHERE rule_code LIKE '%".$_GET['search']['value']."%' ";//." or m.rekening = ".$_GET['search']['value'];
		}else{
				$where_sql	.= "WHERE user LIKE '%".$_GET['search']['value']."%' ";//or UCASE(m.first_name) LIKE '%".strtoupper($_GET['search']['value'])."%'";
		}

	}

		$offset = $this->DT->get_start();
		$rows   = $this->DT->get_rows();
	$sql	= "	SELECT * FROM btn_loyalty_program.M_log_adjust_poin ".$where_sql;
	$query		= $this->db->query($sql);
	$data		= $query->result_array();
	return $data;
	}
   	public function get_adjust_poin() {
			$where_sql	= '';
	 if (isset($_GET['search']['value']) && $_GET['search']['value'] != "" ) {
		 if(is_numeric($_GET['search']['value'])){
				 $where_sql	.= "WHERE rule_code LIKE '%".$_GET['search']['value']."%' ";//." or m.rekening = ".$_GET['search']['value'];
			 }else{
				 $where_sql	.= "WHERE user LIKE '%".$_GET['search']['value']."%' ";//or UCASE(m.first_name) LIKE '%".strtoupper($_GET['search']['value'])."%'";
		 }

	 }
	$offset = $this->DT->get_start();
	$rows   = $this->DT->get_rows();
	$sql	= "	SELECT * FROM btn_loyalty_program.M_log_adjust_poin ".$where_sql."   LIMIT $offset,$rows";
	$query		= $this->db->query($sql);
	$data		= $query->result_array();
	return $data;
	}
	public function select_point_management($id='') {
	$sql	= "	SELECT * FROM btn_loyalty_program.M_log_adjust_poin  where id = ".$id;
	$query		= $this->db->query($sql);
	$data		= $query->result_array();
	return $data;
	}
	public function rulecode() {
	$sql	= "SELECT poin_code FROM M_point_history GROUP BY poin_code";
	$query		= $this->db->query($sql);
	$data		= $query->result_array();
	return $data;
	}

	public function get_member_cif_or_rek($search) {

        // $where_awal="WHERE m.rekening = mr.ACCTNO ";
        // $where_awal ='';

        $where_sql  = '';
        if (isset($search) && $search!= "" ) {
            if(is_numeric($search)){
                $where_sql  .= "WHERE rekening = ".$search." ";//." or m.rekening = ".$_GET['search']['value'];
            }else{
                $where_sql  .= "WHERE cif = ".$search." ";//or UCASE(m.first_name) LIKE '%".strtoupper($_GET['search']['value'])."%'";
            }

        }
        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql    = " SELECT *  FROM M_member  ".$where_sql."  LIMIT $offset,$rows";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;

    }

    public function get_member_by_phone($search) {

				$test=substr($search, 0,2);
        $where_sql  = '';
        if (isset($search) && $search!= "" ) {
					if(is_numeric($search) && $test == '62'){


					 $where_sql  .= "WHERE phone = '".$search."' ";

					}else  if(is_numeric($search)){

                $where_sql  .= "WHERE rekening = ".$search." ";

          }else{

                $where_sql  .= "WHERE CIF = '".$search."' ";

            }

        }
        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql    = " SELECT *  FROM M_member  ".$where_sql."  LIMIT $offset,$rows";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;

    }

    public function select_total_poin_by_cif($cif){
    	// print_r($cif);
    	// die();
        $sql    = " SELECT CIFNO, (SUM(point)) AS Total FROM M_cif_map_rek WHERE CIFNO LIKE '%".$cif."%' GROUP BY CIFNO";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        //print_r($data[0]['point']);
        //die;
        return $data[0]['Total'];

    }


}
