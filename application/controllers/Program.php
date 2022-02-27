<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program extends MY_Controller {

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
	$this->load->model ('program_model');
	$this->load->model ('category_model');
	$this->load->model ('crud_model');
	}
	public function index()
	{
	$parseData ['header']			= $this->load->view ( 'header', '', true);
	$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
	$parseData ['content']			= $this->load->view ( 'content/program', '', true);
	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
	$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	$this->load->view ( 'vside', $parseData);
	}
	public function datatables()
	{
	$program				= $this->program_model->get_program();
	$get_Totalprogram		= $this->program_model->get_Totalprogram();
	$data 		= array();
		if(count($program) > 0){
			for($i=0; $i<count($program); $i++){
			$nestedData		= array();
			$nestedData[] 	= $program[$i]["program_code"];
			$nestedData[] 	= $program[$i]["program_name"];
			$nestedData[] 	= $program[$i]["name"];
			$nestedData[] 	= $program[$i]["phone"];
			// $nestedData[] 	= $program[$i]["status"];

			if( $program[$i]["status"] == "1"){
				$nestedData[]  = "<span class='badge bg-green' style='background:rgb(40,220,20) !important;'>Aktif</span>";
			}else{
				$nestedData[]  ="<span class='badge bg-red''>Tidak Aktif</span>";
			}
			$nestedData[] 	= $program[$i]["email"];
				if($this->session->userdata['user_data_web']['role'] == 1 or $this->session->userdata['user_data_web']['id'] == 2){
				$nestedData[] 	= '<a href="'.$this->config->item('base_url').'program/update/'.$program[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'program/delete/'.$program[$i]["id"].'" class="fa fa-fw fa-trash" data-confirm="Are you sure you want to Delete this data?">&nbsp;</a>';
				}else if($this->session->userdata['user_data_web']['role'] == 2){
				$nestedData[] 	= '<a href="'.$this->config->item('base_url').'program/update/'.$program[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'program/delete/'.$program[$i]["id"].'" class="fa fa-fw fa-trash" data-confirm="Are you sure you want to Delete this data?">&nbsp;</a>';
				}else if($this->session->userdata['user_data_web']['role'] == 3){
				$nestedData[] 	= '<a href="'.$this->config->item('base_url').'program/update/'.$program[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>';
				}else{
				$nestedData[]	= '';
				}
			$data[] = $nestedData;
			}
		}
	$json_data = array(
			"draw"            => intval(@$_REQUEST['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
			"recordsTotal"    => intval(count($get_Totalprogram)),  // total number of records
			"recordsFiltered" => intval(count($get_Totalprogram)),  // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

	echo json_encode($json_data);  // send data as json format
	}
	public function create()
	{
	$data['category']				= $this->category_model->select_category();
	$parseData ['header']			= $this->load->view ( 'header', '', true);
	$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
	$parseData ['content']			= $this->load->view ( 'content/program_create', $data, true);
	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
	$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	$this->load->view ( 'vside', $parseData);
	}
	public function update($id)
	{

	$data['id']						= ($id != '' && is_numeric($id))? $id:0;
	$data['category']				= $this->category_model->select_category();
    $data['program']				= $this->program_model->select_program_detail($data['id']);

    // print_r($data['id']);
    // print_r($data['program']);
	$parseData ['header']			= $this->load->view ( 'header', '', true);
	$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
	$parseData ['content']			= $this->load->view ( 'content/program_update', $data, true);
	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
	$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	$this->load->view ( 'vside', $parseData);
	}
	public function action_update()
	{
	$data['id']						= ($this->input->get_post('id'))?$this->input->get_post('id'):'';
	$data['category_id']	= ($this->input->get_post('category_id'))?$this->input->get_post('category_id'):'';
	$data['program_code']	= ($this->input->get_post('program_code'))?$this->input->get_post('program_code'):'';
	$data['program_name']	= ($this->input->get_post('program_name'))?$this->input->get_post('program_name'):'';
	$data['phone']				= ($this->input->get_post('phone'))?$this->input->get_post('phone'):'';
	$data['email']				= ($this->input->get_post('email'))?$this->input->get_post('email'):'';
	$data['address']			= ($this->input->get_post('address'))?$this->input->get_post('address'):'';
	$data['status']		  	= ($this->input->get_post('status'))?$this->input->get_post('status'):'';


					if($_FILES["iconProgram"]['size'] == 0){

						$field 		= array(
								"category_id"		=> $data['category_id'],
								"program_code" 	=> $data['program_code'],
								"program_name" 	=> $data['program_name'],
								"phone" 				=> $data['phone'],
								"email" 				=> $data['email'],
								"address" 			=> $data['address'],
								"status" 				=> $data['status']
								);
							$update = $this->crud_model->update("M_program", $field, 	$data['id']);

							if($update){
									$this->session->set_flashdata('msgalert', 'Program Poin Berhasil di update');
								header("location: ".$this->config->item('base_url')."program");
													die;
							}else{
									$this->session->set_flashdata('msgalert', 'Program Poin Gagal di update');
									header("location: ".$this->config->item('base_url')."program/update/".$data['id']);
									die;
							}
					}else{


						$this->load->library("Rapid/RapidDataModel");
							 $config['upload_path']     = './uploads/cek_jumlah_poin/';
							 $config['allowed_types']   = 'gif|jpg|JPG|png|jpeg';
							 $new_name                  = sha1(time()).".".basename($_FILES["iconProgram"]['name']);
							 $config['encrypt_name']    = TRUE;
							 $config['file_name']       = $new_name;
							 $config['overwrite']       = TRUE;
							 $config['remove_spaces']   = TRUE;
							 // $config['max_size']             = 100;
							 // $config['max_width']            = 111;
							 // $config['max_height']           = 108;


						$upload =  $this->load->library('upload', $config);
						$this->upload->initialize($config);


							if (!$this->upload->do_upload('iconProgram')) {



								$this->session->set_flashdata('msgalert',	$this->upload->display_errors().$_FILES["iconProgram"]['name']  );

									// $this->session->set_flashdata('msgalert', 'Foto yang di upload tidak sesuai dengan format (gif|jpg|JPG|png|jpeg) atau ukuran lebih dari 100 kb, atau resolusi melebihi dari  111 px dan  108 px');
								header("location: ".$this->config->item('base_url')."program/update/".$data['id']);
									die;
							} else {

									$data1 = array('upload_data' => $this->upload->data());
									$file_info = $this->upload->data();
									$img = $file_info['file_name'];
									$path =$img;
									$error = array('error' => $this->upload->display_errors());


									$this->session->set_flashdata('path',$path);
									$uploadRequest = array(
											'fileName' => basename($this->upload->data()["full_path"]),
											'fileData' => base64_encode(file_get_contents($this->upload->data()["full_path"]))
									);
									// print_r($uploadRequest);
									// die();
									$uploader_id = sha1(uniqid());
									RapidDataModel::use('default');
									$create = RapidDataModel::create('F_uploader', array(
											array(
													"id" => $uploader_id,
													"filename" => $uploadRequest["fileName"],
													"file_encoded" => $uploadRequest["fileData"],
													"date_created" => date("Y-m-d H:i:s")
											)


									));

									if ($create) {
											$resp2 = shell_exec('curl -k -X POST -F "uploader_id='.$uploader_id.'" '.$this->config->item("assets_url_portal").'/index.php/cek_jumlah_poin-receiver/');
											$resp = json_decode($resp2);


											if ($resp->status == 1) {

														$field 		= array(
																"category_id"		=> $data['category_id'],
																"program_code" 	=> $data['program_code'],
																"program_name" 	=> $data['program_name'],
																"phone" 				=> $data['phone'],
																"email" 				=> $data['email'],
																"address" 			=> $data['address'],
																"status" 				=> $data['status'],
																"iconProgram" 	=> $uploadRequest["fileName"]
																);
																// print_r($field);
																// die();
															$update_tentang_mekanisme = $this->crud_model->update("M_program", $field, $data['id']);

																	if($update_tentang_mekanisme){
																			 $this->session->set_flashdata('msgalert', 'Berhasil Upload image ke portal dan simpan data di databse ');
																			header("location: ".$this->config->item('base_url')."program");
																			die;
																	}else{
																			 $this->session->set_flashdata('msgalert', 'Gagal Upload image ke portal dan simpan data di databse');
																			header("location: ".$this->config->item('base_url')."program/update/".$data['id']);
																			die;
																	}

													 }else{
													// Upload Failed
													$this->session->set_flashdata('msgalert', 'Failed upload image to the portal');
													}

									}else{

											$this->session->set_flashdata('msgalert', 'Failed inserting image to database');
									}
						}
				}



									// $this->form_validation->set_rules('category_id', 'category_id', 'required');
									// $this->form_validation->set_rules('program_name', 'program_name', 'required');
									// $this->form_validation->set_rules('phone', 'phone', 'required');
									// $this->form_validation->set_rules('email', 'email', 'required');
									// $this->form_validation->set_rules('address', 'address', 'required');
									// $this->form_validation->set_rules('id', 'id', 'required');
									// $this->form_validation->set_rules('program_code', 'program_code', 'required');
									// 	if ($this->form_validation->run() == TRUE){
									// 			$field 		= array(
									// 			"category_id"	=> $data['category_id'],
									// 			"program_code" 	=> $data['program_code'],
									// 			"program_name" 	=> $data['program_name'],
									// 			"phone" 		=> $data['phone'],
									// 			"email" 		=> $data['email'],
									// 			"address" 		=> $data['address'],
									// 			"status" 		=> $data['status']
									// 			);
									// 			$create_member	= $this->crud_model->update("M_program", $field, $data['id']);
									// 			if($create_member){
									// 			$this->session->set_flashdata('msgalert', 'Update data Success');
									// 			header("location: ".$this->config->item('base_url')."program");
									// 			die;
									// 			}else{
									// 			$this->session->set_flashdata('msgalert', 'Update data Failed, please try again');
									// 			header("location: ".$this->config->item('base_url')."program/update/".$data['id']);
									// 			die;
									// 			}
									// 	}else{
									// 	$this->session->set_flashdata('msgalert', 'Update data Failed, please try again');
									// 	header("location: ".$this->config->item('base_url')."program/update/".$data['id']);
									// 	die;
									// 	}
	}
	public function action_create()
	{
	$data1['category_id']	= ($this->input->get_post('category_id'))?$this->input->get_post('category_id'):'';
	$data1['program_code']	= ($this->input->get_post('program_code'))?$this->input->get_post('program_code'):'';
	$data1['program_name']	= ($this->input->get_post('program_name'))?$this->input->get_post('program_name'):'';
	$data1['phone']			= ($this->input->get_post('phone'))?$this->input->get_post('phone'):'';
	$data1['email']			= ($this->input->get_post('email'))?$this->input->get_post('email'):'';
	$data1['address']		= ($this->input->get_post('address'))?$this->input->get_post('address'):'';

	$this->form_validation->set_rules('program_code', 'program_code',  'required');
	$this->form_validation->set_rules('category_id', 'programcategory_id_code',  'required');
	$this->form_validation->set_rules('program_name', 'program_name',  'required');
	$this->form_validation->set_rules('address', 'address',  'required');
	$this->form_validation->set_rules('phone', 'phone',  'required');
	$this->form_validation->set_rules('email', 'email',  'required');


	$this->session->set_flashdata('filed', $data);

		if ($this->form_validation->run() == TRUE){


			$member	= $this->program_model->select_program($data1['program_code']);

			if(count($member) > 0){

						$this->session->set_flashdata('msgalert', 'Insert data Failed, Program code already exists');
						header("location: ".$this->config->item('base_url')."program/create");
						die;

			}else{
				// print_r($_FILES);
				// die();
				$this->load->library("Rapid/RapidDataModel");
				$config['upload_path']     = './uploads/cek_jumlah_poin/';
				$config['allowed_types']   = 'gif|jpg|png|jpeg';
				$new_name                  = sha1(time()).".".basename($_FILES["iconProgram"]['name']);
				$config['encrypt_name']    = TRUE;
				$config['file_name']       = $new_name;
				$config['overwrite']       = TRUE;
				$config['remove_spaces']   = TRUE;
				// $config['max_size']             = 100;
				// $config['max_width']            = 111;
				// $config['max_height']           = 108;

				$this->load->library('upload', $config);


					if ($this->upload->do_upload('iconProgram'))
						{


								$data = array('upload_data' => $this->upload->data());
								$file_info = $this->upload->data();
								$img = $file_info['file_name'];
								$path =$img;
								$error = array('error' => $this->upload->display_errors());


								$this->session->set_flashdata('path',$path);
								$uploadRequest = array(
										'fileName' => basename($this->upload->data()["full_path"]),
										'fileData' => base64_encode(file_get_contents($this->upload->data()["full_path"]))
								);


								$uploader_id = sha1(uniqid());
								RapidDataModel::use('default');
								$create = RapidDataModel::create('F_uploader', array(
										array(
												"id" => $uploader_id,
												"filename" => $uploadRequest["fileName"],
												"file_encoded" => $uploadRequest["fileData"],
												"date_created" => date("Y-m-d H:i:s")
										)


								));

								if ($create) {
										$resp2 = shell_exec('curl -k -X POST -F "uploader_id='.$uploader_id.'" '.$this->config->item("assets_url_portal").'/index.php/cek_jumlah_poin-receiver/');
										$resp = json_decode($resp2);


										if ($resp->status == 1) {


																	$field 		= array(
																						"category_id"			=> $data1['category_id'],
																						"program_code" 		=> $data1['program_code'],
																						"program_name" 		=> $data1['program_name'],
																						"phone" 					=> $data1['phone'],
																						"email" 					=> $data1['email'],
																						"address" 				=> $data1['address'],
																						"iconProgram" 		=> $uploadRequest["fileName"]
																	);

															$create_member	= $this->crud_model->create("M_program", $field);
															if($create_member){

																	$this->session->set_flashdata('msgalert', 'Insert data Success');
																	header("location: ".$this->config->item('base_url')."program");
																	die;

															}else{

																	$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
																	header("location: ".$this->config->item('base_url')."program/create");
																	die;

															}
										}else{


											// Upload Failed
											$this->session->set_flashdata('cek_jumlah_poinfalse', 'Failed upload image to the portal');
										}


					}
				}else{
							$this->session->set_flashdata('msgalert', 'file tidal seseuain');
							header("location: ".$this->config->item('base_url')."program/create");
							die;
				}


		}


	}
}
	public function delete($id)
	{
	$data['id']	= ($id != '' && is_numeric($id))? $id:0;
	$delete_member	= $this->crud_model->delete("M_program", array("id" => $id));
		if($delete_member){
		$this->session->set_flashdata('msgalert', 'Delete data Success');
		header("location: ".$this->config->item('base_url')."program");
		die;
		}else{
		$this->session->set_flashdata('msgalert', 'Delete data Failed, please try again');
		header("location: ".$this->config->item('base_url')."program");
		die;
		}

	}
}
