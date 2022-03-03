<?php

class Project extends MX_Controller{
	public function __construct(){
		parent::__construct();

		if (!$this->ion_auth->logged_in()){
			redirect('auth/login','refresh');
		}

		//Do your magic here
		$this->load->model('app_model','mapp');
		$this->load->model('project_model','mproject');
		$this->load->helper('project');
	}

	public function index(){
		$projectwhere = array(
			'sDeleteStatus' => NULL
		);
		$data['project'] = $this->mapp->getData('tm_project',$projectwhere);

		$this->load->view('templates/header');
		$this->load->view('project',$data);
		$this->load->view('templates/footer');
	}

	public function lists(){
        $list = $this->mproject->getData();
        $data = array();
        $no   = (isset($_POST['start']) ? $_POST['start'] : 0);

        foreach ($list as $project)
        {
            $no++;
            $row    = array();
            $row[]  = $no;
			$row[]  = $project->sProject;
			$row[]  = (isset($project->sClient) ? $project->sClient : "-");
			$row[]  = getKategori($project->nID);	
			$row[]	= substr(strip_tags($project->sDeskripsi), 0,100);
            $row[]  = ($project->sStatus==1 ? 'Active' : 'Tidak Aktif');
            $row[]  = actionField('project',$project->nID);

            $data[] = $row;
        }

        $output = array(
            "draw"            => (isset($_POST['draw']) ? $_POST['draw'] : ""),
            "recordsTotal"    => $this->mproject->countAll(),
            "recordsFiltered" => $this->mproject->countFiltered(),
            "data"            => $data,
        );

        echo json_encode($output);
	}
	
	public function deleteimagekontent(){
		$reqs = $this->input->get();
		$req['nID'] = $reqs['id'];
		$req['table'] = 'tm_project_gallery';
		deleteDataPermanent($req);
	}

	public function data(){
		
		$view = $this->input->get('view');
		$data['req']  = $req = $this->input->post();
		$projectwhere = array(
			'sDeleteStatus' => NULL
		);

		if(isset($req['submit'])){
			if(isset($_FILES["sImages"]["type"])){
				$validextensions = array("jpeg", "jpg", "png","gif");
				$temporary = explode(".", $_FILES["sImages"]["name"]);

				$namaproject = strtolower(str_replace(array(' ','/'), '', $this->input->post('sProject')));
				$path = $_FILES['sImages']['name'];
				$ext = pathinfo($path, PATHINFO_EXTENSION);

				$file_extension = end($temporary);
				if ((($_FILES["sImages"]["type"] == "image/png") || ($_FILES["sImages"]["type"] == "image/jpg") || ($_FILES["sImages"]["type"] == "image/jpeg") || ($_FILES["sImages"]["type"] == "image/gif"))  && in_array($file_extension, $validextensions)) { 
					if ($_FILES["sImages"]["error"] > 0){
						echo "Return Code: " . $_FILES["sImages"]["error"] . "<br/><br/>";
					}else{
						$sourcePath = $_FILES['sImages']['tmp_name']; // Storing source path of the file in a variable
						$targetPath = "assets/img/project/".md5($namaproject).'.'.$ext; // Target path where file is to be stored
						move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
						$req['sImages'] = md5($namaproject).'.'.$ext;
					}
				}
			}

			$req['sProjectGallery'] = array();
            foreach($_FILES['sImagesKontent']["tmp_name"] as $key=>$tmp_name){
				if(isset($_FILES["sImagesKontent"]["type"])){
                    $validextensions = array("png","jpg","jpeg");
                    $temporary = explode(".", $_FILES["sImagesKontent"]["name"][$key]);

                    
                    $path = $_FILES['sImagesKontent']['name'][$key];
                    $namaproject = strtolower(str_replace(array(' ','/'), '', $this->input->post('sProject')));
                    $ext = pathinfo($path, PATHINFO_EXTENSION);

                    $file_extension = end($temporary);
                    if (($_FILES["sImagesKontent"]["type"][$key] == "image/jpg" || $_FILES["sImagesKontent"]["type"][$key] == "image/jpeg" || $_FILES["sImagesKontent"]["type"][$key] == "image/png") && in_array($file_extension, $validextensions)) {
                        if ($_FILES["sImagesKontent"]["error"][$key] > 0){
                            //echo "Return Code: " . $_FILES["sImagesKontent"]["error"] . "<br/><br/>";
                            echo "gagal";exit;
                        }else{
							$namaproject = md5($namaproject.rand(0000,9999));
                            $sourcePath = $_FILES['sImagesKontent']['tmp_name'][$key]; // Storing source path of the file in a variable
                            $targetPath = "assets/img/project/".$namaproject.'.'.$ext; // Target path where file is to be stored
							move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
                            $req['sProjectGallery'][] = $namaproject.'.'.$ext;
                        }
                        
                    }
                }
			}

			$this->mproject->project($req);
		}
		$req = $this->input->get();
		if (isset($req['delete'])) 
        {
            if (isset($req['nID'])) 
            {
                $req['table'] = 'tm_project';
                deleteData($req);
            }
        }

		$data['project'] = $this->mapp->getData('tm_project',$projectwhere);
		
		if(isset($req['edit'])){
			if(isset($req['nID'])){
				$projectwhere['nID'] = $req['nID'];
				$data['project'] = $this->mapp->getOneData('tm_project',$projectwhere);
				$data['gallery'] = $this->mapp->getData('tm_project_gallery',array('nIDProject' => $req['nID']));
			}
		}
		$data['client'] = $this->mapp->getData('tm_client',array('sDeleteStatus' => NULL));
		$data['site'] = $this->mapp->getData('tm_site',array('sDeleteStatus' => NULL));
		$data['kategori'] = $this->mapp->getData('tm_project_kategori',array('sDeleteStatus' => NULL));
		
		
		if(isset($data)){
			$this->load->view($view,$data);
		}else{
			$this->load->view($view);
		}
	}
}
