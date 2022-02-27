<?php  
	// Openrapid, Royan Zain
	// Copyright 2018, North Jakarta, Indonesia.
	// RapidDataModel is a shortcut to manage your SQL database runs on codeigniter engine
	// When you want to use this library you can directly access your database within your controller
	// Means you only can use this library in codeigniter environment
	// Note that you using database configuration in your database.php file in codeigniter config
	
	// Require CI Model Class
	require_once FCPATH . 'system/core/Model.php';	
	// RapidDataModel Class Extends from CI_model Class
	class RapidDataModel extends CI_model{
		// Define database query
		protected static $db_query;
		// Define database name
		protected static $db_name;
		// Define and inheirit codeigniter model
		protected static $ci_model;
		// Define selected table
		protected static $selected_table;
		// Define tables database
		protected static $tables;
		// Define fields in tables
		protected static $fields;
		// Catch all errors
		protected static $errors = array();
		// get file name
		public static $file;
		// Debug
		public static $debug;
		// Construct class
		public function __construct($db = 'default'){
			parent::__construct();
			RapidDataModel::$debug = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1);
			RapidDataModel::$file = __FILE__;
			RapidDataModel::$ci_model = &get_instance();
			RapidDataModel::$db_name = $db;
			RapidDataModel::$db_query =  RapidDataModel::$ci_model->load->database($db, true);
			RapidDataModel::$tables = RapidDataModel::read_tables();
		}
		// Function to use Database
		public static function use($db){
			RapidDataModel::$db_name = $db;
			RapidDataModel::$db_query = RapidDataModel::$ci_model->load->database($db, true);
			RapidDataModel::$tables = RapidDataModel::read_tables();
			return RapidDataModel::$tables;
		}
		// Function to use table and store it in selected_table variable
		public static function table($tbl){	
			if(!empty($tbl) && !is_array($tbl)){
				if (in_array($tbl, RapidDataModel::$tables)) {
					RapidDataModel::$selected_table = $tbl;
					RapidDataModel::$fields = RapidDataModel::read_fields();
					return RapidDataModel::$fields;
				}else{
					echo RapidDataModel::debug("Table ". $tbl ." is not exist in ". RapidDataModel::$db_name . " database", __CLASS__, __FUNCTION__);
					die;
				}
			}else{
				echo RapidDataModel::debug("You have not defined any table", __CLASS__, __FUNCTION__);
				die;
			}
		}
		// RapidDebugger 
		public static function debug($message, $class = "", $method = ""){
			require_once 'RapidDebuger.php';
		}
		// Query function
		public static function query($args = array()){
			if (!empty($args["query"])) {
				$query = RapidDataModel::$db_query->query($args["query"]);
				if (empty(RapidDataModel::$db_query->error()) || RapidDataModel::$db_query->error()["code"] == 0) {
					if (!empty($args["print"]) == true) {
						print_r($query->result_array());	
					}else{
						return $query->result_array();	
					}
				}else{
					RapidDataModel::debug(RapidDataModel::$db_query->error(), __CLASS__, __FUNCTION__);
				}
			}else{
				RapidDataModel::debug("No query executed", __CLASS__, __FUNCTION__);
			}
		}
		public static function create($tbl = '', $args = array()){
			RapidDataModel::table($tbl);
			if (!empty($args)) {
				if (count($args) > 1) {
					foreach ($args as $value) {
						$create = RapidDataModel::$db_query->insert(RapidDataModel::$selected_table, $value);
					}
				}else{
					$create = RapidDataModel::$db_query->insert(RapidDataModel::$selected_table, $args[0]);
				}
				if ($create) {
					return true;
				}else{
					$error = RapidDataModel::$db_query->error();
					echo json_encode($error);
				}
			}else{
				echo RapidDataModel::debug("Parameter Can't be empty",__CLASS__,  __FUNCTION__);
			}
		}
		public static function read($tbl = '', $args = array()){	
			RapidDataModel::table($tbl);
			$default_fields = RapidDataModel::read_fields();
			$select = implode(", ", $default_fields);
			// Select Fields if its not empty
			if (!empty($args["select"])) {
				$select = $args["select"];
			}
			// Exclude Fields 
			if (!empty($args["exclude_fields"])) {
					// Insert all fields into new variable
					$read_fields = $default_fields;
					// Empty out the default fields
					$fields  = array();
					// Loop Through fields 
					foreach ($read_fields as $key => $value) {
						// Search if between the current field theres an excluded field
						if (!in_array($value, $args['exclude_fields'])) {
							// Register field in to a new temporary variable
							$fields [] = $value;
						}
					}
					// Set the current default fields
					$default_fields = $fields;
					// Set select fields
					$select = implode(", ", $fields);
			}

			// Select Data
			RapidDataModel::$db_query->select($select);

			// Define Table
			if (!empty(RapidDataModel::$selected_table)) {
				RapidDataModel::$db_query->from(RapidDataModel::$selected_table);
			}

			// Join table
			if (!empty($args["join"])) {
				if (is_array($args["join"])) {
					foreach ($args["join"] as $key => $value) {
						if (in_array($key, RapidDataModel::$tables)) {
							RapidDataModel::$db_query->join($key, $value);
						}
					}
				}else{
					RapidDataModel::debug("Join table parameter should be an array containing table and condition", __CLASS__, __FUNCTION__);
					die;
				}
			}
			// Where condition
			if (!empty($args["where"]) && is_array($args["where"])) {
				foreach ($args["where"] as $key => $value) {
					RapidDataModel::$db_query->where($key, $value);
				}
			}
			// Related
			if (!empty($args["related"]) && is_array($args["related"])) {
				foreach ($args["related"] as $key => $value) {
					RapidDataModel::$db_query->like($key, $value);
				}
			}
			// Groups Data
			if (!empty($args["group"])) {
				RapidDataModel::$db_query->group_by($args["group"]);
			}
			// Order 
			if (!empty($args["order"])) {
				RapidDataModel::$db_query->order_by($args["order"][0], $args["order"][1]);
			}
			// Limitation
			if (!empty($args["pagination"]) && is_array($args["pagination"])) {
				if (!empty($args["pagination"]["limit"])) {
					if (!empty($args["pagination"]["start"])) {
						RapidDataModel::$db_query->limit($args["pagination"]["limit"], $args["pagination"]["start"]);
					}
					RapidDataModel::$db_query->limit($args["pagination"]["limit"]);
				}
			}
			// Query Result
			$result = RapidDataModel::$db_query->get();
			if ($result) {
				if (!empty(RapidDataModel::$db_query->error())) {
					$responses = array();
					$responses["from"] = array("database" =>RapidDataModel::$db_name,  "table" => RapidDataModel::$selected_table);
					$responses["rows"] = $result->result_array();
					if (!empty($args["fields"]) == true) {
						$responses["fields"] = $default_fields;
					}
					if (!empty($args["info"]) == true) {
						$responses["info"] = $result->conn_id;
					}
					if (!empty($args["print"]) == true) {
						if (!empty($args["pretty"]) == true) {
		        			RapidFileManager::debug($responses, __CLASS__, __FUNCTION__);
			           	}else{
				           	print_r($responses);
			           	}
					}else{
						return $responses;
					}
				}
			}else{
				$error = RapidDataModel::$db_query->error();
				RapidDataModel::debug($error, __CLASS__, __FUNCTION__);
			}
		}

		public static function is_exist($tbl, $args = array()){
			RapidDataModel::table($tbl);
			if (!empty($tbl)) {
				if (!empty($args)) {
					RapidDataModel::$db_query->select("COUNT(*) as isFound");
					RapidDataModel::$db_query->from(RapidDataModel::$selected_table);
					RapidDataModel::$db_query->where(key($args), $args[key($args)]);
					if (RapidDataModel::$db_query->get()->row("isFound") > 0) {
						return true;
					}else{
						return false;
					}
				}else{
					RapidDataModel::debug("To find a spesific data you need to include key in your parameter", __CLASS__, __FUNCTION__);
				}
			}else{
				RapidDataModel::debug("You have not defined any table", __CLASS__, __FUNCTION__);
			}
		}

		public static function is_duplicate($tbl, $args = array()){
			RapidDataModel::table($tbl);
			if (!empty($tbl)) {
				if (!empty($args["key"])) {
					if (in_array(key($args["key"]), RapidDataModel::$fields)) {
						RapidDataModel::$db_query->select("COUNT(*) as RowFound");
						RapidDataModel::$db_query->from(RapidDataModel::$selected_table);
						RapidDataModel::$db_query->where(key($args["key"]), $args["key"][key($args["key"])]);
						$result = RapidDataModel::$db_query->get()->row()->RowFound;
						if  ($result > 0) {
							return true;
						}else{
							return false;
						}
					}else{
						RapidDataModel::debug("The key you specified is not exist in table " . RapidDataModel::$selected_table, __CLASS__, __FUNCTION__);
					}
				}else{
					RapidDataModel::debug("To find duplicated data please include key parameter in your request", __CLASS__, __FUNCTION__);
				}
			}else{
				RapidDataModel::debug("You have not defined any table", __CLASS__, __FUNCTION__);
			}
		}

		public static function update($tbl, $args = array()){
			RapidDataModel::table($tbl);
			if (!empty($args["key"])) {
				$update_key = $args["key"];
			}
			if (!empty($args["data"])) {
				if (is_array($args["data"])) {
					foreach ($args["data"] as $key => $value) {
						if (in_array($key, RapidDataModel::$fields)) {
							$update = RapidDataModel::$db_query->update($tbl, array($key => $value), $update_key ?? array());
							if (!empty($args["redirect"])) {
								if ($args["redirect"][0] == "success") {
									if ($update == 1) {
										redirect($args["redirect"][1]);
									}
								}elseif ($args["redirect"][0] == "failed") {
									if ($update == 0) {
										redirect($args["redirect"][1]);
									}
								}
							}else{
								return $update;
							}
						}else{
							RapidDataModel::debug("Can't find field ". $key . " in $tbl", __CLASS__,  __FUNCTION__ );
							die;
						}
					}
				}else{
					RapidDataModel::debug("To update data, Parameter data should be an array contains field as key and filed value as value", __CLASS__, __FUNCTION__);
					die;
				}
			}else{
				RapidDataModel::debug("To update data, Paramater data can't be empty", __CLASS__, __FUNCTION__);
				die;
			}
		}

		public static function delete($tbl, $args = array()){
			RapidDataModel::table($tbl);
			if (!empty($args["key"])) {
				$delete = RapidDataModel::$db_query->delete($tbl, $args["key"]);
				if (in_array(key($args["key"]), RapidDataModel::$fields)) {
					if (!empty($args["redirect"])) {
						if ($args["redirect"][0] == "success") {
							if ($delete == 1) {
								redirect($args["redirect"][1]);
							}
						}elseif ($args["redirect"][0] == "failed") {
							if ($delete == 0) {
								redirect($args["redirect"][1]);
							}
						}
					}else{
						return $delete;
					}
				}else{
					RapidDataModel::debug("Can't find field ". $args["key"] . " in $tbl", __CLASS__, __FUNCTION__ );
					die;
				}
			}else{
				RapidDataModel::debug("To delete data, Paramater key is required",  __CLASS__,__FUNCTION__ );
				die;
			}
		}
		
		public static function read_tables(){
        	return RapidDataModel::$db_query->list_tables();        	
		}
			
		public static function read_fields($exlcudes = array(), $tbl = ''){
			if ($tbl != '') {
				if (!empty($exlcudes) && is_array($exlcudes)) {
					$fields = array();
					foreach (RapidDataModel::$db_query->list_fields($tbl) as $key => $value) {
						if (!in_array($value, $exlcudes)) {
							$fields [] = $value;
						}
					}
					return $fields;
				}else{
        			return RapidDataModel::$db_query->list_fields($tbl);
        		}
			}else{
				if (!empty($exlcudes) && is_array($exlcudes)) {
					$fields = array();
					foreach (RapidDataModel::$db_query->list_fields(RapidDataModel::$selected_table) as $key => $value) {
						if (!in_array($value, $exlcudes)) {
							$fields [] = $value;
						}
					}
					return $fields;
				}else{
        			return RapidDataModel::$db_query->list_fields(RapidDataModel::$selected_table);
				}
			}
		}
	}
?>