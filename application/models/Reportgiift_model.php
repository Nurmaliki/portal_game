<?php

class Reportgiift_model extends CI_Model
{
	/*public function __construct() {
	}*/
	public function __construct(){
	parent::__construct();
	$this->db = $this->load->database('default',TRUE);
	$this->load->model('datatables_model','DT');
	//$this->load->library('session');
	}
	
    
	public function get_Reportgiift($from_date='', $to_date='') {
        
            if($from_date != '' and $to_date != ''){
            $where_sql	.= ' and (redeem_date >= "'.$from_date.'" and redeem_date <= "'.$to_date.'")';
            }
        
        $sql	= "SELECT 
                        h.status_msg,
                        h.status,
                        h.member_id,
                        h.email_tujuan , 
                        h.giift_dmo_id,
                        h.giift_name, 
                        h.giift_order_id,
                        h.giift_value, 
                        h.redeem_poin,
                        h.redeem_date,
                        h.transcode_btn,
                        h.transcode_btn_date,
                        h.id as hid,
                        m.first_name,
                        m.cif,
                        m.rekening,
                        m.phone    
                    FROM btn_loyalty_member.M_history h 
                    left join btn_loyalty_program.M_member m on m.id = h.member_id 
                   
                    where h.redeem_poin > 0 AND h.giift_dmo_id != '' 
                    ".$where_sql."order by h.transcode_btn_date desc";
        
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }
    public function get_Reportgiift_download($from_date='', $to_date='') {
        
            if($from_date != '' and $to_date != ''){
            $where_sql   .= ' and (redeem_date >= "'.$from_date.'" and redeem_date <= "'.$to_date.'")';
            }



        $sql    = "SELECT 
                        h.status,
                        h.status_msg,
                         h.member_id,
                        h.email_tujuan , 
                        h.giift_dmo_id,
                        h.giift_name, 
                        h.giift_order_id,
                        h.giift_value, 
                        h.redeem_poin,
                        h.redeem_date,
                        h.transcode_btn,
                        h.transcode_btn_date,
                        h.id as hid,
                        m.first_name,
                        m.cif,
                        m.rekening,
                        m.phone    
                    FROM btn_loyalty_member.M_history h 
                    left join btn_loyalty_program.M_member m on m.id = h.member_id 
                   
                    where h.redeem_poin > 0 AND h.giift_dmo_id != ''
                    ".$where_sql."order by h.transcode_btn_date desc";
        
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;
    }
    
    public function program_name($program_code='') {
       
        $sql	= "SELECT program_name FROM M_program WHERE program_code = '".$program_code."'";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data; 
    }

   


    
}