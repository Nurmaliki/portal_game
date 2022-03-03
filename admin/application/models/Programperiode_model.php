<?php

class Programperiode_model extends CI_Model
{
	
	public function __construct(){
	parent::__construct();
	$this->db = $this->load->database('default',TRUE);
	$this->load->model('datatables_model','DT');
	
	}
	public function get_Totalrequest() {
	
	$sql	= "	SELECT * FROM btn_loyalty_program.M_program_period  Order By id desc ";
	$query		= $this->db->query($sql);
	$data		= $query->result_array();
	return $data;
	}
   	public function get_programperiode() {

	$offset = $this->DT->get_start();
	$rows   = $this->DT->get_rows();
	$sql	= "	SELECT * FROM btn_loyalty_program.M_program_period  Order By id desc ";
	$query		= $this->db->query($sql);
	$data		= $query->result_array();
	return $data;
    }
    public function select_programperiode($id='') {
        $sql	= "	SELECT * FROM btn_loyalty_program.M_program_period  where id = ".$id;
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
        }

}