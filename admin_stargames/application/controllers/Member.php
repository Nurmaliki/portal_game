<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set("memory_limit","-1");
class Member extends MY_Controller {

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
        $this->load->model ('role_model');
        $this->load->model ('member_model');
        $this->load->model ('program_model');
        $this->load->model ('redeem_model');
        $this->load->model ('crud_model');
        error_reporting(E_ALL);
	}
	public function index()
	{
        $get_Totalrequest		= $this->member_model->get_Totalrequest();
        // print_r($get_Totalrequest);
    //    echo  date('Y-m-d H:i:s');
        $parseData ['header']			= $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
        $parseData ['content']			= $this->load->view ( 'content/member', '', true);
        $parseData ['footer']			= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
        $this->load->view ( 'vside', $parseData);
    }
    
	public function detail($id)
	{
        $data['id']						= ($id != '' && is_numeric($id))? $id:0;
        $data['member']					= $this->member_model->select_member($id);

        $data['point']                  = $this->program_model->select_point($data['member'][0]['cif']);
        $data['redeem_giift']           = $this->member_model->select_history_giift($data['member'][0]['cif']);
        $data['total_poin']             = $this->member_model->get_total_poin($data['member'][0]['cif']);

        $data['history']				= $this->member_model->select_member_point($data['member'][0]['cif']);
        $parseData ['header']			= $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
        $parseData ['content']			= $this->load->view ( 'content/member_detail', $data, true);
        $parseData ['footer']			= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
        $this->load->view ( 'vside', $parseData);
    }

   
    public function datatables()
    {
            $member					= $this->member_model->get_member();
            $get_Totalrequest		= $this->member_model->get_Totalrequest();
            $data 		= array();
            if(count($member) > 0){
                for($i=0; $i<count($member); $i++){
                $nestedData		= array();
                $nestedData[] 	= $member[$i]["first_name"];              
                $nestedData[] 	= $member[$i]["cif"];
                $nestedData[] 	= $member[$i]["phone"];
                // $nestedData[] 	= $member[$i]["rekening"];
                // $nestedData[] 	= $member[$i]["point"]; 
                
                    if($this->session->userdata['user_data']['role'] == 1 ){
                        $nestedData[] 	= '<a href="'.$this->config->item('base_url').'member/update/'.$member[$i]["rekening"].'" class="fa fa-fw fa-pencil">&nbsp;<a href="'.$this->config->item('base_url').'member/detail/'.$member[$i]["rekening"].'" class="fa fa-fw fa-user">&nbsp;</a>';
                    }else if($this->session->userdata['user_data']['id'] == 2){
                        $nestedData[] 	= '<a href="'.$this->config->item('base_url').'member/update/'.$member[$i]["rekening"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'member/detail/'.$member[$i]["rekening"].'" class="fa fa-fw fa-user">&nbsp;</a>';

                    }
                    else if($this->session->userdata['user_data']['role'] == 3){
                        $nestedData[] 	= '<a href="'.$this->config->item('base_url').'member/detail/'.$member[$i]["rekening"].'" class="fa fa-fw fa-user">&nbsp;</a>';//'<a href="'.$this->config->item('base_url').'member/update/'.$member[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'member/detail/'.$member[$i]["id"].'" class="fa fa-fw fa-user">&nbsp;</a>';
                    }else if($this->session->userdata['user_data']['role'] == 4 ){
                        $nestedData[] 	= '</a>&nbsp;<a href="'.$this->config->item('base_url').'member/detail/'.$member[$i]["rekening"].'" class="fa fa-fw fa-user">&nbsp;</a>';
                    }else if($this->session->userdata['user_data']['role'] == 5 ){
                        $nestedData[]   = '<a href="'.$this->config->item('base_url').'member/update/'.$member[$i]["rekening"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'member/detail/'.$member[$i]["rekening"].'" class="fa fa-fw fa-user">&nbsp;</a>';
                    }else {
                        $nestedData[]	= '';
                    }
                $data[] = $nestedData; 
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
        $parseData ['content']			= $this->load->view ( 'content/member_create', '', true);
        $parseData ['footer']			= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
        $this->load->view ( 'vside', $parseData);
    }
    
    public function update_point($id)
	{

        if($this->session->userdata['user_data']['role'] == 1 ){
            // $data['member_id']				= ($_GET['member_id'] != '' && is_numeric($_GET['member_id']))? $_GET['member_id']:0; 
            if(isset($_GET['member_id'])){
                $data['member_id']	= $_GET['member_id'];
            }
            $data['id']						= ($id != '' && is_numeric($id))? $id:0;
            $data['member']					= $this->member_model->select_member($data['id'], '');
            $data['role']					= $this->role_model->select_role($id);
            $role_code= array();
            $role_code                      = $this->role_model->select_role_by_type('event_other');
            if(count($role_code)>0){
                for($i=0; $i<count($role_code); $i++){
                    
                    $data['role_code'][$i]	 	= $role_code[$i];
                }
            }
            $parseData ['header']			= $this->load->view ( 'header', '', true);
            $parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
            $parseData ['content']			= $this->load->view ( 'content/member_update_point', $data, true);
            $parseData ['footer']			= $this->load->view ( 'footer', '', true);
            $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
            $this->load->view ( 'vside', $parseData);
        }else if($this->session->userdata['user_data']['role'] == 4 ){
            //$data['id']			= ($this->input->get_post('id'))?$this->input->get_post('id'):'';
           // echo $data['id']; 
            // $data['id']						= ($id != '' && is_numeric($id))? $id:0;
            $data['member_id']				= $_GET['member_id'];
            // echo $data['id']; 
            $data['member']					= $this->member_model->select_member($data['member_id'], '');
            $data['point_adjust']           = $this->member_model->get_approval_status($data['member_id']);
            // echo "<pre>";
            // print_r($data['point_adjust']);
            // echo "</pre>";
            //die;
            $data['role']					= $this->role_model->select_role($id);
            $role_code= array();
            $role_code                      = $this->role_model->select_role_by_type('event_other');
            if(count($role_code)>0){
                for($i=0; $i<count($role_code); $i++){
                    
                    $data['role_code'][$i]	 	= $role_code[$i];
                }
            }
            $parseData ['header']			= $this->load->view ( 'header', '', true);
            $parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
            $parseData ['content']			= $this->load->view ( 'content/member_update_point', $data, true);
            $parseData ['footer']			= $this->load->view ( 'footer', '', true);
            $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
            $this->load->view ( 'vside', $parseData);
        }else if($this->session->userdata['user_data']['role'] == 5 ){
            //$data['id']           = ($this->input->get_post('id'))?$this->input->get_post('id'):'';
           // echo $data['id']; 
            // $data['id']                      = ($id != '' && is_numeric($id))? $id:0;
            $data['member_id']              = $_GET['member_id'];
            // echo $data['id']; 
            $data['member']                 = $this->member_model->select_member($data['member_id'], '');
            $data['point_adjust']           = $this->member_model->get_approval_status($data['member_id']);
            // echo "<pre>";
            // print_r($data['point_adjust']);
            // echo "</pre>";
            //die;
            $data['role']                   = $this->role_model->select_role($id);
            $role_code= array();
            $role_code                      = $this->role_model->select_role_by_type('event_other');
            if(count($role_code)>0){
                for($i=0; $i<count($role_code); $i++){
                    
                    $data['role_code'][$i]      = $role_code[$i];
                }
            }
            $parseData ['header']           = $this->load->view ( 'header', '', true);
            $parseData ['left_coloumn']     = $this->load->view ( 'left_coloumn', '', true);
            $parseData ['content']          = $this->load->view ( 'content/member_update_point', $data, true);
            $parseData ['footer']           = $this->load->view ( 'footer', '', true);
            $parseData ['control_sidebar']  = $this->load->view ( 'control_sidebar', '', true);
            $this->load->view ( 'vside', $parseData);
        }
        
        //
    }

    public function action_update_point()
	{
        $data['member_id']			= ($this->input->get_post('member_id'))?$this->input->get_post('member_id'):'';
        $data['id']			= ($this->input->get_post('id'))?$this->input->get_post('id'):'';
        $data['fullname']	= ($this->input->get_post('fullname'))?$this->input->get_post('fullname'):'';
        $data['cif']		= ($this->input->get_post('cif'))?$this->input->get_post('cif'):'';
        $data['phone']		= ($this->input->get_post('phone'))?$this->input->get_post('phone'):'';
        $data['rekening']	= ($this->input->get_post('rekening'))?$this->input->get_post('rekening'):'';
        $data['point']	= ($this->input->get_post('point'))?$this->input->get_post('point'):'';
        $data['current_point']	= ($this->input->get_post('current_point'))?$this->input->get_post('current_point'):'';
        $data['expire_date'] =($this->input->get_post('rule_expire'))?$this->input->get_post('rule_expire'):'';
        $data['expire_type'] =($this->input->get_post('rule_expire_type'))?$this->input->get_post('rule_expire_type'):'';
        $data['rule_code'] 	= ($this->input->get_post('rule_code'))?$this->input->get_post('rule_code'):'';
        
        
        $current_point=$this->crud_model->select_rek("M_cif_map_rek",$data['rekening']);
        $point1=intval($data['point']);
        $current_point=intval($current_point);
        $point=$point1+$current_point;

        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        // $addExpire = strtotime($now);
        $addExpire = $now;
        $countDay=$data['expire_date'];
        $datetype=$data['expire_type'];
    
       echo $addExpire = date('Y-m-d',strtotime("+$countDay $datetype")); //$NewDate=Date('y:m:d', strtotime('+'.$data['expire_date'].' days'));
        
        //die;
        //strtotime("+".$data['expire_date']." ". $data['expire_type'],$now);
       // $addExpire = date('Y-m-d H:i:s',$addExpire);
        


        $this->form_validation->set_rules('cif', 'cif', 'required');
        $this->form_validation->set_rules('rekening', 'rekening', 'required');
        $this->form_validation->set_rules('phone', 'phone', 'required');
        $creator_name=$this->session->userdata['user_data']['name'];
        $creator_id=$this->session->userdata['user_data']['id'];


        if ($this->form_validation->run() == TRUE){
        
            $field 		= array(
                        "CIFNO" 		=> $data['cif'],
                        "ACCTNO" 		=> $data['rekening'],
                        "point" 		=> $data['point'],
                        "status"        => 1,
                        "expire_date"   => $addExpire,
                        "date_related"  => $now,
                        "create_by"     =>  $creator_name ,
                        "poin_code"     => $data['rule_code'] 


                        );
            $field_rek 		= array(
                
                "CIFNO" 		=> $data['cif'],
                "ACCTNO" 		=> $data['rekening'],
                "point" 		=> $point
            );
            $field_phone		= array(
                
                "CIFNO" 		=> $data['cif'],
                "PHONE" 		=> $data['phone'],
                "point" 		=> $point
            );
            $field_total		= array(
                
                "CIFNO" 			=> $data['cif'],
                
                "total" 		=> $point
            );

            $field_approval_request =array(
                "member_id" =>$data['id'],
                "requester_id" 	=> $creator_id,
                "requester_name" => $creator_name,
                "status"        => 0,
                "poin_code"     => $data['rule_code'],
                "ACCTNO" 		=> $data['rekening'],
                "point_adjust" 	=> $data['point'],

            );

        

            if($this->session->userdata['user_data']['role'] == 1 ){

                $request_approval	= $this->crud_model->create("M_approval_status", $field_approval_request);
                $this->session->set_flashdata('msgalert', 'addjust point waiting for approval');
                    header("location: ".$this->config->item('base_url')."member");
                    die;
            

            }else if($this->session->userdata['user_data']['role'] == 4 ){

                $field_approval =array(
                    "approver_id" 	=> $creator_id,
                    "approver_name" => $creator_name,
                    "status"        => 1,
                    "date_approved" => date("Y-m-d H:i:s"),
                    "poin_code"     => $data['rule_code'],
                    "ACCTNO" 		=> $data['rekening'],
                    "point_adjust" 	=> $data['point'],
        
                );

                // print_r($field_approval);
                // print_r($data['id']); 
            
                //$create_member	= $this->crud_model->update("M_member", $field, $data['id']);
                // $update_approval=$this->crud_model->update_approval_point("M_approval_status", $field_approval, $data['id']);
                // //die;
                // $update_point=$this->crud_model->update_point("M_cif_map_rek", $field_rek, $data['member_id']);
                // $update_point=$this->crud_model->update_point("M_cif_map_phone", $field_phone, $data['member_id']);
                // $update_total_point=$this->crud_model->update_total_point("M_cif_total_point", $field_total, $data['cif']);
                // $update_point_history=$this->crud_model->create_point_history("M_point_history", $field);


// query update poin nov 8
                $update_approval=$this->crud_model->update_approval_point("M_approval_status", $field_approval, $data['id']);
        
                $update_point=$this->crud_model->update_point_tb_rek("M_cif_map_rek", $field_rek, $data['rekening']);
                $update_point=$this->crud_model->update_point_tb_phone("M_cif_map_phone", $field_phone, $data['phone']);
                $update_total_point=$this->crud_model->update_total_point("M_cif_total_point", $field_total, $data['cif']);
                $update_point_history=$this->crud_model->create_point_history("M_point_history", $field);
                
                $this->session->set_flashdata('msgalert', 'Approval success');
                    header("location: ".$this->config->item('base_url'));
                    die;
                
            }
        } else{
            $this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
            header("location: ".$this->config->item('base_url')."member/update/".$data['id']);
            die;
        }
        
    }

	public function update($id)
	{
        $data['id']						= ($id != '' && is_numeric($id))? $id:0;
        $data['member']					= $this->member_model->select_member($data['id'], '');
        $member					        = $this->member_model->get_member();
        // print_r($member);
        // die();
        if(count($member) > 0){
            for($i=0; $i<count($member); $i++){
            $nestedData		= array();
            $nestedData[] 	= $member[$i]["first_name"];
            //$nestedData[] 	= $member[$i]["last_name"];
            //$nestedData[] 	= $member[$i]["email"];
            $nestedData[] 	= $member[$i]["cif"];
            $nestedData[] 	= $member[$i]["phone"];
            $nestedData[] 	= $member[$i]["rekening"];
            // $nestedData[] 	= $member[$i]["point"];
                if($this->session->userdata['user_data']['role'] == 1 ){
                    $nestedData['action_link'] 	= '<a href="'.$this->config->item('base_url').'member/update_point/'.$data['id'].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp';
                }else if($this->session->userdata['user_data']['id'] == 2){
                    $nestedData['action_link'] 	= '<a href="'.$this->config->item('base_url').'member/update_point/'.$data['id'].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;';

                }
                else if($this->session->userdata['user_data']['role'] == 3){
                    $nestedData['action_link']  	= '';//'<a href="'.$this->config->item('base_url').'member/update/'.$member[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'member/detail/'.$member[$i]["id"].'" class="fa fa-fw fa-user">&nbsp;</a>';
                }else if($this->session->userdata['user_data']['role'] == 4){
                    $nestedData['action_link'] 	= '<a href="'.$this->config->item('base_url').'member/update_point/'.$data['id'].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp';
                }else{
                    $nestedData['action_link'] 	= '';
                }
            $data['action_link'] = $nestedData['action_link'] ; 
            }
        }
        $parseData ['header']			= $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
        $parseData ['content']			= $this->load->view ( 'content/member_update', $data, true);
        $parseData ['footer']			= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
        $this->load->view ( 'vside', $parseData);
    }
    
	public function action_update()
	{
        $data['id']			= ($this->input->get_post('id'))?$this->input->get_post('id'):'';
        $data['fullname']	= ($this->input->get_post('fullname'))?$this->input->get_post('fullname'):'';
        $data['password']	= ($this->input->get_post('password'))?$this->input->get_post('password'):'';
        $data['email']		= ($this->input->get_post('email'))?$this->input->get_post('email'):'';
        $data['cif']		= ($this->input->get_post('cif'))?$this->input->get_post('cif'):'';
        $data['phone']		= ($this->input->get_post('phone'))?$this->input->get_post('phone'):'';
        $data['rekening']	= ($this->input->get_post('rekening'))?$this->input->get_post('rekening'):'';
        $data['point']	    = ($this->input->get_post('rekening'))?$this->input->get_post('point'):'';
       
        // print_r($data);
        // echo $this->form_validation->run();
        $this->form_validation->set_rules('fullname', 'fullname', 'required');
		$this->form_validation->set_rules('id', 'id', 'required');
        

		if ($this->form_validation->run() == TRUE){
		$explode	= explode(" ", $data['fullname']); 
		$field 		= array(
					"first_name"	=> strtoupper(@$explode[0]),
					"last_name"		=> strtoupper(@$explode[1]),
					"password" 		=> $data['password'],
					"password" 		=> $data['password'],
					"email" 		=> $data['email'],
					"cif" 			=> $data['cif'],
					"phone" 		=> $data['phone'],
                    "rekening" 		=> $data['rekening'],
                    //"point" 		=> $data['point']
                    );
        $field_rek 		= array(
            
            // "CIFNO" 		=> $data['cif'],
            // "ACCTNO" 		=> $data['rekening'],
            // "point" 		=> $data['point']
        );
        $field_phone		= array(
            
            // "CIFNO" 			=> $data['cif'],
            // "PHONE" 		=> $data['phone'],
            // "point" 		=> $data['point']
        );
        $field_total		= array(
            
            // "CIFNO" 			=> $data['cif'],
            
            // "total" 		=> $data['point']
        );
        $create_member	= $this->crud_model->update("M_member", $field, $data['id']);
        // $update_point=$this->crud_model->update_point("M_cif_map_rek", $field_rek, $data['id']);
        // $update_point=$this->crud_model->update_point("M_cif_map_phone", $field_phone, $data['id']);
        // $update_total_point=$this->crud_model->update_total_point("M_cif_total_point", $field_total, $data['cif']);
        
		$this->session->set_flashdata('msgalert', 'Update success');
            header("location: ".$this->config->item('base_url')."member");
            die;
		}else{
            $this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
            header("location: ".$this->config->item('base_url')."member/update/".$data['id']);
		die;
		}
    }
    
	public function action_create()
	{
        $data['fullname']	= ($this->input->get_post('fullname'))?$this->input->get_post('fullname'):'';
        // $data['password']	= ($this->input->get_post('password'))?$this->input->get_post('password'):'';
        // $data['email']		= ($this->input->get_post('email'))?$this->input->get_post('email'):'';
        $data['cif']		= ($this->input->get_post('cif'))?$this->input->get_post('cif'):'';
        $data['phone']		= ($this->input->get_post('phone'))?$this->input->get_post('phone'):'';
        $data['rekening']	= ($this->input->get_post('rekening'))?$this->input->get_post('rekening'):'';
       
        
        
        $this->form_validation->set_rules('cif', 'cif', 'required');
        $this->form_validation->set_rules('rekening', 'rekening', 'required');
        $this->form_validation->set_rules('fullname', 'fullname', 'required');
        $this->form_validation->set_rules('phone', 'phone', 'required');
       


        // echo strlen($data['password']);
            if ($this->form_validation->run() == TRUE){
                $member	= $this->member_model->select_member('', '',$data['phone']);
                if(count($member) > 0){
                    $this->session->set_flashdata('msgalert', 'Insert data Failed, Member already exists');
                    header("location: ".$this->config->item('base_url')."member/create");
                    die;
                }else{
                    $explode	= explode(" ", $data['fullname']); 
                    $field 		= array(
                    "first_name"	=> strtoupper(@$explode[0]),
                    "last_name"		=> strtoupper(@$explode[1]),
                    "cif" 			=> $data['cif'],
                    "phone" 		=> $data['phone'],
                    "rekening" 		=> $data['rekening']
                    );
                    $create_member	= $this->crud_model->create("M_member", $field);
                     // print_r($create_member);
                     // die();
                    if($create_member){
                        $this->session->set_flashdata('msgalert', 'Insert data Success');
                        header("location: ".$this->config->item('base_url')."member");
                        die;
                    }else{
                    $this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
                    header("location: ".$this->config->item('base_url')."member/create");
                    die;	
                    }
                }
            }else{
            $this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
            header("location: ".$this->config->item('base_url')."member/create");
            die;
            }
    }
    
	public function delete($id)
	{
        $data['id']	= ($id != '' && is_numeric($id))? $id:0;
        $delete_member	= $this->crud_model->delete("M_member", array("id" => $id));
        if($delete_member){
            $this->session->set_flashdata('msgalert', 'Delete data Success');
            header("location: ".$this->config->item('base_url')."member");
            die;
        }else{
            $this->session->set_flashdata('msgalert', 'Delete data Failed, please try again');
            header("location: ".$this->config->item('base_url')."member");
            die;
        }

    }

    public function download()
    {
    	
        $this->member_model->get_reportMemberCSV();

        die();
    }
    
}
