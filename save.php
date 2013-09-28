<?php 

$name = $_POST["name"]; 
$description = $_POST["description"]; 
$email = $_POST["email"]; 

require_once "DBManager.php";
$manager = new DBManager();

try {
	$response = $manager->saveDoc($name, $email, $description);
} catch (Exception $e) {
	echo "Error: ".$e->getMessage()." (errcode=".$e->getCode().")\n";
	exit(1);
}

header("Location: home.php");

?>