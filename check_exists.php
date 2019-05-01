<?php
require_once __DIR__ . '/db_connect.php';

/* array for JSON response */
$response = array();

$db = new DB_CONNECT();
$body = file_get_contents('php://input');
//echo $body;

$obj = json_decode($body, true);
//echo $obj["type"];

$type = $obj["type"];
if($type == "user"){
	$email = $obj["email"];
	//echo $email;

	$sqlquery = "SELECT id FROM utilisateur WHERE utilisateur.email = '$email';";
	$result = mysql_query($sqlquery) or die(mysql_error());
	if(mysql_fetch_row($result)){
		echo "true";
	}
	else{
		echo "false";
	}
}

?>