<?php

class PageContent_model extends CI_Model
{
	/*public function __construct() {
	}*/
	public function __construct(){
        parent::__construct();
        $this->db = $this->load->database('default',TRUE);
        $this->load->model('datatables_model','DT');
        //$this->load->library('session');
    }
    
   	public function get_Faq() {
      
        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql	= "	SELECT * FROM M_faq ";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
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


    public function get_SyaratKetentuan() {
      
        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql	= "	SELECT * FROM SyaratKetentuan ";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }
    public function get_SyaratKetentuanDes() {
      
        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql	= "	SELECT * FROM SyaratKetentuanDes";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }

    public function get_beranda() {
      
        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql	= "	SELECT * FROM PageBeranda ";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data;
    }
    public function get_tentang() {
      
        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql    = " SELECT * FROM PageTentang ";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;
    }
        public function get_sponsor() {
      
        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql    = " SELECT * FROM M_logo_sponsor ";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;
    }



     /////////////////////////////////////
    /////////////////////////////////////tentang poin serbu
   /////////////////////////////////////

    public function get_tentang_poin_serbu_title() {
      
        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql    = " SELECT * FROM M_tentang_poinserbu where type = 'title' ";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;
    }

        public function get_tentang_poin_serbu_link() {
      
        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql    = " SELECT * FROM M_tentang_poinserbu where type = 'url' ";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;
    }
      public function tentang_mekanisme($value='')
    {
         
        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql    = " SELECT * FROM M_tentang_mekanisme  ";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;
    }

          public function tentang_cek_jumlah_poin($value='')
    {
         
        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql    = " SELECT * FROM M_tentang_cek_jumlah_poin  ";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;
    }

///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////
          public function tentang_perhitungan_poin_akuisisi($value='')
    {
         
        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql    = " SELECT * FROM M_tentang_perhitungan_poin  where type ='1' ";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;
    }

              public function tentang_perhitungan_poin_transaksional($value='')
    {
         
        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql    = " SELECT * FROM M_tentang_perhitungan_poin where type ='2' ";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;
    }

            public function beranda_title()
    {
         
        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql    = " SELECT * FROM PageBeranda where param ='title' ";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;
    }
            public function beranda_sub_title()
    {
         
        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql    = " SELECT * FROM PageBeranda where param ='sub_title' ";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;
    }

        public function get_description_akuisisi()
    {
         
        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql    = " SELECT * FROM M_tentang_perhitungan_poin where type ='des1' ";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;
    }
            public function get_description_transaksional()
    {
         
        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql    = " SELECT * FROM M_tentang_perhitungan_poin where type ='des2' ";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data;
    }

        public function get_des_cek_jumlah_poin()
    {
         
        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql    = " SELECT * FROM M_tentang_cek_jumlah_poin_des where id = 1 ";
        $query      = $this->db->query($sql);
        $data       = $query->result_array();
        return $data; 
    }
}