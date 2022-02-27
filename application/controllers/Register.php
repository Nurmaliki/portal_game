<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

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
        $this->load->model ('appusers_model');
        // $this->load->model('appusers_model');

        $this->load->model('admin_model');
        $this->load->model('crud_model');
    }

	public function index()
	{
        $parseData ['header']			= '';
        $this->load->view ( 'login', $parseData);
	}
	public function authentication(){
        $data['username']	= ($this->input->get_post('username'))?$this->input->get_post('username'):'';
        $data['password']	= sha1($this->input->get_post('password'))?sha1($this->input->get_post('password')):'';
        $admin	= $this->appusers_model->select_appusers('', $data['username'], $data['password']);

            if(count($admin) > 0){
                if($data['password'] == $admin[0]['password']){
                    $data_session['user_data_web']	= array(
                                                    'id'		=> $admin[0]['id'],
                                                    'name'		=> $admin[0]['name'],
                                                    'username'      => $admin[0]['username'],
                                                    'last_login'=> $admin[0]['last_login'],
                                                    'date_created'		=> $admin[0]['date_created'],
                                                    'poin'        => $admin[0]['poin']
                                                    );
                    $feriWasHere = 60*60*24*30;//30 days
                    $this->session->sess_expiration = $feriWasHere;
                    $this->session->set_userdata($data_session);

                    $konfigpoin = $this->appusers_model->get_konfig('login');

                    $get_aktifitas = $this->appusers_model->get_aktifitas('login', date("Y-m-d"), $admin[0]['id']);

                     $user_apps       = $this->appusers_model->select_appusers($admin[0]['id'], '');


                    if(count($get_aktifitas) > 0){

                        $poin_user = $user_apps[0]['poin'];

                    }else{


                         $poin_user = $user_apps[0]['poin'] + $konfigpoin[0]['poin'];
                            $field         = array(
                                "type"         => $konfigpoin[0]['code_conf'],
                                "poin_didapat" => $konfigpoin[0]['poin'],
                                "date"         => date("Y-m-d"),
                                "date_time"    => date("Y-m-d H:i:s"),
                                "id_appusers"  => $admin[0]['id'],
                                // "role_id"         => $data['role_id']
                            );
                            $this->crud_model->create("g_aktifitas_userapps", $field);
                    }


                $data_user         = array(
                    "last_login"  => date("Y-m-d H:i:s"),
                    "poin"        => $poin_user

                );
                $this->session->userdata['user_data_web']['poin'] = $poin_user;
                $this->crud_model->update("g_appusers", $data_user, $admin[0]['id']);


                    header("location: ".$this->config->item('base_url'));
                    die;
                }else{
                    $this->session->set_flashdata('msgalert', '<div id="msgalert" class="mb-2 btn btn-danger">Username or Password empty </div>');
                    header("location: ".$this->config->item('base_url')."login");
                    die;
                }
            }else{
                $this->session->set_flashdata('msgalert', '<div id="msgalert" class="bg-danger m-5 btn btn-danger">Username and password not found</div>');
                header("location: ".$this->config->item('base_url')."login");
                die;
            }
    }
    public function prosess()
    {



        if(!isset($_POST['hp'])){


            $json = array(
                "status" => false,
                "message" => "parameter hp kosong "
            );
            print_r(json_encode($json));
        }elseif (!isset($_POST['desc'])) {


                $json = array(
                "status" => false,
                "message" => "parameter desc kosong "
                );

            print_r(json_encode($json));
        }elseif(!isset($_POST['poin'])){

                $json = array(
                "status" => false,
                "message" => "parameter poin kosong "
                );

            print_r(json_encode($json));
		}else{

            $users    = $this->appusers_model->select_appusers('', $_POST['hp']);
            if (count($users) > 0) {


                $konfigpoin = $this->appusers_model->get_konfig('register');

                $poin_user = $users[0]['poin'] + $_POST['poin'];

                $field         = array(
                    "type"         => $_POST['desc'],
                    "poin_didapat" => $_POST['poin'],
                    "date"         => date("Y-m-d"),
                    "date_time"    => date("Y-m-d H:i:s"),
                    "id_appusers"  => $users[0]['id'],
                    // "role_id"         => $data['role_id']
                );

                $this->crud_model->create("g_aktifitas_userapps", $field);



                $data_user         = array(
                    "last_login"  => date("Y-m-d H:i:s"),
                    "poin"        => $poin_user

                );

                $this->crud_model->update("g_appusers", $data_user, $users[0]['id']);



                $users_data    = $this->appusers_model->select_appusers('', $_POST['hp']);
                print_r(json_encode(array(
                    "status" => true,
                    "message" => "Nomor Yang Anda masukan sudah terdaftar",
                    "data" =>  $users_data
                )));
            } else {
                if (isset($_POST['desc']) & isset($_POST['hp'])) {

                    $konfigpoin = $this->appusers_model->get_konfig('register');

                    $field         = array(
                        "desc_note" => $_POST['desc'],
                        // 'id'          => $admin[0]['id'],
                        // 'name'        => $admin[0]['name'],
                        'username'    => $_POST['hp'],
                        // 'last_login'  => $admin[0]['last_login'],
                        'date_created' => date("Y-m-d H:i:s"),
                        'poin'        => $_POST['poin']
                    );

                    $test = $this->crud_model->create_last_id("g_appusers", $field);
                    // print_r($test);
										// echo "test";
                    // die();
                    $field         = array(
                        "type"         => $_POST['desc'],
                        "poin_didapat" => $_POST['poin'],
                        "date"         => date("Y-m-d"),
                        "date_time"    => date("Y-m-d H:i:s"),

		                    "id_appusers"  => $test,
                    );

                  $this->crud_model->create("g_aktifitas_userapps", $field);

                    $user_last    = $this->appusers_model->last_id()[0]['id'];

                    $users_data_select    = $this->appusers_model->select_appusers($user_last);
                    // print_r($users_data_select);
                    // die();
                    print_r(json_encode(array(
                        "status" => true,
                        "message" => "Register berhasil",
                        "data" => $users_data_select,
                    )));


                }
            }


        }

    }

    public function unregister()
    {


        if (!isset($_POST['hp'])) {


            $json = array(
                "status" => false,
                "message" => "parameter hp kosong "
            );
            print_r(json_encode($json));
        }else {

            $users    = $this->appusers_model->select_appusers('', $_POST['hp']);
            if (count($users) > 0) {

                $data_user         = array(
                    "poin"        => 0
                );
                // $this->session->userdata['user_data_web']['poin'] = $poin_user;
                $this->crud_model->update("g_appusers", $data_user, $users[0]['id']);

                $field         = array(
                    "type"         => "unregister",
                    "poin_dipakai" => $users[0]['poin'],
                    "date"         => date("Y-m-d"),
                    "date_time"    => date("Y-m-d H:i:s"),
                    "id_appusers"  => $users[0]['id']
                );
                $this->crud_model->create("g_aktifitas_userapps", $field);
		$users_after    = $this->appusers_model->select_appusers('', $_POST['hp'])[0];
		$delete_redeem	= $this->crud_model->delete("g_appusers", array("id" => $users[0]['id']));



                print_r(json_encode(array(
                    "status" => true,
                    "message" => "Nomor Berhasil Di unregister",
                    "data" => $users_after
                )));
            } else {
                print_r(json_encode(array(
                    "status" => false,
                    "message" => "Nomor Yang Anda masukan tidak terdaftar"
                    // "data" => $users_after
                )));
            }
        }
    }

	public function logout(){
        $data_session['user_data_web']	= array('id' => '', 'email'	=> '', 'name'	=> '');
        $this->session->set_userdata($data_session);
        header("location: ".$this->config->item('base_url')."login");
        die;
	}
}
