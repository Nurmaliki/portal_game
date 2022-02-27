<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_content extends MY_Controller {

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
        $this->load->model ('news_content_model');
        $this->load->model ('news_model');
        $this->load->model ('crud_model');
        error_reporting(E_ALL);
	}
	public function index()
	{
		$parseData ['header']			= $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
        if ($_SESSION['user_data']['role'] == 4){
		    $parseData ['content']			= $this->load->view ( 'content/forbiden-access', '', true);
        }else{
		    $parseData ['content']			= $this->load->view ( 'content/news_content', '', true);
        }
        
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
        // print_r($_SESSION['user_data']);

	    $this->load->view ( 'vside', $parseData);
    }

    public function detail($id)
	{
		$field = $this->session->flashdata('field');
		$data['field']=$field;
		$data['id']						= ($id != '' && is_numeric($id))? $id:0;
        $data['content']				= $this->news_content_model->select_category($data['id'], '');
        $data['category']				= $this->news_model->select_category();
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/news_content_detail', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
    }
    
	public function datatables()
	{

      




		$category				= $this->news_content_model->get_category();
        $get_Totalrequest		= $this->news_content_model->get_Totalrequest();
        
        $category_content		= $this->news_model->get_category();


        // if(count($category_content) > 0){
        //     for($i=0; $i<count($category_content); $i++){
        //         if($category_content[$i]['id'] == $category[0]['category_id']){
    
        //        $categorycontent     = $category_content[$i]['id']; 
        //        $categorycontentname = $category_content[$i]['name']; 
                       
        //             }
              
        //         }
        //     }


		$data 		= array();
		if(count($category) > 0){
			for($i=0; $i<count($category); $i++){
			$nestedData		= array();
            $nestedData[] 	= $category[$i]["title"];
            

            if(count($category_content) > 0){
                for($x=0; $x < count($category_content); $x++){
                    if($category_content[$x]['id'] == $category[$i]['category_id']){
        
                //    $categorycontent     = $category_content[$i]['id']; 
                //    $categorycontentname = 
                     $nestedData[] 	    = $category_content[$x]['name']; 
                        }
                  
                    }
            }

           
            $nestedData[] 	= $category[$i]["status"];
            $nestedData[] 	= $category[$i]["publish_by"];
            $nestedData[] 	= $category[$i]["date_created"];
				if($this->session->userdata['user_data']['role'] == 1 or $this->session->userdata['user_data']['id'] == 2){
					$nestedData[] 	= '<a href="'.$this->config->item('base_url').'news_content/update/'.$category[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'news_content/delete/'.$category[$i]["id"].'" class="fa fa-fw fa-trash " id="delete" data-confirm="Are you sure you want to Delete this data?">&nbsp;</a><a href="'.$this->config->item('base_url').'news_content/detail/'.$category[$i]["id"].'" class="fa fa-fw fa-user">&nbsp;</a>';
					$data[] = $nestedData;
				}else if($this->session->userdata['user_data']['role'] == 3){
					$nestedData[] 	= '<a href="'.$this->config->item('base_url').'news_content/update/'.$category[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;<a href="'.$this->config->item('base_url').'news_content/delete/'.$category[$i]["id"].'" class="fa fa-fw fa-trash" id="delete" >&nbsp;</a><a href="'.$this->config->item('base_url').'news_content/detail/'.$category[$i]["id"].'" class="fa fa-fw fa-user" id="view">&nbsp;</a> ';//<a href="'.$this->config->item('base_url').'news_content/update/'.$category[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>'
                    $data[] = $nestedData;
                }else{
					$nestedData[]	= '';	
				} 
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
        $data['category']				= $this->news_model->select_category();
		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/news_content_create', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
	}
    
    public function update($id)
	{
		$field = $this->session->flashdata('field');
		$data['field']=$field;
		$data['id']						= ($id != '' && is_numeric($id))? $id:0;
        $data['content']				= $this->news_content_model->select_category($data['id'], '');
        $data['category']				= $this->news_model->select_category();


		$parseData ['header']			= $this->load->view ( 'header', '', true);
		$parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
		$parseData ['content']			= $this->load->view ( 'content/news_content_update', $data, true);
		$parseData ['footer']			= $this->load->view ( 'footer', '', true);
		$parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
		$this->load->view ( 'vside', $parseData);
    }
    
	public function action_update($id)
	{
		if(!empty($id)){
			$data['id']			= $id;
		}else{
			$data['id']			= ($this->input->get_post('id'))?$this->input->get_post('id'):'';
		}
	
        $data['name']		= ($this->input->get_post('name'))?$this->input->get_post('name'):'';
        $data['sub_title']		= ($this->input->get_post('sub_title'))?$this->input->get_post('sub_title'):'';
		$data['category_id']		= ($this->input->get_post('category_id'))?$this->input->get_post('category_id'):'';
        $data['body']		= ($this->input->get_post('body'))?$this->input->get_post('body'):'';
		// publish_by
		$data['publish_by']		= ($this->input->get_post('publish_by'))?$this->input->get_post('publish_by'):'';
		$data['status']		    = ($this->input->get_post('status'))?$this->input->get_post('status'):'';
		$data['picture']		= ($this->input->get_post('picture'))?$this->input->get_post('picture'):'';
		$data['video']	    	= ($this->input->get_post('video'))?$this->input->get_post('video'):'none';
		
		$field 		= array(
            "title" => $data['name'],
            "sub_title" => $data['sub_title'],
			"category_id" => $data['category_id'],
			"body" => $data['body'],
			"status" => $data['status'],
			"picture" => $data['picture'],
			"video"	=> $data['video'],
			"publish_by"=> $this->session->userdata['user_data']['name'] ,
			

		);
		$update_province	= $this->crud_model->update("M_news", $field, $data['id']);
		$this->session->set_flashdata('msgalert', 'Update success');
		header("location: ".$this->config->item('base_url')."news_content");
		die;
		
	}
	
	public function do_upload_update()
    {

		$data['id']				= ($this->input->get_post('id'))?$this->input->get_post('id'):'';
		$data['upload']			= ($this->input->get_post('upload'))?$this->input->get_post('upload'):'';
		//$data['submit']			= ($this->input->get_post('id'))?$this->input->get_post('submit'):'';
		//echo "upload = ".$data['upload']."</br>"	;
		//echo "id ".$data['id']	;
        //die;

        // print_r($data);
        
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
				$data['name']		= ($this->input->get_post('name'))?$this->input->get_post('name'):'';
				// category_id
				$data['category_id']		= ($this->input->get_post('category_id'))?$this->input->get_post('category_id'):'';
				$data['body']		= ($this->input->get_post('body'))?$this->input->get_post('body'):'';
				// publish_by
				//$data['publish_by']		= ($this->input->get_post('publish_by'))?$this->input->get_post('publish_by'):'';
				$data['status']		= ($this->input->get_post('publish_by'))?$this->input->get_post('status'):'';
				//$data['picture']		= ($this->input->get_post('picture'))?$this->input->get_post('picture'):'';
				$data['video']		= ($this->input->get_post('video'))?$this->input->get_post('video'):'none';
				$field 		= array(
					"title" => $data['name'],
					"category_id" => $data['category_id'],
					"body" => $data['body'],
					"status" => $data['status'],
					"picture" => "",
					"video"	=> $data['video'],
					"publish_by"=> $this->session->userdata['user_data']['name'] ,
					

				);
				$this->session->set_flashdata('path',$path);
				$this->session->set_flashdata('field',$field);
				
                header("location: ".$this->config->item('base_url')."news_content/update/".$data['id']);
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
				$data['name']		= ($this->input->get_post('name'))?$this->input->get_post('name'):'';
				// category_id
				$data['category_id']		= ($this->input->get_post('category_id'))?$this->input->get_post('category_id'):'';
				$data['body']		= ($this->input->get_post('body'))?$this->input->get_post('body'):'';
				// publish_by
				//$data['publish_by']		= ($this->input->get_post('publish_by'))?$this->input->get_post('publish_by'):'';
				$data['status']		= ($this->input->get_post('publish_by'))?$this->input->get_post('status'):'';
				//$data['picture']		= ($this->input->get_post('picture'))?$this->input->get_post('picture'):'';
				$data['video']		= ($this->input->get_post('video'))?$this->input->get_post('video'):'none';
				$field 		= array(
					"title" => $data['name'],
					"category_id" => $data['category_id'],
					"body" => $data['body'],
					"status" => $data['status'],
					"picture" => $path,
					"video"	=> $data['video'],
					"publish_by"=> $this->session->userdata['user_data']['name'] ,
					

				);

				$this->session->set_flashdata('msgalert', 'Upload data success'.$config['upload_path'].$img);
				$this->session->set_flashdata('img',$img);
				$this->session->set_flashdata('path',$path);
				$this->session->set_flashdata('field',$field);
				echo "id ".$data['id']."</br>path = ".$path;
               header("location: ".$this->config->item('base_url')."news_content/update/".$data['id']);
                die;
            }
		}else{
			$this->action_update($data['id']);
		}  
    }
    
	public function action_create()
	{
        $data['name']		    = ($this->input->get_post('name'))?$this->input->get_post('name'):'';
        $data['sub_title']		= ($this->input->get_post('sub_title'))?$this->input->get_post('sub_title'):'';
        // category_id
        $data['category_id']		= ($this->input->get_post('category_id'))?$this->input->get_post('category_id'):'';
        $data['body']		= ($this->input->get_post('body'))?$this->input->get_post('body'):'';
		// publish_by
		$data['publish_by']		= ($this->input->get_post('publish_by'))?$this->input->get_post('publish_by'):'';
		$data['status']		= ($this->input->get_post('publish_by'))?$this->input->get_post('status'):'';
		$data['picture']		= ($this->input->get_post('picture'))?$this->input->get_post('picture'):'';
		$data['video']		= ($this->input->get_post('video'))?$this->input->get_post('video'):'none';
			
		$this->form_validation->set_rules('name', 'name', 'required');
		if ($this->form_validation->run() == TRUE){
			$category	= $this->news_content_model->select_category('', $data['name']);
			if(count($category) > 0){
				$this->session->set_flashdata('msgalert', 'Insert data Failed, Title already exists');
				$field 		= array(
                    "title" => $data['name'],
                    "sub_title" => $data['sub_title'],
                    "category_id" => $data['category_id'],
					"body" => $data['body'],
					"status" => $data['status'],
					"picture" => $data['picture'],
					"video"	=> $data['video'],
					"publish_by"=> $this->session->userdata['user_data']['name'] ,
					

                );
				$this->session->set_flashdata('path',$data['picture']);
				$this->session->set_flashdata('field',$field);
                header("location: ".$this->config->item('base_url')."news_content/create");
                die;
			}else{
                $field 		= array(
                    "title" => $data['name'],
                    "sub_title" => $data['sub_title'],
                    "category_id" => $data['category_id'],
					"body" => $data['body'],
					"status" => $data['status'],
					"picture" => $data['picture'],
					"video"	=> $data['video'],
					"publish_by"=> $this->session->userdata['user_data']['name'] ,
					

                );
				$create_admin	= $this->crud_model->create("M_news", $field);
				if($create_admin){
                    $this->session->set_flashdata('msgalert', 'Insert data Success');
                    header("location: ".$this->config->item('base_url')."news_content");
                    die;
				}else{
                    $this->session->set_flashdata('msgalert', 'Insert data Failed, please try again');
                    header("location: ".$this->config->item('base_url')."news_content/create");
                    die;	
				}
			}
		}else{
            $this->session->set_flashdata('msgalert', 'no data, Insert data Failed, please try again ');
            header("location: ".$this->config->item('base_url')."news_content/create");
            die;
		}
    }
    
    public function do_upload()
    {
            // $config['upload_path']          = 'http://172.15.11.99/com.btn.portal/uploads/';
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
                $data['name']		= ($this->input->get_post('name'))?$this->input->get_post('name'):'';
                // print_r($data['name']);
                //data form isian
                $data['sub_title']		= ($this->input->get_post('sub_title'))?$this->input->get_post('sub_title'):'';
				// category_id
				$data['category_id']		= ($this->input->get_post('category_id'))?$this->input->get_post('category_id'):'';
				$data['body']		= ($this->input->get_post('body'))?$this->input->get_post('body'):'';
				// publish_by
				//$data['publish_by']		= ($this->input->get_post('publish_by'))?$this->input->get_post('publish_by'):'';
				$data['status']		= ($this->input->get_post('publish_by'))?$this->input->get_post('status'):'';
				//$data['picture']		= ($this->input->get_post('picture'))?$this->input->get_post('picture'):'';
				$data['video']		= ($this->input->get_post('video'))?$this->input->get_post('video'):'none';
				$field 		= array(
                    "title" => $data['name'],
                    "sub_title" => $data['sub_title'],
					"category_id" => $data['category_id'],
					"body" => $data['body'],
					"status" => $data['status'],
					"picture" => "",
					"video"	=> $data['video'],
					"publish_by"=> $this->session->userdata['user_data']['name'] ,
				);
				$this->session->set_flashdata('path',$path);
				$this->session->set_flashdata('field',$field);
                header("location: ".$this->config->item('base_url')."news_content/create");
                die;
            }
            else
            {
				$data = array('upload_data' => $this->upload->data());
				$file_info = $this->upload->data();
				$img = $file_info['file_name']; 
				$path =$this->config->item('assets_url')."uploads/".$img;

				//data form isian
                $data['name']		= ($this->input->get_post('name'))?$this->input->get_post('name'):'';
                
                $data['sub_title']	= ($this->input->get_post('sub_title'))?$this->input->get_post('sub_title'):'';
				// category_id
				$data['category_id'] = ($this->input->get_post('category_id'))?$this->input->get_post('category_id'):'';
				$data['body']		= ($this->input->get_post('body'))?$this->input->get_post('body'):'';
				// publish_by
				//$data['publish_by']		= ($this->input->get_post('publish_by'))?$this->input->get_post('publish_by'):'';
				$data['status']		= ($this->input->get_post('publish_by'))?$this->input->get_post('status'):'';
				//$data['picture']		= ($this->input->get_post('picture'))?$this->input->get_post('picture'):'';
				$data['video']		= ($this->input->get_post('video'))?$this->input->get_post('video'):'none';
				$field 		= array(
                    "title" => $data['name'],
                    "sub_title" => $data['sub_title'],
					"category_id" => $data['category_id'],
					"body" => $data['body'],
					"status" => $data['status'],
					"picture" => $path,
					"video"	=> $data['video'],
					"publish_by"=> $this->session->userdata['user_data']['name'] ,
					 

				);

				$this->session->set_flashdata('msgalert', 'Upload data success'.$config['upload_path'].$img);
				$this->session->set_flashdata('img',$img);
				$this->session->set_flashdata('path',$path);
				$this->session->set_flashdata('field',$field);
                header("location: ".$this->config->item('base_url')."news_content/create");
                die;
            } 
    }

	public function delete($id)
	{
		$data['id']	= ($id != '' && is_numeric($id))? $id:0;
		$delete_admin	= $this->crud_model->delete("M_news", array("id" => $id));
		if($delete_admin){
		$this->session->set_flashdata('msgalert', 'Delete data Success');
			header("location: ".$this->config->item('base_url')."news_content");
			die;
		}else{
		$this->session->set_flashdata('msgalert', 'Delete data Failed, please try again');
			header("location: ".$this->config->item('base_url')."news_content");
			die;
		}

	}
}
