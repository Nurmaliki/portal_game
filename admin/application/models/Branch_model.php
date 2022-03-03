<?php

class Branch_model extends CI_Model
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
            $where_sql	.= "AND where UCASE(m.name) LIKE '%".strtoupper($this->db->escape_str($_GET['search']['value']))."%'";
            }
        $sql	= "	SELECT m.* FROM M_branch m WHERE m.enabled = 1 $where_sql Order By m.id asc ";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }
    
   	public function get_category() {
        $where_sql	= '';
            if (isset($_GET['search']['value']) && $_GET['search']['value'] != "" ) {
            $where_sql	.= " AND where UCASE(m.name) LIKE '%".strtoupper($this->db->escape_str($_GET['search']['value']))."%'";
            }
        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql	= "	SELECT m.* FROM M_branch m WHERE  m.enabled = 1 $where_sql Order By m.id asc LIMIT $offset,$rows";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }

    public function select_id($id='') {

        $sql	= "	SELECT * FROM M_branch where id=".$id;
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }
    
	public function select_category($prefix='', $name='') {
        $where_sql	= '';
            if ($name = "" && $prefix != "" ) {
            $where_sql	.= " where prefix_number = ".$prefix;
            }
            if ($name != "" && $prefix = "") {
            $where_sql	.= " where name = '".$name."'";
            }
            if ($name != "" && $prefix != "") {
                $where_sql	.= " where name = '".$name."' and prefix_name = '".$prefix."'";
            }
        $sql	= "	SELECT * FROM M_branch".$where_sql;
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
	}
}