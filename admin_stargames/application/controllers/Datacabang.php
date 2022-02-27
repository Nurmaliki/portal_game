<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datacabang extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
	parent::__construct();
	$this->load->model ('datacabang_model');
	$this->load->model ('crud_model');
	error_reporting(E_ALL);
	}
	public function index()
	{
        $parseData ['header']			= $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);


        if ($_SESSION['user_data']['role'] == 4){
            $parseData ['content']			= $this->load->view ( 'content/forbiden-access', '', true);
        }else{
            $parseData ['content']			= $this->load->view ( 'content/Datacabang', '', true);
        }

        $parseData ['footer']			= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
        $this->load->view ( 'vside', $parseData);
	}
	public function datatables()
	{
        $cabang					= $this->datacabang_model->get_cabang();
        $get_Totalrequest		= $this->datacabang_model->get_Totalrequest();
        $data 		= array();
		if(count($cabang) > 0){
			for($i=0; $i<count($cabang); $i++){

			$nestedData		= array();
			$nestedData[] 	= $cabang[$i]["nama_cabang"];
			$nestedData[] 	= $cabang[$i]["prefix_rek"];
      $nestedData[] 	= $cabang[$i]["des"];

      // $nestedData[] 	= $cabang[$i]["create_at"];
      // $nestedData[] 	= $cabang[$i]["update_at"];
			$nestedData[] 	= $cabang[$i]["create_at"];
      $nestedData[] 	= $cabang[$i]["create_by"];
			$nestedData[] 	= $cabang[$i]["update_at"];
			$nestedData[] 	= $cabang[$i]["update_by"];

			// $nestedData[] 	= $cabang[$i]["password"];
				if($this->session->userdata['user_data']['role'] == 1 or $this->session->userdata['user_data']['id'] == 2){
				$nestedData[] 	= '<a href="'.$this->config->item('base_url').'datacabang/update/'.$cabang[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp</a> <a href="'.$this->config->item('base_url').'datacabang/delete/'.$cabang[$i]["id"].'" data-confirm="Anda mau delete Cabang '.$cabang[$i]["nama_cabang"].'?" class="fa fa-fw fa-trash">&nbsp</a>';
				$data[] = $nestedData;
				}else if($this->session->userdata['user_data']['role'] == 2){
					$nestedData[] 	= '<a href="'.$this->config->item('base_url').'datacabang/update/'.$cabang[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp</a> <a href="'.$this->config->item('base_url').'datacabang/delete/'.$cabang[$i]["id"].'" data-confirm="Anda mau delete Cabang '.$cabang[$i]["nama_cabang"].'?" class="fa fa-fw fa-trash">&nbsp</a>';
				$data[] = $nestedData;
				}else if($this->session->userdata['user_data']['role'] == 3){
					$nestedData[] 	= '<a href="'.$this->config->item('base_url').'datacabang/update/'.$cabang[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp</a> <a href="'.$this->config->item('base_url').'datacabang/delete/'.$cabang[$i]["id"].'" data-confirm="Anda mau delete Cabang '.$cabang[$i]["nama_cabang"].'?" class="fa fa-fw fa-trash">&nbsp</a>';
				}else if($this->session->userdata['user_data']['role'] == 5){
					$nestedData[]	= '';
					$data[] = $nestedData;
				}else{
					$nestedData[]	= '';
					$data[] = $nestedData;
				}
			}
		}
        $json_data = array(
                "draw"            => intval(@$_REQUEST['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
                "recordsTotal"    => intval(count($get_Totalrequest)),  // total number of records
                "recordsFiltered" => intval(count($get_Totalrequest)),  // total number of records after searching, if there is no searching then totalFiltered = totalData
                "data"            => $data   // total data array
                );

        echo json_encode($json_data);  // send data as json format
	}
	public function create()
	{
        $parseData ['header']						= $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']			= $this->load->view ( 'left_coloumn', '', true);
        $parseData ['content']					= $this->load->view ( 'content/datacabang_create', '', true);
        $parseData ['footer']						= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
        $this->load->view ( 'vside', $parseData);
    }

	public function update($id)
	{
        $data['id']											= ($id != '' && is_numeric($id))? $id:0;
        $data['admin']									= $this->datacabang_model->select_cabang($data['id'], '');
        $parseData ['header']						= $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']			= $this->load->view ( 'left_coloumn', '', true);
        $parseData ['content']					= $this->load->view ( 'content/datacabang_update', $data, true);
        $parseData ['footer']						= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
        $this->load->view ( 'vside', $parseData);
	}



	public function action_update()
	{
				$data['id']					= ($this->input->get_post('id'))?$this->input->get_post('id'):'';
        $data['nama_cabang']				= ($this->input->get_post('nama_cabang'))?$this->input->get_post('nama_cabang'):'';
				$data['prefix_rek']		= ($this->input->get_post('prefix_rek'))?$this->input->get_post('prefix_rek'):'';
        $data['des']		= ($this->input->get_post('des'))?$this->input->get_post('des'):'';

		$this->form_validation->set_rules('prefix_rek', 'prefix_rek', 'required');
		$this->form_validation->set_rules('nama_cabang', 'nama_cabang', 'required');
		$this->form_validation->set_rules('des', 'des', 'required');
		if ($this->form_validation->run() == TRUE){
		    	$field 		= array(
					"nama_cabang" 		=> $data['nama_cabang'],
					"prefix_rek" 			=> $data['prefix_rek'],
					"des" 						=> $data['des'],
					"update_at" 			=> date('Y-m-d H:i:s'),
					"update_by" 			=> $this->session->userdata['user_data']['name']
					);

				$update_admin	= $this->crud_model->update("M_datacabang", $field, $data['id']);

				$this->session->set_flashdata('msgalert', 'Update success');
				header("location: ".$this->config->item('base_url')."datacabang");
				die;
			// }
		}else{

		$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
		header("location: ".$this->config->item('base_url')."datacabang/update/".$data['id']);
		die;
		}
	}


	public function action_create()
	{
        $data['nama_cabang']		= ($this->input->get_post('nama_cabang'))?$this->input->get_post('nama_cabang'):'';
				$data['prefix_rek']	    = ($this->input->get_post('prefix_rek'))?$this->input->get_post('prefix_rek'):'';
        $data['des']	    			= ($this->input->get_post('des'))?$this->input->get_post('des'):'';

				$this->form_validation->set_rules('nama_cabang', 'nama_cabang', 'required');
				$this->form_validation->set_rules('prefix_rek', 'prefix_rek', 'required');
        $this->form_validation->set_rules('des', 'des', 'required');

				if ($this->form_validation->run() == TRUE){

						$field 		= array(
						"nama_cabang" 		=> $data['nama_cabang'],
						"prefix_rek" 			=> $data['prefix_rek'],
						"des" 						=> $data['des'],
						"create_at" 			=> date('Y-m-d H:i:s'),
						"create_by" 			=> $this->session->userdata['user_data']['name']

						);


						$create_admin	= $this->crud_model->create("M_datacabang", $field);

						if($create_admin){

		            $this->session->set_flashdata('msgalert', 'Insert data Success');
		            header("location: ".$this->config->item('base_url')."datacabang");
		            die;

						}else{

								$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
								header("location: ".$this->config->item('base_url')."datacabang/create");
								die;

						}
				}else{
					$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
					$this->session->set_flashdata('field', $data);
		            header("location: ".$this->config->item('base_url')."datacabang/create");
		            die;
				}
    }

	public function delete($id)
	{
        $data['id']	= ($id != '' && is_numeric($id))? $id:0;
        $delete_admin	= $this->crud_model->delete("M_datacabang", array("id" => $id));
		if($delete_admin){
		$this->session->set_flashdata('msgalert', 'Delete data Success');
		header("location: ".$this->config->item('base_url')."datacabang");
		die;
		}else{
		$this->session->set_flashdata('msgalert', 'Delete data Failed, please try again');
		header("location: ".$this->config->item('base_url')."datacabang");
		die;
		}

	}
}
