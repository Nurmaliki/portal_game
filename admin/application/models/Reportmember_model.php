<?php

class Reportmember_model extends CI_Model
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
	$sql	= "	SELECT m.* FROM g_appusers m $where_sql Order By m.id asc ";
	$query		= $this->db->query($sql);
	$data		= $query->result_array();
	return $data;
	}
   	public function get_reportmember() {
	$where_sql	= '';
		if (isset($_GET['search']['value']) && $_GET['search']['value'] != "" ) {
		$where_sql	.= " where UCASE(m.name) LIKE '%".strtoupper($this->db->escape_str($_GET['search']['value']))."%'";
		}
	$offset = $this->DT->get_start();
	$rows   = $this->DT->get_rows();
	$sql	= "	SELECT m.* FROM g_appusers m $where_sql Order By m.id desc LIMIT $offset,$rows";
	$query		= $this->db->query($sql);
	$data		= $query->result_array();
	return $data;
	}
	public function select_reportmember($id='', $name='') {
	$where_sql	= '';
		if ($id != "" ) {
		$where_sql	.= " where id = ".$id;
		}
		if ($name != "" ) {
		$where_sql	.= " where name = '".$name."'";
		}
	$sql	= "	SELECT * FROM g_appusers".$where_sql;
	$query		= $this->db->query($sql);
	$data		= $query->result_array();
	return $data;
	}

	public function get_report_member() {

	//$sql	= "SELECT SUM(poin) AS poin , g_appusers.username AS username FROM g_appusers JOIN `g_aktifitas_userapps` ON g_appusers.id = g_aktifitas_userapps.id_appusers GROUP BY g_appusers.username Order by poin DESC";
	$sql = "SELECT * from g_appusers order by poin DESC ";
	$query		= $this->db->query($sql);
	$data		= $query->result_array();
	return $data;
	}

	public function get_report_reddem() {

	$sql	= "SELECT * FROM g_appusers JOIN `g_aktifitas_userapps` ON g_appusers.id = g_aktifitas_userapps.id_appusers JOIN g_katalog ON g_katalog.id = g_aktifitas_userapps.id_katalog WHERE g_aktifitas_userapps.type= 'tukarpoin'";
	$query		= $this->db->query($sql);
	$data		= $query->result_array();
	return $data;
	}


	public function akt_login_user( $from_date='', $to_date='') {
				$where_sql	= '';

						if($from_date != '' and $to_date != ''){
						$where_sql	.= " AND (g_aktifitas_userapps.date >= '".$from_date."' and g_aktifitas_userapps.date <= '".$to_date."')";
						}

						// print_r($where_sql);
				$sql	= "SELECT * FROM `g_aktifitas_userapps` JOIN `g_appusers` ON `g_appusers`.id =`g_aktifitas_userapps`.id_appusers WHERE `g_aktifitas_userapps`.type LIKE 'login'".$where_sql;
				$query		= $this->db->query($sql);
				$data		= $query->result_array();
				return $data;
		}

		public function per_poin_user( $from_date='', $to_date='') {
					$where_sql	= '';

							if($from_date != '' and $to_date != ''){
							$where_sql	.= " AND (g_aktifitas_userapps.date >= '".$from_date."' and g_aktifitas_userapps.date <= '".$to_date."')";
							}

							// print_r($where_sql);
						$sql	= "SELECT * FROM `g_aktifitas_userapps` JOIN `g_appusers` ON `g_appusers`.id =`g_aktifitas_userapps`.id_appusers WHERE `g_aktifitas_userapps`.type NOT LIKE 'tukarpoin' AND `g_aktifitas_userapps`.type NOT LIKE 'unregister'".$where_sql;
					$query		= $this->db->query($sql);
					$data		= $query->result_array();
					return $data;
			}

			public function penukaran_poin( $from_date='', $to_date='') {
						$where_sql	= '';

								if($from_date != '' and $to_date != ''){
								$where_sql	.= " AND (g_aktifitas_userapps.date >= '".$from_date."' and g_aktifitas_userapps.date <= '".$to_date."')";
								}

								// print_r($where_sql);
							$sql	= "SELECT * FROM `g_aktifitas_userapps` JOIN `g_appusers` ON `g_appusers`.id =`g_aktifitas_userapps`.id_appusers WHERE `g_aktifitas_userapps`.type LIKE 'tukarpoin'".$where_sql;
						$query		= $this->db->query($sql);
						$data		= $query->result_array();
						return $data;
				}

				public function get_katalog($id) {



								$sql	= "SELECT * FROM `g_katalog` WHERE id =".$id;
							$query		= $this->db->query($sql);
							$data		= $query->result_array();
							return $data;
					}

}
