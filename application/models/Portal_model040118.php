<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Portal_model extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    // Each model has this function
    public function read_redeem_history($args){
        $this->db->select("*");
        $this->db->from("M_history");
        $this->db->where("member_id", $args["member_id"]);
        $this->db->where("merchant_id !=", NULL);
        $this->db->limit( $args["limit"],  0);
        $this->db->order_by("date_created", "DESC");
        return $this->db->get()->result_array();
    }
    public function count_total_point($sum, $m_id){
        $this->db->select("sum($sum) as total");
        $this->db->from("M_history");
        $this->db->where("member_id", $m_id);
        return $this->db->get()->row();
    }
    public function search_promonews($type, $query){
        $db = $this->load->database("btn_program", true);
        $db->select("*");
        $db->from("M_news");
        $db->like('title', $query);
        // $db->like('sub_title', $query);
        if ($type == "news") {
            $db->where("category_id !=", 1);
        }else{
            $db->where("category_id ", 1);
        }
        $db->where("status ", 1);
        $db->order_by("date_created", "DESC"); 
        return $db->get()->result_array();
    }

    public function get_exchange_from_list(){
        $db = $this->load->database("btn_program", true);
        $db->select("from_program_id");
        $db->from("T_point_management");
        // $db->join("M_program", "T_point_management.from_program_id = M_program.id");
       return $db->get()->result_array();
    }
    public function get_exchange_to_list(){
        $db = $this->load->database("btn_program", true);
        $db->select("to_program_id, from_ratio, to_ratio");
        $db->from("T_point_management");
        // $db->join("M_program", "M_program.id = T_point_management.from_program_id");
       return $db->get()->result_array();
    }
    public function get_program($id){
        $db = $this->load->database("btn_program", true);
        $db->select("*");
        $db->from("M_program");
        $db->where("id", $id);
       return $db->get()->result_array();
    }
    public function get_program_list(){
        $db = $this->load->database("btn_program", true);
        $db->select("*");
        $db->from("M_program");
        // $db->where("id", $id);
       return $db->get()->result_array();
    }
    public function get_redeem_voucher($member_id, $limit){
        $sql   = "SELECT * FROM btn_loyalty_member.M_history mh
                  LEFT JOIN btn_loyalty_program.M_program mp ON mh.program_id = mp.program_code 
                  LEFT JOIN btn_loyalty_program.M_merchant  mm ON mm.id = mh.merchant_id
                  WHERE mh.member_id = $member_id AND mh.redeem_code != 'NULL'
                  ORDER BY mh.id DESC LIMIT $limit
                ";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;
    }
    public function count_redeem_voucher($member_id){
        $sql   = "SELECT * FROM M_history WHERE member_id = $member_id AND redeem_code != 'NULL'";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;
    }


    public function select_member_point($cif='', $email='') {
        $sql	    = "	SELECT m.* , mr.point as total FROM btn_loyalty_program.M_point_history m LEFT JOIN btn_loyalty_program.M_cif_map_rek mr ON m.ACCTNO = mr.ACCTNO WHERE m.CIFNO like '%$cif%' and  m.status = 1 ORDER BY date_related DESC";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }
    public function get_member_transaction_history($member_id) {
        //$sql	= "	SELECT * FROM M_member m, M_cif_map_rek p where m.rekening = p.ACCTNO Order By p.id desc LIMIT 0,10";
        $sql	= "	SELECT * FROM btn_loyalty_member.M_history h 
                    left join btn_loyalty_program.M_member m on m.id = h.member_id 
                    left join btn_loyalty_program.M_program mp ON mp.program_code = h.program_id
                    WHERE h.member_id = '". $member_id . "' AND h.program_id != ''  Order By h.id desc
                ";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }
    public function redeem() {

        $sql	= "	SELECT h.* FROM btn_loyalty_member.M_history h left join btn_loyalty_program.M_member m on m.id = h.member_id where  ";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }
    public function select_member($id='', $email='') {
        $where_sql	= '';
            if ($id != "" ) {
                $where_sql	.= " where mr.id= m.id and mr.id =".$id;
            }
            if ($email != "" ) {
                $where_sql	.= " where m.email = '".$email."'";
            }
        $sql	= "	SELECT m.* , mr.point FROM M_member m, M_cif_map_rek mr $where_sql";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }
    public function select_point($member_id='') {
        $where_sql	= '';
            if ($member_id != "" ) {
            $where_sql	.= " where m.member_id = ".$member_id;
            }
        //$sql	= "	SELECT m.*, t.program_name as name FROM M_program_join m left JOIN M_program t ON t.id = m.program_id $where_sql";
        $sql	= "	SELECT m.*, t.program_name as name FROM M_history m left JOIN btn_loyalty_program.M_program t ON t.program_code LIKE '%GJAC098%' $where_sql  and m.exchange_poin >0 ";//where m.member_id = 1 and m.exchange_poin >0";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
	}   
}