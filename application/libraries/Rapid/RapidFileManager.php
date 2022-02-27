<?php  	
	require_once FCPATH . 'system/core/Controller.php';
	class RapidFileManager extends CI_Controller{
		protected static $ci_controller;
		public static $file;
		public static $debug;

		public function __construct(){
			RapidFileManager::$debug = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1);
			RapidFileManager::$file = __FILE__;
			RapidFileManager::$ci_controller = get_instance();
		}
		public static function debug($message, $class = "", $method = ""){
			require_once 'RapidDebuger.php';
		}
		public static function upload($dest, $args = array()){
			RapidFileManager::$ci_controller->load->helper("url");
			RapidFileManager::$ci_controller->load->helper("form");
			if (!empty($dest)) {
				if (!empty($args["file"])) {
					if (!empty($args["allowed_types"])) {
						$allowed_types = implode("|", $args["allowed_types"]);
					}else{
						$allowed_types = "*";
					}
					$allowed_max_size = $args["max-size"] ?? 5000;
		  			$config['upload_path'] = FCPATH . $dest;
		  			if (is_writable($config['upload_path'])) {
			            $config['allowed_types'] = $allowed_types;
			            $config['max_size'] = $allowed_max_size;
			            if (!empty($args["file-name"])) {
			            	$config['file_name'] = $args["file-name"];
			            }
			            if (!empty($args["hash-file-name"]) == true) {
			            	if (!empty($args["file-name"])) {
			            		$config['file_name'] = sha1($args["file-name"]);
			            	}else{
			            		$config['file_name'] = sha1(uniqid());
			            	}
			            }
						RapidFileManager::$ci_controller->load->library('upload', $config);
			           	$upload = RapidFileManager::$ci_controller->upload->do_upload($args["file"]);
			           	if ($upload) {
			           		if (!empty($args["print"]) == true) {
			           			if (!empty($args["pretty"]) == true) {
		        					RapidFileManager::debug(RapidFileManager::$ci_controller->upload->data(), __CLASS__, __FUNCTION__);
			           			}else{
				           			print_r(RapidFileManager::$ci_controller->upload->data());
			           			}
			           		}else{
			           			return RapidFileManager::$ci_controller->upload->data();
			           		}
			           	}else{
			           		if (!empty($args["print"]) == true) {
			           			if (!empty($args["pretty"]) == true) {
		        					RapidFileManager::debug("Failed uploading file", __CLASS__, __FUNCTION__);
			           			}else{
		        					RapidFileManager::debug("Failed uploading file", __CLASS__, __FUNCTION__);
			           			}
			           		}else{
			           			return 0;
			           		}
			           	}
			        }else{
		        		RapidFileManager::debug("Directory you trying to upload is not writable", __CLASS__, __FUNCTION__);
			        }
		        }else{
		        	RapidFileManager::debug("To upload file, Parameter filename is required", __CLASS__, __FUNCTION__);
		        }
	        }
		}
		public static function delete($file){
			if (!empty($file)) {
				if (file_exists(FCPATH . $file)) {
					if (is_readable(FCPATH . $file)) {
						unlink(FCPATH . $file);
					}else{
			        	RapidFileManager::debug("File or directory you trying to access is not readable", __CLASS__, __FUNCTION__);
					}
				}else{
			        RapidFileManager::debug("File or directory you trying to delete is not exist", __CLASS__, __FUNCTION__);
				}
			}else{
		        RapidFileManager::debug("To delete file, you must include file path", __CLASS__, __FUNCTION__);
			}
		}
		private static function lib($name, $ret = ''){
			$lib = array(
				"text/javascript" => array(
					"alias" => "js",
					"path" => APPPATH . "../assets/scripts/js/",
					"url" => base_url() . "assets/scripts/js/"
				),
				"text/css" => array(
					"alias" => "css",
					"path" =>  APPPATH . "../assets/styles/",
					"url" => base_url() . "assets/styles/"
				),
				"image/*" => array(
					"alias" => "png, jpg, jpeg",
					"path" =>  APPPATH . "../assets/images/",
					"url" => base_url() . "assets/images/"
				)
			);
			if ($ret != '') {
				return $lib[$name][$ret];
			}else{
				return $lib[$name];
			}
		}
		public static function scan($args){
			$scanned_files = array();
			$spec_folder = $args["folder"] ?? "";
			if (!empty($args["type"])) {
				$is_dir_exists = is_dir(RapidFileManager::lib($args["type"], 'path') . $spec_folder . "/");
				if ($is_dir_exists == 1) {
					$scan_files = scandir(RapidFileManager::lib($args["type"], 'path') . $spec_folder . "/");
					foreach ($scan_files as $key => $value) {
						if ($value != ".." && $value != ".") {
							if ($value != "") {
								if (pathinfo($value,  PATHINFO_EXTENSION) == RapidFileManager::lib($args["type"], 'alias')) {
									if (!empty($args["get"])) {
										if ($args["get"] == "file") {
											$scanned_files[$key] = $value;
										}elseif ($args["get"] == "extension") {
											$scanned_files[$key] = pathinfo($value, PATHINFO_EXTENSION);
										}elseif ($args["get"] == "name") {
											$scanned_files[$key] = pathinfo($value, PATHINFO_FILENAME);
										}else{
											if ($spec_folder == "") {
												$scanned_files[$key] =  RapidFileManager::lib($args["type"], 'url') . $spec_folder .  $value;
											}else{
												$scanned_files[$key] =  RapidFileManager::lib($args["type"], 'url') . $spec_folder . "/" . $value;
											}
										}
									}else{
										if ($spec_folder == "") {
											$scanned_files[$key] =  RapidFileManager::lib($args["type"], 'url') . $spec_folder .  $value;
										}else{
											$scanned_files[$key] =  RapidFileManager::lib($args["type"], 'url') . $spec_folder . "/" . $value;
										}
									}
								}
							}
						}
					}
				}
			}
			return $scanned_files;
		}
	}	
?>