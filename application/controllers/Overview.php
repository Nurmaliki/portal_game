<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Overview extends MY_Controller
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
        $this->load->model('history_model');
        $this->load->model('appusers_model');
        $this->load->model('member_model');
        $this->load->library('excel');
        $this->load->model('crud_model');

        $this->load->model('appuserstoken_model');
        $enc = new EncDec();

        $id_user = $enc->stringEncryption("decrypt", $_GET['access'])->username;
        $user_token = $this->appuserstoken_model->select_appusers('', $id_user);

        if ($this->session->userdata['user_data_web']['token'] != $user_token[0]['token']) {

            header("location: " . $this->config->item('base_url') . "login/logout");
            die();
        }

        error_reporting(0);
    }
    public function index()
    {
        $enc = new EncDec();
        if (!isset($_GET['access']) || !$enc->stringEncryption("decrypt", $_GET['access'])) {
            header("location: " . $this->config->item('base_url') . "login/accessExpired");
        } else {
            $data['data']           = '';
            $parseData['content']   = $this->load->view('new_game/content/overview', $data, true);
            $this->load->view('new_game/vside', $parseData);
        }
    }

    public function detail_game($id)
    {
        $enc = new EncDec();
        if (!isset($_GET['access']) || !$enc->stringEncryption("decrypt", $_GET['access'])) {
            // $data["heading"] = "404 Page Not Found";
            // $data["message"] = "The page you requested was not found ";
            // $this->load->view('errors/html/error_404',$data);
            header("location: " . $this->config->item('base_url') . "login/accessExpired");
        } else {
            $data['data'] = $this->appusers_model->get_game_detail($id)[0];


            $data['data']       = $this->appusers_model->get_game();

            // $parseData['header']                = $this->load->view('header', '', true);
            $parseData['content']               = $this->load->view('content/game_detail', $data, true);
            // $parseData['footer']                = $this->load->view('footer', '', true);
            // $parseData['control_sidebar']       = $this->load->view('control_sidebar', '', true);
            $this->load->view('vside', $parseData);
        }
    }
}
