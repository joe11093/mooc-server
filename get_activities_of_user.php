<?php
//get all activities related to a user

require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

//read input
$body = file_get_contents('php://input');
//obtain associative array from the json
$obj = json_decode($body, true);

if(isset($obj["user_id"])){
	$user_id = $obj["user_id"];

	//query database for table matiere
	$sqlquery = "SELECT * FROM activite	  WHERE activite.user_id = '$user_id' AND activite.type NOT IN ('login','signup') ORDER BY activite.date, activite.time DESC";
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
else{
	echo "error";
}
?>