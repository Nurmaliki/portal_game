<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
        $this->db = $this->load->database('default', TRUE);


        $this->load->model('crud_model');
				$this->load->model ('admin_model');
				$this->load->model ('appusers_model');
					$this->load->model('katalog_model');
    }

	public function index()
	{
        $parseData ['header']			= '';
        $this->load->view ( 'login', $parseData);
	}

    public function cek_poin()
    {
        if(!isset($_POST['hp'])){


            $json = array(
                "status" => false,
                "message" => "parameter hp kosong "
            );
            print_r(json_encode($json));
        }else{

					$poin = $this->admin_model->cek_poin($_POST['hp']);
					if ($poin) {
						$json = array(
								"status" => true,
								"poin" => $poin[0]['poin']
						);
						print_r(json_encode($json));
					}else{
						$json = array(
								"status" => false,
								"message" => "Nomor Hp tidak terdaftar"
						);
						print_r(json_encode($json));
					}

				}

    }

		public function penukaran_hadiah_act_api()
		{
			// $enc = new EncDec();
			// $_POST["prize_code"];
			// $_POST["hp"];
	// print_r($_POST);
	// die();

	if (!isset($_POST["prize_code"]) || $_POST["prize_code"] =="") {
		$false = array('status' =>false ,
										'message' =>'Parameter prize_code Kosong' ,
										 );
			echo json_encode($false);
			die();
	}elseif(!isset($_POST["hp"]) || $_POST["hp"] ==""){
		$false = array('status' =>false ,
										'message' =>'Parameter hp Kosong' ,
										 );
			echo json_encode($false);
			die();
	}
					$data					= count($this->katalog_model->select_katalog_prizecode($_POST["prize_code"])) > 0 ? $this->katalog_model->select_katalog_prizecode($_POST["prize_code"])[0] : false;
					$data_users					= $this->appusers_model->select_appusers("",$_POST["hp"]);

					if (count($data_users) > 0) {
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
																						'message' =>'no quota' ,
																						 );
														echo json_encode($false);

									}else{


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
																						'message' =>'insufficient points' ,
																						 );
														echo json_encode($false);


													}else{

													// create aktifitas user

														$poin_user = $data_users[0]['poin'] - $data['poin'];
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

																$data['hadiah_success']					= $this->katalog_model->select_katalog_prizecode($_POST["prize_code"])[0];

																$sukses = array('status' =>true ,
																								'message' =>'Success' ,
																								 );
																echo json_encode($sukses);

														}





													}
												}
							}else{
								$false = array('status' =>false ,
																'message' =>'no quota' ,
																 );
								echo json_encode($false);

							}
					}else{
						$false = array('status' =>false ,
														'message' =>'Nomor Tidak terdaftar' ,
														 );
						echo json_encode($false);
					}





		}

}
