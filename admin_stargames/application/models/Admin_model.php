<?php

class Admin_model extends CI_Model
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
        $sql	= "	SELECT m.* FROM M_admin m $where_sql Order By m.id desc ";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }

   	public function get_admin() {
        $where_sql	= '';
            if (isset($_GET['search']['value']) && $_GET['search']['value'] != "" ) {
            $where_sql	.= " where UCASE(m.name) LIKE '%".strtoupper($this->db->escape_str($_GET['search']['value']))."%'";
            }
        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql	= "	SELECT m.* FROM M_admin m $where_sql Order By m.id desc LIMIT $offset,$rows";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }

	public function select_admin($id='', $username='') {
        $where_sql	= '';
            if ($id != "" ) {
                $where_sql	.= " where m.id =".$id;
            }
            if ($username != "" ) {
                $where_sql	.= " where m.username = '".$username."'";
            }
        $sql	= "	SELECT m.* FROM M_admin m $where_sql";//where m.username =
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }

    public function get_jumlah_user()
    {

        $sql    = " SELECT COUNT(*) as jumlah FROM `g_appusers`"; //where m.username =
        $query        = $this->db->query($sql);
        $data        = $query->result_array();
        return $data;
    }

    public function get_reddem_poin()
    {

        $sql    = "SELECT SUM(poin_dipakai) AS reddem FROM `g_aktifitas_userapps` WHERE type = 'tukarpoin'"; //where m.username =
        $query        = $this->db->query($sql);
        $data        = $query->result_array();
        return $data;
    }
     public function get_poin_didapat()
    {

        $sql    = "SELECT SUM(poin_didapat) AS poin_didapat FROM `g_aktifitas_userapps`"; //where m.username =
        $query        = $this->db->query($sql);
        $data        = $query->result_array();
        return $data;
    }
     public function get_poin_today()
    {

        $sql    = "SELECT SUM(poin_didapat) AS poin_didapat FROM `g_aktifitas_userapps` where date = '".date("Y-m-d")."'"; //where m.username =
        $query        = $this->db->query($sql);
        $data        = $query->result_array();
        return $data;
    }
    public function get_jumlah_user_aktif()
    {

        $sql    = " SELECT COUNT(*) as jumlah FROM `g_appusers` where poin > 0 "; //where m.username =
        $query        = $this->db->query($sql);
        $data        = $query->result_array();
        return $data;
    }


		public function get_jumlah_user_login_hari_ini()
		{

				$sql    = " SELECT COUNT(*) AS jumlah FROM `g_aktifitas_userapps` WHERE `type` LIKE 'login' AND `date` =  '".date("Y-m-d")."'"; //where m.username =
				$query        = $this->db->query($sql);
				$data        = $query->result_array();
				return $data;
		}



}
