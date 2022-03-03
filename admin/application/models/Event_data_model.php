<?php

class Event_data_model extends CI_Model
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
        $sql	= "	SELECT m.* FROM T_event_participants m $where_sql Order By m.id asc ";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }
    
   	public function get_category() {
        $where_sql	= '';
            if (isset($_GET['search']['value']) && $_GET['search']['value'] != "" ) {
                $where_sql	.= " where UCASE(m.name) LIKE '%".strtoupper($this->db->escape_str($_GET['search']['value']))."%'";
            }
        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql	= "	SELECT m.*, n.*, o.name as event_name FROM T_event_participants AS m INNER JOIN M_member as n ON m.member_id = n.id INNER JOIN M_grand_prize_event as o ON m.event_id = o.id $where_sql Order By m.id desc LIMIT $offset,$rows";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }
    
	public function select_category($id='', $name='') {
        $where_sql	= '';
            if ($id != "" ) {
            $where_sql	.= " where id = ".$id;
            }
            if ($name != "" ) {
            $where_sql	.= " where name Like '%".$name."%'";
            }
        $sql	= "	SELECT * FROM T_event_participants".$where_sql;
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }
    
    public function get_eventparticipant() {// file name 
        $filename = 'Report_event_participant_'.date('Y:m:d').'.csv'; 
        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");
        $sql	= "SELECT M_grand_prize_event.name, M_member.first_name, M_member.last_name, M_member.cif, M_member.phone, T_event_participants.voucher_code, T_event_participants.created_date
        FROM T_event_participants
        INNER JOIN M_member ON T_event_participants.member_id=M_member.id
        INNER JOIN M_grand_prize_event ON M_grand_prize_event.id=T_event_participants.event_id";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        $file = fopen('php://output', 'w');
        $header = array("Nama event","Nama","Cif","Phone","Voucher_code","Tanggal_daftar"); 
        fputcsv($file, $header);
        foreach ($data as $key=>$line){ 
            fputcsv($file,$line); 
        }
        fclose($file); 
    }
}