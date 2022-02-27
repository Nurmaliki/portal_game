<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends MY_Controller {

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
        $this->load->model ('setting_content_model');
        $this->load->model ('setting_model');
        $this->load->model ('crud_model');
        error_reporting(E_ALL);
	}
	public function index()
	{
		$parseData ['header']			= $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
        // if ($_SESSION['user_data_web']['role'] == 4){
		//     $parseData ['content']			= $this->load->view ( 'content/forbiden-access', '', true);
        // }else{
		    $parseData ['content']			= $this->load->view ( 'content/setting', '', true);
        // }

		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
        // print_r($_SESSION['user_data_web']);

	    $this->load->view ( 'vside', $parseData);
    }
	public function datatables()
	{
		$setting				= $this->setting_content_model->get_Setting();
        $get_Totalrequest		= $this->setting_content_model->get_Totalrequest();
        $setting_content		= $this->setting_model->get_Setting();

		$data 		= array();
		if(count($setting) > 0){
			for($i=0; $i<count($setting); $i++){
			$nestedData		= array();
            $nestedData[] 	= $setting[$i]["parameter"];


			if( $setting[$i]["value"] == 1){
				$nestedData[]  = "<span class='badge bg-green' style='background:rgb(40,220,20) !important;'>Aktif</span>";
			}else{
				$nestedData[]  ="<span class='badge bg-green'>Tidak Aktif</span>";
			}
            $nestedData[] 	= $setting[$i]["des"];

            // $nestedData[] 	= $category[$i]["publish_by"];
			$nestedData[] 	= $setting[$i]["date_created"];
			$nestedData[] 	= $setting[$i]["date_updated"];



				if($this->session->userdata['user_data_web']['role'] == 1 or $this->session->userdata['user_data_web']['id'] == 2){
					$nestedData[] 	= '<a href="'.$this->config->item('base_url').'setting/update/'.$setting[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.
										$this->config->item('base_url').'setting/delete/'.$setting[$i]["id"].'" class="fa fa-fw fa-trash " id="delete" data-confirm="Are you sure you want to Delete this data?">&nbsp;</a><a href="'.$this->config->item('base_url').
											'setting/detail/'.$setting[$i]["id"].'" class="fa fa-fw  fa-eye">&nbsp;</a>';
					$data[] = $nestedData;
				}else if($this->session->userdata['user_data_web']['role'] == 3){
					$nestedData[] 	= '</a><a href="'.$this->config->item('base_url').'setting/detail/'.$setting[$i]["id"]
					.'" class="fa fa-fw  fa-eye" id="view">&nbsp;</a> ';//<a href="'.$this->config->item('base_url').'news_content/update/'.$category[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>'
                    $data[] = $nestedData;
                }else if($this->session->userdata['user_data_web']['role'] == 5){
                	$nestedData[] 	= '<a href="'.$this->config->item('base_url').'setting/update/'.$setting[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a><a href="'.$this->config->item('base_url').'setting/detail/'.$setting[$i]["id"].'" class="fa fa-fw  fa-eye" id="view">&nbsp;</a> ';
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

		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/news_content_create', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	}

	public function update($id)
	{
		$field = $this->session->flashdata('field');
		$data['field']=$field;
		$data['id']						= ($id != '' && is_numeric($id))? $id:0;
        $data['content']				= $this->setting_content_model->select_setting($data['id'], '');
        $data['setting']				= $this->setting_model->select_setting();


		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/general_setting_update', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	}

	public function action_update($id)
	{
		if(!empty($id)){
			$data['id']			= $id;
		}else{
			$data['id']			= ($this->input->get_post('id'))?$this->input->get_post('id'):'';
		}

        $data['value']			= ($this->input->get_post('value'))?$this->input->get_post('value'):'';

		$field 		= array(
            "value" 				=> $data['value'],
            "date_updated" 	=> date('Y-m-d H:i:s'),
						"updated_by" 		=> $this->session->userdata['user_data_web']['name']


		);
		$update_province	= $this->crud_model->update("M_general_setting", $field, $data['id']);
		$this->session->set_flashdata('alertSettingTrue', 'Update success');
		header("location: ".$this->config->item('base_url')."setting");
		die;

	}
	public function minimal_poin(){
		$field = $this->session->flashdata('field');
		$data['field']=$field;
		// $data['id']						= ($id != '' && is_numeric($id))? $id:0;
        $data['content']				= $this->setting_content_model->select_setting('','minimalPoin')[0];
        $data['setting']				= $this->setting_model->select_setting();

		// print_r($data);
		// die();
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/general_setting_minimal_poin', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	}
	public function update_minimal_poin(){

		if(!empty($id)){
			$data['id']			= $id;
		}else{
			$data['id']			= ($this->input->get_post('id'))?$this->input->get_post('id'):'';
		}

        $data['value']			= ($this->input->get_post('value'))?$this->input->get_post('value'):'';

		$field 		= array(
            "value" 				=> $data['value'],
						"date_updated" 	=> date('Y-m-d H:i:s'),
            "updated_by" 		=> $this->session->userdata['user_data_web']['name']


		);

		$update_province	= $this->crud_model->update("M_general_setting", $field, $data['id']);
		$this->session->set_flashdata('minimalPoinTrue', 'Update success');
		header("location: ".$this->config->item('base_url')."setting/minimal_poin");
		die;
	}

}
