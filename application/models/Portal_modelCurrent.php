<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Portal_model extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->db = $this->load->database('default',TRUE);
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
        // tambahan 3 januari 2019
          $this->db->close();
    }
    public function count_total_point($sum, $m_id){
        $this->db->select("sum($sum) as total");
        $this->db->from("M_history");
        $this->db->where("member_id", $m_id);
        return $this->db->get()->row();
          // tambahan 3 januari 2019
          $this->db->close();
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
         // tambahan 3 januari 2019
          $this->db->close();
    }

    public function get_exchange_from_list(){
        $db = $this->load->database("btn_program", true);
        $db->select("from_program_id");
        $db->from("T_point_management");
        // $db->join("M_program", "T_point_management.from_program_id = M_program.id");
       return $db->get()->result_array();
        // tambahan 3 januari 2019
          $this->db->close();
    }
    public function get_exchange_to_list(){
        $db = $this->load->database("btn_program", true);
        $db->select("to_program_id, from_ratio, to_ratio");
        $db->from("T_point_management");
        // $db->join("M_program", "M_program.id = T_point_management.from_program_id");
       return $db->get()->result_array();
        // tambahan 3 januari 2019
          $this->db->close();
    }
    public function get_program($id){
        $db = $this->load->database("btn_program", true);
        $db->select("*");
        $db->from("M_program");
        $db->where("id", $id);
       return $db->get()->result_array();
        // tambahan 3 januari 2019
          $this->db->close();
    }
    public function get_program_list(){
        $db = $this->load->database("btn_program", true);
        $db->select("*");
        $db->from("M_program");
        // $db->where("id", $id);
       return $db->get()->result_array();
        // tambahan 3 januari 2019
          $this->db->close();
    }
    public function get_redeem_voucher($cif, $limit){
    
        // $sql = "SELECT m.* FROM btn_loyalty_member.`M_history` m  WHERE m.`member_id`=".$cif."  AND m.`status`='SUCCESS' ORDER BY m.`id` DESC LIMIT ".$limit;
         $sql    = " SELECT m.* FROM btn_loyalty_member.`M_history` m  WHERE m.`member_id` in (select id from btn_loyalty_program.M_member where cif like '%".$cif."%') AND m.giift_dmo_id != ''  ORDER BY m.`id` DESC " ;
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
      
        return $data;
       
    }
    public function count_redeem_voucher($member_id){
        $sql   = "SELECT * FROM M_history WHERE member_id = $member_id AND redeem_code != 'NULL'";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;
         // tambahan 3 januari 2019
          $this->db->close();
    }


    public function select_member_point($cif='', $email='') {
        $sql	    = "	SELECT m.* , mr.point as total FROM btn_loyalty_program.M_point_history m LEFT JOIN btn_loyalty_program.M_cif_map_rek mr ON m.ACCTNO = mr.ACCTNO WHERE m.CIFNO like '%$cif%' and  m.status = 1 ORDER BY date_related DESC";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
         // tambahan 3 januari 2019
          $this->db->close();
    }

     public function total_poin_yang_didapat($cif='') {

        $sql      = " SELECT sum(point) FROM btn_loyalty_program.M_point_history  WHERE  CIFNO LIKE '%$cif%'";

        $query    = $this->db->query($sql);
        $data     = $query->result_array();
      //     print_r($data);
      // die();
        return $data;

         // tambahan 3 januari 2019
          $this->db->close();
    }
    public function get_member_transaction_history($cif) {
        //$sql	= "	SELECT * FROM M_member m, M_cif_map_rek p where m.rekening = p.ACCTNO Order By p.id desc LIMIT 0,10";
        // $sql	= "	SELECT * FROM btn_loyalty_member.M_history h 
        //             left join btn_loyalty_program.M_member m on m.id = h.member_id 
        //             left join btn_loyalty_program.M_program mp ON mp.program_code = h.program_id
        //             WHERE h.member_id = '". $member_id . "' AND h.program_id != ''  Order By h.id desc
        //         ";

     $sql    = "SELECT m.*, t.program_name as name FROM btn_loyalty_member.M_history m left JOIN btn_loyalty_program.M_program t ON t.program_code where m.member_id in (select id from btn_loyalty_program.M_member where cif like '%".$cif."%')  and m.exchange_poin >0 order by m.date_created desc";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
         // tambahan 3 januari 2019
          $this->db->close();
    }
    public function redeem() {

        $sql	= "	SELECT h.* FROM btn_loyalty_member.M_history h left join btn_loyalty_program.M_member m on m.id = h.member_id where  ";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
         // tambahan 3 januari 2019
          $this->db->close();
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
         // tambahan 3 januari 2019
          $this->db->close();
	}   
     public function merchant_giift($id='') {
         $where_sql = '';
            if ($id != "" ) {
            $where_sql  .= " where M_giift_list.id = ".$id;
            } 
       
        $sql        = " SELECT * FROM btn_loyalty_program.M_giift_list".$where_sql." ORDER BY M_giift_list.name ";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;
        // print_r($data);
        // die();
         // tambahan 3 januari 2019
          $this->db->close();
    } 
     public function merchant_giift_category() {
       
        $sql        = " SELECT category FROM btn_loyalty_program.M_giift_list GROUP BY category  ";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;
        // tambahan 3 januari 2019
        $this->db->close();
    } 
     public function merchant_giift_category_data($category="") {
         $where_sql = '';
            if ($category != "" ) {
            $where_sql  .= " where M_giift_list.category LIKE '%".$category."%'";
            } 
        $sql        = " SELECT * FROM btn_loyalty_program.M_giift_list ".$where_sql;
       
        $query      = $this->db->query($sql);
        $data       = $query->result_array();

        
        return $data;
        // tambahan 3 januari 2019
        $this->db->close();
    } 

    public function merchant_giift_count($search = ""){
        $this->db->select("*");
        $this->db->from("btn_loyalty_program.M_giift_list");
        if (!empty($search)) {
          $this->db->like('name', $search);
        }
        $points = $this->db->get()->result_array();
        return count($points);
    }

    public function merchant_giift_category_count($search = ""){
        $this->db->select("*");
        $this->db->from("btn_loyalty_program.M_giift_list");
        if (!empty($search)) {
          $this->db->like('category', $search);
        }
        $points = $this->db->get()->result_array();
        return count($points);
    }



    public function merchant_giift_get_points($id){
        $this->db->select("MAX(M_giift_list.points) AS maxpoin, MIN(M_giift_list.points) AS minpoin");
        $this->db->from("btn_loyalty_program.M_giift_list");
        $this->db->where('dmo_id', $id);
        $points = $this->db->get()->result_array();
        return $points;
    }



    public function merchant_giift_name_data($name="", $limit = 9, $order = "") {

        $returned_data = [];

        $this->db->select("id, name, dmo_id, img, value, price, points, unit, category, last_update");
        $this->db->from("btn_loyalty_program.M_giift_list");
        $this->db->like('name', $name);
        if (!empty($order)) {
          if ($order == "latest") {
            $this->db->order_by('last_update', 'DESC');
          }elseif ($order == "oldest") {
            $this->db->order_by('last_update', 'ASC');
          }elseif ($order == "highest") {
            $this->db->order_by('points', 'DESC');
          }elseif ($order == "lowest") {
            $this->db->order_by('last_update', 'ASC');
          }
        }else{
            $this->db->order_by('name', "DESC");
            $this->db->order_by('last_update', 'DESC');
        }
        $this->db->limit($limit);
        $voucher = $this->db->get()->result_array();
        foreach ($voucher as $key => $value) {
          $returned_data [$key] = $value;
          $returned_data [$key]["minpoin"] = $this->merchant_giift_get_points($value["dmo_id"])[0]["minpoin"];
          $returned_data [$key]["maxpoin"] = $this->merchant_giift_get_points($value["dmo_id"])[0]["maxpoin"];
        }
        return $returned_data;
         $this->db->close();
   } 
   public function merchant_giift_by_id($id="", $limit = 9, $order = "") {

        $returned_data = [];

        $this->db->select("id, name, dmo_id, img, value, price, points, unit, category, last_update");
        $this->db->from("btn_loyalty_program.M_giift_list");
        $this->db->where('id', $id);
        if (!empty($order)) {
          if ($order == "latest") {
            $this->db->order_by('last_update', 'DESC');
          }elseif ($order == "oldest") {
            $this->db->order_by('last_update', 'ASC');
          }elseif ($order == "highest") {
            $this->db->order_by('points', 'DESC');
          }elseif ($order == "lowest") {
            $this->db->order_by('last_update', 'ASC');
          }
        }else{
            $this->db->order_by('name', "DESC");
            $this->db->order_by('last_update', 'DESC');
        }
        $this->db->limit($limit);
        $voucher = $this->db->get()->result_array();
        foreach ($voucher as $key => $value) {
          $returned_data [$key] = $value;
          $returned_data [$key]["minpoin"] = $this->merchant_giift_get_points($value["dmo_id"])[0]["minpoin"];
          $returned_data [$key]["maxpoin"] = $this->merchant_giift_get_points($value["dmo_id"])[0]["maxpoin"];
        }
        return $returned_data;
         $this->db->close();
   } 
   public function merchant_giift_category_search($name="", $limit = 9, $order = "") {

        $returned_data = [];

        $this->db->select("id, name, dmo_id, img, value, price, points, unit, category, last_update");
        $this->db->from("btn_loyalty_program.M_giift_list");
        $this->db->where('category', $name);
        if (!empty($order)) {
          if ($order == "latest") {
            $this->db->order_by('last_update', 'DESC');
          }elseif ($order == "oldest") {
            $this->db->order_by('last_update', 'ASC');
          }elseif ($order == "highest") {
            $this->db->order_by('points', 'DESC');
          }elseif ($order == "lowest") {
            $this->db->order_by('last_update', 'ASC');
          }
        }else{
            $this->db->order_by('name', "DESC");
            $this->db->order_by('last_update', 'DESC');
        }
        $this->db->limit($limit);
        $voucher = $this->db->get()->result_array();
        foreach ($voucher as $key => $value) {
          $returned_data [$key] = $value;
          $returned_data [$key]["minpoin"] = $this->merchant_giift_get_points($value["dmo_id"])[0]["minpoin"];
          $returned_data [$key]["maxpoin"] = $this->merchant_giift_get_points($value["dmo_id"])[0]["maxpoin"];
        }
        return $returned_data;
         $this->db->close();
   } 
    public function merchant_giift_group_by_name($limit = 9, $order = ""){

        $returned_data = [];
        $this->db->select("id, name, dmo_id, img, value, price, points, unit, category, last_update");
        $this->db->from("btn_loyalty_program.M_giift_list");
       
        if (!empty($order)) {
          if ($order == "latest") {
            $this->db->order_by('last_update', 'DESC');
          }elseif ($order == "oldest") {
            $this->db->order_by('last_update', 'ASC');
          }elseif ($order == "highest") {
            $this->db->order_by('points', 'DESC');
          }elseif ($order == "lowest") {
            $this->db->order_by('last_update', 'ASC');
          }
        }else{
            $this->db->order_by('name', "DESC");
            $this->db->order_by('last_update', 'DESC');
        }

        $this->db->limit($limit);
        $voucher = $this->db->get()->result_array();
        foreach ($voucher as $key => $value) {
          $returned_data [$key] = $value;
          $returned_data [$key]["minpoin"] = $this->merchant_giift_get_points($value["dmo_id"])[0]["minpoin"];
          $returned_data [$key]["maxpoin"] = $this->merchant_giift_get_points($value["dmo_id"])[0]["maxpoin"];
        }
        return $returned_data;

       $this->db->close();
    }
    public function otp_fail_attempt($phone="",$type="") {
         $where_sql = '';
            if ($phone != "" ) {
            $where_sql  .= " where  M_otp_fail_attempt.phone LIKE '%".$phone."%' AND  M_otp_fail_attempt.type LIKE '%".$type."%'";
            } 
        $sql        = " SELECT * FROM btn_loyalty_program. M_otp_fail_attempt ".$where_sql;
       
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;
         // tambahan 3 januari 2019
          $this->db->close();
    } 
     public function otp_fail_attempt_update($table, $data, $phone,$type) {


        $this->db->where('phone', $phone);
        $this->db->where('type', $type);
        return $this->db->update($table, $data);
        // die();
        
    } 
    public function otp_fail_attempt_insert($table,$data) {
        
       return $this->db->insert($table,$data);
    } 

    public function get_burn_date() {
       $sql        = " SELECT * FROM btn_loyalty_program.M_burn_date";
       $query      = $this->db->query($sql);
       $data       = $query->result_array();
       return $data;
       $this->db->close();
   } 
   public function getWishList($id){
        $this->db->select('*');
        $this->db->where('member_id', $id);
        $this->db->from('btn_loyalty_program.M_wishlist');
        $this->db->join('btn_loyalty_program.M_giift_list', 'btn_loyalty_program.M_giift_list.id = btn_loyalty_program.M_wishlist.list_id');
        return $this->db->get()->result_array();
        // return $data;
        
        $this->db->close();
   }
}