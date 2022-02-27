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
	$sql	= "	SELECT m.*, c.name FROM M_program m left JOIN M_category c ON c.id = m.category_id $where_sql Order By m.id asc LIMIT $offset,$rows";
	$query		= $this->db->query($sql);
	$data		= $query->result_array();
	return $data;
	}
	public function select_program($program_code='', $id='') {
	$where_sql	= '';
		if ($program_code != "" ) {
		$where_sql	.= " where m.program_code = '".$program_code."'";
		}
		if ($id != "" ) {
		$where_sql	.= " where m.id = ".$id;
		}
	$sql	= "	SELECT m.* FROM M_program m $where_sql";
	$query		= $this->db->query($sql);
	$data		= $query->result_array();
	return $data;
	}
}