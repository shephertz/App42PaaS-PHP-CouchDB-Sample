<?php 
require_once "./lib/couch.php";
require_once "./lib/couchClient.php";
require_once "./lib/couchDocument.php";

class DBManager {

	public $client;
	
	public function __construct() {
		
		$lines = file("Config.properties"); 
		foreach ($lines as $line) {
			list($k, $v) = explode('=', $line);
			if (rtrim(ltrim($k)) == rtrim(ltrim("app42.paas.db.username"))) {
				$user = rtrim(ltrim($v));
			}if (rtrim(ltrim($k)) == rtrim(ltrim("app42.paas.db.port"))) {
				$port = rtrim(ltrim($v));
			}if (rtrim(ltrim($k)) == rtrim(ltrim("app42.paas.db.password"))) {
				$password = rtrim(ltrim($v));
			}if (rtrim(ltrim($k)) == rtrim(ltrim("app42.paas.db.ip"))) {
				$ip = rtrim(ltrim($v));
			}if (rtrim(ltrim($k)) == rtrim(ltrim("app42.paas.db.name"))) {
				$dbName = rtrim(ltrim($v));
			}
		}
			$couch_dsn = "http://$user:$password@$ip:$port/";
			$options = array();
			$options['user'] = $user; 
			$options['pass'] = $password;
			
       
	   try{
			$this->client = new couchClient($couch_dsn,$dbName,$options);
	   } catch(Exception $e){
			$this->client = new couchClient($couch_dsn,$dbName,$options);
			$this->client->createDatabase();
	   }	
    }

	
	function saveDoc($name, $email, $description) {
		
		$data = new stdClass();
		$data->name = $name;
		$data->email= $email;
		$data->description = $description;
		
		try {
			$response = $this->client->storeDoc($data);
		} catch (Exception $e) {
			echo "Error: ".$e->getMessage()." (errcode=".$e->getCode().")\n";
			exit(1);
		}
    }
	
	function getAllDocs() {
		
		$result = $this->client->getAllDocs();
		return $result->rows;
    }
	
	function getDocById($id) {
		$result = $this->client->getDoc($id);
		return $result;
    }

}

?>