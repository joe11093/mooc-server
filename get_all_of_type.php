<?php
require_once __DIR__ . '/db_connect.php';

$db = new DB_CONNECT();

//read input
$body = file_get_contents('php://input');
//obtain associative array from the json
$obj = json_decode($body, true);

$type = $obj["type"];
if($type == "matiere" || $type == "annee_scolaire"){
	//query database for table matiere
	$sqlquery = "SELECT * FROM $type;";
	$result = mysql_query($sqlquery) or die(mysql_error());
	if(mysql_num_rows($result) > 0){
		//there are results 
		//encode results into json
		//echo the result
		$res_array = array();
		while ($row=mysql_fetch_assoc($result)){
    		array_push($res_array, array_map("utf8_encode", $row));
   		}
   		//print_r($res_array);
   		echo json_encode($res_array);
	}
		else{
		//no results
		echo "no_results";
	}
	}
	
else{
	echo "error";
}

?>
