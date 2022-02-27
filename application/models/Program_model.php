<?php

class Program_model extends CI_Model
{
	/*public function __construct() {
	}*/
	public function __construct(){
        parent::__construct();
        $this->db = $this->load->database('default',TRUE);
        $this->load->model('datatables_model','DT');
        //$this->load->library('session');
    }
    
	public function get_Totalprogram() {
        $where_sql	= '';
            if (isset($_GET['search']['value']) && $_GET['search']['value'] != "" ) {
            $where_sql	.= "where UCASE(m.program_code) LIKE '%".strtoupper($this->db->escape_str($_GET['search']['value']))."%'";
            }
        $sql	= "	SELECT m.* FROM M_program m $where_sql Order By m.id asc ";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }
    
   	public function get_program() {
        $where_sql	= '';
            if (isset($_GET['search']['value']) && $_GET['search']['value'] != "" ) {
            $where_sql	.= " where UCASE(m.program_code) LIKE '%".strtoupper($this->db->escape_str($_GET['search']['value']))."%'";
            }
        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql	= "	SELECT m.*, c.name FROM M_program m left JOIN M_category c ON c.id = m.category_id $where_sql Order By m.id desc LIMIT $offset,$rows";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }
    
	public function select_program($program_code='', $id='', $name="") {
        $where_sql	= '';
            if ($program_code != "" ) {
            $where_sql	.= " and m.program_code = '".$program_code."'";
            }
            if ($id != "" ) {
            $where_sql	.= " and m.id = ".$id;
            }
            if ($name != "" ) {
            $where_sql	.= " and m.program_name = '".$name."' ";
            }
        $sql	= "	SELECT m.* FROM M_program m where m.status = 1  $where_sql ";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }

    public function select_program_detail($id='') {
    
        $sql	= "SELECT m.* FROM M_program m where m.id = $id ";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }
    
	public function select_point($cif='' , $program_code='') {


     $sql    = "SELECT m.*, t.program_name as name FROM btn_loyalty_member.M_history m left JOIN btn_loyalty_program.M_program t ON t.program_code LIKE m.program_id  where m.member_id in (select id from btn_loyalty_program.M_member where cif like '%".$cif."%')  and m.exchange_poin >0 order by m.date_created desc";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }
    public function select_point_redeem($member_id='' ) {
        $where_sql	= '';
        
        if ($member_id != "" ) {
                $where_sql	.= " where m.member_id = ".$member_id;
        }
        
        //$sql	= "	SELECT m.*, t.program_name as name FROM M_program_join m left JOIN M_program t ON t.id = m.program_id $where_sql";
        // $sql    = " SELECT m.*, t.name as name FROM btn_loyalty_member.M_history m left JOIN btn_loyalty_program.M_merchant t ON t.id  $where_sql and m.redeem_poin >0";
        $sql	= "	SELECT m.*, t.name as name FROM btn_loyalty_member.M_history m left JOIN btn_loyalty_program.M_merchant t ON t.id  $where_sql and m.redeem_poin >0";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
	}
}