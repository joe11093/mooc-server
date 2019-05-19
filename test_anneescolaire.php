<?php

require_once __DIR__ . '/db_connect.php';

$db = new DB_CONNECT();

//read input
$body = file_get_contents('php://input');
//obtain associative array from the json
$obj = json_decode($body, true);
$annee = $obj["anneescolaire"];

		$sqlquery = "SELECT id FROM annee_scolaire WHERE annee_scolaire.annee_scolaire = '$annee';";
		$result = mysql_query($sqlquery) or die(mysql_error());
		$row = mysql_fetch_assoc($result);
		if($row)
			echo $row["id"];
		else
			echo "error";
?>