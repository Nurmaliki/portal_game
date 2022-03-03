<?php

class Merchantgiiftmanagement_model extends CI_Model
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
	// $where_sql	= '';
	// 	if (isset($_GET['search']['value']) && $_GET['search']['value'] != "" ) {
	// 	$where_sql	.= "where UCASE(m.first_name) LIKE '%".strtoupper($this->db->escape_str($_GET['search']['value']))."%'";
	// 	}
	$sql	= "	SELECT * FROM btn_loyalty_program.M_giift_point_value  Order By id desc ";
	$query		= $this->db->query($sql);
	$data		= $query->result_array();
	return $data;
	}
   	public function get_merchantgiiftmanagement() {
	// $where_sql	= '';
	// 	if (isset($_GET['search']['value']) && $_GET['search']['value'] != "" ) {
	// 	$where_sql	.= " where UCASE(m.first_name) LIKE '%".strtoupper($this->db->escape_str($_GET['search']['value']))."%'";
	// 	}
	$offset = $this->DT->get_start();
	$rows   = $this->DT->get_rows();
	$sql	= "	SELECT * FROM btn_loyalty_program.M_giift_point_value  Order By id desc ";
	$query		= $this->db->query($sql);
	$data		= $query->result_array();
	return $data;
	}
	public function select_point_management($id='') {
	$sql	= "	SELECT * FROM btn_loyalty_program.M_giift_point_value  where id = ".$id;
	$query		= $this->db->query($sql);
	$data		= $query->result_array();
	return $data;
	}
}