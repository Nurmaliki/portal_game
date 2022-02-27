<?php

class Merchantbtn_model extends CI_Model
{
	/*public function __construct() {
	}*/
	public function __construct(){
	parent::__construct();
	$this->db = $this->load->database('default',TRUE);
	$this->load->model('datatables_model','DT');
	$this->load->library('encryption');
	//$this->load->library('session');
	}
	public function get_Totalrequest() {
		$where_sql	= '';
			if (isset($_GET['search']['value']) && $_GET['search']['value'] != "" ) {
				if (is_numeric($_GET['search']['value'])) {
					$where_sql .="where UCASE(m.points) LIKE '%".strtoupper($this->db->escape_str($_GET['search']['value']))."%' AND enabled=1";
				
				}else{
					$where_sql	.= "where UCASE(m.name) LIKE '%".strtoupper($this->db->escape_str($_GET['search']['value']))."%' AND enabled=1";
				}
			}
		$sql	= "	SELECT m.* FROM M_merchant_btn m $where_sql Order By m.id asc ";
		$query		= $this->db->query($sql);
		$data		= $query->result_array();
		return $data;
	}

	public function get_merchant_btn_by_id($id) {

		$sql	= "SELECT * FROM M_merchant_btn WHERE dmo_id='" . $id . "' AND enabled=1";
		$query		= $this->db->query($sql);
		$data		= $query->result_array();
		return $data;
	}
	
	public function check_duplicate($merchant_id, $md5_signature) {

		$sql	= "SELECT * FROM M_btn_voucher_code WHERE merchant_id='" . $merchant_id . "' AND md5_signature='". md5($md5_signature) . "'";
		$query		= $this->db->query($sql);
		$data		= $query->result_array();
		if(count($data) > 0){
			return false;
		} else {
			return true;
		}
	}

   	public function get_merchant() {

		$sql	= "	SELECT m.* FROM M_merchant_btn m  WHERE m.enabled=1 Order By m.id desc ";

		$query		= $this->db->query($sql);
		$data		= $query->result_array();
		return $data;
	}
	public function get_voucher_by_merchant($merchantid) {

		$sql	= "	SELECT m.* FROM M_btn_voucher_code m  WHERE m.merchant_id = '" . $merchantid ."' AND m.status = 1";

		$query		= $this->db->query($sql);
		$data		= $query->result_array();
		return $data;
	}
	public function get_all_voucher_by_merchant($merchantid) {

		$sql	= "	SELECT m.* FROM M_btn_voucher_code m  WHERE m.merchant_id = '" . $merchantid ."'";

		$query		= $this->db->query($sql);
		$data		= $query->result_array();
		return $data;
	}
	public function get_all_voucher_by_merchant_and_status($merchantid,$status) {

		$sql	= "	SELECT m.* FROM M_btn_voucher_code m  WHERE m.merchant_id = '" . $merchantid ."' AND m.status='".$status."'";

		$query		= $this->db->query($sql);
		$data		= $query->result_array();
		return $data;
	}
	public function get_merchant_new() {

		$sql	= "SELECT * FROM M_merchant_btn WHERE enabled=1";
		$query		= $this->db->query($sql);
		$data		= $query->result_array();
		return $data;
	}	

	public function get_voucher_list() {

		$sql	= "SELECT M_merchant_btn.points,M_merchant_btn.value, M_btn_voucher_code.expired_date, M_btn_voucher_code.used_date, M_merchant_btn.name,M_btn_voucher_code.status FROM M_btn_voucher_code INNER JOIN M_merchant_btn ON M_btn_voucher_code.merchant_id = M_merchant_btn.dmo_id WHERE M_merchant_btn.enabled=1";
		$query		= $this->db->query($sql);
		$data		= $query->result_array();
		return $data;
	}

	public function get_category() {

		$sql	= "SELECT category FROM M_merchant_btn WHERE M_merchant_btn.enabled=1 GROUP BY category";
		$query		= $this->db->query($sql);
		$data		= $query->result_array();
		return $data;
	}	
	public function select_merchant($id='') {
		$where_sql	= '';
			if ($id != "" ) {
			$where_sql	.= " where m.id = '".$id."' AND m.enabled=1 ";
			}
		$sql	= "	SELECT m.* FROM M_merchant_btn m $where_sql";
		$query		= $this->db->query($sql);
		$data		= $query->result_array();
		return $data;
	}
	public function select_merchant_new($id='',$type='') {
		$tableName = $type == 2 ? 'M_merchant_btn' : 'M_merchant_btn';
		$where_sql	= '';
			if ($id != "" ) {
			$where_sql	.= " where id = '".$id."' AND enabled=1";
			}
		$sql	= "SELECT * FROM $tableName $where_sql";
		$query		= $this->db->query($sql);
		$data		= $query->result_array();
		return $data;
	}

	public function select_merchant_btn($id='',$type='') {
		$sql	= "SELECT * FROM M_merchant_btn WHERE id='" . $id ."' AND enabled=1";
		$query		= $this->db->query($sql);
		$data		= $query->result_array();
		return $data;
	}
}