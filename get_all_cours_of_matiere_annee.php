<?php
//get all videos of a matiere annee
//input parameters are matiere id and annee id

require_once __DIR__ . '/db_connect.php';

$db = new DB_CONNECT();

//read input
$body = file_get_contents('php://input');
//obtain associative array from the json
$obj = json_decode($body, true);

if(isset($obj["annee_id"])){
	$matiere_id = $obj["matiere_id"];
	$annee_id = $obj["annee_id"];
	//query database for table matiere
	$sqlquery = "SELECT * FROM fiche_de_cours WHERE fiche_de_cours.matiere_id = '$matiere_id' AND fiche_de_cours.annee_id = '$annee_id' ORDER BY fiche_de_cours.chapitre ASC";
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
?><?php

?>