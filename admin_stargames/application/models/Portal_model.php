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

    public function get_news_by_cat($cat_id, $limit){
      $db = $this->load->database("btn_program", true);
      $db->select("*");
      $db->from("M_news");
      $db->where("category_id =", $cat_id);
      $db->where("status ", 1);
      $db->limit($limit);
      // $db->limit(6);
      $db->order_by("date_created", "DESC");
      return $db->get()->result_array();
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
        // $db->limit(6);
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

    public function get_member_activity_old($member_id) {
        $tabel1 = "btn_loyalty_program.M_point_history";
        $tabel2 = "btn_loyalty_member.M_history";
        $sql = "SELECT *
        FROM " . $tabel1 . "
        INNER JOIN " . $tabel2 . "
        ON " . $tabel1 . ".member_id = " . $tabel2 . ".member_id
        WHERE " . $tabel1 . ".member_id = " . $member_id ."
        ORDER BY " . $tabel2 . ".date_created ASC LIMIT 5";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
         // tambahan 3 januari 2019
          $this->db->close();
    }

    public function read_activity($key){
      $activity = array(
        "1001" => "Debit BTN Online",
        "1002" => "Transaksi pembayaran dan pembelian",
        "1003" => "Penarikan tunai luar negeri",
        "1004" => "Transaksi transfer ke rekening bank lain",
        "1005" => "Setoran",
        "1006" => "Pencetakan rekening koran melalui mesin ATM",
        "add_point_manual" => "Penambahan Poin manual",
        "ultah" => "Poin Ulang Tahun",
        "aft" => "Aktivasi AFT",
        "agf" => "Aktivasi AGF",
        "aib" => "Aktivasi Internet Banking",
        "akd" => "Aktivasi Kartu Debit",
        "mstr_mob" => "Master Mob",
        "balance" => "Mengecek saldo",
        "open_acc" => "Pembukaan Akun Baru"
        );
        return $activity[$key];
    }

    public function get_member_activity($member_id) {
      $tabel_history = "btn_loyalty_member.M_history";
      $tabel_program = "btn_loyalty_program.M_point_history";
      // $tabel_point_history = "btn_loyalty_program.M_point_history";
      $sql = "SELECT *
      FROM " . $tabel_history . "
      WHERE " . $tabel_history . ".member_id = " . $member_id ."
      ORDER BY " . $tabel_history . ".date_created DESC LIMIT 5";
      $query		= $this->db->query($sql);
      $data		= $query->result_array();

      $sql1 = "SELECT *
      FROM " . $tabel_program . "
      WHERE " . $tabel_program . ".member_id = '" . $member_id ."'
      ORDER BY " . $tabel_program . ".date_related DESC LIMIT 5";
      $query_program	= $this->db->query($sql1);
      $data_program =  $query_program->result_array();
      $datas['m_history'] = $data;
      $datas['m_poin_history'] = $data_program;

      // foreach($data_program as $index => $dt){
      //   if(isset($data[$index]['program_id']))
      //   {
      //     $sql1 = "SELECT *
      //     FROM " . $tabel_program . "
      //     WHERE " . $tabel_program . ".member_id = '" . $member_id ."'
      //     LIMIT 5";
      //     $query_program	= $this->db->query($sql1);
      //     $data_program =  $query_program->result_array();
      //     $data[$index]['program_data'] = count($data_program) > 0 ? $data_program[0] : null;
      //   }
      //   else
      //   {
      //     $sql1 = "SELECT *
      //     FROM " . $tabel_program . "
      //     WHERE " . $tabel_program . ".member_id = '" . $member_id ."'
      //     LIMIT 1";
      //     $query_program	= $this->db->query($sql1);
      //     $data_program =  $query_program->result_array();
      //     $data[$index]['poin_code'] =  $data_program;
      //   }
      // }
      return $datas;
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
            $where_sql  .= " where M_giift_list.id = '".$id."'";
            }

        $sql        = " SELECT * FROM btn_loyalty_program.M_giift_list".$where_sql." ORDER BY M_giift_list.name ";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        $data[0]['is_btn'] = 0;
        return $data;
        // print_r($data);
        // die();
         // tambahan 3 januari 2019
        $this->db->close();
    }

    public function merchant_btn($id='') {
      $where_sql = '';
      if ($id != "" ) {
      $where_sql  .= " where M_merchant_btn.id = '".$id."' AND M_merchant_btn.enabled=1";
      }
      $sql        = " SELECT * FROM btn_loyalty_program.M_merchant_btn".$where_sql." ORDER BY M_merchant_btn.name ";
      $query      = $this->db->query($sql);
      $data       = $query->result_array();
      $data[0]['is_btn'] = 1;
     return $data;
     // print_r($data);
     // die();
      // tambahan 3 januari 2019
     $this->db->close();
 }


    public function merchant_giift_by_dmo_id($id='') {

        $data = null;
        $this->db->select("*");
        $this->db->from("btn_loyalty_program.M_giift_list");
        $this->db->where('dmo_id', $id);
        $data = $this->db->get()->result_array();
        return $data;

         $this->db->close();
   }

   public function merchant_giift_by_dmo_id_btn($id='') {


    $this->db->select("*");
    $this->db->from("btn_loyalty_program.M_merchant_btn");
    $this->db->where('dmo_id', $id);
    $this->db->where('enabled', 1);

    return $this->db->get()->result_array();

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
   //  public function merchant_giift_name_data($name="") {


   //      $this->db->select("*");
   //      $this->db->from("btn_loyalty_program.M_giift_list");
   //      $this->db->order_by('name', "ASC");
   //      $this->db->like('name', $name);

   //      return $this->db->get()->result_array();
   //      // tambahan 3 januari 2019
   //       $this->db->close();
   // }
//    public function merchant_giift_group_by_name($limit = 9, $order = ""){

//     $returned_data = [];
//     $this->db->select("id, name, dmo_id, img, value, price, points, unit, category, last_update");
//     $this->db->from("btn_loyalty_program.M_giift_list");

//     if (!empty($order)) {
//       if ($order == "latest") {
//         $this->db->order_by('last_update', 'DESC');
//       }elseif ($order == "oldest") {
//         $this->db->order_by('last_update', 'ASC');
//       }elseif ($order == "highest") {
//         $this->db->order_by('points', 'DESC');
//       }elseif ($order == "lowest") {
//         $this->db->order_by('last_update', 'ASC');
//       }
//     }else{
//         $this->db->order_by('name', "DESC");
//         $this->db->order_by('last_update', 'DESC');
//     }

//     $this->db->limit($limit);
//     $voucher = $this->db->get()->result_array();
//     foreach ($voucher as $key => $value) {
//       $returned_data [$key] = $value;
//       $returned_data [$key]["minpoin"] = $this->merchant_giift_get_points($value["dmo_id"])[0]["minpoin"];
//       $returned_data [$key]["maxpoin"] = $this->merchant_giift_get_points($value["dmo_id"])[0]["maxpoin"];
//     }
//     return $returned_data;

//    $this->db->close();
// }
    public function merchant_giift_group_by_name2($name){

        $this->db->select("MAX(M_giift_list.points) AS maxpoin, MAX(M_giift_list.img) AS img, MIN(M_giift_list.points) AS minpoin, M_giift_list.name");
        $this->db->where("M_giift_list.name", $name);
        $query = $this->db->get('btn_loyalty_program.M_giift_list')->result_array();  // Produces: SELECT MAX(age) as age FROM members

       return $query;

          $this->db->close();
    }

    public function merchant_giift_get_img($name){

        $this->db->select("M_giift_list.*");
        $this->db->order_by("M_giift_list.points","asc");
        $this->db->where("M_giift_list.name", $name);
        $query = $this->db->get('btn_loyalty_program.M_giift_list')->result_array();  // Produces: SELECT MAX(age) as age FROM members

       return $query;

          $this->db->close();
    }

    public function merchant_giift_get_img_btn($name){

      $this->db->select("M_merchant_btn.*");
      $this->db->order_by("M_merchant_btn.points","asc");
      $this->db->where("M_merchant_btn.name", $name);
      $this->db->where("M_merchant_btn.enabled", 1);
      $query = $this->db->get('btn_loyalty_program.M_merchant_btn')->result_array();  // Produces: SELECT MAX(age) as age FROM members

     return $query;

        $this->db->close();
  }

    public function merchant_giift_group_by_name_btn($name){

      $this->db->select("MAX(M_merchant_btn.points) AS maxpoin, MIN(M_merchant_btn.enabled) AS enabled, MIN(M_merchant_btn.points) AS minpoin, M_merchant_btn.name");
      $this->db->where("M_merchant_btn.name", $name);
      $this->db->where("M_merchant_btn.enabled", 1);
      $query = $this->db->get('btn_loyalty_program.M_merchant_btn')->result_array();  // Produces: SELECT MAX(age) as age FROM members

     return $query;

        $this->db->close();
  }

    public function merchant_giift_group_by_cat($cat){
    $sql        = " SELECT M_giift_list.name, MIN(M_giift_list.img) AS imags,MIN(M_giift_list.type) AS types FROM btn_loyalty_program.M_giift_list WHERE category = '" . $cat . "' GROUP BY  M_giift_list.name LIMIT 6";
    $query      = $this->db->query($sql)->result_array();

    $sql1        = " SELECT M_merchant_btn.name, MIN(M_merchant_btn.img) AS imags,MIN(M_merchant_btn.type) AS types FROM btn_loyalty_program.M_merchant_btn WHERE M_merchant_btn.category = '" . $cat . "' AND M_merchant_btn.enabled = 1 GROUP BY  M_merchant_btn.name LIMIT 6";
    $query1      = $this->db->query($sql1)->result_array();
    // $data       = $query->result_array();
    $data = array_merge($query,$query1);
    return $data;
     // tambahan 3 januari 2019
      $this->db->close();
    }

    public function merchant_giift_group_by_category(){
      $sql = "SELECT category from btn_loyalty_program.M_giift_list
        UNION
        SELECT category from btn_loyalty_program.M_merchant_btn WHERE M_merchant_btn.enabled = 1";
        // $sql        = "SELECT DISTINCT btn_loyalty_program.M_giift_list.category FROM btn_loyalty_program.M_giift_list";
        $query      = $this->db->query($sql)->result_array();
        // $data       = $query->result_array();
        return $query;
         // tambahan 3 januari 2019
          $this->db->close();
    }



// ///

    public function merchant_giift_count($search = ""){
        $this->db->select("*");
        $this->db->from("btn_loyalty_program.M_giift_list");
        if (!empty($search)) {
          $this->db->like('name', $search);
        }
        $points = $this->db->get()->result_array();

        $this->db->select("*");
        $this->db->where("enabled",1);
        $this->db->from("btn_loyalty_program.M_merchant_btn");
        if (!empty($search)) {
          $this->db->like('name', $search);
        }
        $points_btn = $this->db->get()->result_array();

        $pts = array_merge($points_btn,$points);
        return count($pts);
    }

    public function merchant_giift_category_count($search = ""){
        $this->db->select("*");
        $this->db->from("btn_loyalty_program.M_giift_list");
        if (!empty($search)) {
          $this->db->like('category', $search);
        }
        $points = $this->db->get()->result_array();

        $this->db->select("*");
        $this->db->where("enabled",1);
        $this->db->from("btn_loyalty_program.M_merchant_btn");
        if (!empty($search)) {
          $this->db->like('category', $search);
        }
        $points2 = $this->db->get()->result_array();

        $pts = array_merge($points,$points2);

        return count($pts);
    }



    public function merchant_giift_get_points($id){
        $this->db->select("MAX(M_giift_list.points) AS maxpoin, MIN(M_giift_list.points) AS minpoin");
        $this->db->from("btn_loyalty_program.M_giift_list");
        $this->db->where('dmo_id', $id);
        $points = $this->db->get()->result_array();
        return $points;
    }

    public function merchant_giift_name_data_detail($name){
        $returned_data = [];
        $this->db->select("dmo_id, id, img, name, points");
        $this->db->where('name', $name);
        $this->db->order_by('points', "ASC");
        $query = $this->db->get('btn_loyalty_program.M_giift_list')->result_array();  // Produces: SELECT MAX(age) as age FROM members
        foreach ($query as $key => $value) {
          $returned_data [$key] = $value;
          $returned_data[$key]['is_btn'] = 0;
          $returned_data[$key]['voucher_count'] = 10;
          // $returned_data [$key] ["img"] = self::merchant_giift_get_image_by_name($value["name"], $value["minpoin"])[0]["img"];
        }
        if(count($returned_data) == 0){
          $returned_data = [];
          $this->db->select("dmo_id, id, img, name, points");
          $this->db->where('name', $name);
          $this->db->where('enabled', 1);
          $this->db->order_by('points', "ASC");
          $query = $this->db->get('btn_loyalty_program.M_merchant_btn')->result_array();  // Produces: SELECT MAX(age) as age FROM members
          foreach ($query as $key => $value) {
            // $dmo_id = $query[0]['dmo_id'];
            // $this->db->select("dmo_id, points, price, expired_date");
            // $this->db->where('merchant_id', $dmo_id);
            // $this->db->order_by('points', "ASC");
            // $querys = $this->db->get('btn_loyalty_program.M_btn_voucher_code');
            // if(count($querys) > 0){
            // foreach ($querys as $key => $value) {
            //   $returned_data [$key] = $value;
            //   $returned_data[$key]['is_btn'] = 1;
            // }
            // }
            $returned_data[$key] = $value;
            $returned_data[$key]['is_btn'] = 1;
            $returned_data[$key]['voucher_count'] = self::countVoucherCode($returned_data[$key]['dmo_id']);
            $returned_data[$key] ["img"] = str_replace('poin-serbu-web','poin-serbu-cms', base_url()) . ''.$returned_data[$key]['img'];//self::merchant_giift_get_image_by_name($value["name"], $value["minpoin"])[0]["img"];
          }
        }
        return $returned_data;


        $this->db->close();
    }

    public function countVoucherCode($merchantid){
      $this->db->select("*");
      $this->db->where("merchant_id",$merchantid);
      $this->db->where("status",1);
      $this->db->where("expired_date >=",date('Y-m-d'));
      return $this->db->get("btn_loyalty_program.M_btn_voucher_code")->num_rows();
    }

    public function merchant_giift_name_data($name="", $limit = 12, $order = "") {

        $returned_data = [];
        $this->db->select("MAX(M_giift_list.points) AS maxpoin, MIN(M_giift_list.points) AS minpoin, M_giift_list.name");
        $this->db->group_by('name');
        // $this->db->where('category', $name);
        $this->db->like('name', $name);
        $this->db->limit($limit);
        $query = $this->db->get('btn_loyalty_program.M_giift_list')->result_array();  // Produces: SELECT MAX(age) as age FROM members
        foreach ($query as $key => $value) {
          $returned_data [$key] = $value;
          $returned_data [$key] ["img"] = self::merchant_giift_get_image_by_name($value["name"], $value["minpoin"])[0]["img"];
        }

        $returned_data_btn = [];
        $this->db->select("MAX(M_merchant_btn.points) AS maxpoin, MIN(M_merchant_btn.enabled) AS enabled, MIN(M_merchant_btn.points) AS minpoin, M_merchant_btn.name");
        $this->db->where('enabled',1);
        $this->db->group_by('name');
        // $this->db->where('category', $name);
        $this->db->like('name', $name);
        $this->db->limit($limit);
        $query = $this->db->get('btn_loyalty_program.M_merchant_btn')->result_array();  // Produces: SELECT MAX(age) as age FROM members
        foreach ($query as $key => $value) {
          $returned_data_btn [$key] = $value;
          $returned_data_btn [$key] ["img"] = base_url() . self::merchant_giift_get_image_by_name_btn($value["name"], $value["minpoin"])[0]["img"];
        }

        return array_merge($returned_data,$returned_data_btn);// $returned_data;

        $this->db->close();
   }

   public function merchant_giift_name_data_all($name="", $order = "") {

   $returned_data = [];
   $this->db->select("MAX(M_giift_list.points) AS maxpoin, MIN(M_giift_list.points) AS minpoin, M_giift_list.name");
   $this->db->group_by('name');
   $this->db->like('name', $name);
   $query = $this->db->get('btn_loyalty_program.M_giift_list')->result_array();  // Produces: SELECT MAX(age) as age FROM members
   foreach ($query as $key => $value) {
     $returned_data [$key] = $value;
     $returned_data [$key] ["img"] = self::merchant_giift_get_image_by_name($value["name"], $value["minpoin"])[0]["img"];
   }

   $returned_data_btn = [];
   $this->db->select("MAX(M_merchant_btn.points) AS maxpoin, MIN(M_merchant_btn.enabled) AS enabled, MIN(M_merchant_btn.points) AS minpoin, M_merchant_btn.name");
   $this->db->where('enabled',1);
   $this->db->group_by('name');
   $this->db->like('name', $name);
   $query = $this->db->get('btn_loyalty_program.M_merchant_btn')->result_array();  // Produces: SELECT MAX(age) as age FROM members
   foreach ($query as $key => $value) {
     $returned_data_btn [$key] = $value;
     $returned_data_btn [$key] ["img"] = base_url() . self::merchant_giift_get_image_by_name_btn($value["name"], $value["minpoin"])[0]["img"];
   }

   return array_merge($returned_data,$returned_data_btn);

   $this->db->close();
}

   public function merchant_giift_by_id($id="", $limit = 12, $order = "") {

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

        $returned_data_btn = [];
        $this->db->select("id, name, dmo_id, img, value, price, points, unit, category, last_update");
        $this->db->from("btn_loyalty_program.M_merchant_btn");
        $this->db->where('enabled', 1);
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
          $returned_data_btn[$key] = $value;
          $returned_data_btn[$key]["minpoin"] = $this->merchant_giift_get_points($value["dmo_id"])[0]["minpoin"];
          $returned_data_btn[$key]["maxpoin"] = $this->merchant_giift_get_points($value["dmo_id"])[0]["maxpoin"];
        }

        return array_merge($returned_data,$returned_data_btn);
        $this->db->close();
   }

   public function merchant_giift_by_id_all($id="", $order = "") {

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
    $voucher = $this->db->get()->result_array();
    foreach ($voucher as $key => $value) {
      $returned_data [$key] = $value;
      $returned_data [$key]["minpoin"] = $this->merchant_giift_get_points($value["dmo_id"])[0]["minpoin"];
      $returned_data [$key]["maxpoin"] = $this->merchant_giift_get_points($value["dmo_id"])[0]["maxpoin"];
    }

    $returned_data_btn = [];
    $this->db->select("id, name, dmo_id, img, value, price, points, unit, category, last_update");
    $this->db->from("btn_loyalty_program.M_merchant_btn");
    $this->db->where('enabled', 1);
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
    $voucher = $this->db->get()->result_array();
    foreach ($voucher as $key => $value) {
      $returned_data_btn[$key] = $value;
      $returned_data_btn[$key]["minpoin"] = $this->merchant_giift_get_points($value["dmo_id"])[0]["minpoin"];
      $returned_data_btn[$key]["maxpoin"] = $this->merchant_giift_get_points($value["dmo_id"])[0]["maxpoin"];
    }
    return array_merge($returned_data,$returned_data_btn);
     $this->db->close();
}

   public function merchant_giift_category_search($name="", $limit = 12, $order = "") {
        $returned_data = [];
        $this->db->select("MAX(M_giift_list.points) AS maxpoin, MIN(M_giift_list.points) AS minpoin, M_giift_list.name");
        $this->db->group_by('name');
        $this->db->where('category', $name);
        $this->db->limit($limit);
        $query = $this->db->get('btn_loyalty_program.M_giift_list')->result_array();  // Produces: SELECT MAX(age) as age FROM members
        foreach ($query as $key => $value) {
          $returned_data [$key] = $value;
          $returned_data [$key] ["img"] = self::merchant_giift_get_image_by_name($value["name"], $value["minpoin"])[0]["img"];
        }

        $returned_data_btn = [];
        $this->db->select("MAX(M_merchant_btn.points) AS maxpoin, MIN(M_merchant_btn.points) AS minpoin,MIN(M_merchant_btn.enabled) AS enabled, M_merchant_btn.name");
        $this->db->group_by('name');
        $this->db->where('category', $name);
        $this->db->where('enabled', 1);
        $this->db->limit($limit);
        $query = $this->db->get('btn_loyalty_program.M_merchant_btn')->result_array();  // Produces: SELECT MAX(age) as age FROM members
        foreach ($query as $key => $value) {
          $returned_data_btn[$key] = $value;
          $returned_data_btn[$key] ["img"] = base_url() . self::merchant_giift_get_image_by_name_btn($value["name"], $value["minpoin"])[0]["img"];
        }

        return array_merge($returned_data,$returned_data_btn);
        $this->db->close();
   }

   public function merchant_giift_category_search_all($name="", $order = "") {
   $returned_data = [];
   $this->db->select("MAX(M_giift_list.points) AS maxpoin, MIN(M_giift_list.points) AS minpoin, M_giift_list.name");
   $this->db->group_by('name');
   $this->db->where('category', $name);
   $query = $this->db->get('btn_loyalty_program.M_giift_list')->result_array();  // Produces: SELECT MAX(age) as age FROM members
   foreach ($query as $key => $value) {
     $returned_data [$key] = $value;
     $returned_data [$key] ["img"] = self::merchant_giift_get_image_by_name($value["name"], $value["minpoin"])[0]["img"];
   }

   $returned_data_btn = [];
   $this->db->select("MAX(M_merchant_btn.points) AS maxpoin, MIN(M_merchant_btn.enabled) AS enabled, MIN(M_merchant_btn.points) AS minpoin, M_merchant_btn.name");
   $this->db->group_by('name');
   $this->db->where('category', $name);
   $this->db->where('enabled', 1);
   $query = $this->db->get('btn_loyalty_program.M_merchant_btn')->result_array();  // Produces: SELECT MAX(age) as age FROM members
   foreach ($query as $key => $value) {
     $returned_data_btn[$key] = $value;
     $returned_data_btn[$key] ["img"] = base_url() . self::merchant_giift_get_image_by_name_btn($value["name"], $value["minpoin"])[0]["img"];
   }

   return array_merge($returned_data,$returned_data_btn);
   $this->db->close();
}

   private function merchant_giift_get_image_by_name($name, $point){
        $this->db->select("img");
        $this->db->from("btn_loyalty_program.M_giift_list");
        $this->db->where('name', $name);
        $this->db->where('points', $point);
        $name = $this->db->get()->result_array();
        return $name;
   }

   private function merchant_giift_get_image_by_name_btn($name, $point){
    $this->db->select("img");
    $this->db->from("btn_loyalty_program.M_merchant_btn");
    $this->db->where('name', $name);
    $this->db->where('enabled', 1);
    $this->db->where('points', $point);
    $name = $this->db->get()->result_array();
    return $name;
}

   public function merchant_giift_group_by_name_all($order = ""){

    $returned_data = [];

    $this->db->select("MAX(M_giift_list.points) AS maxpoin, MIN(M_giift_list.points) AS minpoin, M_giift_list.name");
    $this->db->group_by('name');
    if (!empty($order)) {
      if ($order == "latest") {
        // $this->db->order_by('last_update', 'DESC');
      }elseif ($order == "oldest") {
        // $this->db->order_by('last_update', 'ASC');
      }elseif ($order == "highest") {
        $this->db->order_by('maxpoin', 'DESC');
      }elseif ($order == "lowest") {
        $this->db->order_by('minpoin', 'ASC');
      }
    }
    $query = $this->db->get('btn_loyalty_program.M_giift_list')->result_array();  // Produces: SELECT MAX(age) as age FROM members
    foreach ($query as $key => $value) {
      $returned_data [$key] = $value;
      $returned_data [$key] ["img"] = self::merchant_giift_get_image_by_name($value["name"], $value["minpoin"])[0]["img"];
    }

    $returned_data_btn = [];
    $this->db->select("MAX(M_merchant_btn.points) AS maxpoin, MIN(M_merchant_btn.enabled) AS enabled, MIN(M_merchant_btn.points) AS minpoin, M_merchant_btn.name");
    $this->db->where('enabled',1);
    $this->db->group_by('name');
    if (!empty($order)) {
      if ($order == "latest") {
        // $this->db->order_by('last_update', 'DESC');
      }elseif ($order == "oldest") {
        // $this->db->order_by('last_update', 'ASC');
      }elseif ($order == "highest") {
        $this->db->order_by('maxpoin', 'DESC');
      }elseif ($order == "lowest") {
        $this->db->order_by('minpoin', 'ASC');
      }
    }
    $querys = $this->db->get('btn_loyalty_program.M_merchant_btn')->result_array();  // Produces: SELECT MAX(age) as age FROM members
    foreach ($querys as $key => $value) {
      $returned_data_btn [$key] = $value;
      $returned_data_btn [$key] ["img"] = base_url() . self::merchant_giift_get_image_by_name_btn($value["name"], $value["minpoin"])[0]["img"];
    }


    return array_merge($returned_data,$returned_data_btn);

    $this->db->close();

}

    public function merchant_giift_group_by_name($limit = 12, $order = ""){

        $returned_data = [];

        $this->db->select("MAX(M_giift_list.points) AS maxpoin,MAX(M_giift_list.img) AS img, MIN(M_giift_list.points) AS minpoin, M_giift_list.name");
        $this->db->group_by('name');
        if (!empty($order)) {
          if ($order == "latest") {
            // $this->db->order_by('last_update', 'DESC');
          }elseif ($order == "oldest") {
            // $this->db->order_by('last_update', 'ASC');
          }elseif ($order == "highest") {
            $this->db->order_by('maxpoin', 'DESC');
          }elseif ($order == "lowest") {
            $this->db->order_by('minpoin', 'ASC');
          }
        }
        $this->db->limit(12);
        $this->db->offset($limit - 12);
        $query = $this->db->get('btn_loyalty_program.M_giift_list')->result_array();  // Produces: SELECT MAX(age) as age FROM members

        $this->db->select("MAX(M_merchant_btn.points) AS maxpoin,MAX(M_merchant_btn.enabled) AS enabled,MAX(M_merchant_btn.img) AS img, MIN(M_merchant_btn.points) AS minpoin, M_merchant_btn.name");
        $this->db->group_by('name');
        $this->db->where('enabled',1);
        if (!empty($order)) {
          if ($order == "latest") {
            // $this->db->order_by('last_update', 'DESC');
          }elseif ($order == "oldest") {
            // $this->db->order_by('last_update', 'ASC');
          }elseif ($order == "highest") {
            $this->db->order_by('maxpoin', 'DESC');
          }elseif ($order == "lowest") {
            $this->db->order_by('minpoin', 'ASC');
          }
        }
        $this->db->limit(12);
        $this->db->offset($limit - 12);
        $query2 = $this->db->get('btn_loyalty_program.M_merchant_btn')->result_array();

        foreach ($query2 as $key => $value) {
          $returned_data [$key] = $value;
          $returned_data [$key] ["img"] = base_url() . ''. self::merchant_giift_get_image_by_name_btn($value["name"], $value["minpoin"])[0]["img"];
        }

        return array_merge($query,$returned_data);

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

    public function update_foto_profile($id, $data) {
      $this->db->where('id', $id);
      $this->db->set('img', $data);
      return $this->db->update('btn_loyalty_program.M_member');
      // die();
    }

    public function otp_fail_attempt_insert($table,$data) {

       return $this->db->insert($table,$data);
    }


    public function insert_submission($data) {

        // return $this->db->insert('btn_loyalty_program.M_news_letter_subs',$data);
        $proses = false;
        $this->db->where('email', $data['email']);
        $q = $this->db->get('btn_loyalty_program.M_news_letter_subs');
        if ( $q->num_rows() > 0 )
        {
            $proses = $this->db->update('btn_loyalty_program.M_news_letter_subs',$data);
        } else {
           // $this->db->set('user_id', $id);
           $proses =  $this->db->insert('btn_loyalty_program.M_news_letter_subs',$data);
        }
        return $proses;
        $this->db->close();
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
        $merchant_giift = $this->db->get()->result_array();
        foreach ($merchant_giift as $key => $value) {
          $merchant_giift[$key]['is_btn'] = 0;
        }

        $sql        = "SELECT * FROM btn_loyalty_program.M_wishlist JOIN btn_loyalty_program.M_merchant_btn ON btn_loyalty_program.M_merchant_btn.id = btn_loyalty_program.M_wishlist.list_id WHERE btn_loyalty_program.M_merchant_btn.enabled = 1 AND btn_loyalty_program.M_wishlist.member_id = ".$id;
        $query      = $this->db->query($sql);
        $merchant_btn = $query->result_array();
        foreach ($merchant_btn as $keys => $value) {
          $merchant_giift[$key]['is_btn'] = 0;
        }

        return array_merge($merchant_giift,$merchant_btn);



        $this->db->close();
   }
   public function searchWishList($id,$name,$paginate){
        $this->db->select('*');
        $this->db->where('member_id', $id);
        $this->db->like('M_giift_list.name', $name);
        $this->db->from('btn_loyalty_program.M_wishlist');
        $this->db->join('btn_loyalty_program.M_giift_list', 'btn_loyalty_program.M_giift_list.id = btn_loyalty_program.M_wishlist.list_id');
        $merchant_giift = $this->db->get()->result_array();

        $this->db->select('*');
        $this->db->where('member_id', $id);
        $this->db->where('enabled', 1);
        $this->db->like('M_merchant_btn.name', $name);
        $this->db->from('btn_loyalty_program.M_wishlist');
        $this->db->join('btn_loyalty_program.M_merchant_btn', 'btn_loyalty_program.M_merchant_btn.id = btn_loyalty_program.M_wishlist.list_id');
        $merchant_btn = $this->db->get()->result_array();

        return array_slice(array_merge($merchant_giift,$merchant_btn), $paginate ) ;



        $this->db->close();
   }
   public function is_item_in_wishlist($member_id, $id){
        $this->db->select('*');
        $this->db->where('member_id', $member_id);
        $this->db->where('list_id', $id);
        $this->db->from('btn_loyalty_program.M_wishlist');
        if (count($this->db->get()->result_array()) > 0) {
          return true;
        }else{
          return false;
        }
        // return $data;

        $this->db->close();
   }
  public function detailMerchant($id){
       $returned_data = [];

        $this->db->select("*");
        $this->db->where('dmo_id', $id);
        $query = $this->db->get('btn_loyalty_program.M_giift_list')->result_array();  // Produces: SELECT MAX(age) as age FROM members
        foreach ($query as $key => $value) {
          $returned_data [$key] = $value;
          // $returned_data [$key] ["img"] = self::merchant_giift_get_image_by_name($value["name"], $value["minpoin"])[0]["img"];
        }

        return $returned_data;

        $this->db->close();
    }


    public function get_Faq() {


        $this->db->select('*');
        $this->db->from('btn_loyalty_program.M_faq');
        return $this->db->get()->result_array();

        $this->db->close();
    }

    public function getFaqListIdPer($id){
        $this->db->select('*');
        $this->db->where('parent_id_pertama', $id);
        $this->db->from('btn_loyalty_program.M_faq');
        return $this->db->get()->result_array();

        $this->db->close();
   }
    public function getFaqListIdDua($id){
        $this->db->select('*');
        $this->db->where('parent_id_kedua', $id);
        $this->db->from('btn_loyalty_program.M_faq');
        return $this->db->get()->result_array();

        $this->db->close();
   }

   public function get_Syarat()
   {
        $this->db->select('*');
        $this->db->from('btn_loyalty_program.SyaratKetentuan');
        return $this->db->get()->result_array();

        $this->db->close();
   }
      public function get_Syarat_des()
   {
        $this->db->select('*');
        $this->db->from('btn_loyalty_program.SyaratKetentuanDes');
        return $this->db->get()->result_array();

        $this->db->close();
   }
      public function get_sosial_media($id)
   {
        $this->db->select('*');
        $this->db->where('id',$id);
        $this->db->from('btn_loyalty_program.M_sosial_media');
        return $this->db->get()->result_array();

        $this->db->close();
   }

    public function get_tentang_poin_serbu_title() {



        $this->db->select('*');
        $this->db->from('btn_loyalty_program.M_tentang_poinserbu');
        $this->db->where('type','title');
        return $this->db->get()->result_array();

        $this->db->close();
    }

        public function get_tentang_poin_serbu_link() {



        $this->db->select('*');
        $this->db->from('btn_loyalty_program.M_tentang_poinserbu');
        $this->db->where('type','url');
        return $this->db->get()->result_array();

        $this->db->close();
    }
      public function tentang_mekanisme($value='')
    {

        $this->db->select('*');
        $this->db->from('btn_loyalty_program.M_tentang_mekanisme');
        return $this->db->get()->result_array();

        $this->db->close();
    }

///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////
          public function tentang_perhitungan_poin_akuisisi($value='')
    {



        $this->db->select('*');
        $this->db->from('btn_loyalty_program.M_tentang_perhitungan_poin');
        $this->db->where('type','1');
        return $this->db->get()->result_array();

        $this->db->close();

    }

              public function tentang_perhitungan_poin_transaksional($value='')
    {

        $this->db->select('*');
        $this->db->from('btn_loyalty_program.M_tentang_perhitungan_poin');
        $this->db->where('type','2');
        return $this->db->get()->result_array();

        $this->db->close();
    }


    public function tentang_cek_jumlah_poin($value='')
    {

        $this->db->select('*');
        $this->db->from('btn_loyalty_program.M_tentang_cek_jumlah_poin');
        return $this->db->get()->result_array();

        $this->db->close();
    }

    public function logo_sponsor($value='')
    {

        $this->db->select('*');
        $this->db->from('btn_loyalty_program.M_logo_sponsor');
        return $this->db->get()->result_array();

        $this->db->close();
    }
     public function title_beranda()
    {

        $this->db->select('*');
        $this->db->from('btn_loyalty_program.PageBeranda');
        $this->db->where('param','title');
        return $this->db->get()->result_array();

        $this->db->close();
    }
     public function get_description_akuisisi()
    {




        $this->db->select('*');
        $this->db->from('btn_loyalty_program.M_tentang_perhitungan_poin');
        $this->db->where('type','des1');
        return $this->db->get()->result_array();

        $this->db->close();
    }
             public function get_description_transaksional()
    {



        $this->db->select('*');
        $this->db->from('btn_loyalty_program.M_tentang_perhitungan_poin');
        $this->db->where('type','des2');
        return $this->db->get()->result_array();

        $this->db->close();
    }

        public function get_des_cek_jumlah_poin()
    {


        $this->db->select('*');
        $this->db->from('btn_loyalty_program.M_tentang_cek_jumlah_poin_des');
        return $this->db->get()->result_array();

    }
      public function minimal_poin()
      {
        $this->db->select('value');
        $this->db->from('btn_loyalty_program.M_general_setting');
        $this->db->where('parameter','minimalPoin');
        return (int)$this->db->get()->result_array()[0]['value'];



      }

      public function getMember($id)
      {
        $this->db->select('*');
        $this->db->from('btn_loyalty_program.M_member');
        $this->db->where('id',$id);
        return $this->db->get()->result_array()[0];
      }
      public function getMemberActivation($id)
      {

        $data = array(
              'activation_date' => date("y-m-d H:i:s"),
        );

        $this->db->where('id', $id);
        $this->db->update('btn_loyalty_program.M_member', $data);

      }
}
