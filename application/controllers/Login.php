<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

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
    public function __construct()
    {
        parent::__construct();
        $this->load->model('appusers_model');
        $this->load->model('appuserstoken_model');
        // $this->load->model('appusers_model');

        $this->load->model('admin_model');
        $this->load->model('crud_model');
    }

    public function index()
    {
        $parseData['header']            = '';
        $this->load->view('new_game/login', $parseData);
    }
    public function authentication()
    {
        $enc = new EncDec();
        $data['username']    = ($this->input->get_post('username')) ? $this->input->get_post('username') : '';
        $data['username']       = "62" . $data['username'];
        $data['password']    = sha1($this->input->get_post('password')) ? sha1($this->input->get_post('password')) : '';
        $admin    = $this->appusers_model->select_appusers('', $data['username'], $data['password']);


        $ch = curl_init();
        $p = base64_encode($this->input->get_post('password') . '@2022Jet53T!');
        $url = $this->config->item('url_api_layanan') . "?k=jetset2022&m=" . $data['username'] . "&p=" . $p . "";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $feridisini = curl_exec($ch);
        $output = json_decode($feridisini, true);
        curl_close($ch);


        // $output["success"] = 1;

        if (isset($output["error"])) {
            $this->session->set_flashdata('msgalert', '<div id="msgalert" style="margin-bottom: 10px;     color: #ff5012;    text-align: center; font-weight: bold;border-radius: 6px;    padding: 8px;">' . $output["error"] . '</div>');
            header("location: " . $this->config->item('base_url') . "login");
            die;
        } elseif (isset($output["success"])) {
            if (count($admin) > 0) {
                if ($data['password'] == $admin[0]['password']) {
                    $data_session['user_data_web']    = array(
                        'id'            => $admin[0]['id'],
                        'name'          => $admin[0]['name'],
                        'username'      => $admin[0]['username'],
                        'last_login'    => $admin[0]['last_login'],
                        'date_created'  => $admin[0]['date_created'],
                        'poin'          => $admin[0]['poin']
                    );
                    $feriWasHere = 60 * 60000; //30 minutes
                    $this->session->sess_expiration = $feriWasHere;
                    $this->session->set_userdata($data_session);

                    $accessKey = $enc->stringEncryption("encrypt", json_encode($data_session['user_data_web']));


                    $konfigpoin = $this->appusers_model->get_konfig('login');

                    $get_aktifitas = $this->appusers_model->get_aktifitas('login', date("Y-m-d"), $admin[0]['id']);

                    $user_apps       = $this->appusers_model->select_appusers($admin[0]['id'], '');


                    if (count($get_aktifitas) > 0) {
                        $poin_user = $user_apps[0]['poin'];
                        $this->session->userdata['user_data_web']['is_first_login_today'] = false;
                    } else {
                        $this->session->userdata['user_data_web']['bonuspoin'] = $konfigpoin[0]['poin'];
                        $this->session->userdata['user_data_web']['is_first_login_today'] = true;
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

                    //Generate Token
                    $user_token = $this->appuserstoken_model->select_appusers('', $data['username']);
                    $token = $this->getToken(10);

                    $this->session->userdata['user_data_web']['token'] = $token;

                    if (count($user_token) > 0) {
                        $data_user_token         = array(
                            "last_login"  => date("Y-m-d H:i:s"),
                            "token"          => $token

                        );

                        $this->crud_model->update("g_appusers_token", $data_user_token, $user_token[0]['id']);
                    } else {

                        $data_user_token         = array(
                            "username"  => $data['username'],
                            "token"          => $token

                        );
                        $this->crud_model->create("g_appusers_token", $data_user_token);
                    }


                    header("location: " . $this->config->item('base_url') . "?access=" . $accessKey);
                    die;
                } else {




                    $data_session['user_data_web']    = array(
                        'id'            => $admin[0]['id'],
                        'name'          => $admin[0]['name'],
                        'username'      => $admin[0]['username'],
                        'last_login'    => $admin[0]['last_login'],
                        'date_created'  => $admin[0]['date_created'],
                        'poin'          => $admin[0]['poin']
                    );
                    $feriWasHere = 60 * 60000; //30 minutes
                    $this->session->sess_expiration = $feriWasHere;
                    $this->session->set_userdata($data_session);

                    $accessKey = $enc->stringEncryption("encrypt", json_encode($data_session['user_data_web']));
                    //$strdec = $enc->stringEncryption("decrypt",$strenc);
                    //print_r($strenc);
                    //die();

                    $konfigpoin = $this->appusers_model->get_konfig('login');

                    $get_aktifitas = $this->appusers_model->get_aktifitas('login', date("Y-m-d"), $admin[0]['id']);

                    $user_apps       = $this->appusers_model->select_appusers($admin[0]['id'], '');


                    if (count($get_aktifitas) > 0) {
                        $poin_user = $user_apps[0]['poin'];
                        $this->session->userdata['user_data_web']['is_first_login_today'] = false;
                    } else {
                        $this->session->userdata['user_data_web']['bonuspoin'] = $konfigpoin[0]['poin'];
                        $this->session->userdata['user_data_web']['is_first_login_today'] = true;
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
                        "poin"        => $poin_user,
                        "password"      => $data['password']

                    );
                    $this->session->userdata['user_data_web']['poin'] = $poin_user;
                    $this->crud_model->update("g_appusers", $data_user, $admin[0]['id']);

                    $user_token = $this->appuserstoken_model->select_appusers('', $data['username']);
                    //Generate Token
                    $token = $this->getToken(10);
                    $this->session->userdata['user_data_web']['token'] = $token;

                    if (count($user_token) > 0) {
                        $data_user_token         = array(
                            "last_login"  => date("Y-m-d H:i:s"),
                            "token"          => $token

                        );

                        $this->crud_model->update("g_appusers_token", $data_user_token, $user_token[0]['id']);
                    } else {

                        $data_user_token         = array(
                            "username"  => $data['username'],
                            "token"          => $token

                        );
                        $this->crud_model->create("g_appusers_token", $data_user_token);
                    }



                    header("location: " . $this->config->item('base_url') . "?access=" . $accessKey);
                    die;
                }
            } else {

                $konfigpoin = $this->appusers_model->get_konfig('login');

                $field         = array(
                    'name'        => $data['username'],
                    'username'    => $data['username'],
                    'password'      => $data['password'],
                    'date_created' => date("Y-m-d H:i:s"),
                );

                $test = $this->crud_model->create("g_appusers", $field);

                $user_last    = $this->appusers_model->last_id()[0]['id'];

                $users_data_select    = $this->appusers_model->select_appusers($user_last);

                $data_session['user_data_web']    = array(
                    'id'        => $users_data_select[0]['id'],
                    'name'        => $users_data_select[0]['name'],
                    'username'      => $users_data_select[0]['username'],
                    'last_login' => $users_data_select[0]['last_login'],
                    'date_created'        => $users_data_select[0]['date_created'],
                    'poin'        => $users_data_select[0]['poin']
                );
                $feriWasHere = 60 * 60000; //30 minutes
                $this->session->sess_expiration = $feriWasHere;
                $this->session->set_userdata($data_session);

                $accessKey = $enc->stringEncryption("encrypt", json_encode($data_session['user_data_web']));
                $konfigpoin = $this->appusers_model->get_konfig('login');

                $get_aktifitas = $this->appusers_model->get_aktifitas('login', date("Y-m-d"), $users_data_select[0]['id']);

                $user_apps       = $this->appusers_model->select_appusers($users_data_select[0]['id'], '');


                if (count($get_aktifitas) > 0) {
                    $poin_user = $user_apps[0]['poin'];
                    $this->session->userdata['user_data_web']['is_first_login_today'] = false;
                } else {
                    $this->session->userdata['user_data_web']['bonuspoin'] = $konfigpoin[0]['poin'];
                    $this->session->userdata['user_data_web']['is_first_login_today'] = true;
                    $poin_user = $user_apps[0]['poin'] + $konfigpoin[0]['poin'];
                    $field         = array(
                        "type"         => $konfigpoin[0]['code_conf'],
                        "poin_didapat" => $konfigpoin[0]['poin'],
                        "date"         => date("Y-m-d"),
                        "date_time"    => date("Y-m-d H:i:s"),
                        "id_appusers"  => $users_data_select[0]['id'],
                    );
                    $this->crud_model->create("g_aktifitas_userapps", $field);
                }




                $data_user         = array(
                    "last_login"  => date("Y-m-d H:i:s"),
                    "poin"        => $poin_user,
                    "password"      => $data['password']

                );
                $this->session->userdata['user_data_web']['poin'] = $poin_user;
                $this->crud_model->update("g_appusers", $data_user, $users_data_select[0]['id']);

                $user_token = $this->appuserstoken_model->select_appusers('', $data['username']);


                //Generate Token
                $token = $this->getToken(10);
                $this->session->userdata['user_data_web']['token'] = $token;

                if (count($user_token) > 0) {
                    $data_user_token         = array(
                        "last_login"  => date("Y-m-d H:i:s"),
                        "token"          => $token

                    );

                    $this->crud_model->update("g_appusers_token", $data_user_token, $user_token[0]['id']);
                } else {

                    $data_user_token         = array(
                        "username"  => $data['username'],
                        "token"          => $token

                    );
                    $this->crud_model->create("g_appusers_token", $data_user_token);
                }

                header("location: " . $this->config->item('base_url') . "?access=" . $accessKey);
                die;
            }
        } else {
            $this->session->set_flashdata('msgalert', '<div id="msgalert" style="margin-bottom: 10px;    color: #ff5012;   text-align: center; font-weight: bold;border-radius: 6px;    padding: 8px;">' . $output["error"] . '</div>');
            header("location: " . $this->config->item('base_url') . "login");
            die;
        }
    }

    public function unregister()
    {
    }
    public function logout()
    {
        $data_session['user_data_web']    = array('id' => '', 'email'    => '', 'name'    => '');
        $this->session->set_userdata($data_session);
        header("location: " . $this->config->item('base_url') . "login");
        die;
    }

    public function accessExpired()
    {
        $data_session['user_data_web']    = array('id' => '', 'email'    => '', 'name'    => '');
        $this->session->set_userdata($data_session);
        //$this->session->sess_destroy();
        $this->session->set_flashdata('msgalert', '<div id="msgalert" style="margin-bottom: 10px;
    color: #f6921e;
    font-weight: bold;">Your access expired. Please relogin.</div>');
        header("location: " . $this->config->item('base_url') . "login");
        die;
    }
    // Generate token
    function getToken($length)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet .= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i = 0; $i < $length; $i++) {
            $token .= $codeAlphabet[random_int(0, $max - 1)];
        }

        return $token;
    }
}
