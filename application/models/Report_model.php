<?php

class Report_model extends CI_Model
{
	/*public function __construct() {
	}*/
	public function __construct(){
	parent::__construct();
	$this->db = $this->load->database('default',TRUE);
	$this->load->model('datatables_model','DT');
	//$this->load->library('session');
	}
	public function get_Reportexchange($program_code='', $from_date='', $to_date='') {
        $this->db->get_compiled_select();
        $where_sql	= '';
            if($program_code != ''){
                $where_sql	.= ' and h.program_id LIKE "%'.$program_code.'%"';
            }
            if($from_date != '' and $to_date != ''){
                $where_sql	.= ' and (h.date_created >= "'.$from_date.'" and h.date_created <= "'.$to_date.'")';
            }
        $sql	= "SELECT h.exchange_poin, h.exchange_date,h.date_created, h.id as hid, h.phone_tujuan, m.first_name, m.cif, m.rekening, m.phone,m.email, t.total, p.program_name FROM btn_loyalty_member.M_history h left join btn_loyalty_program.M_member m on m.id = h.member_id left join btn_loyalty_program.M_cif_total_point t on t.CIFNO LIKE concat('%', m.cif,'%') left join btn_loyalty_program.M_program p on p.program_code LIKE concat('%', h.program_id,'%') where h.exchange_poin > 0".$where_sql;
        $query		= $this->db->query($sql);
        //$this->output->enable_profiler(TRUE);
        //print_r($query); die;
        //echo $this->db->last_query(); die;
        $data		= $query->result_array();
        //
        //
        return $data;
    }

	public function get_Reportredeem($program_code='', $from_date='', $to_date='') {
        $where_sql	= '';
            if($program_code != ''){
            $where_sql	.= ' and h.program_id = "'.$program_code.'"';
            }
            if($from_date != '' and $to_date != ''){
            $where_sql	.= ' and (h.redeem_date >= "'.$from_date.'" and h.redeem_date <= "'.$to_date.'")';
            }
        $sql	= "SELECT h.redeem_poin, h.redeem_date, h.id as hid, m.first_name, m.cif, m.rekening, m.phone,m.email, t.total, p.program_name FROM btn_loyalty_member.M_history h left join btn_loyalty_program.M_member m on m.id = h.member_id left join btn_loyalty_program.M_cif_total_point t on t.CIFNO LIKE concat('%', m.cif,'%') left join btn_loyalty_program.M_program p on p.program_code = h.program_id where h.redeem_poin > 0".$where_sql;
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }

    public function program_name($program_code='') {

        $sql	= "SELECT program_name FROM M_program WHERE program_code = '".$program_code."'";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }

    // public function get_point_by_poincode($date){
    //     // $month="2018-06";//date('Y-m');
    //     // $date = date('Y-m-d');
    //     print_r($date);
    //     // $date='2018-10-25';
    //     $sql	= "SELECT poin_code, COUNT(*) as Total FROM `M_point_history` WHERE date_related LIKE '%$date%' GROUP BY poin_code";
    //     $query		= $this->db->query($sql);
    //     $data		= $query->result_array();
    //     return $data;
    // }

    public function report_member() {
			$where_sql2	= '';
		if (isset($_GET['search']['value']) && $_GET['search']['value'] != "" ) {
			if(is_numeric($_GET['search']['value'])){
					$where_sql2	.= " AND  ( phone LIKE '%".$_GET['search']['value']."%' )";//." or m.rekening = ".$_GET['search']['value'];
			}else if(ctype_alpha($_GET['search']['value'])){
					$where_sql2	.= " AND  ( first_name LIKE '%".$_GET['search']['value']."%' )";//or UCASE(m.first_name) LIKE '%".strtoupper($_GET['search']['value'])."%'";
			}else{
					$where_sql2	.= " AND  ( cif LIKE '%".$_GET['search']['value']."%' )";//or UCASE(m.first_name) LIKE '%".strtoupper($_GET['search']['value'])."%'";
			}

		}
		$offset = $this->DT->get_start();
		$rows   = $this->DT->get_rows();
        $sql	= "SELECT * FROM M_member WHERE (email != null OR email != '') ".$where_sql2."  LIMIT $offset,$rows";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }

		public function get_Totalrequest_report_member() {

						$where_sql	= '';
					if (isset($_GET['search']['value']) && $_GET['search']['value'] != "" ) {
						if(is_numeric($_GET['search']['value'])){
								$where_sql	.= " AND  ( phone LIKE '%".$_GET['search']['value']."%' )";//." or m.rekening = ".$_GET['search']['value'];
						}else if(ctype_alpha($_GET['search']['value'])){
								$where_sql	.= " AND  ( first_name LIKE '%".$_GET['search']['value']."%' )";//or UCASE(m.first_name) LIKE '%".strtoupper($_GET['search']['value'])."%'";
						}else{
								$where_sql	.= " AND  ( cif LIKE '%".$_GET['search']['value']."%' )";//or UCASE(m.first_name) LIKE '%".strtoupper($_GET['search']['value'])."%'";
						}

					}
					$sql	= "	SELECT * FROM M_member WHERE (email != null OR email != '')  $where_sql  ";
					$query		= $this->db->query($sql);
					$data		= $query->result_array();
					return $data;
			}


			public function download_report_member_regis() {


						$sql	= "	SELECT * FROM M_member WHERE (email != null OR email != '')  ";
						$query		= $this->db->query($sql);
						$data		= $query->result_array();
						return $data;
				}

		public function report_member_range($date_from='',$date_to='') {

				$sql	= "SELECT * FROM M_member WHERE registered_dated  BETWEEN  ".$date_from." AND ".$date_to."";
				$query		= $this->db->query($sql);
				$data		= $query->result_array();
				return $data;
		}

}
 
