<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merchant extends MY_Controller {

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
	$this->load->model ('merchant_model');
	$this->load->model ('category_model');
	$this->load->model ('crud_model');
	$this->load->model ('province_model');
	}
	public function index()
	{
	$parseData ['header']			= $this->load->view ( 'header', '', true);
	$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
	$parseData ['content']			= $this->load->view ( 'content/merchant', '', true);
	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
	$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	$this->load->view ( 'vside', $parseData);
	}
	public function datatables()
	{
	$merchant				= $this->merchant_model->get_merchant();
	$get_Totalrequest		= $this->merchant_model->get_Totalrequest();
	$data 		= array();
		if(count($merchant) > 0){
			for($i=0; $i<count($merchant); $i++){
			$nestedData		= array();
			$nestedData[] 	= $merchant[$i]["name"];
			$nestedData[] 	= $merchant[$i]["c_name"];
			$nestedData[] 	= $merchant[$i]["phone"];
			$nestedData[] 	= $merchant[$i]["email"];
			$nestedData[] 	= $merchant[$i]["address"].', '.$merchant[$i]["pname"];
				if($this->session->userdata['user_data_web']['role'] == 1 or $this->session->userdata['user_data_web']['id'] == 2){
				$nestedData[] 	= '<a href="'.$this->config->item('base_url').'merchant/update/'.$merchant[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'merchant/delete/'.$merchant[$i]["id"].'" class="fa fa-fw fa-trash" data-confirm="Are you sure you want to Delete this data?">&nbsp;</a>';
				}else if($this->session->userdata['user_data_web']['role'] == 3){
				$nestedData[] 	= '<a href="'.$this->config->item('base_url').'merchant/update/'.$merchant[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>';
				}else{
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


        $img = $this->session->flashdata('img');
		$path = $this->session->flashdata('path');
		$field = $this->session->flashdata('field');
		$data['img']=$img;
		$data['path']=$path;
		$data['field']=$field;

	$data['category']				= $this->category_model->select_category();
	$data['province']				= $this->province_model->select_province();
	$parseData ['header']			= $this->load->view ( 'header', '', true);
	$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
	$parseData ['content']			= $this->load->view ( 'content/merchant_create', $data, true);
	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
	$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	$this->load->view ( 'vside', $parseData);
	}
	public function update($id)
	{
        $field = $this->session->flashdata('field');
		$data['field']=$field;
	$data['id']						= ($id != '' && is_numeric($id))? $id:0;
	$data['category']				= $this->category_model->select_category();
	$data['province']				= $this->province_model->select_province();
    $data['merchant']				= $this->merchant_model->select_merchant($data['id']);
        
    // print_r($data['merchant']);



	$parseData ['header']			= $this->load->view ( 'header', '', true);
	$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
	$parseData ['content']			= $this->load->view ( 'content/merchant_update', $data, true);
	$parseData ['footer']			= $this->load->view ( 'footer', '', true);
	$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
	$this->load->view ( 'vside', $parseData);
	}
	public function action_update()
	{
	$data['id']				= ($this->input->get_post('id'))?$this->input->get_post('id'):'';
	$data['category_id']	= ($this->input->get_post('category_id'))?$this->input->get_post('category_id'):'';
	$data['province_id']	= ($this->input->get_post('province_id'))?$this->input->get_post('province_id'):'';
	$data['name']			= ($this->input->get_post('name'))?$this->input->get_post('name'):'';
	$data['description']	= ($this->input->get_post('description'))?$this->input->get_post('description'):'';
	$data['phone']			= ($this->input->get_post('phone'))?$this->input->get_post('phone'):'';
	$data['email']			= ($this->input->get_post('email'))?$this->input->get_post('email'):'';
    $data['address']		= ($this->input->get_post('address'))?$this->input->get_post('address'):'';    
	$data['picture']		= ($this->input->get_post('picture'))?$this->input->get_post('picture'):'';
				$field 		= array(
				"category_id"	=> $data['category_id'],
				"province_id"	=> $data['province_id'],
				"name" 			=> $data['name'],
				"description" 	=> $data['description'],
				"phone" 		=> $data['phone'],
				"email" 		=> $data['email'],
                "address" 		=> $data['address'],
                "image"       => $data['picture'],
				);
				$create_merchant	= $this->crud_model->update("M_merchant", $field, $data['id']);
				if($create_merchant){
				$this->session->set_flashdata('msgalert', 'Update data Success');
				header("location: ".$this->config->item('base_url')."merchant");
				die;
				}else{
				$this->session->set_flashdata('msgalert', 'Update data Failed, please try again');
				header("location: ".$this->config->item('base_url')."merchant/update/".$data['id']);
				die;	
				}
	}
	public function action_create()
	{
	$data['category_id']	= ($this->input->get_post('category_id'))?$this->input->get_post('category_id'):'';
	$data['province_id']	= ($this->input->get_post('province_id'))?$this->input->get_post('province_id'):'';
	$data['name']			= ($this->input->get_post('name'))?$this->input->get_post('name'):'';
	$data['address']		= ($this->input->get_post('address'))?$this->input->get_post('address'):'';
	$data['phone']			= ($this->input->get_post('phone'))?$this->input->get_post('phone'):'';
	$data['email']			= ($this->input->get_post('email'))?$this->input->get_post('email'):'';
    $data['description']	= ($this->input->get_post('description'))?$this->input->get_post('description'):'';
    $data['picture']		= ($this->input->get_post('picture'))?$this->input->get_post('picture'):'';

    print_r($data);
	$this->form_validation->set_rules('name', 'name', 'required');
		if ($this->form_validation->run() == TRUE){
				$field 		= array(
				"category_id"	=> $data['category_id'],
				"province_id"	=> $data['province_id'],
				"name" 			=> $data['name'],
				"description" 	=> $data['description'],
				"phone" 		=> $data['phone'],
				"email" 		=> $data['email'],
                "address" 		=> $data['address'],
                "image"         => $data['picture'],
				);
				$create_merchant = $this->crud_model->create("M_merchant", $field);
				if($create_merchant){
				$this->session->set_flashdata('msgalert', 'Insert data Success');
				header("location: ".$this->config->item('base_url')."merchant");
				die;
				}else{
				$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
				header("location: ".$this->config->item('base_url')."merchant/create");
				die;	
				}
		}else{
		$this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
		header("location: ".$this->config->item('base_url')."merchant/create");
		die;
		}
	}
	public function delete($id)
	{
	$data['id']	= ($id != '' && is_numeric($id))? $id:0;
	$delete_merchant	= $this->crud_model->delete("M_merchant", array("id" => $id));
		if($delete_merchant){
		$this->session->set_flashdata('msgalert', 'Delete data Success');
		header("location: ".$this->config->item('base_url')."merchant");
		die;
		}else{
		$this->session->set_flashdata('msgalert', 'Delete data Failed, please try again');
		header("location: ".$this->config->item('base_url')."merchant");
		die;
		}

    }
    




    // upload image
    public function do_upload()
    {
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            // $config['max_size']             = 100;
            // $config['max_width']            = 1024;
			// $config['max_height']           = 768;

			$this->load->library('upload', $config);
               
            

            if ( ! $this->upload->do_upload('userfile'))
            {
                $error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('msgalert', 'Upload data Failed sd,'.$this->upload->display_errors().' please try again');
			

                $data['category_id']	= ($this->input->get_post('category_id'))?$this->input->get_post('category_id'):'';
                $data['province_id']	= ($this->input->get_post('province_id'))?$this->input->get_post('province_id'):'';
                $data['name']			= ($this->input->get_post('name'))?$this->input->get_post('name'):'';
                $data['address']		= ($this->input->get_post('address'))?$this->input->get_post('address'):'';
                $data['phone']			= ($this->input->get_post('phone'))?$this->input->get_post('phone'):'';
                $data['email']			= ($this->input->get_post('email'))?$this->input->get_post('email'):'';
                $data['description']	= ($this->input->get_post('description'))?$this->input->get_post('description'):'';
                $data['picture']		= ($this->input->get_post('picture'))?$this->input->get_post('picture'):'';

				$field 		= array(
                    "province_id" => $data['province_id'],
                    "name" => $data['name'],
					"category_id" => $data['category_id'],
					"address" => $data['address'],
					"phone" => $data['phone'],
					"email" => $data['email'],                   
                    "description"	=> $data['description'],                    
                    "picture"	=> $data['picture'],
                    
					// "publish_by"=> $this->session->userdata['user_data_web']['name'] ,
                );
                
                print_r($field);
                echo "!userfile";
				$this->session->set_flashdata('path',$path);
				$this->session->set_flashdata('field',$field);
                header("location: ".$this->config->item('base_url')."merchant/create");
                die;
            }
            else
            {
				$data = array('upload_data' => $this->upload->data());
				$file_info = $this->upload->data();
				$img = $file_info['file_name']; 
				$path =$this->config->item('assets_url')."uploads/".$img;

                $data['category_id']	= ($this->input->get_post('category_id'))?$this->input->get_post('category_id'):'';
                $data['province_id']	= ($this->input->get_post('province_id'))?$this->input->get_post('province_id'):'';
                $data['name']			= ($this->input->get_post('name'))?$this->input->get_post('name'):'';
                $data['address']		= ($this->input->get_post('address'))?$this->input->get_post('address'):'';
                $data['phone']			= ($this->input->get_post('phone'))?$this->input->get_post('phone'):'';
                $data['email']			= ($this->input->get_post('email'))?$this->input->get_post('email'):'';
                $data['description']	= ($this->input->get_post('description'))?$this->input->get_post('description'):'';
                $data['picture']		= ($this->input->get_post('picture'))?$this->input->get_post('picture'):'';

				$field 		= array(
                    "province_id" => $data['province_id'],
                    "name" => $data['name'],
					"category_id" => $data['category_id'],
					"address" => $data['address'],
					"phone" => $data['phone'],
					"email" => $data['email'],                   
                    "description"	=> $data['description'],                    
                    "picture"	=> $data['picture'],
                    
					// "publish_by"=> $this->session->userdata['user_data_web']['name'] ,
                );
                

                print_r($field);

                //Get uploaded file information
                $upload_data = $this->upload->data();
                $fileName = $upload_data['file_name'];
                print_r($fileName);
                echo "<br>path ".$path;
                
                //File path at local server
                $source = $config['upload_path'].$img;//'./uploads/'.$fileName;
                
                //Load codeigniter FTP class
                $this->load->library('ftp');

                $config['hostname'] = '172.15.11.99';
                $config['username'] = 'administrator';
                $config['password'] = 'P@ssw0rd';

                $this->ftp->connect($config);

                $this->ftp->upload($source, '/var/www/html/com.btn.portal/uploads/'.$img, 'ascii', 0777);

                $this->ftp->close();
                //Delete file from local server
                //@unlink($source);
                
				$this->session->set_flashdata('msgalert', 'Upload data success'.$config['upload_path'].$img);
				$this->session->set_flashdata('img',$img);
				$this->session->set_flashdata('path',$path);
				$this->session->set_flashdata('field',$field);
                header("location: ".$this->config->item('base_url')."merchant/create");
                die;
            } 
    }




    public function do_upload_update()
    {

		$data['id']				= ($this->input->get_post('id'))?$this->input->get_post('id'):'';
		$data['upload']			= ($this->input->get_post('upload'))?$this->input->get_post('upload'):'';
		//$data['submit']			= ($this->input->get_post('id'))?$this->input->get_post('submit'):'';
		//echo "upload = ".$data['upload']."</br>"	;
		//echo "id ".$data['id']	;
        //die;
        // print_r($data['id']);
        // print_r($data['upload']);

		if($data['upload']=="upload"){
			$config['upload_path']          = './uploads/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			// $config['max_size']             = 100;
			// $config['max_width']            = 1024;
			// $config['max_height']           = 768;

			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('userfile'))
            {
                $error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('msgalert', 'Upload data Failed,'.$this->upload->display_errors().' please try again');
                //data form isian
                $data['id']				= ($this->input->get_post('id'))?$this->input->get_post('id'):'';
                $data['category_id']	= ($this->input->get_post('category_id'))?$this->input->get_post('category_id'):'';
                $data['province_id']	= ($this->input->get_post('province_id'))?$this->input->get_post('province_id'):'';
                $data['name']			= ($this->input->get_post('name'))?$this->input->get_post('name'):'';
                $data['address']		= ($this->input->get_post('address'))?$this->input->get_post('address'):'';
                $data['phone']			= ($this->input->get_post('phone'))?$this->input->get_post('phone'):'';
                $data['email']			= ($this->input->get_post('email'))?$this->input->get_post('email'):'';
                $data['description']	= ($this->input->get_post('description'))?$this->input->get_post('description'):'';
                $data['picture']		= ($this->input->get_post('picture'))?$this->input->get_post('picture'):'';

				$field 		= array(
                    "province_id" => $data['province_id'],
                    "name" => $data['name'],
					"category_id" => $data['category_id'],
					"address" => $data['address'],
					"phone" => $data['phone'],
					"email" => $data['email'],                   
                    "description"	=> $data['description'],                    
                    "image"	=> $data['picture'],
                    
					// "publish_by"=> $this->session->userdata['user_data_web']['name'] ,
                );

				$this->session->set_flashdata('path',$path);
				$this->session->set_flashdata('field',$field);
				
                header("location: ".$this->config->item('base_url')."merchant/update/".$data['id']);
                die;
            }
            else
            {
				$data = array('upload_data' => $this->upload->data());
				$file_info = $this->upload->data();
				$img = $file_info['file_name']; 
				$path =$this->config->item('assets_url')."uploads/".$img;

                //data form isian
                $data['id']				= ($this->input->get_post('id'))?$this->input->get_post('id'):'';
		        $data['category_id']	= ($this->input->get_post('category_id'))?$this->input->get_post('category_id'):'';
                $data['province_id']	= ($this->input->get_post('province_id'))?$this->input->get_post('province_id'):'';
                $data['name']			= ($this->input->get_post('name'))?$this->input->get_post('name'):'';
                $data['address']		= ($this->input->get_post('address'))?$this->input->get_post('address'):'';
                $data['phone']			= ($this->input->get_post('phone'))?$this->input->get_post('phone'):'';
                $data['email']			= ($this->input->get_post('email'))?$this->input->get_post('email'):'';
                $data['description']	= ($this->input->get_post('description'))?$this->input->get_post('description'):'';
                $data['picture']		= ($this->input->get_post('picture'))?$this->input->get_post('picture'):'';

				$field 		= array(
                    "province_id" => $data['province_id'],
                    "name" => $data['name'],
					"category_id" => $data['category_id'],
					"address" => $data['address'],
					"phone" => $data['phone'],
					"email" => $data['email'],                   
                    "description"	=> $data['description'],                    
                    "image"	=> $data['picture'],
                    
					// "publish_by"=> $this->session->userdata['user_data_web']['name'] ,
                );
				$this->session->set_flashdata('msgalert', 'Upload data success'.$config['upload_path'].$img);
				$this->session->set_flashdata('img',$img);
				$this->session->set_flashdata('path',$path);
				$this->session->set_flashdata('field',$field);
				echo "id ".$data['id']."</br>path = ".$path;
               header("location: ".$this->config->item('base_url')."merchant/update/".$data['id']);
                die;
            }
		}else{
            $this->action_update($data['id']);
            // echo "sucses";
		}  
    }



}
