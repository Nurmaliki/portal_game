<?php

class Crud_model extends CI_Model
{
	/*public function __construct() {
	}*/
	public function __construct(){
	parent::__construct();
	$this->db = $this->load->database('default',TRUE);
    }

    public function select_rek($table, $rek){
        $sql	= "	SELECT m.point FROM $table m WHERE ACCTNO = $rek ";
        $query		= $this->db->query($sql);
        $data		= $query->result_array();
        return $data[0]['point'];

    }



   	public function update($table, $data, $id){
        $this->db->where('id', $id);
        return $this->db->update($table, $data);
    }

    public function update_approval_point($table, $data, $id){
        // $this->db->where('id', $id);
        return $this->db->update($table, $data, array("id" => $id));
    }
// codingan lama
    // public function update_point($table, $data, $id){
    //     // $this->db->where('id', $id);
    //     return $this->db->update($table, $data,array("id" => $id));
    // }

// maliki tgl 8 nov
    public function update_point_tb_rek($table, $data, $ACCTNO){
        // $this->db->where('id', $id);
        return $this->db->update($table, $data,array("ACCTNO" => $ACCTNO));
    }
    public function update_point_tb_phone($table, $data, $PHONE){
        // $this->db->where('id', $id);
        return $this->db->update($table, $data,array("PHONE" => $PHONE));
    }
    public function update_total_point($table, $data, $cif){
        $where	= "CIFNO LIKE '%$cif%'";
        //$query		= $this->db->query($sql);
        // $data		= $query->result_array();
	    // return $data;
        $this->db->where($where);
        return $this->db->update($table, $data);
    }

    public function update_point_history($table, $data, $cif){
        $where	= "CIFNO LIKE '%$cif%'";
        //$query		= $this->db->query($sql);
        // $data		= $query->result_array();
        // return $data;
        print_r($data);
        die;
        $this->db->where($where);
        return $this->db->update($table, $data);
    }

    public function create_point_history($table, $data){
        return $this->db->insert($table,$data);
    }

	public function create($table, $data){
	    return $this->db->insert($table,$data);
    }
	public function create_last_id($table, $data){
		    $this->db->insert($table,$data);
				$insert_id = $this->db->insert_id();
				return $insert_id;
	    }
	public function delete($table, $data){
        return $this->db->delete($table, $data);
    }

    public function insert_id(){
	    return $this->db->insert_id();
	}
}
