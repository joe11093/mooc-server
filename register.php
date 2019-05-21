<?php
require_once __DIR__ . '/db_connect.php';

$db = new DB_CONNECT();

//read input
$body = file_get_contents('php://input');
//obtain associative array from the json
$obj = json_decode($body, true);
$firstname = $obj["firstname"];
$lastname = $obj["lastname"];
$dob = $obj["dob"];
$email = strtolower($obj["email"]);
$password = $obj["password"];
$city = $obj["city"];
$country = $obj["country"];
$anneescolaire = $obj["anneescolaire"];
$type = $obj["type"];
//check if already exists
$sqlqueryexists = "SELECT id FROM utilisateur WHERE utilisateur.email = '$email';";
	$result = mysql_query($sqlqueryexists) or die(mysql_error());
	if(mysql_fetch_row($result)){
		//if already exists in db
		echo "false";
	}
	else{
		//get id of année scolaire
		$sqlqueryexists = "SELECT id FROM annee_scolaire WHERE annee_scolaire.annee_scolaire = '$anneescolaire';";
		$result = mysql_query($sqlqueryexists) or die(mysql_error());
		$row = mysql_fetch_assoc($result);
		if($row){
			//if already exists in db
			$annee_id = $row['id'];
		}

		//student
		if($type == "student"){
			//without parent
			if(!isset($obj["parent"])){
				//insert into user
				$sqlquery = "INSERT INTO utilisateur (firstname, lastname, dateofbirth, email, password, city, country, type) VALUES ('$firstname', '$lastname', '$dob', '$email', '$password', '$city', '$country', '$type');";

				$result = mysql_query($sqlquery) or die(mysql_error());
				//get inserted ID
				$inserted_id = mysql_insert_id();
 				// insert into student using the last id
				$sqlquery = "INSERT INTO student (id, annee_scolaire) VALUES ('$inserted_id', $annee_id);";
				$result = mysql_query($sqlquery) or die(mysql_error());
				$sqlquery = "INSERT INTO activite (user_id, type, date, time, activite_text) VALUES ('$inserted_id', 'singup', NOW(), NOW(), 'You signed up');";
				$result = mysql_query($sqlquery) or die(mysql_error());
				echo "true";
				}

			}
		//parent		
		elseif($type == "parent"){

		}		


		}
?>