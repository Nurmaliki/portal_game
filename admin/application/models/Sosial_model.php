<?php

class Sosial_model extends CI_Model
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
        $where_sql  = '';
        if (isset($_GET['search']['value']) && $_GET['search']['value'] != "") {
            $where_sql  .= "where UCASE(m.name) LIKE '%" . strtoupper($this->db->escape_str($_GET['search']['value'])) . "%'";
        }
        $sql    = " SELECT m.* FROM m_admin m $where_sql Order By m.id desc ";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;
    }

    public function get_admin()
    {
        $where_sql  = '';
        if (isset($_GET['search']['value']) && $_GET['search']['value'] != "") {
            $where_sql  .= " where UCASE(m.name) LIKE '%" . strtoupper($this->db->escape_str($_GET['search']['value'])) . "%'";
        }
        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql    = " SELECT m.* FROM m_admin m $where_sql Order By m.id desc LIMIT $offset,$rows";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;
    }

    public function select_sosial($id = '', $param = '')
    {
        $where_sql  = '';
        if ($id != "") {
            $where_sql  .= " where m.id =" . $id;
        }
        if ($param != "") {
            $where_sql  .= " where m.param = '" . $param . "'";
        }
        $sql    = " SELECT m.* FROM M_sosial_media m $where_sql"; //where m.username =
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;
    }
}
