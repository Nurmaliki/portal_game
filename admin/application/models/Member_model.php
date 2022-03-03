<?php
ini_set("memory_limit","-1");
class Member_model extends CI_Model
{
	/*public function __construct() {
	}*/
	public function __construct(){
	parent::__construct();
	$this->db = $this->load->database('default',TRUE);
	$this->db->save_queries =false;
	$this->load->model('datatables_model','DT');
	//$this->load->library('session');
	}
	public function get_Totalrequest() {
        // $where_sql	= 'WHERE m.rekening = mr.ACCTNO ';
          $where_sql    = '';
            if (isset($_GET['search']['value']) && $_GET['search']['value'] != "" ) {
                if(is_numeric($_GET['search']['value'])){
                    $where_sql	.= "WHERE phone = ".$_GET['search']['value']." or rekening = ".$_GET['search']['value'];
                }else{
                    $where_sql	.= "WHERE cif LIKE '%".$_GET['search']['value']."%' ";
                //"where UCASE(m.first_name) LIKE '%".strtoupper($_GET['search']['value'])."%'";
                }
            }
        $sql	= "	SELECT * FROM M_member  $where_sql  ";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }

    public function get_reportMemberCSV() {// file name
        $filename = 'Report_poin_'.date('Y:m:d').'.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");
        $sql	= "SELECT m.first_name, m.cif, m.rekening, m.phone, m.email, m.registered_dated FROM `M_member` m" ;
        $query		= $this->db->query($sql);
        $data		= $query->result_array();

        // file creation
        $file = fopen('php://output', 'w');

        $header = array();
        fputcsv($file, $header);

        $header = array("Report jumlah nasabah yang sudah registrasi poin serbu");
        fputcsv($file, $header);

        $header = array();
        fputcsv($file, $header);

        $header = array("Nama","CIF","No. Rekening","Phone","Email","Tanggal Aktivasi","Cabang");
        fputcsv($file, $header);


            foreach ($data as $key=>$line){
            $sql	= "SELECT m.name FROM `M_branch` m WHERE m.prefix_number = '". substr($line['rekening'], 0, 4)."' " ;
            $query		= $this->db->query($sql);
            $data		= $query->result_array();
            $line['cabang'] = count($data) > 0 ? $data[0]['name'] : '';
            fputcsv($file,$line);
            }

        fclose($file);
        // $filename = 'Report_poins_'.date('Y:m:d').'.csv';
        // header("Content-Description: File Transfer");
        // header("Content-Disposition: attachment; filename=$filename");
        // header("Content-Type: application/csv; ");
        // $sql	= "SELECT first_name, cif, rekening, phone, email, registered_date FROM `M_member` LIMIT 1" ;
        // $query		= $this->db->query($sql);
        // $data		= $query->result_array();
        // $file = fopen('php://output', 'w');
        // $header = array("Nama","CIF","No. Rekening","Phone","Email","Tanggal Aktivasi","Cabang");
        // fputcsv($file, $header);
        //     foreach ($data as $key=>$line){
        //     fputcsv($file,$line);
        //     }
        // fclose($file);
}


    public function get_member() {

	    $where_sql	= '';
		if (isset($_GET['search']['value']) && $_GET['search']['value'] != "" ) {
			if(is_numeric($_GET['search']['value'])){
			    $where_sql	.= "WHERE phone LIKE '%".$_GET['search']['value']."%' ";//." or m.rekening = ".$_GET['search']['value'];
			}else if(ctype_alpha($_GET['search']['value'])){
			    $where_sql	.= "WHERE first_name LIKE '%".$_GET['search']['value']."%' ";//or UCASE(m.first_name) LIKE '%".strtoupper($_GET['search']['value'])."%'";
			}else{
			    $where_sql	.= "WHERE cif LIKE '%".$_GET['search']['value']."%' ";//or UCASE(m.first_name) LIKE '%".strtoupper($_GET['search']['value'])."%'";
			}

		}
		$offset = $this->DT->get_start();
		$rows   = $this->DT->get_rows();
		$sql	= "	SELECT *  FROM M_member  ".$where_sql."  LIMIT $offset,$rows";
		$query		= $this->db->query($sql);
		$data		= $query->result_array();
		return $data;

    }

    public function get_member_cif_or_rek($search) {
        // $where_awal="WHERE m.rekening = mr.ACCTNO ";
        // $where_awal ='';
        $where_sql  = '';
        if (isset($search) && $search!= "" ) {
            if(is_numeric($search)){
                $where_sql  .= "WHERE rekening LIKE '%".$search."%' ";//." or m.rekening = ".$_GET['search']['value'];
            }else{
                $where_sql  .= "WHERE cif LIKE '%".$search."%' ";//or UCASE(m.first_name) LIKE '%".strtoupper($_GET['search']['value'])."%'";
            }

        }
        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql    = " SELECT *  FROM M_member  ".$where_sql."  LIMIT $offset,$rows";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;

    }


    //============== total member==========
    public function total_member() {


		$sql	= "select COUNT(id) as total_member FROM M_member";
		$query		= $this->db->query($sql);
		$data		= $query->result_array();
		return $data;

    }

    public function total_member_register() {


		$sql	= 'SELECT COUNT(id) AS total_member_register FROM M_member WHERE M_member.email != "" or M_member.email != NULL' ;
		$query		= $this->db->query($sql);
		$data		= $query->result_array();
		return $data;

    }








	public function select_member($id='', $email='', $phone='') {
        $where_sql	= '';
            if ($id != "" ) {
                // $where_sql	.= " where mr.id= m.id and mr.id =".$id;
                $where_sql	.= " where mr.ACCTNO= m.rekening and mr.ACCTNO =".$id;

            }
            if ($email != "" ) {
                $where_sql	.= " where m.email = '".$email."'";
            }
            if ($phone != "" ) {
                $where_sql  .= " where m.phone = '".$phone."'";
            }
        $sql	= "	SELECT m.* , mr.point FROM M_member m, M_cif_map_rek mr $where_sql";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }

    public function get_total_poin($cif='') {


        $sql    = "SELECT trim(CIFNO),(SUM(point)) AS total FROM M_cif_map_rek where CIFNO LIKE '%".trim($cif)."%' GROUP BY trim(CIFNO)";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;
    }

    public function select_member_point($cif='', $email='') {
        $sql	= "	SELECT m.* , mr.point as total FROM M_point_history m LEFT JOIN M_cif_map_rek mr ON m.ACCTNO = mr.ACCTNO WHERE m.CIFNO like '%$cif%' and  m.status = 1 order by m.id desc";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }
     public function select_history_giift($cif) {
        $sql    = " SELECT m.* FROM btn_loyalty_member.`M_history` m  WHERE m.`member_id` in (select id from btn_loyalty_program.M_member where cif like '%".$cif."%') AND m.giift_dmo_id != ''  ORDER BY m.`id` DESC ";
        // $sql    = "SELECT m.*, t.program_name as name FROM btn_loyalty_member.M_history m left JOIN btn_loyalty_program.M_program t ON t.program_code where m.member_id in (select id from btn_loyalty_program.M_member where cif like '%".$cif."%')  and m.exchange_poin >0 order by m.date_created desc";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;
    }


    public function update_approval_status($id, $acctno){
        //M_approval_status
        $where_sql	= '';
            if ($id != "" ) {
                $where_sql	.= " where id =".$id;
            }
            if ($acctno != "" ) {
                $where_sql	.= " Where ACCTNO = '".$acctno."'";
            }
        $sql	= "	update M_approval_status set status = 1 $where_sql";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }

    public function get_approval_status($id){
        // $sql	= "	SELECT ms.point_adjust FROM M_approval_status ms  WHERE ms.member_id=$id";
        $sql	= "	SELECT ms.point_adjust FROM M_approval_status ms  WHERE ms.ACCTNO=$id";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }

    public function get_approval_list(){
        //$sql	= "	SELECT * FROM M_approval_status ";
        // $query		= $this->db->query($sql);
        // $data		= $query->result_array();
        // return $data;


	    $where_sql	= '';
		if (isset($_GET['search']['value']) && $_GET['search']['value'] != "" ) {
			if(is_numeric($_GET['search']['value'])){
			    $where_sql	.= "where ACCTNO =".$_GET['search']['value']." ";//." or m.rekening = ".$_GET['search']['value'];
			}

		}
		$offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql	= "	SELECT * FROM M_approval_status ".$where_sql." Order By id DESC LIMIT $offset,$rows";
		//$sql	= "	SELECT m.* , mr.point FROM M_member m, M_cif_map_rek mr ".$where_awal.$where_sql." Order By m.id asc LIMIT $offset,$rows";
		$query		= $this->db->query($sql);
		$data		= $query->result_array();
		return $data;
    }
}
