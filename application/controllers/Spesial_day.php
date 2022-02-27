<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spesial_day extends MY_Controller {

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
        $this->load->model ('spesial_day_model');
        $this->load->model ('crud_model');
        error_reporting(E_ALL);
	}
	public function index()
	{
		$category['category']			= $this->spesial_day_model->get_spesial_day();
		// print_r($category);

		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
        // $parseData ['content']			= $this->load->view ( 'content/news_category', '', true);
        if ($_SESSION['user_data_web']['role'] == 4){
		    $parseData ['content']			= $this->load->view ( 'content/forbiden-access', '', true);
        }else{
		    $parseData ['content']			= $this->load->view ( 'content/spesial_day', $category, true);
        }
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
    }

	public function datatables()
	{
		$category				= $this->spesial_day_model->get_spesial_day();
		$get_Totalrequest		= $this->spesial_day_model->get_Totalrequest();
        $data 		= array();
        $c =1;
		if(count($category) > 0){
			for($i=0; $i<count($category); $i++){
				if($category[$i]["name"] == 'bonus_ultah'){
					echo "";
				}else{
						$nestedData		= array();
						$nestedData[] 	= $c++;
						$nestedData[] 	= $category[$i]["name"];

						$nestedData[] 	= $category[$i]["bonus"];
						if ($category[$i]["bonus_type"] == 0) {
								$nestedData[] 	= "Penambahan";
						}else{
								$nestedData[] 	= "Presentase "; 
						}

						$nestedData[] 	= $category[$i]["event_date"];
							if($this->session->userdata['user_data_web']['role'] == 1 or $this->session->userdata['user_data_web']['id'] == 2){
								$nestedData[] 	= '<a href="'.$this->config->item('base_url').'spesial_day/update/'.$category[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'spesial_day/delete/'.$category[$i]["id"].'" class="fa fa-fw fa-trash" data-confirm="Are you sure you want to Delete this data?">&nbsp;</a>';
								$data[] = $nestedData;
							}else if($this->session->userdata['user_data_web']['role'] == 3){
	/*EDIT FILE INI */			$nestedData[] 	= '';
								$data[] = $nestedData;
							}else if($this->session->userdata['user_data_web']['role'] == 5){
								$nestedData[]	= '';
								$data[] = $nestedData;
							}else{
								$nestedData[]	= '';
								$data[] = $nestedData;
							}
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
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/spesial_day_create', '', true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	}

    public function update($id='')
	{
		$data['id']						= ($id != '' && is_numeric($id))? $id:0;
		$data['spesial_day']			= $this->spesial_day_model->select_spesial_day('id', $data['id'])[0];
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/spesial_day_update', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
    }

	public function action_update()
	{

		$data['id']			= ($this->input->get_post('id'))?$this->input->get_post('id'):'';
		$current_data 		= $this->spesial_day_model->select_spesial_day('id', $data['id'])[0];
		$data['name']		= ($this->input->get_post('name'))?$this->input->get_post('name'):'';
		$data['bonus']		= ($this->input->get_post('bonus'))?$this->input->get_post('bonus'):'';
        $data['event_date']	= ($this->input->get_post('event_date'))?$this->input->get_post('event_date'):'';
		$data['rule_expire']= ($this->input->get_post('rule_expire'))?$this->input->get_post('rule_expire'):'';
		$data['bonus_type']	= ($this->input->get_post('bonus_type'))?$this->input->get_post('bonus_type'):'';


		$this->form_validation->set_rules('rule_expire', 'rule_expire', 'required');
		$this->form_validation->set_rules('bonus', 'bonus', 'required');
		if ($this->form_validation->run() == TRUE){
			$name		= $this->spesial_day_model->select_spesial_day('name', $data['name']);
			$event		= $this->spesial_day_model->select_spesial_day('event_date', $data['event_date']);
			// print_r($_POST);
			$field = array();
			$err = "data";
			// print_r($current_data);
			foreach($_POST as $key => $data_to_be_updated){
				// print_r($key);
				if($current_data[$key] != $_POST[$key]){
					$duplicated_name = count($this->spesial_day_model->select_spesial_day('name', $_POST[$key]));
					$duplicated_date = count($this->spesial_day_model->select_spesial_day('event_date', $_POST[$key]));
						if($duplicated_name == 0 ){
							$field[$key] =  $_POST[$key];
						}elseif($duplicated_date == 0){
							$field[$key] =  $_POST[$key];
						}else{
							$this->session->set_flashdata('spesialDayFalse', 'Update data Failed '.$err.' already exist, please try again');
							header("location: ".$this->config->item('base_url')."spesial_day/update/".$data['id']);
							die;
						}
				}
			}
			if(!empty($field)){
				$update = $this->crud_model->update("M_spesial_day", $field, $data['id']);
				$this->session->set_flashdata('spesialDayTrue', 'Update success');
				header("location: ".$this->config->item('base_url')."spesial_day");
				die;
			}else{
				$this->session->set_flashdata('spesialDayTrue', 'Update success');
				header("location: ".$this->config->item('base_url')."spesial_day");
				die;
			}
		}else{
		$this->session->set_flashdata('spesialDayFalse', 'Insert data Failed, please try again');
		header("location: ".$this->config->item('base_url')."spesial_day/update/".$data['id']);
		die;
		}
    }

	public function action_create()
	{
        $data['name']		= ($this->input->get_post('name'))?$this->input->get_post('name'):'';
		$data['bonus']		= ($this->input->get_post('bonus'))?$this->input->get_post('bonus'):'';
        $data['event_date']		= ($this->input->get_post('event_date'))?$this->input->get_post('event_date'):'';
		$data['rule_expire']		= ($this->input->get_post('rule_expire'))?$this->input->get_post('rule_expire'):'';
		$data['bonus_type']		= ($this->input->get_post('bonus_type'))?$this->input->get_post('bonus_type'):'';
		$this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('event_date', 'event_date', 'required');
        $this->session->set_flashdata('data',$data);
		if ($this->form_validation->run() == TRUE){

			$name		= $this->spesial_day_model->select_spesial_day('name', $data['name']);
			$event		= $this->spesial_day_model->select_spesial_day('event_date', $data['event_date']);
			// print_r(count($name));
			if(count($name) > 0){
                $this->session->set_flashdata('spesialDayFalse', 'Insert data Failed, name already exists');
                header("location: ".$this->config->item('base_url')."spesial_day/create");
                die;
			}elseif(count($event) > 0){
				$this->session->set_flashdata('spesialDayFalse', 'Insert data Failed, event_date already exists');
                header("location: ".$this->config->item('base_url')."spesial_day/create");
                die;
			}else{
                $field 		= array(
                                    "name"          => $data['name'],
                                    "bonus"         => $data['bonus'],
                                    "event_date"    => $data['event_date'],
                                    "rule_expire"   => $data['rule_expire'],
                                    "bonus_type"    => $data['bonus_type']


                );
				$create_admin	= $this->crud_model->create("M_spesial_day", $field);
				if($create_admin){
                    $this->session->set_flashdata('spesialDayTrue', 'Insert data Success');
                    echo "berhasil";
                    header("location: ".$this->config->item('base_url')."spesial_day");
                    die;
				}else{
                    $this->session->set_flashdata('spesialDayFalse', 'Insert data Failed, please try again');
                    echo "gagal2";
                    header("location: ".$this->config->item('base_url')."spesial_day/create");
                    die;
			 	}
			}
		}else{
        $this->session->set_flashdata('spesialDayFalse', 'Insert data Failed, please try again');
        echo "gagal3";
		header("location: ".$this->config->item('base_url')."spesial_day/create");
		die;
		}
	}
	public function delete($id)
	{
		$data['id']	= ($id != '' && is_numeric($id))? $id:0;
		$delete_admin	= $this->crud_model->delete("M_spesial_day", array("id" => $id));
		if($delete_admin){
		$this->session->set_flashdata('spesialDayTrue', 'Delete data Success');
			header("location: ".$this->config->item('base_url')."spesial_day");
			die;
		}else{
		$this->session->set_flashdata('spesialDayFalse', 'Delete data Failed, please try again');
			header("location: ".$this->config->item('base_url')."spesial_day");
			die;
		}

	}
}
