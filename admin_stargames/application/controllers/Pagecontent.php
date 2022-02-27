<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagecontent extends MY_Controller {

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
	$this->load->model ('PageContent_model');
    $this->load->model ('crud_model');
    $this->db = $this->load->database('default',TRUE);
    $this->load->model('datatables_model','DT');

	error_reporting(E_ALL);
	}
	public function index()
	{

        $parseData ['header']			= $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
        $parseData ['content']			= $this->load->view ( 'content/pagecontent', '', true);
        $parseData ['footer']			= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
        $this->load->view ( 'vside', $parseData);
    }


    public function tentang()
	{

        $data['get_tentang_poin_serbu_title'] 						= $this->PageContent_model->get_tentang_poin_serbu_title();
        $data['get_tentang_poin_serbu_link'] 							= $this->PageContent_model->get_tentang_poin_serbu_link();
        $data['tentang_mekanisme'] 												= $this->PageContent_model->tentang_mekanisme();
        $data['tentang_perhitungan_poin_akuisisi'] 				= $this->PageContent_model->tentang_perhitungan_poin_akuisisi();
        $data['tentang_perhitungan_poin_transaksional'] 	= $this->PageContent_model->tentang_perhitungan_poin_transaksional();
      	$data['tentang_cek_jumlah_poin']									= $this->PageContent_model->tentang_cek_jumlah_poin();
      	$data['get_description_transaksional']						= $this->PageContent_model->get_description_transaksional();
      	$data['get_description_akuisisi']									= $this->PageContent_model->get_description_akuisisi();
        $data['get_des_cek_jumlah_poin']									= $this->PageContent_model->get_des_cek_jumlah_poin();

        $parseData ['header']								= $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']					= $this->load->view ( 'left_coloumn', '', true);
        $parseData ['content']							= $this->load->view ( 'content/pagecontent/tentang', $data, true);
        $parseData ['footer']								= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']			= $this->load->view ( 'control_sidebar', '', true);
        $this->load->view ( 'vside', $parseData);
    }

////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////I Love You/////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////sYarat ketentuan/////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////

    public function syaratketentuan()
	{

        $data["data"]     							= $this->PageContent_model->get_SyaratKetentuan();
        $data["desc"]  									= $this->PageContent_model->get_SyaratKetentuanDes();
        $parseData ['header']						= $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']			= $this->load->view ( 'left_coloumn', '', true);
        $parseData ['content']					= $this->load->view ( 'content/pagecontent/syaratketentuan', $data, true);
        $parseData ['footer']						= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
        $this->load->view ( 'vside', $parseData);
    }
    public function updateDescriptionSyarat($id)
    {
        $description = $this->input->get_post('description');

        $faild = array(
            'description'  => $description,
            'updated_at'=>date("Y-m-d H:i:s")
        );

        $update = $this->crud_model->update("SyaratKetentuanDes", $faild,$id);
        if ($update){
              $this->session->set_flashdata('msgalert', 'Update syarat ketentuan description');
            header("location: ".$this->config->item('base_url')."pagecontent/syaratketentuan");
            die;
        }else{
              $this->session->set_flashdata('msgalert', 'gagal update syarat ketentuan');
            header("location: ".$this->config->item('base_url')."pagecontent/syaratketentuan?failed");
            die;
        }
    }
     public function actionCreateSyaratKetentuan()
    {
        $syarat = $this->input->get_post('syarat');
        $ketentuan = $this->input->get_post('ketentuan');

        $faild = array(
            'syarat'  => $syarat,
            'ketentuan'    => $ketentuan,
            'created_at'=>date("Y-m-d H:i:s")
        );

        $action_insert = $this->crud_model->create("SyaratKetentuan", $faild);
        if ($action_insert){
              $this->session->set_flashdata('msgalert', 'Sukses insert syarat ketentuan');
            header("location: ".$this->config->item('base_url')."pagecontent/syaratketentuan");
            die;
        }else{
              $this->session->set_flashdata('msgalert', 'gagal Update Syarat ketentuan');
            header("location: ".$this->config->item('base_url')."pagecontent/syaratketentuan?failed");
            die;
        }
    }

    public function deleteSyaratKetentuan($id)
    {
        $data['id']	= ($id != '' && is_numeric($id))? $id:0;
		$delete_admin	= $this->crud_model->delete("SyaratKetentuan", array("id" => $id));
		if($delete_admin){
              $this->session->set_flashdata('msgalert', 'Sukses update Syarat ketentuan');
			header("location: ".$this->config->item('base_url')."pagecontent/syaratketentuan");
			die;
		}else{
              $this->session->set_flashdata('msgalert', 'Gagal Updatge syarat ketentuan ');
			header("location: ".$this->config->item('base_url')."pagecontent/syaratketentuan?failed");
			die;
		}
    }
		public function actionUpdateSyaratKetentuan($id)
	 {
			$syarat = $this->input->get_post('syarat');
			$ketentuan = $this->input->get_post('ketentuan');
			 $faild = array(
					 'syarat'  => $syarat,
					 'ketentuan'    => $ketentuan,
					 'created_at'=>date("Y-m-d H:i:s")
			 );
			 $update	= $this->crud_model->update("SyaratKetentuan", $faild, $id);

			 // print_r($update);
			 if($update){
						 $this->session->set_flashdata('msgalert'.$id, 'sukses update Syarat ketentuan');
				 header("location: ".$this->config->item('base_url')."pagecontent/syaratketentuan#".$id);
				 die;
			 }else{
								 $this->session->set_flashdata('alertwarning'.$id, 'Gagal Update syarat ketentuan ');
				 header("location: ".$this->config->item('base_url')."pagecontent/syaratketentuan#".$id);
				 die;
			 }
	 }


/////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////Syaratdan Ketentuand End//////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////





////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////FAQ Start////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////

    public function faq()
	{
        $data["data"]  =$this->PageContent_model->get_Faq();
        // print_r($data);
        $parseData ['header']			= $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
        $parseData ['content']			= $this->load->view ( 'content/pagecontent/faq', $data , true);
        $parseData ['footer']			= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
        $this->load->view ( 'vside', $parseData);
    }
    public function action_create()
    {
        $question = $this->input->get_post('question');
        $parent_id_kedua = !empty($this->input->get_post('parent_id_kedua'))?$this->input->get_post('parent_id_kedua'):"";
        $parent_id_pertama = !empty($this->input->get_post('parent_id_pertama'))?$this->input->get_post('parent_id_pertama'):"";

        // print_r($question);

        $faild = array(
            'description'  => $question,
            'parent_id_kedua'    =>  $parent_id_kedua ,
            'parent_id_pertama'    => $parent_id_pertama ,
            'date'=>date("Y-m-d H:i:s")
        );

        $action_insert = $this->crud_model->create("M_faq", $faild);
        if ($action_insert){
            //   $this->session->set_flashdata('msgalert', 'Sukses Update Faq');
            // header("location: ".$this->config->item('base_url')."pagecontent/faq#input");
            // die;
						echo "true";

        }else{
            //   $this->session->set_flashdata('msgalert', 'Gagal updtae Faq');
            // header("location: ".$this->config->item('base_url')."pagecontent/faq#input");
            // die;
						echo "true";

        }
    }
    public function delete($id)
    {
        // print_r($id);
        $data['id']	= ($id != '' && is_numeric($id))? $id:0;
		$delete_admin	= $this->crud_model->delete("M_faq", array("id" => $id));
		if($delete_admin){
			header("location: ".$this->config->item('base_url')."pagecontent/faq#input");
			die;
		}else{
            $this->session->set_flashdata('msgalert', 'Gagal delete faq');
			header("location: ".$this->config->item('base_url')."pagecontent/faq#input");
			die;
		}
    }

    public function action_update($id)
    {
			// print_r($id);
			// die();
       $question = $this->input->get_post('question');
       // $answer = $this->input->get_post('answer');
       $field = array(
            'description'           =>  $question,
						'date'                  =>  date("Y-m-d H:i:s"),
            'create_by'             =>  $this->session->userdata['user_data']['name']
        );
        $update	= $this->crud_model->update("M_faq", $field, $id);

        // print_r($update);
        if($update){
      //         $this->session->set_flashdata('msgalert', 'Sukses update Faq');
			// header("location: ".$this->config->item('base_url')."pagecontent/faq#".$id);
			// die;
			echo $id;
		}else{
      //         $this->session->set_flashdata('msgalert', 'Gagal Update Faq');
			// header("location: ".$this->config->item('base_url')."pagecontent/faq#".$id);
			// die;
			echo $id;
		}
    }


////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////FAQ END////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////
////////////////////////////////beranda start/////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////



    public function beranda()
	{
        $this->load->helper("url");
        $data = array();

        $offset = $this->DT->get_start();
        $rows   = $this->DT->get_rows();
        $sql	= "	SELECT * FROM PageBeranda where param = 'linkyoutube'" ;
        $query		= $this->db->query($sql);
        $data['linkyoutube']	= $query->result_array();

        $sql	= "	SELECT * FROM PageBeranda where param = 'tentang'" ;
        $query		= $this->db->query($sql);
        $data['tentang']	= $query->result_array();


        $sql	= "	SELECT * FROM PageBeranda where param = 'mekanismetitle1'" ;
        $query		= $this->db->query($sql);
        $data['mekanismetitle1']	= $query->result_array();

        $sql	= "	SELECT * FROM PageBeranda where param = 'mekanismetitle2'" ;
        $query		= $this->db->query($sql);
        $data['mekanismetitle2']	= $query->result_array();

        $sql	= "	SELECT * FROM PageBeranda where param = 'mekanismetitle3'" ;
        $query		= $this->db->query($sql);
        $data['mekanismetitle3']	= $query->result_array();

        $sql	= "	SELECT * FROM PageBeranda where param = 'mekanismetitle4'" ;
        $query		= $this->db->query($sql);
        $data['mekanismetitle4']	= $query->result_array();

        $sql	= "	SELECT * FROM PageBeranda where param = 'mekanisme1'" ;
        $query		= $this->db->query($sql);
        $data['mekanisme1']	= $query->result_array();

        $sql	= "	SELECT * FROM PageBeranda where param = 'mekanisme2'" ;
        $query		= $this->db->query($sql);
        $data['mekanisme2']	= $query->result_array();

          $sql	= "	SELECT * FROM PageBeranda where param = 'mekanisme3'" ;
        $query		= $this->db->query($sql);
        $data['mekanisme3']	= $query->result_array();

        $sql	= "	SELECT * FROM PageBeranda where param = 'mekanisme4'" ;
        $query		= $this->db->query($sql);
        $data['mekanisme4']	= $query->result_array();


        // print_r($data);
        // die;

        $banner = scandir("./uploads/home-banner/");
        foreach ($banner as $key => $value) {
            if ($value != ".." && $value != ".") {
                $data["banner"][] = $value;
            }
        }

        $parseData ['header']			= $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']		= $this->load->view ( 'left_coloumn', '', true);
            $parseData ['content']			= $this->load->view ( 'content/pagecontent/beranda', $data, true);
        $parseData ['footer']			= $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']	= $this->load->view ( 'control_sidebar', '', true);
        $this->load->view ( 'vside', $parseData);
    }
    public function banner_delete()
    {

        $this->load->helper("url");
        $delete = unlink("./uploads/home-banner/". $this->uri->segment(3));
        if ($delete) {
            $uploadRequest = array(
                'fileName' => basename($this->uri->segment(3)),
            );
            $resp1 = shell_exec('curl -k -X POST -F  "fileName='.$uploadRequest["fileName"].'"  '.$this->config->item("assets_url_portal").'/index.php/banner-delete/');

            $resp = json_decode($resp1);


               if ($resp->status == 1) {
                // Upload Success
                $this->session->set_flashdata('msgalert', 'Delete from microsite successfull');
               }else{
                // Upload Failed
                $this->session->set_flashdata('msgalert', 'Failed deleted from portal');
               }
        }else{
            $this->session->set_flashdata('msgalert', 'Failed deleted image');
        }
       header("location: ".$this->config->item('base_url')."pagecontent/beranda");
    }
    public function updateBerandaCaption()
    {
        $linkyoutube = $this->input->get_post('linkyoutube');
        $tentang = $this->input->get_post('tentang');

         $mekanismetitle1 = $this->input->get_post('mekanismeTitle1');
         $mekanismetitle2 = $this->input->get_post('mekanismeTitle2');
         $mekanismetitle3 = $this->input->get_post('mekanismeTitle3');
         $mekanismetitle4 = $this->input->get_post('mekanismeTitle4');

         $mekanisme1 = $this->input->get_post('mekanisme1');
         $mekanisme2 = $this->input->get_post('mekanisme2');
         $mekanisme3 = $this->input->get_post('mekanisme3');
         $mekanisme4 = $this->input->get_post('mekanisme4');


        $datalinkyoutube = array(
            'text'=> $linkyoutube
        );
        // $update["linkyoutube"]	= $this->crud_model->update("PageBeranda", $datalinkyoutube, array('param'=>'linkyoutube'));

        $this->db->where('param','linkyoutube');
        if ($this->db->update('PageBeranda',$datalinkyoutube)){

            echo "sukses";
        }else{
            echo "gagal";
        }
        $datatentang = array(
            'text'=> $tentang
        );
        // $update["tentang"]	= $this->crud_model->update("Faq", $datatentang, 'tentang', array('param'=>'tentang'));

         $this->db->where('param','tentang');
        if ($this->db->update('PageBeranda',$datatentang)){

            echo "sukses";
        }else{
            echo "gagal";
        }



        $datamekanismetitle1 = array(
            'text'=> $mekanismetitle1
        );
          $this->db->where('param','mekanismetitle1');
        if ($this->db->update('PageBeranda',$datamekanismetitle1)){

            echo "sukses";
        }else{
            echo "gagal";
        }

        $datamekanismetitle2 = array(
            'text'=> $mekanismetitle2
        );
           $this->db->where('param','mekanismetitle2');
        if ($this->db->update('PageBeranda',$datamekanismetitle2)){

            echo "sukses";
        }else{
            echo "gagal";
        }
        $datamekanismetitle3 = array(
            'text'=> $mekanismetitle3
        );
           $this->db->where('param','mekanismetitle3');
        if ($this->db->update('PageBeranda',$datamekanismetitle3)){

            echo "sukses";
        }else{
            echo "gagal";
        }


        $datamekanismetitle4 = array(
            'text'=> $mekanismetitle4
        );
        $this->db->where('param','mekanismetitle4');
        if ($this->db->update('PageBeranda',$datamekanismetitle4)){

            echo "sukses";
        }else{
            echo "gagal";
        }


        $datamekanisme1= array(
            'text'=> $mekanisme1
        );
        $this->db->where('param','mekanisme1');
        if ($this->db->update('PageBeranda',$datamekanisme1)){

            echo "sukses";
        }else{
            echo "gagal";
        }


        $datamekanisme2= array(
            'text'=> $mekanisme2
        );
        $this->db->where('param','mekanisme2');
        if ($this->db->update('PageBeranda',$datamekanisme2)){

            echo "sukses";
        }else{
            echo "gagal";
        }
        $datamekanisme3= array(
            'text'=> $mekanisme3
        );
        $this->db->where('param','mekanisme3');
        if ($this->db->update('PageBeranda',$datamekanisme3)){

            echo "sukses";
        }else{
            echo "gagal";
        }


        $datamekanisme4= array(
            'text'=> $mekanisme4
        );
        $this->db->where('param','mekanisme4');
        if ($this->db->update('PageBeranda',$datamekanisme4)){

            echo "sukses";
        }else{
            echo "gagal";
        }
        header("location: ".$this->config->item('base_url')."pagecontent/beranda");
			die;

    }


////////////////////////////////////////////////////////////////////////////////
///////////////////////////////beranda end///////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////




    ////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////

    public function sponsor()
    {
        $data["data"]  =$this->PageContent_model->get_sponsor();
        // print_r($data);
        $parseData ['header']           = $this->load->view ( 'header', '', true);
        $parseData ['left_coloumn']     = $this->load->view ( 'left_coloumn', '', true);
        $parseData ['content']          = $this->load->view ( 'content/pagecontent/sponsor', $data , true);
        $parseData ['footer']           = $this->load->view ( 'footer', '', true);
        $parseData ['control_sidebar']  = $this->load->view ( 'control_sidebar', '', true);
        $this->load->view ( 'vside', $parseData);
    }

    public function actionLogoDelete()
    {

    	$this->load->helper("url");
		$delete = unlink("./uploads/logo/". $this->uri->segment(3));

		if ($delete) {
			$uploadRequest = array(
		        'fileName' => basename($this->uri->segment(3)),
		    );
			$resp1 = shell_exec('curl -k -X POST -F  "fileName='.$uploadRequest["fileName"].'"  '.$this->config->item("assets_url_portal").'/index.php/logo-delete/');

			$resp = json_decode($resp1);

		       if ($resp->status == 1) {
		       	$delete_admin	= $this->crud_model->delete("M_logo_sponsor", array("img" => $this->uri->segment(3)));
		       	// Upload Success
				$this->session->set_flashdata('msgalert', 'Delete from microsite successfull');
		       }else{
		       	// Upload Failed
				$this->session->set_flashdata('msgalert', 'Failed deleted from portal');
		       }
		}else{
			$this->session->set_flashdata('msgalert', 'Failed deleted image');
		}
       header("location: ".$this->config->item('base_url')."pagecontent/sponsor");
    }

	public function actionlogo()
    {

        $name   = $this->input->get_post('name');
        $url    = !empty($this->input->get_post('url'))?$this->input->get_post('url'):"";

            $this->load->library("Rapid/RapidDataModel");
            $config['upload_path']     = './uploads/logo/';
            $config['allowed_types']   = 'gif|jpg|png|jpeg';
            $new_name                  = sha1(time()).".".basename($_FILES["userfile"]['name']);
            $config['encrypt_name']    = TRUE;
            $config['file_name']       = $new_name;
            $config['overwrite']       = TRUE;
            $config['remove_spaces']   = TRUE;
						$config['max_size']             = 100;
						$config['max_width']            = 160;
						$config['max_height']           = 45;
						$config['min_width']            = 10;
						$config['min_height']           = 10;


            $this->load->library('upload', $config);



         if ($this->upload->do_upload('userfile'))
            {
                $data = array('upload_data' => $this->upload->data());
                $file_info = $this->upload->data();
                $img = $file_info['file_name'];
                $path =$img;
                $error = array('error' => $this->upload->display_errors());

                $this->session->set_flashdata('path',$path);
                $uploadRequest = array(
                    'fileName' => basename($this->upload->data()["full_path"]),
                    'fileData' => base64_encode(file_get_contents($this->upload->data()["full_path"]))
                );
                $uploader_id = sha1(uniqid());
                RapidDataModel::use('default');
                $create = RapidDataModel::create('F_uploader', array(
                    array(
                        "id" => $uploader_id,
                        "filename" => $uploadRequest["fileName"],
                        "file_encoded" => $uploadRequest["fileData"],
                        "date_created" => date("Y-m-d H:i:s")
                    )
                ));

                if ($create) {
                    $resp2 = shell_exec('curl -k -X POST -F "uploader_id='.$uploader_id.'" '.$this->config->item("assets_url_portal").'/index.php/logo-receiver/');
                    $resp = json_decode($resp2);

                    if ($resp->status == 1) {

                        $faild = array(
                            'name'   => $name,
                            'url'    => $url ,
                            'img'    => $uploadRequest["fileName"]
                        );

                        $action_insert = $this->crud_model->create("M_logo_sponsor", $faild);
                        if ($action_insert){
                        	$this->session->set_flashdata('msgLogoMerchantT', 'Upload data success'.$config['upload_path'].$img);
                            header("location: ".$this->config->item('base_url')."pagecontent/sponsor");
                            die;
                        }else{
                        	$this->session->set_flashdata('msgLogoMerchantF', 'gagal input database');
                            header("location: ".$this->config->item('base_url')."pagecontent/sponsor?failed");
                            die;
                        }

                    }else{
                        // Upload Failed
                        $this->session->set_flashdata('msgLogoMerchantF', 'Failed upload image to the portal');
                    }
                }else{
                    $this->session->set_flashdata('msgLogoMerchantF', 'Failed inserting image to database');
                }
                // Now delete local temp file
                header("location: ".$this->config->item('base_url')."pagecontent/sponsor");
            }else{
							$this->session->set_flashdata('msgLogoMerchantF', 'Foto yang di upload tidak sesuai dengan format (gif|jpg|JPG|png|jpeg) atau ukuran lebih dari 100 kb, atau resolusi melebihi dari  160 px dan  45 px');
							  header("location: ".$this->config->item('base_url')."pagecontent/sponsor");
						}

    }
		public function actionUpdatelogo($id)
	    {


	        $name   = $this->input->get_post('name');
	        $url    = !empty($this->input->get_post('url'))?$this->input->get_post('url'):"";

	            $this->load->library("Rapid/RapidDataModel");
	            $config['upload_path']     = './uploads/logo/';
	            $config['allowed_types']   = 'gif|jpg|png|jpeg';
	            $new_name                  = sha1(time()).".".basename($_FILES["userfile"]['name']);
	            $config['encrypt_name']    = TRUE;
	            $config['file_name']       = $new_name;
	            $config['overwrite']       = TRUE;
	            $config['remove_spaces']   = TRUE;
							$config['max_size']             = 100;
							$config['max_width']            = 160;
							$config['max_height']           = 45;
							$config['min_width']            = 10;
							$config['min_height']           = 10;

	            $this->load->library('upload', $config);

							if ($_FILES["userfile"]['size']==0) {
												$faild = array(
														'name'   => $name,
														'url'    => $url
												);

												$update = $this->crud_model->update("M_logo_sponsor", $faild, $id);
												if ($update){
													$this->session->set_flashdata('msgLogoMerchantT', 'Upload data success ');
														header("location: ".$this->config->item('base_url')."pagecontent/sponsor");
														die;
												}else{
													$this->session->set_flashdata('msgLogoMerchantF', 'gagal input database');
														header("location: ".$this->config->item('base_url')."pagecontent/sponsor?failed");
														die;
												}
							}else{




						         if ($this->upload->do_upload('userfile'))
						            {
						                $data = array('upload_data' => $this->upload->data());
						                $file_info = $this->upload->data();
						                $img = $file_info['file_name'];
						                $path =$img;
						                $error = array('error' => $this->upload->display_errors());

						                $this->session->set_flashdata('path',$path);
						                $uploadRequest = array(
						                    'fileName' => basename($this->upload->data()["full_path"]),
						                    'fileData' => base64_encode(file_get_contents($this->upload->data()["full_path"]))
						                );
						                $uploader_id = sha1(uniqid());
						                RapidDataModel::use('default');
						                $create = RapidDataModel::create('F_uploader', array(
						                    array(
						                        "id" => $uploader_id,
						                        "filename" => $uploadRequest["fileName"],
						                        "file_encoded" => $uploadRequest["fileData"],
						                        "date_created" => date("Y-m-d H:i:s")
						                    )
						                ));



						                if ($create) {
						                    $resp2 = shell_exec('curl -k -X POST -F "uploader_id='.$uploader_id.'" '.$this->config->item("assets_url_portal").'/index.php/logo-receiver/');
						                    $resp = json_decode($resp2);

						                    if ($resp->status == 1) {

						                        $faild = array(
						                            'name'   => $name,
						                            'url'    => $url ,
						                            'img'    => $uploadRequest["fileName"]
						                        );

																		$update = $this->crud_model->update("M_logo_sponsor", $faild, $id);
						                        if ($update){
						                        	$this->session->set_flashdata('msgLogoMerchantT', 'Upload data success'.$config['upload_path'].$img);
						                            header("location: ".$this->config->item('base_url')."pagecontent/sponsor");
						                            die;
						                        }else{
						                        	$this->session->set_flashdata('msgLogoMerchantF', 'gagal input database');
						                            header("location: ".$this->config->item('base_url')."pagecontent/sponsor?failed");
						                            die;
						                        }
						                        // Upload Success
						                        $this->session->set_flashdata('msgLogoMerchantT', 'Upload data success'.$config['upload_path'].$img);
						                    }else{
						                        // Upload Failed
						                        $this->session->set_flashdata('msgLogoMerchantF', 'Failed upload image to the portal');
						                    }
						                }else{
						                    $this->session->set_flashdata('msgLogoMerchantF', 'Failed inserting image to database');
						                }
						                // Now delete local temp file
						                header("location: ".$this->config->item('base_url')."pagecontent/sponsor");
						            }else{
																$this->session->set_flashdata('msgLogoMerchantF', 'Foto yang di upload tidak sesuai dengan format (gif|jpg|JPG|png|jpeg) atau ukuran lebih dari 100 kb, atau resolusi melebihi dari  160 px dan  45 px');
																header("location: ".$this->config->item('base_url')."pagecontent/sponsor?failed");
																die;
												}
										}

	    }




    public function do_upload()
    {
            $this->load->library("Rapid/RapidDataModel");
            $config['upload_path']          =   './uploads/home-banner/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $new_name = sha1(time()).".".basename($_FILES["userfile"]['name']);
            $config['encrypt_name'] = TRUE;
            $config['file_name'] = $new_name;
            $config['overwrite'] = TRUE;
            $config['remove_spaces'] = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('userfile'))
            {
                // $this->upload->do_upload('userfile');
                $data = array('upload_data' => $this->upload->data());
                $file_info = $this->upload->data();
                $img = $file_info['file_name'];
                // $path =$this->config->item('assets_url')."uploads/".$img;
                $path =$img;
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('msgalert', 'Upload data Failed,'.$this->upload->display_errors().' please try again');
                //data form isian
                $data['name']       = ($this->input->get_post('name'))?$this->input->get_post('name'):'';
                //data form isian
                $data['sub_title']      = ($this->input->get_post('sub_title'))?$this->input->get_post('sub_title'):'';
                // category_id
                $data['category_id']        = ($this->input->get_post('category_id'))?$this->input->get_post('category_id'):'';
                $data['body']       = ($this->input->get_post('body'))?$this->input->get_post('body'):'';
                // publish_by
                //$data['publish_by']       = ($this->input->get_post('publish_by'))?$this->input->get_post('publish_by'):'';
                $data['status']     = ($this->input->get_post('publish_by'))?$this->input->get_post('status'):'';
                //$data['picture']      = ($this->input->get_post('picture'))?$this->input->get_post('picture'):'';
                $data['video']      = ($this->input->get_post('video'))?$this->input->get_post('video'):'none';
                $data['picture']        = ($this->input->get_post('picture'))?$this->input->get_post('picture'):'none';
                $field      = array(
                    "title" => $data['name'],
                    "sub_title" => $data['sub_title'],
                    "category_id" => $data['category_id'],
                    "body" => $data['body'],
                    "status" => $data['status'],
                    "picture" => basename($this->upload->data()["full_path"]),
                    "video" => $data['video'],
                    "publish_by"=> $this->session->userdata['user_data']['name'] ,
                );
                $this->session->set_flashdata('path',$path);
                $this->session->set_flashdata('field',$field);
                $uploadRequest = array(
                    'fileName' => basename($this->upload->data()["full_path"]),
                    'fileData' => base64_encode(file_get_contents($this->upload->data()["full_path"]))
                );
                $uploader_id = sha1(uniqid());
                RapidDataModel::use('default');
                $create = RapidDataModel::create('F_uploader', array(
                    array(
                        "id" => $uploader_id,
                        "filename" => $uploadRequest["fileName"],
                        "file_encoded" => $uploadRequest["fileData"],
                        "date_created" => date("Y-m-d H:i:s")
                    )
                ));

                if ($create) {
                    $resp2 = shell_exec('curl -k -X POST -F "uploader_id='.$uploader_id.'" '.$this->config->item("assets_url_portal").'/index.php/banner-receiver/');
                    $resp = json_decode($resp2);


                    if ($resp->status == 1) {
                        // Upload Success
                        $this->session->set_flashdata('msgalert', 'Upload data success'.$config['upload_path'].$img);
                    }else{
                        // Upload Failed
                        $this->session->set_flashdata('msgalert', 'Failed upload image to the portal');
                    }
                }else{
                    $this->session->set_flashdata('msgalert', 'Failed inserting image to database');
                }
                // Now delete local temp file
                header("location: ".$this->config->item('base_url')."pagecontent/beranda");
            }

    }

    //////////////////////////////tentang poin serbu update ///////////

    public function tentangUpdate($id)
    {
        $data['description']    = !empty($this->input->get_post('description'))?$this->input->get_post('description'):"";
        $data['description_2']  = !empty($this->input->get_post('description_2'))?$this->input->get_post('description_2'):"";
        $data['url_youtube']  = !empty($this->input->get_post('url_youtube'))?$this->input->get_post('url_youtube'):"";



        $field = array(
            'description'           =>  $data['description'] ,
            'description_2'         =>  $data['description_2'],
            'url_youtube'           =>  $data['url_youtube']
        );
        $update = $this->crud_model->update("M_tentang_poinserbu", $field, $id);

				if($data['url_youtube']!=""){

					if($update){
							 $this->session->set_flashdata('linktrue', 'Sukses update link youtube ');
							header("location: ".$this->config->item('base_url')."pagecontent/tentang#linkyoutube");
							die;
					}else{
							 $this->session->set_flashdata('linkfalse', 'Gagal Update link youtube');
							header("location: ".$this->config->item('base_url')."pagecontent/tentang#linkyoutube");
							die;
					}

				}else{

					if($update){
							 $this->session->set_flashdata('Tentangtrue', 'Sukses update title tentang ');
							header("location: ".$this->config->item('base_url')."pagecontent/tentang");
							die;
					}else{
							 $this->session->set_flashdata('Tentangfalse', 'Gagal Update title tentang');
							header("location: ".$this->config->item('base_url')."pagecontent/tentang?failed");
							die;
					}
				}


    }
    public function addTentanglink()
    {
         $this->load->library("Rapid/RapidDataModel");
           $data['url_youtube']  = !empty($this->input->get_post('url_youtube'))?$this->input->get_post('url_youtube'):"";

             RapidDataModel::use('default');
                $create = RapidDataModel::create('M_tentang_poinserbu', array(
                    array(
                        "type"          => "url",
                        "url_youtube"   => $data['url_youtube']
                    )
                ));
                    if($create){
                         $this->session->set_flashdata('linktrue', 'Sukses insert link youtube');
                        header("location: ".$this->config->item('base_url')."pagecontent/tentang#linkyoutube");
                        die;
                    }else{
                         $this->session->set_flashdata('linkfalse', 'Gagal insert link youtube');
                        header("location: ".$this->config->item('base_url')."pagecontent/tentang#linkyoutube");
                        die;
                    }

    }
    public function deleteTentang()
    {
            $delete_admin   = $this->crud_model->delete("M_tentang_poinserbu", array("id" => $this->uri->segment(3)));
            if($delete_admin){
                $this->session->set_flashdata('msgalert', 'Sukses delete link youtube');
                        header("location: ".$this->config->item('base_url')."pagecontent/tentang#linkyoutube");
                        die;
            }else{
                $this->session->set_flashdata('msgalert', 'Gagal delete link youtube');
                header("location: ".$this->config->item('base_url')."pagecontent/tentang#linkyoutube");
                die;
            }
    }


    public function addTentangMekanisme()
    {
         $this->load->library("Rapid/RapidDataModel");
        $data_post['title']      = !empty($this->input->get_post('title'))?$this->input->get_post('title'):"";
        $data_post['sub_title']  = !empty($this->input->get_post('sub_title'))?$this->input->get_post('sub_title'):"";


         $this->load->library("Rapid/RapidDataModel");
            $config['upload_path']     = './uploads/mekanisme/';
            $config['allowed_types']   = 'gif|jpg|JPG|png|jpeg';
            $new_name                  = sha1(time()).".".basename($_FILES["userfile"]['name']);
            $config['encrypt_name']    = TRUE;
            $config['file_name']       = $new_name;
            $config['overwrite']       = TRUE;
            $config['remove_spaces']   = TRUE;
						$config['max_size']             = 300;
						$config['max_width']            = 467;
						$config['max_height']           = 406;

            $this->load->library('upload', $config);


          if ($this->upload->do_upload('userfile'))
            {

                $data = array('upload_data' => $this->upload->data());
                $file_info = $this->upload->data();
                $img = $file_info['file_name'];
                $path =$img;
                $error = array('error' => $this->upload->display_errors());


                $this->session->set_flashdata('path',$path);
                $uploadRequest = array(
                    'fileName' => basename($this->upload->data()["full_path"]),
                    'fileData' => base64_encode(file_get_contents($this->upload->data()["full_path"]))
                );
                $uploader_id = sha1(uniqid());
                RapidDataModel::use('default');
                $create = RapidDataModel::create('F_uploader', array(
                    array(
                        "id" => $uploader_id,
                        "filename" => $uploadRequest["fileName"],
                        "file_encoded" => $uploadRequest["fileData"],
                        "date_created" => date("Y-m-d H:i:s")
                    )


                ));

                if ($create) {
                    $resp2 = shell_exec('curl -k -X POST -F "uploader_id='.$uploader_id.'" '.$this->config->item("assets_url_portal").'/index.php/mekanisme-receiver/');
                    $resp = json_decode($resp2);


                    if ($resp->status == 1) {

                            RapidDataModel::use('default');
                            $create_tentang_mekanisme = RapidDataModel::create('M_tentang_mekanisme', array(
                                array(
                                    "title"       =>    $data_post['title'],
                                    "sub_title"   =>    $data_post['sub_title'],
                                    "img"         =>    $uploadRequest["fileName"]
                                )
                            ));
                                if($create_tentang_mekanisme){
                                     $this->session->set_flashdata('mekanismetrue', 'Berhasil Upload image ke portal dan simpan data di databse');
                                    header("location: ".$this->config->item('base_url')."pagecontent/tentang");
                                    die;
                                }else{
                                     $this->session->set_flashdata('mekanismefalse', 'Gagal Upload image ke portal dan simpan data di databse');
                                    header("location: ".$this->config->item('base_url')."pagecontent/tentang?failed");
                                    die;
                                }

                         }else{
                        // Upload Failed
                        $this->session->set_flashdata('mekanismefalse', 'Failed upload image to the portal');
												header("location: ".$this->config->item('base_url')."pagecontent/tentang");
				 							 die;

                        }

                }else{

                    $this->session->set_flashdata('mekanismefalse', 'Failed inserting image to database');
										header("location: ".$this->config->item('base_url')."pagecontent/tentang");
		 							 	die;


                }




            }else{
							$this->session->set_flashdata('mekanismefalse', 'Foto yang di upload tidak sesuai dengan format (gif|jpg|JPG|png|jpeg) atau ukuran lebih dari 300 kb, atau resolusi melebihi dari  467 px dan  406px');
							// $this->session->set_flashdata('msgalert', $this->upload->display_errors());

							 header("location: ".$this->config->item('base_url')."pagecontent/tentang");
							 die;
						}




    }
    public function deleteTentangMekanisme()
    {

			 $delete_admin   = $this->crud_model->delete("M_tentang_mekanisme", array("id" => $this->uri->segment(3)));

			 if($delete_admin){
					 $this->session->set_flashdata('mekanismetrue', 'Delete Success Mekanisme');
					 header("location: ".$this->config->item('base_url')."pagecontent/tentang#mekanisme");
									 die;
			 }else{
						$this->session->set_flashdata('mekanismefalse', 'Delete not success Mekanisme !!!');
					 header("location: ".$this->config->item('base_url')."pagecontent/tentang#mekanisme");
					 die;
			 }


    }

    public function updateMekanisme($id)
    {
        $this->load->library("Rapid/RapidDataModel");
        $data_post['title']      = !empty($this->input->get_post('title'))?$this->input->get_post('title'):"";
        $data_post['sub_title']  = !empty($this->input->get_post('sub_title'))?$this->input->get_post('sub_title'):"";

					// print_r($_FILES);
					// die();

        if($_FILES["userfiles"]['size'] == 0 && $_FILES["userfiles"]['name'] == ""){

            $field = array(
            'title'     =>  $data_post['title'] ,
            'sub_title' =>  $data_post['sub_title']
            );
            $update = $this->crud_model->update("M_tentang_mekanisme", $field, $id);

            if($update){
                 $this->session->set_flashdata('msgalert_mekanisme', 'Sukses update mekanisme');
                        header("location: ".$this->config->item('base_url')."pagecontent/tentang#mekanisme");
                        die;
            }else{
                 $this->session->set_flashdata('msgalert_mekanisme', 'Gagal update mekanisme!!!');
                header("location: ".$this->config->item('base_url')."pagecontent/tentang#mekanisme");
                die;
            }
        }else{
            $this->load->library("Rapid/RapidDataModel");
            $config['upload_path']     			= './uploads/mekanisme/';
            $config['allowed_types']   			= 'gif|jpg|png|jpeg';
            $new_name                  			= sha1(time()).".".basename($_FILES["userfiles"]['name']);
            $config['encrypt_name']    			= TRUE;
            $config['file_name']       			= $new_name;
            $config['overwrite']       			= TRUE;
            $config['remove_spaces']   			= TRUE;
						$config['max_size']             = 300;
						$config['max_width']            = 467;
						$config['max_height']           = 406;


            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('userfiles')) {
								$this->session->set_flashdata('mekanismefalse', 'Foto yang di upload tidak sesuai dengan format (gif|jpg|JPG|png|jpeg) atau ukuran lebih dari 300 kb, atau resolusi melebihi dari  467 px dan  406px');
						    header("location: ".$this->config->item('base_url')."pagecontent/tentang#mekanisme");
                die;
            } else {
                $data = array('upload_data' => $this->upload->data());
                $file_info = $this->upload->data();
                $img = $file_info['file_name'];
                $path =$img;
                $error = array('error' => $this->upload->display_errors());


                $this->session->set_flashdata('path',$path);
                $uploadRequest = array(
                    'fileName' => basename($this->upload->data()["full_path"]),
                    'fileData' => base64_encode(file_get_contents($this->upload->data()["full_path"]))
                );
                $uploader_id = sha1(uniqid());
                RapidDataModel::use('default');
                $create = RapidDataModel::create('F_uploader', array(
                    array(
                        "id" => $uploader_id,
                        "filename" => $uploadRequest["fileName"],
                        "file_encoded" => $uploadRequest["fileData"],
                        "date_created" => date("Y-m-d H:i:s")
                    )


                ));

                $field = array(
                    'title'     =>  $data_post['title'] ,
                    'sub_title' =>  $data_post['sub_title'],
                    'img'       =>  $uploadRequest['fileName']
                    );
                $update = $this->crud_model->update("M_tentang_mekanisme", $field, $id);

                if ($create) {
                    $resp2 = shell_exec('curl -k -X POST -F "uploader_id='.$uploader_id.'" '.$this->config->item("assets_url_portal").'/index.php/mekanisme-receiver/');
                    $resp = json_decode($resp2);


                    if ($resp->status == 1) {

                           $field_2 = array(
                                'title'     =>  $data_post['title'] ,
                                'sub_title' =>  $data_post['sub_title'],
                                'img'       =>  $uploadRequest["fileName"],
                                );
                            $update_tentang_mekanisme = $this->crud_model->update("M_tentang_mekanisme", $field_2, $id);

                                if($update_tentang_mekanisme){
                                     $this->session->set_flashdata('mekanismetrue', 'Berhasil Upload image ke portal dan simpan data di databse');
                                    header("location: ".$this->config->item('base_url')."pagecontent/tentang#mekanisme");
                                    die;
                                }else{
                                     $this->session->set_flashdata('mekanismefalse', 'Gagal Upload image ke portal dan simpan data di databse');
                                    header("location: ".$this->config->item('base_url')."pagecontent/tentang#mekanisme");
                                    die;
                                }

                         }else{
                        // Upload Failed
                        $this->session->set_flashdata('mekanismefalse', 'Failed upload image to the portal');
                        }

                }else{
                    $this->session->set_flashdata('mekanismefalse', 'Failed inserting image to database');
                }
            }
        }

    }

        public function addTentangPerhitungan()
    {
         $this->load->library("Rapid/RapidDataModel");
        $data['poin']           = !empty($this->input->get_post('poin'))?$this->input->get_post('poin'):"";
        $data['description']    = !empty($this->input->get_post('description'))?$this->input->get_post('description'):"";
        $data['type']           = !empty($this->input->get_post('type'))?$this->input->get_post('type'):"";

             RapidDataModel::use('default');
                $create = RapidDataModel::create('M_tentang_perhitungan_poin', array(
                    array(
                        "poin"          => $data['poin'],
                        "description"   => $data['description'],
                        "type"          => $data['type']
                    )
                ));
                if($create){
                     $this->session->set_flashdata('perhitunganPoinTrue', 'sukses insert perhitungan');
                    header("location: ".$this->config->item('base_url')."pagecontent/tentang#perhitunganPoin");
                    die;
                }else{
                     $this->session->set_flashdata('perhitunganPoinFalse', 'Gagal Update !!!');
                    header("location: ".$this->config->item('base_url')."pagecontent/tentang#perhitunganPoin");
                    die;
                }

    }

     public function updateTentangPerhitungan($id)
    {
        $data['poin']         = !empty($this->input->get_post('poin'))?$this->input->get_post('poin'):"";
        $data['description']  = !empty($this->input->get_post('description'))?$this->input->get_post('description'):"";


        // print_r($data);
        // die();
        $field = array(
            'description'  =>  $data['description'] ,
            'poin'         =>  $data['poin']
        );
        $update = $this->crud_model->update("M_tentang_perhitungan_poin", $field, $id);

        if($update){
             $this->session->set_flashdata('perhitunganPoinTrue', 'Sukses update perhitungan');
            header("location: ".$this->config->item('base_url')."pagecontent/tentang#perhitunganPoin");
            die;
        }else{
             $this->session->set_flashdata('perhitunganPoinFalse', 'Gagal update perhitungan !!!');
            header("location: ".$this->config->item('base_url')."pagecontent/tentang#perhitunganPoin");
            die;
        }

    }

        public function deleteTentangPerhitungan()
    {
            $delete_admin   = $this->crud_model->delete("M_tentang_perhitungan_poin", array("id" => $this->uri->segment(3)));

            if($delete_admin){
                $this->session->set_flashdata('perhitunganPoinTrue', 'Delete Success perhitungan data');
                header("location: ".$this->config->item('base_url')."pagecontent/tentang#perhitunganPoin");
                        die;
            }else{
                 $this->session->set_flashdata('perhitunganPoinFalse', 'Delete not success perhitungan data !!!');
                header("location: ".$this->config->item('base_url')."pagecontent/tentang#perhitunganPoin");
                die;
            }
    }


      //////////////////////////////////////////
     //////////Cek Jumlah Poin/////////////////
    //////////////////////////////////////////
    public function addCekJumlahPoin()
    {
          $this->load->library("Rapid/RapidDataModel");
        $data_post['title']      = !empty($this->input->get_post('title'))?$this->input->get_post('title'):"";
        $data_post['sub_title']  = !empty($this->input->get_post('sub_title'))?$this->input->get_post('sub_title'):"";

         $this->load->library("Rapid/RapidDataModel");
            $config['upload_path']     = './uploads/cek_jumlah_poin/';
            $config['allowed_types']   = 'gif|jpg|png|jpeg';
            $new_name                  = sha1(time()).".".basename($_FILES["userfile"]['name']);
            $config['encrypt_name']    = TRUE;
            $config['file_name']       = $new_name;
            $config['overwrite']       = TRUE;
            $config['remove_spaces']   = TRUE;
						$config['max_size']             = 100;
						$config['max_width']            = 111;
						$config['max_height']           = 108;
						$config['min_width']            = 110;
						$config['min_height']           = 107;

            $this->load->library('upload', $config);


          if ($this->upload->do_upload('userfile'))
            {


                $data = array('upload_data' => $this->upload->data());
                $file_info = $this->upload->data();
                $img = $file_info['file_name'];
                $path =$img;
                $error = array('error' => $this->upload->display_errors());


                $this->session->set_flashdata('path',$path);
                $uploadRequest = array(
                    'fileName' => basename($this->upload->data()["full_path"]),
                    'fileData' => base64_encode(file_get_contents($this->upload->data()["full_path"]))
                );
                $uploader_id = sha1(uniqid());
                RapidDataModel::use('default');
                $create = RapidDataModel::create('F_uploader', array(
                    array(
                        "id" => $uploader_id,
                        "filename" => $uploadRequest["fileName"],
                        "file_encoded" => $uploadRequest["fileData"],
                        "date_created" => date("Y-m-d H:i:s")
                    )


                ));

                if ($create) {
                    $resp2 = shell_exec('curl -k -X POST -F "uploader_id='.$uploader_id.'" '.$this->config->item("assets_url_portal").'/index.php/cek_jumlah_poin-receiver/');
                    $resp = json_decode($resp2);


                    if ($resp->status == 1) {

                            RapidDataModel::use('default');
                            $create_tentang_mekanisme = RapidDataModel::create('M_tentang_cek_jumlah_poin', array(
                                array(
                                    "title"       =>    $data_post['title'],
                                    "sub_title"   =>    $data_post['sub_title'],
                                    "img"         =>    $uploadRequest["fileName"]
                                )
                            ));
                                if($create_tentang_mekanisme){
                                     $this->session->set_flashdata('cek_jumlah_pointrue', 'Berhasil Upload image ke portal dan simpan data di databse');
                                    header("location: ".$this->config->item('base_url')."pagecontent/tentang");
                                    die;
                                }else{
                                     $this->session->set_flashdata('cek_jumlah_poinfalse', 'Gagal Upload image ke portal dan simpan data di databse');
                                    header("location: ".$this->config->item('base_url')."pagecontent/tentang?failed");
                                    die;
                                }

                         }else{
                        // Upload Failed
                        $this->session->set_flashdata('cek_jumlah_poinfalse', 'Failed upload image to the portal');
                        }

                }else{

                    $this->session->set_flashdata('cek_jumlah_poinfalse', 'Failed inserting image to database');
                }

            }else{

							$this->session->set_flashdata('cek_jumlah_poinfalse', 'Foto yang di upload tidak sesuai dengan format (gif|jpg|JPG|png|jpeg) atau ukuran lebih dari 100 kb, atau resolusi melebihi dari  111 px dan  108 px');
						  header("location: ".$this->config->item('base_url')."pagecontent/tentang");
							 die;
						}



    }

     public function updateCekJumlahpoin($id)
    {

        $this->load->library("Rapid/RapidDataModel");
        $data_post['title']      = !empty($this->input->get_post('title'))?$this->input->get_post('title'):"";
        $data_post['sub_title']  = !empty($this->input->get_post('sub_title'))?$this->input->get_post('sub_title'):"";



        if($_FILES["userfile"]['size'] == 0){

            $field = array(
            'title'     =>  $data_post['title'] ,
            'sub_title' =>  $data_post['sub_title']
            );
            $update = $this->crud_model->update("M_tentang_cek_jumlah_poin", $field, $id);

            if($update){
                $this->session->set_flashdata('cek_jumlah_pointrue', 'Sukses update cek jumlah poin');
                header("location: ".$this->config->item('base_url')."pagecontent/tentang#cek_jumlah_poinid");
                        die;
            }else{
                $this->session->set_flashdata('cek_jumlah_poinfalse', 'Gagal update cek jumlah poin');
                header("location: ".$this->config->item('base_url')."pagecontent/tentang#cek_jumlah_poinid");
                die;
            }
        }else{


					$this->load->library("Rapid/RapidDataModel");
						 $config['upload_path']     = './uploads/cek_jumlah_poin/';
						 $config['allowed_types']   = 'gif|jpg|JPG|png|jpeg';
						 $new_name                  = sha1(time()).".".basename($_FILES["userfile"]['name']);
						 $config['encrypt_name']    = TRUE;
						 $config['file_name']       = $new_name;
						 $config['overwrite']       = TRUE;
						 $config['remove_spaces']   = TRUE;
						 $config['max_size']             = 100;
						 $config['max_width']            = 111;
						 $config['max_height']           = 108;
						 $config['min_width']            = 110;
 						 $config['min_height']           = 107;


          $upload =  $this->load->library('upload', $config);
					$this->upload->initialize($config);


						if (!$this->upload->do_upload('userfile')) {



							// $this->session->set_flashdata('cek_jumlah_poinfalse',	$this->upload->display_errors().$_FILES["userfile"]['name']  );

								$this->session->set_flashdata('cek_jumlah_poinfalse', 'Foto yang di upload tidak sesuai dengan format (gif|jpg|JPG|png|jpeg) atau ukuran lebih dari 100 kb, atau resolusi melebihi dari  111 px dan  108 px');
								header("location: ".$this->config->item('base_url')."pagecontent/tentang#cek_jumlah_poinid");
								die;
						} else {

                $data = array('upload_data' => $this->upload->data());
                $file_info = $this->upload->data();
                $img = $file_info['file_name'];
                $path =$img;
                $error = array('error' => $this->upload->display_errors());


                $this->session->set_flashdata('path',$path);
                $uploadRequest = array(
                    'fileName' => basename($this->upload->data()["full_path"]),
                    'fileData' => base64_encode(file_get_contents($this->upload->data()["full_path"]))
                );
								// print_r($uploadRequest);
								// die();
                $uploader_id = sha1(uniqid());
                RapidDataModel::use('default');
                $create = RapidDataModel::create('F_uploader', array(
                    array(
                        "id" => $uploader_id,
                        "filename" => $uploadRequest["fileName"],
                        "file_encoded" => $uploadRequest["fileData"],
                        "date_created" => date("Y-m-d H:i:s")
                    )


                ));

                if ($create) {
                    $resp2 = shell_exec('curl -k -X POST -F "uploader_id='.$uploader_id.'" '.$this->config->item("assets_url_portal").'/index.php/cek_jumlah_poin-receiver/');
                    $resp = json_decode($resp2);


                    if ($resp->status == 1) {

                           $field_2 = array(
                                'title'     =>  $data_post['title'] ,
                                'sub_title' =>  $data_post['sub_title'],
                                'img'       =>  $uploadRequest["fileName"],
                                );
                            $update_tentang_mekanisme = $this->crud_model->update("M_tentang_cek_jumlah_poin", $field_2, $id);

                                if($update_tentang_mekanisme){
                                     $this->session->set_flashdata('cek_jumlah_pointrue', 'Berhasil Upload image ke portal dan simpan data di databse');
                                    header("location: ".$this->config->item('base_url')."pagecontent/tentang#cek_jumlah_poinid");
                                    die;
                                }else{
                                     $this->session->set_flashdata('cek_jumlah_poinfalse', 'Gagal Upload image ke portal dan simpan data di databse');
                                    header("location: ".$this->config->item('base_url')."pagecontent/tentang#cek_jumlah_poinid");
                                    die;
                                }

                         }else{
                        // Upload Failed
                        $this->session->set_flashdata('cek_jumlah_poinfalse', 'Failed upload image to the portal');
												header("location: ".$this->config->item('base_url')."pagecontent/tentang#cek_jumlah_poinid");
												die;
                        }

                }else{

                    $this->session->set_flashdata('cek_jumlah_poinfalse', 'Failed inserting image to database');
										header("location: ".$this->config->item('base_url')."pagecontent/tentang#cek_jumlah_poinid");
										die;
                }
        	}
			}
    }
      public function deleteCekJumlahpoin()
    {
			$delete_admin   = $this->crud_model->delete("M_tentang_cek_jumlah_poin", array("id" => $this->uri->segment(3)));

			if($delete_admin){
					$this->session->set_flashdata('cek_jumlah_pointrue', 'Delete Success cek_jumlah_poin');
					header("location: ".$this->config->item('base_url')."pagecontent/tentang#cek_jumlah_poinid");
									die;
			}else{
					 $this->session->set_flashdata('cek_jumlah_poinfalse', 'Delete not success cek_jumlah_poin !!!');
					header("location: ".$this->config->item('base_url')."pagecontent/tentang#cek_jumlah_poinid");
					die;
			}




    }
    public function update_beranda_title($id)
    {
            $this->load->library("Rapid/RapidDataModel");

            $text1 = str_replace('<p>','',$this->input->get_post('text'));
            $text11 = str_replace('</p>','',$text1);

            $text2 = str_replace('<p>','',$this->input->get_post('text_2'));
            $text21 = str_replace('</p>','',$text2);

            $data_post['text']      = !empty($this->input->get_post('text'))?$text11:"";
            $data_post['text_2']  = !empty($this->input->get_post('text_2'))?$text21:"";
            // print_r($data_post);
            // die();
            RapidDataModel::use('default');
               $field_2 = array(
                                'text'     =>  $data_post['text'] ,
                                'text_2' =>  $data_post['text_2'],
                                );

             $update_tentang_mekanisme = $this->crud_model->update("PageBeranda", $field_2, $id);

            if($update_tentang_mekanisme){
                 $this->session->set_flashdata('msgalert', 'Sukses update title beranda');
                        header("location: ".$this->config->item('base_url')."pagecontent/beranda");
                        die;
            }else{
                 $this->session->set_flashdata('msgalert', ' gagal update title beranda');
                header("location: ".$this->config->item('base_url')."pagecontent/beranda?failed");
                die;
            }


    }
    public function updateGetDescription($id)
    {
        $this->load->library("Rapid/RapidDataModel");
            $data_post['description']      = !empty($this->input->get_post('description'))?$this->input->get_post('description'):"";

            RapidDataModel::use('default');
               $field_2 = array(
                                'description'     =>  $data_post['description'] ,
                                );

             $update_tentang_mekanisme = $this->crud_model->update("M_tentang_perhitungan_poin", $field_2, $id);

            if($update_tentang_mekanisme){
                 $this->session->set_flashdata('perhitunganPoinTrue', 'Sukses update description');
                        header("location: ".$this->config->item('base_url')."pagecontent/tentang#cek_jumlah_poinid");
                        die;
            }else{
                 $this->session->set_flashdata('perhitunganPoinFalse', 'Gagal update description');
                header("location: ".$this->config->item('base_url')."pagecontent/tentang#cek_jumlah_poinid");
                die;
            }
    }


    public function update_cek_jumlah_poin($id)
    {
        $this->load->library("Rapid/RapidDataModel");
            $data_post['description']      = !empty($this->input->get_post('description'))?$this->input->get_post('description'):"";

            RapidDataModel::use('default');
               $field_2 = array(
                                'description'     =>  $data_post['description'] ,
                                );

             $update_tentang_mekanisme = $this->crud_model->update("M_tentang_cek_jumlah_poin_des", $field_2, $id);

            if($update_tentang_mekanisme){
                 $this->session->set_flashdata('cek_jumlah_pointrue', 'Sukses Update cek jumlah poin');
                        header("location: ".$this->config->item('base_url')."pagecontent/tentang#cek_jumlah_poinid");
                        die;
            }else{
                 $this->session->set_flashdata('cek_jumlah_poinfalse', 'Gagal Update cek jumlah poin');
                header("location: ".$this->config->item('base_url')."pagecontent/tentang#cek_jumlah_poinid");
                die;
            }
    }
}
 
