<?php

class Katalog_model extends CI_Model
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
	$sql	= "	SELECT m.* FROM g_katalog m $where_sql Order By m.id asc ";
	$query		= $this->db->query($sql);
	$data		= $query->result_array();
	return $data;
	}
   	public function get_katalog() {
	$where_sql	= '';
		if (isset($_GET['search']['value']) && $_GET['search']['value'] != "" ) {
		$where_sql	.= " where UCASE(m.name) LIKE '%".strtoupper($this->db->escape_str($_GET['search']['value']))."%'";
		}
	$offset = $this->DT->get_start();
	$rows   = $this->DT->get_rows();
	$sql	= "	SELECT m.* FROM g_katalog m $where_sql Order By m.id desc LIMIT $offset,$rows";
	$query		= $this->db->query($sql);
	$data		= $query->result_array();
	return $data;
	}

	public function get_hadiah()
	{
		// $where_sql	= '';
		// if (isset($_GET['search']['value']) && $_GET['search']['value'] != "") {
		// 	$where_sql	.= " where UCASE(m.name) LIKE '%" . strtoupper($this->db->escape_str($_GET['search']['value'])) . "%'";
		// }
		$offset = $this->DT->get_start();
		$rows   = $this->DT->get_rows();
		$sql	= "	SELECT m.* FROM g_katalog m where aktive = 1 Order By m.id asc LIMIT $offset,$rows";
		$query		= $this->db->query($sql);
		$data		= $query->result_array();
		return $data;
	}

	public function select_katalog($id='', $name='') {
	$where_sql	= '';
		if ($id != "" ) {
		$where_sql	.= " where id = ".$id." AND aktive=1";
		}
		if ($name != "" ) {
		$where_sql	.= " where name = '".$name."' AND aktive=1";
		}
	$sql	= "	SELECT * FROM g_katalog".$where_sql;
	$query		= $this->db->query($sql);
	$data		= $query->result_array();
	return $data;
	}

	public function select_katalog_prizecode($prize_code='', $name='') {
	$where_sql	= '';
		if ($prize_code != "" ) {
		$where_sql	.= " where prize_code = '".$prize_code."' AND aktive=1";
		}
		if ($name != "" ) {
		$where_sql	.= " where name = '".$name."' AND aktive=1";
		}
	$sql	= "	SELECT * FROM g_katalog".$where_sql;
	$query		= $this->db->query($sql);
	$data		= $query->result_array();
	return $data;
	}
}
