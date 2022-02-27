<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Addpoint extends CI_Controller {

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
                    // "id_appusers"  => $admin[0]['id'],
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

                    $test = $this->crud_model->create("g_appusers", $field);
                    // print_r($test);
                    // die();
                    $field         = array(
                        "type"         => $_POST['desc'],
                        "poin_didapat" => $_POST['poin'],
                        "date"         => date("Y-m-d"),
                        "date_time"    => date("Y-m-d H:i:s"),
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

}
