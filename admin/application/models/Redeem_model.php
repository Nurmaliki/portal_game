<?php

class Redeem_model extends CI_Model
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
	$sql	= "	SELECT p.program_name, p.image, m.name, p.phone, p.email, p.address, r.amount, r.point FROM T_redeem_management r left JOIN M_program p  ON p.id = r.program_id left JOIN M_merchant m  ON m.id = r.merchant_id $where_sql Order By m.id asc ";
	$query		= $this->db->query($sql);
	$data		= $query->result_array();
	return $data;
	}
   	public function get_redeem() {
	$where_sql	= '';
		if (isset($_GET['search']['value']) && $_GET['search']['value'] != "" ) {
		$where_sql	.= " where UCASE(p.program_name) LIKE '%".strtoupper($this->db->escape_str($_GET['search']['value']))."%'";
		}
	$offset = $this->DT->get_start();
	$rows   = $this->DT->get_rows();
	$sql	= "SELECT p.program_name, p.image, m.name, p.phone, p.email, p.address, r.id, r.amount, r.point FROM T_redeem_management r left JOIN M_program p  ON p.id = r.program_id left JOIN M_merchant m  ON m.id = r.merchant_id $where_sql Order By r.id desc LIMIT $offset,$rows";
	$query		= $this->db->query($sql);
	$data		= $query->result_array();
	return $data;
	}
	public function select_redeem_management($id='') {
	$sql	= "	SELECT m.* FROM T_redeem_management m where m.id = ".$id;
	$query		= $this->db->query($sql);
	$data		= $query->result_array();
	return $data;
	}
}