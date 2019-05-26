<?php
require_once __DIR__ . '/db_connect.php';

$db = new DB_CONNECT();

//read input
$body = file_get_contents('php://input');
//obtain associative array from the json
$obj = json_decode($body, true);

if(isset($obj["activite_text"])){
	$user_id = $obj["user_id"];
	$type = $obj["type"];
	$ref = $obj["ref"];
	$activite_text = $obj["activite_text"];


	$sqlquery = "INSERT INTO activite (user_id, type, ref, date, time, activite_text) VALUES ('$user_id', '$type', $ref, NOW(), NOW(), '$activite_text');";
	$result = mysql_query($sqlquery) or die(mysql_error());
}
else{
	echo "error";
}
?>