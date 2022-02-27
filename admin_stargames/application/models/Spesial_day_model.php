<?php

class Spesial_day_model extends CI_Model
{
	/*public function __construct() {
	}*/
	public function __construct(){
        parent::__construct();
        $this->db = $this->load->database('default',TRUE);
        $this->load->model('datatables_model','DT');
        //$this->load->library('session');
	}
	public function get_Totalrequest() {
        $where_sql	= '';
            if (isset($_GET['search']['value']) && $_GET['search']['value'] != "" ) {
            $where_sql	.= "where UCASE(m.name) LIKE '%".strtoupper($this->db->escape_str($_GET['search']['value']))."%'";
            }
        $sql	= "	SELECT m.* FROM M_spesial_day m $where_sql Order By m.id asc ";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }
    
   	public function get_spesial_day() {
        $where_sql	= '';
            if (isset($_GET['search']['value']) && $_GET['search']['value'] != "" ) {
            $where_sql	.= " where UCASE(m.name) LIKE '%".strtoupper($this->db->escape_str($_GET['search']['value']))."%'";
            }
        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql	= "	SELECT m.* FROM M_spesial_day m $where_sql Order By m.id asc LIMIT $offset,$rows";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }
    
	public function select_spesial_day($id='', $name='') {
        $where_sql	= '';
            if ($name != "" ) {
            $where_sql	.= " where $id = '".$name."'";
            }
        $sql	= "	SELECT * FROM M_spesial_day".$where_sql;
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
	}
}