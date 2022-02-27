<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hadiah extends MY_Controller {

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
	$this->load->model ('admin_model');
	$this->load->model ('appusers_model');
		$this->load->model('katalog_model');
	$this->load->model ('crud_model');


	$this->load->model ('appuserstoken_model');
        $enc = new EncDec();

        $id_user = $enc->stringEncryption("decrypt",$_GET['access'])->username;
        $user_token = $this->appuserstoken_model->select_appusers('', $id_user);

        if ($this->session->userdata['user_data_web']['token'] != $user_token[0]['token']) {

        	 header("location: ".$this->config->item('base_url')."login/logout");
        	die();
        }

	error_reporting(E_ALL);
	}
	public function index()
	{
		$enc = new EncDec();

		// $strenc = $enc->stringEncryption("encrypt",json_encode($this->session->userdata['user_data_web']));
		// $strdec = $enc->stringEncryption("decrypt",$strenc);
		// print_r($strenc);
		// die();
		if(!isset($_GET['access']) || !$enc->stringEncryption("decrypt",$_GET['access'])){
			$data["heading"] = "404 Page Not Found";
			$data["message"] = "The page you requested was not found ";
			$this->load->view('errors/html/error_404',$data);
		}else{
			$data['hadiah']					= $this->katalog_model->get_hadiah();
			// print_r($katalog);
			// $parseData ['header']			= $this->load->view ( 'header', $data, true);
			// $parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);

				$parseData ['content']			= $this->load->view ( 'content/hadiah', $data, true);

			// $parseData ['footer']			= $this->load->view ( 'footer', '', true);
			// $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
			$this->load->view ( 'vside', $parseData);
		}

	}
	public function penukaran_hadiah($id)
	{
		$enc = new EncDec();
		if(!isset($_GET['access']) || !$enc->stringEncryption("decrypt",$_GET['access'])){
			$data["heading"] = "404 Page Not Found";
			$data["message"] = "The page you requested was not found ";
			$this->load->view('errors/html/error_404',$data);
		}else{

			$data['hadiah']					= count($this->katalog_model->select_katalog($id)) > 0 ? $this->katalog_model->select_katalog($id)[0] : false;

			// if($data['hadiah'] && $data['hadiah']['jumlah'] > 0){
				$parseData['content']			= $this->load->view('content/hadiah_detail',$data, true);

				// $parseData['footer']			= $this->load->view('footer', '', true);
				// $parseData['control_sidebar']	= $this->load->view('control_sidebar', '', true);
				$this->load->view('vside', $parseData);
			// }else{
				// $data["heading"] = "404 Page Not Found";
				// $data["message"] = "The page you requested was not found ";
				// $this->load->view('errors/html/error_404',$data);
//
			// }
		}
	}

	public function penukaran_hadiah_act_api()
	{
		// $enc = new EncDec();
		// $_POST["prize_code"];
		// $_POST["hp"];
print_r($_POST);
die();
				$data					= count($this->katalog_model->select_katalog_prizecode($_POST["prize_code"])) > 0 ? $this->katalog_model->select_katalog_prizecode($_POST["prize_code"])[0] : false;
				$data_users					= $this->appusers_model->select_appusers("",$_POST["hp"]);

				if($data){
					if($data['jumlah'] < 0) {

										$ch = curl_init();

										$url= "http://202.159.35.83/sms/api_sms_notif_ht.php?k=gaspol2020&m=".$_POST["hp"]."&p=QUOTA";
										curl_setopt($ch,CURLOPT_URL,$url);
										curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
										$feridisini = curl_exec($ch);
										$output=json_decode($feridisini,true);
										curl_close($ch);


										$false = array('status' =>false ,
																		'message' =>'Maaf hadiah habis' ,
																		 );
										echo json_encode($false);

					}elseif ($data['aktive'] != 1) {
                      	                $ch = curl_init();

										$url= "http://202.159.35.83/sms/api_sms_notif_ht.php?k=gaspol2020&m=".$_POST["hp"]."&p=QUOTA";
										curl_setopt($ch,CURLOPT_URL,$url);
										curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
										$feridisini = curl_exec($ch);
										$output=json_decode($feridisini,true);
										curl_close($ch);


										$false = array('status' =>false ,
																		'message' =>'Maaf hadiah sudah tidak aktif' ,
																		 );
										echo json_encode($false);
                    } else{


									if($data['poin'] > $data_users[0]["poin"]){


										$ch = curl_init();

										$url= "http://202.159.35.83/sms/api_sms_notif_ht.php?k=gaspol2020&m=".$_POST["hp"]."&p=INSUF";
										curl_setopt($ch,CURLOPT_URL,$url);
										curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
										$feridisini = curl_exec($ch);
										$output=json_decode($feridisini,true);
										curl_close($ch);

										// $this->session->set_flashdata('alert_hadiah_success', 'Poin Anda tidak cukup, silakan tingkatkan poin Anda');
										// $this->session->set_flashdata('alert_hadiah_success2', null);
										// $this->session->set_flashdata('picture', $data['picture']);
										//
										//
										// header("location: " . $this->config->item('base_url') . "hadiah/hadiah_success?access=".$_GET['access']);
										// die;

										$false = array('status' =>false ,
																		'message' =>'Poin Anda tidak cukup, silakan tingkatkan poin Anda' ,
																		 );
										echo json_encode($false);


									}else{

									// create aktifitas user

										// $poin_user = $this->session->userdata['user_data_web']['poin'] - $data['poin'];
										$field         = array(
											"type"         => "tukarpoin",
											"poin_dipakai" => $data['poin'],
											"date"         => date("Y-m-d"),
											"date_time"    => date("Y-m-d H:i:s"),
											"id_appusers"  => $data_users[0]["id"],
											"id_katalog"   => $data['id']
										);
										$this->crud_model->create("g_aktifitas_userapps", $field);



									// Update User

										$data_user         = array(
											"last_login"  => date("Y-m-d H:i:s"),
											"poin"        => $poin_user

										);

										$this->session->userdata['user_data_web']['poin'] = $poin_user;

										$this->crud_model->update("g_appusers", $data_user,$data_users[0]["id"]);

									// update hadiah
										$jumlah_katalog = $data['jumlah']-1;
										$data_katalog       = array(

											"jumlah"        => $jumlah_katalog

										);

										$jumlah_katalog_kurang = $this->crud_model->update("g_katalog", $data_katalog, $data['id']);

										if($jumlah_katalog_kurang){

											$ch = curl_init();

											$url= "http://202.159.35.83/sms/api_sms_notif_ht.php?k=gaspol2020&m=".$_POST["hp"]."&p=".$data['prize_code']."";
											curl_setopt($ch,CURLOPT_URL,$url);
											curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
											$feridisini = curl_exec($ch);
											$output=json_decode($feridisini,true);
											curl_close($ch);
											//print_r($output);
											//die();
												//
												// $this->session->userdata['user_data_web']['poin'] = $poin_user;
												// $this->session->set_flashdata('alert_hadiah_success', 'Selamat, Poin Anda telah di tukaer dengan '.$data['name']);
												// $this->session->set_flashdata('alert_hadiah_success2', 'Anda Akan Di Hubungi Oleh Team CS Kami');
												// $this->session->set_flashdata('picture', $data['picture']);

												$data['hadiah_success']					= $this->katalog_model->select_katalog_prizecode($_POST["prize_code"])[0];

												$sukses = array('status' =>true ,
																				'message' =>'Selamat, Poin Anda telah di tukaer dengan '.$data['name'] ,
																				 );
												echo json_encode($sukses);

										}





									}
								}
			}else{
				$false = array('status' =>false ,
												'message' =>'Hadiah Tidak terdaftar' ,
												 );
				echo json_encode($false);

			}



	}

	public function penukaran_hadiah_act($id)
	{
		$enc = new EncDec();
	//print_r(isset($_GET['access']));

		if(!isset($_GET['access']) || !isset($enc->stringEncryption("decrypt",$_GET['access'])->id) ){
			// $data["heading"] = "404 Page Not Found";
			// $data["message"] = "The page you requested was not found ";
            // $this->load->view('errors/html/error_404',$data);
			echo "test";
			die();
            header("location: ".$this->config->item('base_url')."login/accessExpired");
		}else{
				$data					= count($this->katalog_model->select_katalog($id)) > 0 ? $this->katalog_model->select_katalog($id)[0] : false;

				// print_r($data);
				// print_r($data['jumlah'] < 0);
				// die();
				if($data){
					if($data['jumlah'] <= 0) {

										$ch = curl_init();

										$url= "http://202.159.35.83/sms/api_sms_notif_ht.php?k=gaspol2020&m=".$this->session->userdata['user_data_web']['username']."&p=QUOTA";
										curl_setopt($ch,CURLOPT_URL,$url);
										curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
										$feridisini = curl_exec($ch);
										$output=json_decode($feridisini,true);
										curl_close($ch);

										$this->session->set_flashdata('alert_hadiah_success', 'Maaf hadiah habis');
										$this->session->set_flashdata('alert_hadiah_success2', null);
										$this->session->set_flashdata('picture', $data['picture']);


										header("location: " . $this->config->item('base_url') . "hadiah/hadiah_success?access=".$_GET['access']);
										die;

					}else{
									if($data['poin'] > $this->session->userdata['user_data_web']['poin']){

										// $this->session->set_flashdata('alert_hadiah_falid', 'Poin Anda tidak cukup, silakan tingkatkan poin Anda');
										// $data['hadiah_success']					= $this->katalog_model->select_katalog($id)[0];
										// $parseData['content']			= $this->load->view('content/hadiah_success', $data, true);
										// $this->load->view('vside', $parseData);
										$ch = curl_init();

										$url= "http://202.159.35.83/sms/api_sms_notif_ht.php?k=gaspol2020&m=".$this->session->userdata['user_data_web']['username']."&p=INSUF";
										curl_setopt($ch,CURLOPT_URL,$url);
										curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
										$feridisini = curl_exec($ch);
										$output=json_decode($feridisini,true);
										curl_close($ch);

										$this->session->set_flashdata('alert_hadiah_success', 'Poin Anda tidak cukup, silakan tingkatkan poin Anda');
										$this->session->set_flashdata('alert_hadiah_success2', null);
										$this->session->set_flashdata('picture', $data['picture']);


										header("location: " . $this->config->item('base_url') . "hadiah/hadiah_success?access=".$_GET['access']);
										die;



									}else{

									// create aktifitas user

										$poin_user = $this->session->userdata['user_data_web']['poin'] - $data['poin'];
										$field         = array(
											"type"         => "tukarpoin",
											"poin_dipakai" => $data['poin'],
											"date"         => date("Y-m-d"),
											"date_time"    => date("Y-m-d H:i:s"),
											"id_appusers"  => $this->session->userdata['user_data_web']['id'],
											"id_katalog"   => $data['id']
										);
										$this->crud_model->create("g_aktifitas_userapps", $field);



									// Update User

										$data_user         = array(
											"last_login"  => date("Y-m-d H:i:s"),
											"poin"        => $poin_user

										);

										$this->session->userdata['user_data_web']['poin'] = $poin_user;

										$this->crud_model->update("g_appusers", $data_user, $this->session->userdata['user_data_web']['id']);

									// update hadiah
										$jumlah_katalog = $data['jumlah']-1;
										$data_katalog       = array(

											"jumlah"        => $jumlah_katalog

										);

										$jumlah_katalog_kurang = $this->crud_model->update("g_katalog", $data_katalog, $data['id']);

										if($jumlah_katalog_kurang){

											$ch = curl_init();

											$url= "http://202.159.35.83/sms/api_sms_notif_ht.php?k=gaspol2020&m=".$this->session->userdata['user_data_web']['username']."&p=".$data['prize_code']."";
											curl_setopt($ch,CURLOPT_URL,$url);
											curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
											$feridisini = curl_exec($ch);
											$output=json_decode($feridisini,true);
											curl_close($ch);
											//print_r($output);
											//die();

												$this->session->userdata['user_data_web']['poin'] = $poin_user;
												$this->session->set_flashdata('alert_hadiah_success', 'Selamat, Poin Anda telah di tukaer dengan '.$data['name']);
												$this->session->set_flashdata('alert_hadiah_success2', 'Anda Akan Di Hubungi Oleh Team CS Kami');
												$this->session->set_flashdata('picture', $data['picture']);

												$data['hadiah_success']					= $this->katalog_model->select_katalog($id)[0];



												header("location: " . $this->config->item('base_url') . "hadiah/hadiah_success?access=".$_GET['access']);
												die;


										}else{

										}





									}
								}
			}else{
				$data["heading"] = "404 Page Not Found";
				$data["message"] = "The page you requested was not found ";
				$this->load->view('errors/html/error_404',$data);

			}

		}

	}

	public function hadiah_success()
	{


		$enc = new EncDec();
		if(!isset($_GET['access']) || !isset($enc->stringEncryption("decrypt",$_GET['access'])->id)){
			// $data["heading"] = "404 Page Not Found";
			// $data["message"] = "The page you requested was not found ";
            // $this->load->view('errors/html/error_404',$data);

            header("location: ".$this->config->item('base_url')."login/accessExpired");
		}else{

		// $data['alert_hadiah_success'] = $this->session->flashdata('alert_hadiah_success');
		// $data['alert_hadiah_success2'] = $this->session->flashdata('alert_hadiah_success');
		// $data['alert_hadiah_falid'] = $this->session->flashdata('alert_hadiah_falid');
		// // $data['alert_hadiah_falid'] = $this->session->flashdata('alert_hadiah_falid');
		// $data['picture'] = $this->session->flashdata('picture');

		// if($this->session->flashdata('alert_hadiah_success') && $this->session->flashdata('alert_hadiah_falid')){

			// $data['hadiah_success']					= $this->katalog_model->select_katalog($id)[0];

			$parseData['content']			= $this->load->view('content/hadiah_success', '', true);

			$this->load->view('vside', $parseData);


		// }else{
		// 	header("location: " . $this->config->item('base_url') . "hadiah");
		// 	die;
		// }
		}

	}
	public function create()
	{
        $parseData ['header']			= $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
        $parseData ['content']			= $this->load->view ( 'content/admin_create', '', true);
        $parseData ['footer']			= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
        $this->load->view ( 'vside', $parseData);
    }

	public function update($id)
	{
        $data['id']						= ($id != '' && is_numeric($id))? $id:0;
        $data['admin']					= $this->admin_model->select_admin($data['id'], '');
        $parseData ['header']			= $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
        $parseData ['content']			= $this->load->view ( 'content/admin_update', $data, true);
        $parseData ['footer']			= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
        $this->load->view ( 'vside', $parseData);
	}



	public function action_update()
	{
		$data['id']			= ($this->input->get_post('id'))?$this->input->get_post('id'):'';
        $data['name']		= ($this->input->get_post('name'))?$this->input->get_post('name'):'';
        $data['username']	= ($this->input->get_post('username'))?$this->input->get_post('username'):'';
        if (!empty($this->input->get_post('password'))) {
        	$data['password']	= sha1($this->input->get_post('password'))?sha1($this->input->get_post('password')):'';
        }
        $data['status']	= $this->input->get_post('status')?$this->input->get_post('status'): 0;
        $data['role_id']	= ($this->input->get_post('role_id'))?$this->input->get_post('role_id'):'';
		$this->form_validation->set_rules('id', 'id', 'required');
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('username', 'username', 'required');
		// $this->form_validation->set_rules('password', 'password', '');
		$this->form_validation->set_rules('role_id', 'role_id', 'required');
		if ($this->form_validation->run() == TRUE){
			// $admin	= $this->admin_model->select_admin('', $data['name']);
			// if(count($admin) > 0){
			// $this->session->set_flashdata('msgalert', 'Update data Failed, admin already exists');
			// header("location: ".$this->config->item('base_url')."admin");
			// die;
			// }else{
				// $field 	= array("name" => $data['name']);
        	if (!empty($this->input->get_post('password'))) {
				$field 		= array(
					"username" 		=> $data['username'],
					"password" 		=> $data['password'],
					"name" 			=> $data['name'],
					"status" 			=> $data['status'] ?? 0,
					"role_id" 		=> $data['role_id']
					);
			}else{
				$field 		= array(
					"username" 		=> $data['username'],
					"name" 			=> $data['name'],
					"status" 			=> $data['status'] ?? 0,
					"role_id" 		=> $data['role_id']
					);
			}
				$update_admin	= $this->crud_model->update("M_admin", $field, $data['id']);

				$this->session->set_flashdata('msgalert', 'Update success');
				header("location: ".$this->config->item('base_url')."admin");
				die;
			// }
		}else{

		$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
		header("location: ".$this->config->item('base_url')."admin/update/".$data['id']);
		die;
		}
	}


	public function action_create()
	{
        $data['name']		= ($this->input->get_post('name'))?$this->input->get_post('name'):'';
        $data['username']	= ($this->input->get_post('username'))?$this->input->get_post('username'):'';
        //$password = sha1($this->input->post('password'));

        $data['password']	= sha1($this->input->get_post('password'))?sha1($this->input->get_post('password')):'';
		$data['role_id']	= ($this->input->get_post('role_id'))?$this->input->get_post('role_id'):'';
		$this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
		if ($this->form_validation->run() == TRUE){
			$admin	= $this->admin_model->select_admin('', $data['username']);
			if(count($admin) > 0){
			$this->session->set_flashdata('msgalert', 'Insert data Failed, Username already exists');
			header("location: ".$this->config->item('base_url')."admin/create");
			die;
			}else{
				$field 		= array(
				"username" 		=> $data['username'],
				"password" 		=> $data['password'],
				"name" 			=> $data['name'],
				"status" => 0,
				"role_id" 		=> $data['role_id']
				);
				$create_admin	= $this->crud_model->create("M_admin", $field);
				if($create_admin){
                    $this->session->set_flashdata('msgalert', 'Insert data Success');
                    header("location: ".$this->config->item('base_url')."admin");
                    die;
				}else{
				$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
				header("location: ".$this->config->item('base_url')."admin/create");
				die;
				}
			}
		}else{
			$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
			$this->session->set_flashdata('field', $data);
            header("location: ".$this->config->item('base_url')."admin/create");
            die;
		}
    }

	public function delete($id)
	{
        $data['id']	= ($id != '' && is_numeric($id))? $id:0;
        $delete_admin	= $this->crud_model->delete("M_admin", array("id" => $id));
		if($delete_admin){
		$this->session->set_flashdata('msgalert', 'Delete data Success');
		header("location: ".$this->config->item('base_url')."admin");
		die;
		}else{
		$this->session->set_flashdata('msgalert', 'Delete data Failed, please try again');
		header("location: ".$this->config->item('base_url')."admin");
		die;
		}

	}
}
