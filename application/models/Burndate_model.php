<?php

class Burndate_model extends CI_Model
{
	
	public function __construct(){
	parent::__construct();
	$this->db = $this->load->database('default',TRUE);
	$this->load->model('datatables_model','DT');
	
	}
	public function get_Totalrequest() {
	
	$sql	= "	SELECT * FROM btn_loyalty_program.M_burn_date  Order By id desc ";
	$query		= $this->db->query($sql);
	$data		= $query->result_array();
	return $data;
	}
   	public function get_burndate() {

	$offset = $this->DT->get_start();
	$rows   = $this->DT->get_rows();
	$sql	= "	SELECT * FROM btn_loyalty_program.M_burn_date  Order By id desc ";
	$query		= $this->db->query($sql);
	$data		= $query->result_array();
	return $data;
    }
    public function select_burndate($id='') {
        $sql	= "	SELECT * FROM btn_loyalty_program.M_burn_date  where id = ".$id;
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
        }

}


