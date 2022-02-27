<?php

class Emailsubscribe_model extends CI_Model
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
            $where_sql	.= "where UCASE(m.email) LIKE '%".strtoupper($this->db->escape_str($_GET['search']['value']))."%'";
            }
        $sql	= "	SELECT m.* FROM M_news_letter_subs m $where_sql Order By m.id desc ";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }

   	public function get_email() {
        $where_sql	= '';
            if (isset($_GET['search']['value']) && $_GET['search']['value'] != "" ) {
            $where_sql	.= " where UCASE(m.email) LIKE '%".strtoupper($this->db->escape_str($_GET['search']['value']))."%'";
            }
        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql	= "	SELECT m.* FROM M_news_letter_subs m $where_sql Order By m.id desc LIMIT $offset,$rows";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }

	public function select_email($id='', $email='') {
        $where_sql	= '';
            if ($id != "" ) {
                $where_sql	.= " where m.id =".$id;
            }
            if ($email != "" ) {
                $where_sql	.= " where m.email = '".$email."'";
            }
        $sql	= "	SELECT m.* FROM M_news_letter_subs m $where_sql";//where m.username =
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
	}

	public function download_email_letter_sub()
	{
		$sql	= "	SELECT * FROM M_news_letter_subs ";
		$query		= $this->db->query($sql);
		$data		= $query->result_array();
		return $data;
	}
}
