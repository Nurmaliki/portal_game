<?php

class Appusers_model extends CI_Model
{
    /*public function __construct() {
	}*/
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
        $this->load->model('datatables_model', 'DT');
        //$this->load->library('session');
    }

    public function get_Totalrequest()
    {
        $where_sql    = '';
        if (isset($_GET['search']['value']) && $_GET['search']['value'] != "") {
            $where_sql    .= "where UCASE(m.name) LIKE '%" . strtoupper($this->db->escape_str($_GET['search']['value'])) . "%'";
        }
        $sql    = "	SELECT m.* FROM g_appusers m $where_sql Order By m.id desc ";
        $query        = $this->db->query($sql);
        $data        = $query->result_array();
        return $data;
    }

    public function get_appusers()
    {
        $where_sql    = '';
        if (isset($_GET['search']['value']) && $_GET['search']['value'] != "") {
            $where_sql    .= " where UCASE(m.name) LIKE '%" . strtoupper($this->db->escape_str($_GET['search']['value'])) . "%'";
        }
        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql    = "	SELECT m.* FROM g_appusers m $where_sql Order By m.id desc LIMIT $offset,$rows";
        $query        = $this->db->query($sql);
        $data        = $query->result_array();
        return $data;
    }

    public function select_appusers($id = '', $username = '')
    {
        $where_sql    = '';
        if ($id != "") {
            $where_sql    .= " where id =" . $id;
        }
        if ($username != "") {
            $where_sql    .= " where username = '" . $username . "'";
        }
        $sql    = "	SELECT * FROM g_appusers $where_sql"; //where m.username =
        $query        = $this->db->query($sql);
        $data        = $query->result_array();
        return $data;
    }
    public function get_konfig($code_conf = '')
    {

        $sql    = "	SELECT * FROM g_konfigurasi where code_conf LIKE '" . $code_conf . "'"; //where m.username =
        $query        = $this->db->query($sql);
        $data        = $query->result_array();
        return $data;
    }

    public function get_aktifitas($type = '', $date, $id)
    {

        $sql    = "	SELECT * FROM g_aktifitas_userapps where type LIKE '" . $type . "' and date  = '" . $date . "' and id_appusers =" . $id; //where m.username =
        $query        = $this->db->query($sql);
        $data        = $query->result_array();
        return $data;
    }

    public function get_game()
    {

        $sql    = "SELECT m_news.*,m_news_cat.id as id_cat,m_news_cat.name as name FROM m_news JOIN m_news_cat ON m_news_cat.id = m_news.category_id where m_news.status = 1"; //where m.username =
        $query        = $this->db->query($sql);
        $data        = $query->result_array();
        return $data;
    }

    public function get_game_limit_offset($limit, $offset)
    {

        $sql    = "SELECT m_news.*,m_news_cat.id as id_cat,m_news_cat.name as name FROM m_news JOIN m_news_cat ON m_news_cat.id = m_news.category_id where m_news.status = 1 LIMIT $limit OFFSET $offset"; //where m.username =
        $query        = $this->db->query($sql);
        $data        = $query->result_array();
        return $data;
    }

    public function get_game_detail($id)
    {

        $sql    = "SELECT m_news.*,m_news_cat.id as id_cat,m_news_cat.name as name FROM m_news JOIN m_news_cat ON m_news_cat.id = m_news.category_id  where m_news.id = " . $id; //where m.username =
        $query        = $this->db->query($sql);
        $data        = $query->result_array();
        return $data;
    }



    public function get_member()
    {

        $sql        = "SELECT * FROM `g_appusers`"; //where m.username =
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;
    }

    public function get_member_detail($id)
    {

        $sql        = "SELECT * FROM `g_appusers` where id =" . $id; //where m.username =
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;
    }

    public function last_id()
    {

        $sql = 'SELECT MAX(id) as id FROM g_appusers';
        $query        = $this->db->query($sql);
        $user_last        = $query->result_array();
        // print_r($user_last);
        return $user_last;
    }
}
