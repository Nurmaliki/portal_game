<?php

class Point_model extends CI_Model
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
		$where_sql	.= "where UCASE(m.first_name) LIKE '%".strtoupper($this->db->escape_str($_GET['search']['value']))."%'";
		}
	$sql	= "	SELECT m.*, f.program_name as from_name, t.program_name as to_name FROM T_point_management m left JOIN M_program f ON f.id = m.from_program_id left JOIN M_program t ON t.id = m.to_program_id $where_sql Order By m.id desc ";
	$query		= $this->db->query($sql);
	$data		= $query->result_array();
	return $data;
	}
   	public function get_point() {
	$where_sql	= '';
		if (isset($_GET['search']['value']) && $_GET['search']['value'] != "" ) {
		$where_sql	.= " where UCASE(m.first_name) LIKE '%".strtoupper($this->db->escape_str($_GET['search']['value']))."%'";
		}
	$offset = $this->DT->get_start();
	$rows   = $this->DT->get_rows();
	$sql	= "	SELECT m.*, f.program_name as from_name, t.program_name as to_name FROM T_point_management m left JOIN M_program f ON f.id = m.from_program_id left JOIN M_program t ON t.id = m.to_program_id $where_sql Order By m.id desc LIMIT $offset,$rows";
	$query		= $this->db->query($sql);
	$data		= $query->result_array();
	return $data;
	}
	public function select_point_management($id='') {
	$sql	= "	SELECT m.* FROM T_point_management m where m.id = ".$id;
	$query		= $this->db->query($sql);
	$data		= $query->result_array();
	return $data;
	}
}