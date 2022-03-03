<?php

class Role_model extends CI_Model
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
			$where_sql	.= "where UCASE(p.program_name) LIKE '%".strtoupper($this->db->escape_str($_GET['search']['value']))."%'";
			}
		$sql	= "SELECT p.program_name, r.* FROM M_rules r left JOIN M_program p  ON p.id = r.program_id $where_sql Order By r.id asc ";
		$query		= $this->db->query($sql);
		$data		= $query->result_array();
		return $data;
	}
   	public function get_role() {
		$where_sql	= '';
			if (isset($_GET['search']['value']) && $_GET['search']['value'] != "" ) {
			$where_sql	.= " where UCASE(p.program_name) LIKE '%".strtoupper($this->db->escape_str($_GET['search']['value']))."%'";
			}
		$offset = $this->DT->get_start();
		$rows   = $this->DT->get_rows();
		$sql	= "SELECT p.program_name, r.* FROM M_rules r left JOIN M_program p  ON p.id = r.program_id $where_sql Order By r.id desc LIMIT $offset,$rows";
		$query		= $this->db->query($sql);
		$data		= $query->result_array();
		return $data;
	}

	public function get_role_all() {
		$sql	= "SELECT p.program_name, r.* FROM M_rules r left JOIN M_program p  ON p.id = r.program_id  Order By r.id asc ";
		$query		= $this->db->query($sql);
		$data		= $query->result_array();
		return $data;
	}
	public function select_role($id='') {
		$sql	= "	SELECT m.* FROM M_rules m where m.id = ".$id;
		$query		= $this->db->query($sql);
		$data		= $query->result_array();
		return $data;
    }
    public function select_role_by_type($type='') {
		$sql	= "	SELECT m.* FROM M_rules m where m.rule_type LIKE '%".$type."%' ";
		$query		= $this->db->query($sql);
		$data		= $query->result_array();
		return $data;
	}
}