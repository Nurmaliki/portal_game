<?php

class History_model extends CI_Model
{
	/*public function __construct() {
	}*/
	public function __construct(){
        parent::__construct();
        $this->db = $this->load->database('default',TRUE);
        $this->load->model('datatables_model','DT');
        //$this->load->library('session');
	}
   	public function get_member_history() {
        $sql	= "SELECT * FROM M_point_history Order By date_related desc LIMIT 0,10";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
	}
	public function get_member_transaction_history() {
        //$sql	= "	SELECT * FROM M_member m, M_cif_map_rek p where m.rekening = p.ACCTNO Order By p.id desc LIMIT 0,10";
        // $sql	= "	SELECT h.* FROM btn_loyalty_member.M_history h left join btn_loyalty_program.M_member m on m.id = h.member_id Order By h.id desc LIMIT 0,10";
        $sql	= "SELECT h.*,m.* FROM btn_loyalty_member.`M_history` h JOIN btn_loyalty_program.`M_member` m ON m.id =h.member_id WHERE h.program_id != '' OR h.giift_dmo_id != '' Order By h.id desc LIMIT 0,10";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }
    public function get_all_poin() {
        //$sql	= "	SELECT * FROM M_member m, M_cif_map_rek p where m.rekening = p.ACCTNO Order By p.id desc LIMIT 0,10";
        $sql	= "	SELECT (SUM(point)) AS Total FROM M_point_history";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }
    public function get_all_poin_perday($date_start,$date_end) {

        $sql	= "	SELECT (SUM(point)) AS Total FROM M_point_history WHERE date_related BETWEEN '".$date_start."' AND '".$date_end."' ";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }
    public function get_all_poin_daybyday($date_end) {
        //SELECT id,point,date_related,poin_code FROM M_point_history WHERE   date_related <'2018-06-14 00:00:00.000000'
        //and date_related >'2018-06-10 00:00:00.000000' - INTERVAL 1 DAY
        //SELECT (SUM(point)) AS Total FROM M_point_history WHERE date_related <'2018-06-14 00:00:00.000000' and date_related >'2018-06-10 00:00:00.000000' - INTERVAL 1 DAY and date_related LIKE '%2018-06-11%'
        //SELECT (SUM(point)) AS Total FROM M_point_history WHERE date_related LIKE '%2018-06-11%'
        //$sql	= "	SELECT * FROM M_member m, M_cif_map_rek p where m.rekening = p.ACCTNO Order By p.id desc LIMIT 0,10"; 2018-06-25 00:00:00'

        $sql	= "	SELECT (SUM(point)) AS Total FROM M_point_history WHERE date_related LIKE '%".$date_end."%' ";
        //echo $sql,"</br>";

        $query		= $this->db->query($sql);
        $data	= $query->result_array();
        // print_r($data);
        // echo"</br>";

        return $data;
    }
    public function get_all_poin_byWeek($date_start,$date_end){


        $sql	= "SELECT SQL_NO_CACHE o1.date_related as week, SUM(o2.Total1)as Total FROM ( SELECT date_related FROM M_point_history WHERE date_related BETWEEN '$date_start' and '$date_end' GROUP BY date_related ) o1 INNER JOIN ( SELECT date_related, SUM(point) AS Total1 FROM M_point_history WHERE date_related BETWEEN '$date_start' and '$date_end' GROUP BY date_related ) o2 WHERE o2.date_related BETWEEN o1.date_related AND o1.date_related + INTERVAL 7 DAY AND o1.date_related GROUP BY o1.date_related";
        // $sql	= "SELECT (SUM(point)) AS Total , adddate(date_related, INTERVAL 7-DAYOFWEEK(date_related) DAY) as week FROM M_point_history WHERE date(date_related) BETWEEN '$date_start' and '$date_end' group by adddate(date_related, INTERVAL 7-DAYOFWEEK(date_related) DAY)";
        //echo "</br>sql = $sql</br>";
        $query		= $this->db->query($sql);
        $data	= $query->result_array();
        return $data;
    }
    public function get_all_poin_byMonth($date_start,$date_end){
        $sql	= "SELECT SQL_NO_CACHE o1.date_related as month, SUM(o2.Total1)as Total FROM ( SELECT date_related FROM M_point_history WHERE date_related BETWEEN '$date_start' and '$date_end' GROUP BY date_related ) o1 INNER JOIN ( SELECT date_related, SUM(point) AS Total1 FROM M_point_history WHERE date_related BETWEEN '$date_start' and '$date_end' GROUP BY date_related ) o2 WHERE o2.date_related BETWEEN o1.date_related AND o1.date_related + INTERVAL 29 DAY AND o1.date_related GROUP BY o1.date_related";
        // $sql ="SELECT (SUM(point)) AS Total , date_related as month FROM M_point_history WHERE date_related BETWEEN '$date_start' and '$date_end' GROUP BY date_related";
        // $sql ="SELECT (SUM(point)) AS Total , date_related FROM M_point_history WHERE date_related BETWEEN '$date_start' and '$date_end' GROUP BY date_related";
        // $sql	= "SELECT (SUM(point)) AS Total , adddate(date_related, INTERVAL 30-DAYOFMONTH(date_related) DAY) as month FROM M_point_history WHERE date(date_related) BETWEEN '$date_start' and '$date_end' group by adddate(date_related, INTERVAL 30-DAYOFMONTH(date_related) DAY)";
        //echo "</br>sql = $sql</br>";
        $query		= $this->db->query($sql);
        $data	= $query->result_array();
        return $data;
    }
    public function get_distribution($date_start,$date_end){
        // $sql	= "SELECT (SUM(exchange_poin)) AS Total , adddate(exchange_date, INTERVAL 30-DAYOFMONTH(exchange_date) DAY) as month FROM btn_loyalty_member.M_history WHERE date(exchange_date) BETWEEN '$date_start 00:00:00.000000' AND '$date_end 00:00:00.000000' group by adddate(exchange_date, INTERVAL 30-DAYOFMONTH(exchange_date) DAY);";
        // print_r($sql);

        $sql =" SELECT SQL_NO_CACHE o1.exchange_date as month, SUM(o2.Total1)as Total FROM ( SELECT exchange_date FROM btn_loyalty_member.M_history WHERE exchange_date BETWEEN '$date_start' and '$date_end' GROUP BY exchange_date ) o1 INNER JOIN ( SELECT exchange_date, SUM(exchange_poin) AS Total1 FROM btn_loyalty_member.M_history WHERE exchange_date BETWEEN '$date_start' and '$date_end' GROUP BY exchange_date ) o2 WHERE o2.exchange_date BETWEEN o1.exchange_date AND o1.exchange_date + INTERVAL 29 DAY AND o1.exchange_date GROUP BY o1.exchange_date ";

        $query		= $this->db->query($sql);
        $data	= $query->result_array();
        return $data;
    }
    public function get_distribution_redeem($date_start,$date_end){
        $sql = "SELECT SQL_NO_CACHE o1.redeem_date as month, SUM(o2.Total1)as Total FROM ( SELECT redeem_date FROM btn_loyalty_member.M_history WHERE redeem_date BETWEEN '$date_start' and '$date_end' GROUP BY redeem_date ) o1 INNER JOIN ( SELECT redeem_date, SUM(redeem_poin) AS Total1 FROM btn_loyalty_member.M_history WHERE redeem_date BETWEEN '$date_start' and '$date_end' GROUP BY redeem_date ) o2 WHERE o2.redeem_date BETWEEN o1.redeem_date AND o1.redeem_date + INTERVAL 29 DAY AND o1.redeem_date GROUP BY o1.redeem_date";
        // $sql	= "SELECT (SUM(redeem_poin)) AS Total , adddate(redeem_date, INTERVAL 30-DAYOFMONTH(redeem_date) DAY) as month FROM btn_loyalty_member.M_history WHERE date(redeem_date) BETWEEN '$date_start 00:00:00.000000' AND '$date_end 00:00:00.000000' group by adddate(redeem_date, INTERVAL 30-DAYOFMONTH(redeem_date) DAY)";
    //    print_r($sql);
        $query		= $this->db->query($sql);
        $data	= $query->result_array();
        // print_r($data);
        return $data;
    }
    public function get_all_poin_perweek() {
        //$sql	= "	SELECT * FROM M_member m, M_cif_map_rek p where m.rekening = p.ACCTNO Order By p.id desc LIMIT 0,10";
        $sql	= "	SELECT (SUM(point)) AS Total FROM M_point_history";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }

    public function get_all_poin_permonth() {
        $month="2018-06";//date('Y-m');
        //$sql	= "	SELECT * FROM M_member m, M_cif_map_rek p where m.rekening = p.ACCTNO Order By p.id desc LIMIT 0,10";
        $sql	= "	SELECT (SUM(point)) AS Total FROM M_point_history WHERE `date_related` LIKE '%".$month."%' ";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }

    public function get_poin_redeem_day() {
        // $month="2018-06";//date('Y-m');
        $date = date('Y-m-d');
        // $date='2018-10-25';
        $sql	= "	SELECT (SUM(redeem_poin)) AS Total FROM btn_loyalty_member.`M_history` WHERE redeem_date LIKE '%$date%'";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }
    public function get_poin_exchange_day() {
        // $month="2018-06";//date('Y-m');
        $date = date('Y-m-d');
        // print_r($date);
        // $date='2018-10-25';
        $sql	= "	SELECT (SUM(exchange_poin)) AS Total FROM btn_loyalty_member.`M_history` WHERE exchange_date LIKE '%$date%'";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }
     public function get_point_by_poincode($date,$order_by){
        if ($date !="") {
                $order_by ="order by total ".$order_by;
        }

        $sql    = "SELECT trim(poin_code) as poin_code_ps, (SUM(point)) as Total FROM btn_loyalty_program.M_point_history WHERE date_related LIKE '%$date%' GROUP BY poin_code_ps $order_by";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;
    }
    // public function get_point_by_poincode($date_from,$date_to){
		//
		//
    //     $sql    = "SELECT poin_code, (SUM(point)) as Total FROM btn_loyalty_program.M_point_history WHERE date_related BETWEEN '$date_from' AND '$date_to' GROUP BY date_related,poin_code order by Total desc";
    //     $query      = $this->db->query($sql);
    //     $data       = $query->result_array();
    //     return $data;
    // }
    public function get_poin_code(){

        $sql	= "SELECT TRIM(poin_code) AS poin_code FROM `M_point_history` GROUP BY TRIM(poin_code)";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }
    public function get_point_expire_by_poincode($date,$order_by){
        if ($date !="") {
                $order_by ="order by Total ".$order_by;
        }

        $sql    = "SELECT poin_code, (SUM(expire_point)) as Total FROM btn_loyalty_program.M_point_history WHERE expire_date LIKE '%$date%' GROUP BY poin_code $order_by";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;
    }
    public function get_poin_poincode_bydate($poincode='',$date_start='',$date_end=''){

        $sql	= "SELECT date_related,trim(poin_code) as poin_code_ps, (sum(point)) AS Total FROM `M_point_history`WHERE poin_code LIKE '%$poincode%' AND date_related BETWEEN '$date_start' AND '$date_end' GROUP BY date_related,poin_code_ps";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }
    public function get_poin_expire_poincode_bydate($poincode='',$date_start='',$date_end=''){

        $sql	= "SELECT date_related,poin_code, (sum(expire_point)) AS Total FROM `M_point_history`WHERE poin_code LIKE '%$poincode%' AND date_related BETWEEN '$date_start' AND '$date_end' GROUP BY poin_code,date_related";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }

}
