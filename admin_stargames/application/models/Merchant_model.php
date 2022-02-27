<?php

class Merchant_model extends CI_Model
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
		$sql	= "	SELECT m.* FROM M_merchant m $where_sql Order By m.id asc ";
		$query		= $this->db->query($sql);
		$data		= $query->result_array();
		return $data;
	}
   	public function get_merchant() {
		$where_sql	= '';
			if (isset($_GET['search']['value']) && $_GET['search']['value'] != "" ) {
			$where_sql	.= " where UCASE(m.name) LIKE '%".strtoupper($this->db->escape_str($_GET['search']['value']))."%'";
			}
		$offset = $this->DT->get_start();
		$rows   = $this->DT->get_rows();
		$sql	= "	SELECT m.*, c.name as c_name, p.name as pname FROM M_merchant m left JOIN M_category c ON c.id = m.category_id left JOIN M_province p ON p.id = m.province_id $where_sql Order By m.id desc LIMIT $offset,$rows";
		$query		= $this->db->query($sql);
		$data		= $query->result_array();
		return $data;
	}
	public function select_merchant($id='') {
		$where_sql	= '';
			if ($id != "" ) {
			$where_sql	.= " where m.id = ".$id;
			}
		$sql	= "	SELECT m.* FROM M_merchant m $where_sql";
		$query		= $this->db->query($sql);
		$data		= $query->result_array();
		return $data;
	}
}