<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

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
        $this->load->model ('history_model');
        $this->load->model ('appusers_model');
        $this->load->model ('appuserstoken_model');
        $this->load->model('member_model');
        $this->load->library('excel');
        $this->load->model('crud_model');


        $this->load->model ('appuserstoken_model');
        $enc = new EncDec();

        $id_user = $enc->stringEncryption("decrypt",$_GET['access'])->username;
        $user_token = $this->appuserstoken_model->select_appusers('', $id_user);

        if ($this->session->userdata['user_data_web']['token'] != $user_token[0]['token']) {
        
        	 header("location: ".$this->config->item('base_url')."login/logout");
        	die();
        }

     

        error_reporting(0);
	}
    public function index($offset = false)
	{
        $enc = new EncDec();
        if(!isset($_GET['access']) || !$enc->stringEncryption("decrypt",$_GET['access'])){			
			// $data["heading"] = "404 Page Not Found";
			// $data["message"] = "The page you requested was not found ";
            // $this->load->view('errors/html/error_404',$data);
            header("location: ".$this->config->item('base_url')."login/accessExpired");
		}else{
            if($offset){
                if($offset > 0){
                    $offset = $offset . '0';
                }else{
                    $offset = 0;
                }

            }else{
                $offset = 0;
            }
	    
	   if(isset($_GET['offset'])){
		$_GET['offset'] = $_GET['offset'];
	    }else{
		$_GET['offset'] = 0 ;
	    }
 	    $data['offset'] = $_GET['offset'];
	    $data['limit'] = 10;

//	    print_r($enc->getUserIpAddr());
//die();
            $data['data']       = $this->appusers_model->get_game_limit_offset($data['limit'],$_GET['offset']);

            $data['berikutnya']       = $this->appusers_model->get_game_limit_offset($data['limit'],$_GET['offset']+10);
        
            // $parseData['header']                = $this->load->view('header', '', true);
            // $parseData['left_coloumn']          = $this->load->view('left_coloumn', '', true);
            $parseData['content']               = $this->load->view('content/game', $data, true);
            // $parseData['footer']                = $this->load->view('footer', '', true);
            // $parseData['control_sidebar']       = $this->load->view('control_sidebar', '', true);
            $this->load->view('vside', $parseData);
        }
    }
    public function detail_game_play($id)
	{
        // echo "detail game Play".$id;
        $enc = new EncDec();
        if(!isset($_GET['access']) || !$enc->stringEncryption("decrypt",$_GET['access'])){			
			// $data["heading"] = "404 Page Not Found";
			// $data["message"] = "The page you requested was not found ";
            // $this->load->view('errors/html/error_404',$data);
            header("location: ".$this->config->item('base_url')."login/accessExpired");
		}else{
        $konfigpoin = $this->appusers_model->get_konfig('main');

        $get_aktifitas = $this->appusers_model->get_aktifitas('main', date("Y-m-d"), $_SESSION["user_data_web"]["id"]);

        $user_apps       = $this->appusers_model->select_appusers($_SESSION["user_data_web"]["id"], '');


        if (count($get_aktifitas) > 0) {

            $poin_user = $user_apps[0]['poin'];
        } else {


            $poin_user = $user_apps[0]['poin'] + $konfigpoin[0]['poin'];
            $field         = array(
                "type"         => $konfigpoin[0]['code_conf'],
                "poin_didapat" => $konfigpoin[0]['poin'],
                "date"         => date("Y-m-d"),
                "date_time"    => date("Y-m-d H:i:s"),
                "id_appusers"  => $_SESSION["user_data_web"]["id"],
                "id_game"      => $id,
                // "role_id"         => $data['role_id']
            );
            $this->crud_model->create("g_aktifitas_userapps", $field);
        }

        $data_user         = array(
            "last_login"  => date("Y-m-d H:i:s"),
            "poin"        => $poin_user

        );
        $this->session->userdata['user_data_web']['poin'] = $poin_user;
        $this->crud_model->update("g_appusers", $data_user, $_SESSION["user_data_web"]["id"]);

        
       $detail_game = $this->appusers_model->get_game_detail($id);
        // echo $poin_user."poin user";
        // print_r($detail_game);
      //  echo "<script type='text/javascript' language='Javascript'>window.open('".$detail_game[0]['video']."');</script>";
//print_r($detail_game);
         header("location: " .$detail_game[0]['video']."?access=".$_GET['access']."");
        die;
    }
    }

    public function detail_game($id)
    {
        // echo "detail game".$id;

        // $konfigpoin = $this->appusers_model->get_konfig('main');

        // $get_aktifitas = $this->appusers_model->get_aktifitas('main', date("Y-m-d"), $_SESSION["user_data_web"]["id"]);

        // $user_apps       = $this->appusers_model->select_appusers($_SESSION["user_data_web"]["id"], '');

        $enc = new EncDec();
        if(!isset($_GET['access']) || !$enc->stringEncryption("decrypt",$_GET['access'])){			
			// $data["heading"] = "404 Page Not Found";
			// $data["message"] = "The page you requested was not found ";
            // $this->load->view('errors/html/error_404',$data);
            header("location: ".$this->config->item('base_url')."login/accessExpired");
		}else{
     


        $data['data'] = $this->appusers_model->get_game_detail($id)[0];
      //print_r($data);
//die();

      //  $data['data']       = $this->appusers_model->get_game();

        // $parseData['header']                = $this->load->view('header', '', true);
        $parseData['content']               = $this->load->view('content/game_detail', $data, true);
        // $parseData['footer']                = $this->load->view('footer', '', true);
        // $parseData['control_sidebar']       = $this->load->view('control_sidebar', '', true);
        $this->load->view('vside', $parseData);
        }
      
    }
    
    
   
}
