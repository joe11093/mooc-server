<?php
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

//read input
$body = file_get_contents('php://input');
//obtain associative array from the json
$obj = json_decode($body, true);
$email = $obj["email"];
$password = $obj["password"];

//execute query
$sqlquery = "SELECT * FROM utilisateur WHERE utilisateur.email = '$email';";
$result = mysql_query($sqlquery) or die(mysql_error());
$row = mysql_fetch_assoc($result);

//check query result
if($row){
   if(strcmp($password, $row["password"]) == 0){    //strcmp -> 0 if equal
   		//make array of results to return
   		$response = array("id"=>$row["id"], "firstname" => $row["firstname"], "email"=>$row["email"], "type"=>$row["type"]);
   		$id_ac = $row['id'];
   		$sqlquery = "INSERT INTO activite (user_id, type, date, time, activite_text) VALUES ('$id_ac', 'login', NOW(), NOW(), 'You logged in');";
		$result = mysql_query($sqlquery) or die(mysql_error());
   		echo json_encode($response);
   }
   else{
   	echo "error";
   }
}
else{
	echo "error";
}
?>