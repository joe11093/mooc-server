<?php
require_once __DIR__ . '/db_connect.php';

$db = new DB_CONNECT();

//read input
$body = file_get_contents('php://input');
//obtain associative array from the json
$obj = json_decode($body, true);
$annee_id = $obj["annee_id"];

if(isset($obj["annee_id"])){
	//query database for table matiere
	$sqlquery = "SELECT * FROM matiere WHERE matiere.id IN (SELECT matiere_annee.id FROM matiere_annee WHERE matiere_annee.annee_id = '$annee_id');";

	$result = mysql_query($sqlquery) or die(mysql_error());
	if(mysql_num_rows($result) > 0){
		$arr = array();
		while ($row=mysql_fetch_assoc($result)){
    		array_push($arr, array_map("utf8_encode", $row));
   		}
   		echo json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
	}
	else{
		//no results
		echo "no_results";
	}
	}


?>
